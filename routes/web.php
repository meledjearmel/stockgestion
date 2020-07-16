<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return redirect()->route('login');
});

Route::resource('warehouse', WarehouseController::class);
Route::resource('sellpoint', SellpointController::class);
Route::resource('article', ArticleController::class);
Route::resource('employe', EmployeController::class);


Route::group(['prefix' => 'warehouse'], function () {
    Route::get('{id}/supply', 'WarehouseController@supplyIndex')->name('warehouse.supply.inner');
    Route::post('{id}/supply', 'SupplyController@warehouseStore')->name('warehouse.supply.store');

    Route::get('{id}/transaction', 'WarehouseController@transaction')->name('warehouse.transaction');
    Route::get('{id}/settings', 'WarehouseController@showSetting')->name('warehouse.setting.index');
});


Route::group(['prefix' => 'sellpoint'], function () {
    Route::get('{id}/supply', 'SellpointController@supplyIndex')->name('sellpoint.supply.inner');
    Route::post('{id}/supply', 'SupplyController@sellpointStore')->name('sellpoint.supply.store');

    Route::get('{id}/transaction', 'SellpointController@transaction')->name('sellpoint.transaction');

    Route::get('{id}/settings', 'SellpointController@showSetting')->name('sellpoint.setting.index');

    Route::get('/json/{id}', 'SellpointController@warehouseJson')->name('sellpoint.warehouse.get');
});


Route::group(['prefix' => 'supply'], function () {
    Route::get('ware', 'SupplyController@warehouseHome')->name('warehouse.supply.index');

    Route::get('sell', 'SupplyController@sellpointHome')->name('sellpoint.supply.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('edit/profil/{id}', 'HomeController@edit')->name('profil');
Route::get('messages', 'HomeController@message')->name('notify');
Route::get('settings/{id}', 'HomeController@setting')->name('setting');
