<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::any('admin/login', 'Admin\LoginController@login');
//    Route::any('admin/crypt', 'Admin\LoginController@crypt');
    Route::get('admin/code', 'Admin\LoginController@code');

});

Route::group(['middleware' => ['web','admin.login'],'prefix'=>'admin','namespace'=>'Admin'], function () {

    Route::any('index', 'IndexController@index');
    Route::any('info', 'IndexController@info');
    Route::any('quit', 'LoginController@quit');
    Route::any('pass', 'IndexController@pass');
    Route::any('home', 'IndexController@home');
    Route::post('cate/changeorder','CategoryController@changeOrder');
//ask 方法群 开始
    Route::any('WebService/ask', 'WebServiceController@ask');
    Route::any('ASP_NET/ask', 'ASP_NETController@ask');
    Route::any('JavaScript/ask', 'JavaScriptController@ask');
    Route::any('HTML_CSS/ask', 'HTML_CSSController@ask');
//ask 方法群 结束
    Route::resource('category', 'CategoryController');


    Route::resource('qalist', 'QaListController');


    Route::resource('WebService', 'WebServiceController');
    Route::resource('ASP_NET', 'ASP_NETController');
    Route::resource('HTML_CSS', 'HTML_CSSController');
    Route::resource('JavaScript', 'JavaScriptController');
    Route::any('/AnswerList', 'QaListController@AnswerList');
    Route::any('/AddList', 'QaListController@AddList');
});
