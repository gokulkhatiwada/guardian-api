<?php

use Illuminate\Support\Facades\Http;
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

Route::get('/mock',function(){
//   $response =  Http::get('https://content.guardianapis.com'."/sections",['api-key'=>'9d97b471-ee1c-473a-b293-7998a92c4182'])->json();
   $response = (new \App\Services\Requests\GuardianSection())->doRequest();
    dd($response);
});

Route::get('/', 'HomeController@index');

Route::get('/auth/login','Auth\LoginController@showLoginForm')->name('login');

Route::post('/auth/login','Auth\LoginController@authenticate')->name('authenticate');


Route::middleware('auth')->group(function(){
    Route::post('/logout','Auth\LoginController@logout')->name('logout');
    Route::get('/update-password','Auth\PasswordUpdateController@index')->name('change.password');
    Route::post('/update-password','Auth\PasswordUpdateController@update')->name('update.password');
});

Route::get('/{any?}','HomeController@index');