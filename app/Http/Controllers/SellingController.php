<?php

namespace App\Http\Controllers;

use App\Article;
use App\Employe;
use App\Selling;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','role:seller']);
        Carbon::setLocale(config('app.locale'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('sell.selling');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $facture = $request->get('facture');
        $employe = Employe::find(Auth::id());
        $sellpoint = $employe->sellpoint;

        $notExist = [];
        $nbrExt = [];

        foreach ($facture as $product) {
            $article = $sellpoint->articles->where('code', '=', $product['code'])->first();
            $isGood = $article ? true : false;
            if (!$isGood) {
                array_push($notExist, $article);
            } else {
                $isNotExt = $article->pivot->quantity >= $product['count'];
                if ($isNotExt) {
                    array_push($nbrExt, $article);
                }
            }
        }

        $registered = [];

        if ($isGood && $isNotExt) {
            foreach ($facture as $product) {
                $article = $sellpoint->articles->where('code', '=', $product['code'])->first();
                $restQty = $article->pivot->quantity - $product['count'];
                $sellpoint->articles()->updateExistingPivot($article->id, ['quantity' => $restQty]);

                $selling = new Selling();
                $selling->quantity = $product['count'];
                $selling->sellpoint_id = $sellpoint->id;
                $selling->user_id = Auth::id();
                $selling->article_id = $article->id;
                $selling->save();
            }
            return response()->json(['pass' => true]);
        }
        return response()->json(['pass' => false, 'notExist' => $notExist, 'nbrExt' => $nbrExt]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function show($id)
    {
        if (Auth::id() === (int) $id) {
            $employe = Employe::find(Auth::id());
            $sellings = $employe->sellings;
            $AllSelled = [];
            $mountToday = 0;
            $mountYester = 0;
            $mountMonth = 0;

            foreach ($sellings as $selling) {

                $desc = $selling->article->caracts ? ' ('.$selling->article->caracts.')' : '';

                $account = (object) [
                    'name' => $selling->article->name . $desc,
                    'price' => $selling->article->price,
                    'count' => $selling->quantity,
                    'mount' => (int) $selling->quantity * (int) $selling->article->price,
                    'date' => $selling->created_at->format('d F, Y \\a H:i'),
                ];
                array_push($AllSelled, $account);

                $dateSell = Carbon::make($selling->created_at->format('Y-m-d'));
                if (Carbon::today()->equalTo($dateSell)) {
                    $mountToday += (int) $selling->quantity * (int) $selling->article->price;
                } elseif (Carbon::yesterday()->equalTo($dateSell)) {
                    $mountYester += (int) $selling->quantity * (int) $selling->article->price;
                }

                $sellMonth = Carbon::make($selling->created_at->format('Y-m'));
                $todayMonth = Carbon::make(Carbon::today()->format('Y-m'));
                if ($sellMonth->equalTo($todayMonth)) {
                    $mountMonth += (int) $selling->quantity * (int) $selling->article->price;
                }

            }

            $AllSelled = (object) $AllSelled;
            $show = true;

            return view('sell.dashboard', compact('AllSelled', 'mountMonth', 'mountYester', 'mountToday', 'show'));
        } else {
            return abort('404');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        abort(404);
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

    public function articlesJson()
    {
        $seller = Employe::find(Auth::id());
        $sellpoint = $seller->sellpoint;
        $articles = [];

        foreach ($sellpoint->articles as $article) {

            if ($article->pivot->quantity > 0) {
                $tmp = [
                    'code' => $article->code,
                    'name' => $article->name,
                    'price' => $article->price,
                ];

                array_push($articles, $tmp);
            }

        }

        return response()->json($articles);
    }
}
