<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Article;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\StringInput;

class ArticleController extends Controller
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

        $articles = Article::all();
        return view('owners.articles.all', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('owners.articles.create');
    }

    /**
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function valid(array $data, $whithDescribe = true, $withImage = true, $update = false){


        $messages = [
            'required' => 'Ce champs est requis.',
            'min' => 'Un minimun de :min caractères est requis pour ce champs.',
            'regex' => 'Mauvais format du champs',
            'size' => 'Le code doit faire exactement :size caractères',
            'image' => 'Charger une image',
            'mimes' => 'Charger l\'image dans un format jpg,jpeg ou png',
            'max' => 'La taille de l\'image ne doit pas depasser 1Mo',
            'numeric' => 'Ce champs doit contenir uniquement des chiffes',
            'unique' => 'Le code a déjà été utilisé pour un article',
            ''
        ];

        if($update) {
            return Validator::make($data, [
                'name' => 'required|regex:/^[a-z][a-z0-9 \-]+/i|min:3',
                'caracts' => $whithDescribe ? 'regex:/^[a-z][a-z0-9 \-,]+/i|min:3' : 'nullable',
                'img_url' => $withImage ? 'image|mimes:jpg,jpeg,png|max:1000' : 'nullable',
                'price' => 'required|numeric|min:1',
            ], $messages);
        }

        return Validator::make($data, [
            'name' => 'required|regex:/^[a-z][a-z0-9 \-]+/i|min:3',
            'caracts' => $whithDescribe ? 'regex:/^[a-z][a-z0-9 \-,]+/i|min:3' : 'nullable',
            'img_url' => $withImage ? 'image|mimes:jpg,jpeg,png|max:1000' : 'nullable',
            'price' => 'required|numeric|min:1',
            'code' => 'unique:App\Article,code|required|alpha_num|size:8|'
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
        $existImage = $request->file('img_url') ? true : false;
        $existCaracts = $request->get('caracts') ? true : false;

        $validator = $this->valid($request->all(), $existCaracts, $existImage);

        if ($validator->fails()) {
            return redirect('article/create')
                ->withErrors($validator)
                ->withInput();
        }

        $admin = Admin::find(Auth::id());

        if ($existImage) {
            $path = $request->file('img_url')->store('public/img/articles/'.$admin->username);
        }


        $datas = [
            'name' => $request->get('name'),
            'code' => strtoupper($request->get('code')),
            'caracts' => $request->get('caracts'),
            'img_url' => $path ?? null,
            'price' => $request->get('price'),
        ];


        $article = Article::create($datas)->admin()->associate($admin);
        $article->save();
        return redirect()->route('article.create')->with(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('owners.articles.edit', compact('article'));
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
        $article = Article::findOrFail($id);
        if(!empty($article)) {


            $existImage = $request->file('img_url') ? true : false;
            $existCaracts = $request->get('caracts') ? true : false;

            $validator = $this->valid($request->all(), $existCaracts, $existImage, true);

            if ($validator->fails()) {
                return redirect('article/'.$id.'/edit')
                    ->withErrors($validator)
                    ->withInput();
            }

            if ($article->name !== $request->get('name')) {
                $article->name = $request->get('name');
            }
            if($existImage) {
                Storage::delete($article->img_url);
                $username = $article->admin()->first()->username;
                $article->img_url = $request->file('img_url')->store('public/img/articles/'.$username);
            }
            if ($article->price !== $request->get('price')) {
                $article->price = $request->get('price');
            }
            if ($article->caracts !== $request->get('caracts')) {
                $article->caracts = $request->get('caracts');
            }

            $article->save();

            $nameChange = $article->wasChanged('name');
            $caractsChange = $article->wasChanged('caracts');
            $imgChange = $article->wasChanged('img_url');
            $priceChange = $article->wasChanged('price');


            return redirect()->route('article.edit', $id)->with([
                'name' => $nameChange,
                'caracts' => $caractsChange,
                'price' => $priceChange,
                'img' => $imgChange
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
