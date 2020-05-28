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

        Route::group(['prefix'=>'settings'],function (){
            Route::get('/', 'Admin\SettingController@index')->name('admin.settings');
            Route::post('/', 'Admin\SettingController@update')->name('admin.settings.update');

            Route::post('/main', 'Admin\SettingController@main');//vue disable
            Route::post('/vue', 'Admin\SettingController@other');//vue active
        });



        Route::group(['prefix'  =>   'menus'], function() {
            Route::get('/', 'Admin\MenuController@index')->name('admin.menus.index');

            Route::get('/create', 'Admin\MenuController@create')->name('admin.menus.create');
            Route::post('/store', 'Admin\MenuController@store')->name('admin.menus.store');
            Route::get('/edit/{id}', 'Admin\MenuController@edit')->name('admin.menus.edit');
            Route::post('/update', 'Admin\MenuController@update')->name('admin.menus.update');
            Route::get('/delete/{id}', 'Admin\MenuController@delete')->name('admin.menus.delete');

            Route::get('/{action}/{id?}', 'Admin\MenuController@crud')->name('admin.menus.crud');

            Route::get('/action/{action}/{item}/{id?}', 'Admin\MenuController@actionOnMenu')->name('admin.menus.action');


        });

        Route::group(['prefix'  =>   'members'], function() {
            Route::get('/', 'Admin\MemberController@index')->name('admin.members.index');
            Route::get('/create', 'Admin\MemberController@create')->name('admin.members.create');
            Route::post('/store', 'Admin\MemberController@store')->name('admin.members.store');
            Route::get('/edit/{id}', 'Admin\MemberController@edit')->name('admin.members.edit');
            Route::post('/update', 'Admin\MemberController@update')->name('admin.members.update');
            Route::get('/delete/{id}', 'Admin\MemberController@delete')->name('admin.members.delete');

            Route::get('/action/{action}/{item}/{id?}', 'Admin\MemberController@actionOnMember')->name('admin.members.action');
            Route::get('/image/action/{action}/{item}/{id?}/{memberId?}', 'Admin\MemberController@actionOnMemberImage')->name('admin.members.image.action');

            Route::get('/editAll', 'Admin\MemberController@indexEditAll')->name('admin.members.indexEditAll');
            Route::get('/getRegLoginId', 'Admin\MemberController@getRegLoginId')->name('admin.members.getRegLoginId');

            Route::get('/mail/{email}/{name}/{registrationId}/{loginId}', 'Admin\MemberController@sendLoginIdMail')->name('admin.members.sendLoginIdMail');
            Route::get('/sendLoginIdMailAll', 'Admin\MemberController@sendLoginIdMailAll')->name('admin.members.sendLoginIdMailAll');
            Route::post('/sendLoginIdMailAllVue', 'Admin\MemberController@sendLoginIdMailAllVue');

            Route::group(['prefix'  =>   'profile'], function() {
                Route::get('/edit/{id}', 'Admin\MemberController@editProfile')->name('admin.members.profiles.editProfile');
                Route::post('/images/upload', 'Admin\Member\ImageController@upload')->name('admin.members.images.upload');
                Route::post('/images/upload1', 'Admin\Member\ImageController@upload')->name('admin.members.images.upload1');
                Route::get('/images/delete/{id}', 'Admin\Member\ImageController@delete')->name('admin.members.images.delete');

            });
        });
    });
});
