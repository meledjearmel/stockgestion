<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Article;
use App\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PhpParser\Node\Scalar\String_;

/**
 * Class WarehouseController
 * @package App\Http\Controllers
 */
class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $warehouses = Warehouse::all();
        return view('owners.warehouses.all', compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('owners.warehouses.create');
    }

    /**
     * @param $model
     * @return mixed
     */
    private function sum ($model)
    {
        $used = DB::table('article_warehouse')
            ->select(DB::raw('sum(quantity) as total'))
            ->where('warehouse_id', '=', $model->id)
            ->get();

        return $used[0]->total;
    }

    /**
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function valid(array $data){
        $messages = [
            'required'    => 'Ce champs est requis.',
            'min'    => 'Un minimun de :min est requis pour ce champs.',
            'numeric' => 'Ce champs doit contenir uniquement des chiffres.',
            'regex' => 'Mauvais format du champs'
        ];

        return Validator::make($data, [
            'name' => 'required|regex:/^[a-z][a-z0-9 ]+/i|min:3',
            'location' => 'required|regex:/^[a-z][a-z0-9 \-,]+/i|min:3',
            'capacity' => 'required|numeric',
        ], $messages);
    }

    /**
     * @param String $str
     * @return object
     */
    private function slugDecompose (String $str)
    {
        $parts = explode('/', $str);
        $username = $parts[0];
        $name = ucwords(str_replace('-', ' ', $parts[1]));
        $id = $parts[2];

        return (object) [
            'username' => $username,
            'name' => $name,
            'id' => $id,
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validator = $this->valid($request->all());

        if ($validator->fails()) {
            return redirect('warehouse/create')
                ->withErrors($validator)
                ->withInput();
        }

        $admin = Admin::find(Auth::id());
        $warehouse = Warehouse::create($request->all())->admin()->associate($admin);
        $warehouse->save();
        $success = true;
        return redirect()->route('warehouse.create')->with(['success' => $success]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $used = $this->sum($warehouse);

        $articles = [];

        foreach ($warehouse->articles as $article) {
            if ($article->pivot->quantity > 0) {
                $tmp = [
                    'name' => $article->name,
                    'value' => $article->pivot->quantity,
                ];

                array_push($articles, $tmp);
            }
        }

        if (empty($articles))
        {
            $articles = [
                0 => [
                    'name' => 'Vide',
                    'value' => 100,
                ]
            ];
        }

        return view('owners.warehouses.show.index', compact('warehouse', 'used', 'articles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        return view('owners.warehouses.edit', compact('warehouse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $warehouse = Warehouse::findOrFail($id);
        if(!empty($warehouse)) {
            $validator = $this->valid($request->all());

            if ($validator->fails()) {
                return redirect('warehouse/'.$id.'/edit')
                    ->withErrors($validator)
                    ->withInput();
            }

            if ($warehouse->name !== $request->get('name')) {
                $warehouse->name = $request->get('name');
            }
            if ($warehouse->location !== $request->get('location')) {
                $warehouse->location = $request->get('location');
            }
            if ($warehouse->capacity !== $request->get('capacity')) {
                $warehouse->capacity = $request->get('capacity');
            }

            $warehouse->save();

            $nameChange = $warehouse->wasChanged('name');
            $localChange = $warehouse->wasChanged('location');
            $capChange = $warehouse->wasChanged('capacity');

            return redirect()->route('warehouse.edit', $id)->with(['nameChange' => $nameChange, 'capChange' => $capChange, 'localChange' => $localChange]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, $id)
    {
        $admin = Admin::findOrFail(Auth::id());
        $warehouse = $admin->warehouses()->where('id', $id)->get()->toArray();


        if(!empty($warehouse)) {

            $validator = Validator::make($request->all(), [
                'slugDelete' => 'required|regex:/^[a-z][a-z0-9\-]+\/[a-z0-9\-]+\/[0-9]+$/i|min:3',
            ]);


            if ($validator->fails()) {
                return redirect ( '/warehouse/' . $id . '/settings' );
            }



            $warehouse = (object) $warehouse[0];
            $datas = $this->slugDecompose($request->get('slugDelete'));

            $name = ucwords(strtolower($warehouse->name));

            if ($admin->username === $datas->username && $warehouse->id == $datas->id && $name === $datas->name) {
                $admin->warehouses()->where('id', $id)->delete();

                return redirect()->route('warehouse.index')->with(['success' => true, 'name' => $warehouse->name]);
            }

            return redirect ( '/warehouse/' . $id . '/settings' );

        }

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function supplyIndex ($id)
    {
        $articles = Article::all();
        $warehouse = Warehouse::findOrFail($id);
        $used = $this->sum($warehouse);
        return view('owners.warehouses.show.supply', compact('warehouse', 'articles', 'used'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function transaction ($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        return view('owners.warehouses.show.transaction', compact('warehouse'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSetting ($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $warehouseSlug = Str::slug($warehouse->name);
        $username = $warehouse->admin()->first()->username;
        $warehouseSlug = $username . '/' . $warehouseSlug . '/' . $warehouse->id;
        return view('owners.warehouses.show.setting', compact('warehouse', 'warehouseSlug'));
    }
}
