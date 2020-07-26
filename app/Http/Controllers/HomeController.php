<?php

namespace App\Http\Controllers;

use App\Employe;
use App\Sellpoint;
use App\User;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
	 */
	public function index() {
		if (Auth::user()->getRoleNames()->first() === 'seller') {
			return redirect()->route('selling.index');
		} elseif (Auth::user()->getRoleNames()->first() === 'manager') {

			$employe = Employe::find(Auth::id());
			$sellpoint = $employe->sellpoint;
//			$articles = $sellpoint->articles;
			$sellings = $sellpoint->sellings;

			$artOut = [];
			$nbrToday = 0;
			$nbrYester = 0;
			$nbrMonth = 0;

			foreach ($sellings as $selling) {

				$desc = $selling->article->caracts ? '( ' . $selling->article->caracts . ' )' : '';

				$account = (object) [
					'code' => $selling->article->code,
					'name' => $selling->article->name . $desc,
					'count' => $selling->quantity,
					'date' => $selling->created_at->format('d F, Y'),
				];
				array_push($artOut, $account);

				$dateSell = Carbon::make($selling->created_at->format('Y-m-d'));
				if (Carbon::today()->equalTo($dateSell)) {
					$nbrToday += (int) $selling->quantity;
				} elseif (Carbon::yesterday()->equalTo($dateSell)) {
					$nbrYester += (int) $selling->quantity;
				}

				$sellMonth = Carbon::make($selling->created_at->format('Y-m'));
				$todayMonth = Carbon::make(Carbon::today()->format('Y-m'));
				if ($sellMonth->equalTo($todayMonth)) {
					$nbrMonth += (int) $selling->quantity;
				}

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
			}

			//dd($articles, $nbrMonth, $nbrToday, $nbrYester);
			return view('manager.dashboard', compact('nbrMonth', 'nbrToday', 'nbrYester', 'articles'));

		} else {

			return view('owners.dashboard');
		}
	}

	public function edit($username)
    {
        if (Auth::user()->username === $username) {

            $user = Auth::user();
            return view('auth.settings.profil', compact('user'));

        }
        abort(404);
    }

    public function setting($username)
    {
        if (Auth::user()->username === $username) {

            $user = Auth::user();
            return view('auth.settings.settings', compact('user'));

        }
        abort(404);
    }
}
