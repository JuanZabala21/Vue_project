<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('invoice', function(){
    return view('invoice');
});
Route::get('/profile', 'HomeController@profile')->name('profile');
//Route::get('profile', 'HomeController@profile')->name('profile');
//Route::get('{path}','HomeController@index')->where( 'path', '([A-z\d-/_.]+)?' );
