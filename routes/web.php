<?php

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

Route::get('', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => 'role:keeper'], function () {

        Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
            Route::get("", ['uses' => 'UsersController@index', 'as' => 'index']);
            Route::get("create", ['uses' => 'UsersController@create', 'as' => 'create']);
            Route::get("{id}/edit", ['uses' => 'UsersController@edit', 'as' => 'edit']);
            Route::post("", ['uses' => 'UsersController@store', 'as' => 'store']);
            Route::put("{id}", ['uses' => 'UsersController@update', 'as' => 'update']);
        });

        Route::group(['prefix' => 'materials', 'as' => 'materials.'], function () {
            Route::get("", ['uses' => 'MaterialsController@index', 'as' => 'index']);
            Route::get("create", ['uses' => 'MaterialsController@create', 'as' => 'create']);
            Route::get("{id}/edit", ['uses' => 'MaterialsController@edit', 'as' => 'edit']);
            Route::post("", ['uses' => 'MaterialsController@store', 'as' => 'store']);
            Route::put("{id}", ['uses' => 'MaterialsController@update', 'as' => 'update']);
        });

        Route::group(['prefix' => 'departments', 'as' => 'departments.'], function () {
            Route::get("", ['uses' => 'DepartmentsController@index', 'as' => 'index']);
            Route::get("create", ['uses' => 'DepartmentsController@create', 'as' => 'create']);
            Route::get("{id}/edit", ['uses' => 'DepartmentsController@edit', 'as' => 'edit']);
            Route::post("", ['uses' => 'DepartmentsController@store', 'as' => 'store']);
            Route::put("{id}", ['uses' => 'DepartmentsController@update', 'as' => 'update']);
            Route::get('{id}', 'DepartmentsController@show')->name('show');

        });

        Route::get('in', 'InController@index')->name('in.index');
        Route::post('in', 'InController@store')->name('in.store');

        Route::get('out', 'OutController@index')->name('out.index');
        Route::post('out', 'OutController@store')->name('out.store');

        Route::get("records", "RecordsController@index")->name("records.index");
        Route::get("excel", "RecordsController@exportExcel")->name('records.excel');

        Route::resource('types', 'TypeController');
        Route::resource('units', 'UnitController');

    });

    Route::group(['prefix' => 'department', 'as' => 'department.'], function () {
        Route::get("", ['uses' => 'DepartmentController@index', 'as' => 'index']);
        Route::get("{id}/materials", ['uses' => 'DepartmentController@materials', 'as' => 'materials']);
        Route::post('material/{id}/reduce', 'ReduceController@reduce')->name('reduce');
        Route::post('adjustment', 'DepartmentController@adjustment')->name('adjustment');
    });

    Route::group(['prefix' => 'record', 'as' => 'record.'], function () {
        Route::get("", ['uses' => 'RecordController@index', 'as' => 'index']);
    });

});
