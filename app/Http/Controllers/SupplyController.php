<?php

namespace App\Http\Controllers;

use App\Article;
use App\Sellpoint;
use App\Warehouse;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * Class SupplyController
 * @package App\Http\Controllers
 */
class SupplyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    /**
     * @param $model
     * @return mixed
     */
    private function sum ($model, $table, $columnId)
    {
        $used = DB::table($table)
            ->select(DB::raw('sum(quantity) as total'))
            ->where($columnId, '=', $model->id)
            ->get();

        return $used[0]->total;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function warehouseHome ()
    {
        return view('owners.supply.warehouse.home');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function warehouseStore (Request $request, $id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $article = Article::findOrFail($request->get('article_id'));

        $messages = [
            'required'    => 'Ce champs est requis.',
            'numeric' => 'Ce champs doit contenir uniquement des chiffres.',
            'regex' => 'Mauvais format du champs'
        ];

        $validator = Validator::make($request->all(), [
            'article_id' => 'required|regex:/^[0-9]+/i',
            'quantity' => 'required|numeric',
        ], $messages);

        if ($validator->fails()) {
            return redirect('warehouse/'.$id.'/supply')
                ->withErrors($validator)
                ->withInput();
        }

        $available = $warehouse->capacity - ($this->sum($warehouse, 'article_warehouse', 'warehouse_id' ) + $request->get('quantity'));

        if ($available > 0) {

            $join = DB::table('article_warehouse')
                ->where('warehouse_id', '=', $warehouse->id)
                ->where('article_id', '=', $article->id)
                ->first();

            if ($join) {

                $quantity = (int) $request->get('quantity') + (int) $join->quantity;
                $warehouse->articles()->updateExistingPivot($article->id, ['quantity' => $quantity]);

            } else {

                $warehouse->articles()->attach($article->id, ['quantity' => $request->get('quantity')]);

            }

            $success = true;
            return redirect()->route('warehouse.supply.inner', $warehouse->id)->with(['success' => $success]);

        } else {

            $noUsed = $warehouse->capacity - $this->sum($warehouse, 'article_warehouse', 'warehouse_id' );
            $failed = true;
            return redirect()->route('warehouse.supply.inner', $warehouse->id)->with(['failed' => $failed, 'noUsed' => $noUsed]);

        }

    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sellpointHome ()
    {
        return view('owners.supply.sellpoint.home');
    }

    /**
     * @param Request $request
     */
    public function sellpointStore (Request $request, $id)
    {

        $messages = [
            'required'    => 'Ce champs est requis.',
            'numeric' => 'Ce champs doit contenir uniquement des chiffres.',
            'regex' => 'Mauvais format du champs'
        ];

        $validator = Validator::make($request->all(), [
            'article_id' => 'required|regex:/^[0-9]+/i',
            'warehouse_id' => 'required|regex:/^[0-9]+/i',
            'quantity' => 'required|numeric',
        ], $messages);

        if ($validator->fails()) {
            return redirect('sellpoint/'.$id.'/supply')
                ->withErrors($validator)
                ->withInput();
        }

        $sellpoint = Sellpoint::findOrFail($id);
        $warehouse = Warehouse::findOrFail($request->get('warehouse_id'));
        $article = $warehouse->articles()->where('articles.id', $request->get('article_id'))->first();

        DB::table('article_sellpoint_warehouses')->insertGetId([
            'quantity' => $request->get('quantity'),
            'warehouse_id' => $warehouse->id,
            'sellpoint_id' => $sellpoint->id,
            'article_id' => $article->id,
        ]);

        if ($article->pivot->quantity >= $request->get('quantity')) {

            /*
         * Mise a jour de l'entrepot
         */

            $quantityRest = $article->pivot->quantity - $request->get('quantity');
            $warehouse->articles()->updateExistingPivot($article->id, ['quantity' => $quantityRest]);

            /*
             * Mise a jour du point de vente
             */

            $join = DB::table('article_sellpoint')
                ->where('sellpoint_id', '=', $sellpoint->id)
                ->where('article_id', '=', $article->id)
                ->first();

            if ($join) {

                $quantity = (int) $request->get('quantity') + (int) $join->quantity;
                $sellpoint->articles()->updateExistingPivot($article->id, ['quantity' => $quantity]);

            } else {

                $sellpoint->articles()->attach($article->id, ['quantity' => $request->get('quantity')]);

            }

            $success = true;
            return redirect()->route('sellpoint.supply.inner', $sellpoint->id)->with(['success' => $success]);

        } else {

            $failed = true;
            return redirect()->route('sellpoint.supply.inner', $sellpoint->id)->with(['failed' => $failed, 'artQuantity' => $article->pivot->quantity, 'artName' => $article->name, 'warName' => $warehouse->name]);

        }

    }
}
