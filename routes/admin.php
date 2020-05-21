<?php
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['prefix'  =>  'admin'], function () {

    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login')->name('admin.login.post');
    Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');

    Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('/', function () {
            return view('admin.dashboard.index');
        })->name('admin.dashboard');

        Route::get('/settings', 'Admin\SettingController@index')->name('admin.settings');
        Route::post('/settings', 'Admin\SettingController@update')->name('admin.settings.update');

        Route::group(['prefix'  =>   'menus'], function() {
            Route::get('/', 'Admin\MenuController@index')->name('admin.menus.index');
            Route::get('/create', 'Admin\MenuController@create')->name('admin.menus.create');
            Route::post('/store', 'Admin\MenuController@store')->name('admin.menus.store');
            Route::get('/{id}/edit', 'Admin\MenuController@edit')->name('admin.menus.edit');
            Route::post('/update', 'Admin\MenuController@update')->name('admin.menus.update');
            Route::get('/{id}/delete', 'Admin\MenuController@delete')->name('admin.menus.delete');
        });

    });
});
