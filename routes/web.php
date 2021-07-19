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
Route::resource('selling', SellingController::class);
Route::resource('messagerie', MessagerieController::class);

Route::group(['prefix' => 'selling'], function () {
    Route::get('articles/json', 'SellingController@articlesJson');
});

Route::group(['prefix' => 'article'], function () {
    Route::get('{id}/transaction', 'ArticleController@transaction')->name('article.transaction');
    Route::get('{id}/settings', 'ArticleController@showSetting')->name('article.setting.index');
});

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('edit/profil/{id}', 'HomeController@edit')->name('profil');
Route::get('settings/{id}', 'HomeController@setting')->name('setting');
