<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Article;
use App\Sellpoint;
use App\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * Class SellpointController
 * @package App\Http\Controllers
 */
class SellpointController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $sellpoints = Sellpoint::all();
        return view('owners.sellpoints.all', compact('sellpoints'));
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('owners.sellpoints.create');
    }

    /**
     * @param $model
     * @return mixed
     */
    private function sum ($model)
    {
        $used = DB::table('article_sellpoint')
            ->select(DB::raw('sum(quantity) as total'))
            ->where('article_id', '=', $model->id)
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
            'regex' => 'Mauvais format du champs'
        ];

        return Validator::make($data, [
            'name' => 'required|regex:/^[a-z][a-z0-9 \-]+/i|min:3',
            'location' => 'required|regex:/^[a-z][a-z0-9 \-,]+/i|min:3',
        ], $messages);
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
            return redirect('sellpoint/create')
                ->withErrors($validator)
                ->withInput();
        }

        $admin = Admin::find(Auth::id());
        $sellpoint = Sellpoint::create($request->all())->admin()->associate($admin);
        $sellpoint->save();
        $success = true;
        return redirect()->route('sellpoint.create')->with(['success' => $success]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $sellpoint = Sellpoint::findOrFail($id);

        $articles = [];

        foreach ($sellpoint->articles as $article) {
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

        return view('owners.sellpoints.show.index', compact('sellpoint', 'articles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $sellpoint = Sellpoint::findOrFail($id);
        return view('owners.sellpoints.edit', compact('sellpoint'));
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
        $sellpoint = Sellpoint::findOrFail($id);
        if(!empty($sellpoint)) {
            $validator = $this->valid($request->all());

            if ($validator->fails()) {
                return redirect('warehouse/'.$id.'/edit')
                    ->withErrors($validator)
                    ->withInput();
            }

            if ($sellpoint->name !== $request->get('name')) {
                $sellpoint->name = $request->get('name');
            }
            if ($sellpoint->location !== $request->get('location')) {
                $sellpoint->location = $request->get('location');
            }

            $sellpoint->save();

            $nameChange = $sellpoint->wasChanged('name');
            $localChange = $sellpoint->wasChanged('location');

            return redirect()->route('sellpoint.edit', $id)->with(['nameChange' => $nameChange, 'localChange' => $localChange]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $admin = Admin::findOrFail(1);
        $sellpoint = $admin->sellpoints()->where('id', $id)->get()->toArray();


        if(!empty($sellpoint)) {

            $validator = Validator::make($request->all(), [
                'slugDelete' => 'required|regex:/^[a-z][a-z0-9\-]+\/[a-z0-9\-]+\/[0-9]+$/i|min:3',
            ]);


            if ($validator->fails()) {
                return redirect('/warehouse/' . $id . '/settings');
            }


            $sellpoint = (object)$sellpoint[0];
            $datas = $this->slugDecompose($request->get('slugDelete'));

            $name = ucwords(strtolower($sellpoint->name));

            if ($admin->username === $datas->username && $sellpoint->id == $datas->id && $name === $datas->name) {
                $admin->sellpoints()->where('id', $id)->delete();

                return redirect()->route('warehouse.index')->with(['success' => true, 'name' => $sellpoint->name]);
            }

            return redirect('/sellpoint/' . $id . '/settings');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function supplyIndex ($id)
    {
        $warehouses = Warehouse::select('id','name')->get();
        $sellpoint = Sellpoint::findOrFail($id);
        return view('owners.sellpoints.show.supply', compact('sellpoint', 'warehouses'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function transaction ($id)
    {
        $sellpoint = Sellpoint::findOrFail($id);
        return view('owners.sellpoints.show.transaction', compact('sellpoint'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSetting ($id)
    {
        $sellpoint = Sellpoint::findOrFail($id);
        $sellpointSlug = Str::slug($sellpoint->name);
        $username = $sellpoint->admin()->first()->username;
        $sellpointSlug = $username . '/' . $sellpointSlug . '/' . $sellpoint->id;
        return view('owners.sellpoints.show.setting', compact('sellpoint', 'sellpointSlug'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function warehouseJson ($id)
    {

        $warehouse = Warehouse::findOrFail($id);

        $articles = [];

        foreach ($warehouse->articles as $article) {

            if ($article->pivot->quantity > 0) {
                $tmp = [
                    'id' => $article->id,
                    'name' => $article->name,
                    'value' => $article->pivot->quantity,
                ];

                array_push($articles, $tmp);
            }

        }

        return response()->json($articles);

    }

}
