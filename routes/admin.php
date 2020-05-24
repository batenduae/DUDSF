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
            Route::get('/edit/{id}', 'Admin\MenuController@edit')->name('admin.menus.edit');
            Route::post('/update', 'Admin\MenuController@update')->name('admin.menus.update');
            Route::get('/delete/{id}', 'Admin\MenuController@delete')->name('admin.menus.delete');

            Route::get('/action/{action}/{item}/{id?}', 'Admin\MenuController@actionOnMenu')->name('admin.menus.action');


        });

        Route::group(['prefix'  =>   'members'], function() {
            Route::get('/', 'Admin\MemberController@index')->name('admin.members.index');
            Route::get('/create', 'Admin\MemberController@create')->name('admin.members.create');
            Route::post('/store', 'Admin\MemberController@store')->name('admin.members.store');
            Route::get('/{id}/edit', 'Admin\MemberController@edit')->name('admin.members.edit');
            Route::post('/update', 'Admin\MemberController@update')->name('admin.members.update');
            Route::get('/{id}/delete', 'Admin\MemberController@delete')->name('admin.members.delete');

            Route::get('/action/{action}/{item}/{id?}', 'Admin\MemberController@actionOnMember')->name('admin.members.action');

            Route::get('/editAll', 'Admin\MemberController@indexEditAll')->name('admin.members.indexEditAll');
            Route::get('/getRegLoginId', 'Admin\MemberController@getRegLoginId')->name('admin.members.getRegLoginId');

            Route::get('/mail/{email}/{name}/{registrationId}/{loginId}', 'Admin\MemberController@sendMail')->name('admin.members.mail');
            Route::get('/sendMailAll', 'Admin\MemberController@sendMailAll')->name('admin.members.sendMailAll');



        });

    });
});
