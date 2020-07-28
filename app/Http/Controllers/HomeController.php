<?php

namespace App\Http\Controllers;

use App\Employe;
use App\Sellpoint;
use App\User;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Object_;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
		Carbon::setLocale(config('app.locale'));
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
			$outs = [];

			$nbrToday = 0;
			$nbrYester = 0;
            $nbrYester2 = 0;
            $nbrYester3 = 0;
            $nbrYester4 = 0;
            $nbrYester5 = 0;
            $nbrYester6 = 0;

			$nbrMonth = 0;

			$frenchDay = [
                'Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi',
            ];

			$articles = [];

			foreach ($sellings as $selling) {

				$desc = $selling->article->caracts ? ' (' . $selling->article->caracts . ')' : '';

				$account = (object) [
					'code' => $selling->article->code,
					'name' => $selling->article->name . $desc,
					'count' => $selling->quantity,
					'date' => $selling->created_at->format('d F, Y'),
				];

				/*if (empty($outs)) {
                    array_push($outs, [
                        'code' => $selling->article->code,
                        'name' => $selling->article->name . $desc,
                        'count' => $selling->quantity,
                        'mount' => $selling->quantity * $selling->article->price,
                    ]);
                } else {
				    foreach ($outs as $out) {
				        if ($out['code'] === $selling->article->code) {
				            echo 'The same product ' . $selling->article->name . '<br>';
				            $out['mount'] += $selling->quantity * $selling->article->price;
				            $out['count'] += $selling->quantity;
                        } else {
                            echo 'Add new product <br>';
                            array_push($outs, [
                                'code' => $selling->article->code,
                                'name' => $selling->article->name . $desc,
                                'count' => $selling->quantity,
                                'mount' => $selling->quantity * $selling->article->price,
                            ]);
                        }
                    }
                }*/

				array_push($artOut, $account);

				$dateSell = Carbon::make($selling->created_at->format('Y-m-d'));
				if (Carbon::today()->equalTo($dateSell)) {

					$nbrToday += (int) $selling->quantity;

				}
				elseif (Carbon::yesterday()->equalTo($dateSell)) {

					$nbrYester += (int) $selling->quantity;

				}
				elseif (Carbon::today()->subDays(2)->equalTo($dateSell)) {

				    $nbrYester2 += (int) $selling->quantity;

                }
				elseif (Carbon::today()->subDays(3)->equalTo($dateSell)) {

                    $nbrYester3 += (int) $selling->quantity;

                }
				elseif (Carbon::today()->subDays(4)->equalTo($dateSell)) {

                    $nbrYester4 += (int) $selling->quantity;

                }
				elseif (Carbon::today()->subDays(5)->equalTo($dateSell)) {

                    $nbrYester5 += (int) $selling->quantity;

                }
				elseif (Carbon::today()->subDays(6)->equalTo($dateSell)) {

                    $nbrYester6 += (int) $selling->quantity;

                }

                $sellMonth = Carbon::make($selling->created_at->format('Y-m'));
				$todayMonth = Carbon::make(Carbon::today()->format('Y-m'));
				if ($sellMonth->equalTo($todayMonth)) {
					$nbrMonth += (int) $selling->quantity;
				}

			}

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

            $weekSells = [
                ['day' => $frenchDay[Carbon::today()->subDays(6)->dayOfWeek], 'articles' => $nbrYester6],
                ['day' => $frenchDay[Carbon::today()->subDays(5)->dayOfWeek], 'articles' => $nbrYester5],
                ['day' => $frenchDay[Carbon::today()->subDays(4)->dayOfWeek], 'articles' => $nbrYester4],
                ['day' => $frenchDay[Carbon::today()->subDays(3)->dayOfWeek], 'articles' => $nbrYester3],
                ['day' => $frenchDay[Carbon::today()->subDays(2)->dayOfWeek], 'articles' => $nbrYester2],
                ['day' => $frenchDay[Carbon::yesterday()->dayOfWeek], 'articles' => $nbrYester],
                ['day' => $frenchDay[Carbon::today()->dayOfWeek], 'articles' => $nbrToday],
            ];

            $weekSells = (Object) $weekSells;

			return view('manager.dashboard', compact('nbrMonth', 'nbrToday', 'nbrYester', 'articles', 'weekSells'));

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

    public function managerJson()
    {

    }
}
