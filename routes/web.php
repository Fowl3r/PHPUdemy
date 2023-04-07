<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});
// Route::get('/about', function () {
//     return 'Hi about page';
// });
// Route::get('/contact', function () {
//     return 'hi I am contact';
// });
// Route::get('/classic', function () {
//     return 'Hello world :D';
// });

// Route::get('/post/{id}/{name}', function ($id, $name) {
// return "This is post number ". $id . " " . $name;
// });

// Route::get('admin/posts/example', array('as'=>'admin.home', function () {
//     $url = route('admin.home');

//     return "This urls is " . $url;
// }));

// first line of php! Below is a route group, middleware is a security frature of laravel
// everything in the route group below will be available for 'web'
// Route::group(['middleware' => ['web']], function () {


// });
// Route::get('/post/{id}', 'App\Http\Controllers\PostController@index');

Route::resource('posts', 'App\Http\Controllers\PostController');

Route::get('/contact/{id}', 'App\Http\Controllers\PostController@contact');

Route::get('post/{id}/{name}/{password}' , 'App\Http\Controllers\PostController@show_post');