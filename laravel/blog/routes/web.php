<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('invoice', function(){
    return view('invoice');
});
Route::get('/profile', function(){
    return view('profile', ['name'=>Auth::user()->name]);
})->name('profile');
Route::get('/profiles', function(){
    return Auth::user();
})->name('profiles');
//Route::get('profile', 'HomeController@profile')->name('profile');
//Route::get('{path}','HomeController@index')->where( 'path', '([A-z\d-/_.]+)?' );
Route::get('users/{user}',  ['as' => 'users.edit', 'uses' => 'UserController@edit']);
Route::patch('users/{user}/update',  ['as' => 'users.update', 'uses' => 'UserController@update']);
Route::post('/formSubmit/{id}',function($id)
{
    $lista = explode("-", $id);
     DB::table('users')->where('id',$lista[0])->update(array(
        "id" => $lista[0],
        "name" => $lista[1],
        "email" => $lista[2],
        "password" => bcrypt($lista[3])
    ));
    return back();

});