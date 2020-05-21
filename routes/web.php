<?php

use Illuminate\Support\Facades\Route;

require 'admin.php';

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
