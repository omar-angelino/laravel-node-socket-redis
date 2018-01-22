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

Route::get('/chat/{id}', function ($id) {
    return view('index')->with('id', $id);
});

Route::get('/nodetest', function () {
    return "OK!";
});

Route::get('/event/event', 'EventController@event');