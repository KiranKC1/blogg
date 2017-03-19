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



//Authentication Routes
/*Route::get('auth/login', 'Auth\LoginController@getLogin');
Route::post('auth/login', 'Auth\LoginController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
//Registration routes
Route::get('auth/register', 'Auth\RegisterController@getRegister');
Route::post('auth/register', 'Auth\RegisterController@postRegister');
*/
Route::get('blog/{slug}',['as'=>'blog.single','uses'=>'BlogController@getSingle'])->where('slug','[\w\d\-\_]+');
Route::get('/', 'PagesController@getIndex');
Route::get('about', 'PagesController@getAbout');
Route::get('contact','PagesController@getContact');
Route::resource('posts','PostController');
Route::get('blog',['uses'=>'BlogController@getIndex', 'as' =>'blog.index']);
//categories route
Route::resource('categories','CategoryController',['except'=>['create']]);//we can use 'only'(except jasari) for mentioning needed resources
Route::resource('tags','TagController',['except'=>'create']);
//comments
Route::post('comments/{post_id}',['uses'=>'CommentsController@store', 'as'=>'comments.store']);
Route::get('comments/{id}/edit',['uses'=>'CommentsController@edit', 'as'=>'comments.edit']);
Route::put('comments/{id}',['uses'=>'CommentsController@update', 'as'=>'comments.update']);
Route::delete('comments/{id}',['uses'=>'CommentsController@destroy', 'as'=>'comments.destroy']);
Route::get('comments/{id}/delete',['uses'=>'CommentsController@delete' ,'as'=>'comments.delete']);

//admin login routes
Route::get('/admin/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login','Auth\AdminLoginController@showLoginForm')->name('admin.login.submit');


Auth::routes();

Route::get('/home', 'HomeController@index');
