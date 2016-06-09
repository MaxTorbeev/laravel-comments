<?php

Route::get('/', function () {
    return redirect()->route('posts.index');
});


Route::resource('/posts', 'PostsController',
    ['names' => [
        'index'     => 'posts.index',
        'store'     => 'posts.store',
        'show'      => 'posts.show',
    ]
]);

Route::get('/comments/vote/{id}', [
    'as'            => 'comments.vote',
    'uses'          => 'CommentsController@vote'
]);

Route::resource('/comments', 'CommentsController',
    ['names' => [
        'index'     => 'comments.index',
        'store'     => 'comments.store',
        'update'     => 'comments.update',
        'destroy'    => 'comments.destroy',
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
