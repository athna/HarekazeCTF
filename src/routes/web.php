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
Route::get('/' , 'TopController@index');

//Logged in user
Route::group(['middleware' => ['auth'] ], function ()
{
    Route::get('questions'          , 'AnswerController@index');
    Route::get('questions/{id}'     , 'AnswerController@showAnswerForm');
    Route::post('questions/{id}'    , 'AnswerController@answer');
    Route::get('ranking'            , 'RankingController@index');    
});

// master
Route::group(['middleware' => ['auth', 'can:master'] ], function ()
{
    Route::get('control'                    , 'MasterController@show')  ->name('control');
    Route::resource('control/questions'     , 'QuestionController');
});

// owner
Route::group(['middleware' => ['auth', 'can:owner'] ], function ()
{
    Route::get('control/user'               , 'UserController@index');
    Route::put('control/user/update/{id}'   , 'UserController@update');
});

Auth::routes();