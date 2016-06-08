<?php

Route::get('/', function () {
    return view('welcome');
});


Route::resource('/posts', 'PostsController',
    ['names' => [
        'index' => 'posts.index',
        'store' => 'posts.store',
        'show'  => 'posts.show',
    ]
]);

Route::get('/comments/vote/{id}', [
    'as'   => 'comments.vote',
    'uses'   => 'CommentsController@vote'
]);

Route::resource('/comments', 'CommentsController',
    ['names' => [
        'index' => 'comments.index',
        'store' => 'comments.store',
    ]
]);

Route::controllers([
    'auth'       => 'Auth\AuthController',
    'password'   => 'Auth\PasswordController'
]);

Route::get('/logout', function()
{
    Auth::logout();
    Session::flush();
    return Redirect::to('/');
});
Route::auth();

Route::get('/home', 'HomeController@index');
