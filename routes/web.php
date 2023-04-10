<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;

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

use Illuminate\Support\Facades\DB;

Route::get('/insert', function(){

    DB::insert('insert into posts(title, content) values(?, ?)', ['PHP is awesome with Timmy', 'laravel is the best thing that has happened to PHP, oh really?']);

});

Route::get('/read', function(){
    
    $results = DB::select('select * FROM posts where id = ?', [1]);

    foreach($results as $post){
        return $post->title;
    }

});

Route::get('/update', function() {

    $update = DB::update('update posts set title = "Updated title" where id = ?', [1]);

    return $update;

});

Route::get('/delete', function(){
   
    $deleted =  DB::delete('delete FROM posts where id = ?', [1]);

    return $deleted;
});

Route::get('/find', function(){

    $posts = Post::all();

    foreach($posts as $post){

        return $post->title;
    }

});

Route::get('/findwhere', function(){

        $posts = Post::where('id', 3)->orderBy('id', 'desc')->take(1)->get();

        return  $posts;

});

Route::get('/findmore', function(){

    // $posts = Post::findOrFail(1);

    // return $posts;

    $posts = Post::where('users_count', '<', 50)->firstOrFail();

    return $posts;

});

Route::get('/basicinsert', function(){

    $post = new Post;

    $post->title = 'New Eloquent title inser';
    $post->content = 'Wow eloquent is really cool, look at this content';

    $post->save();


});

Route::get('/basicinsert1', function(){

    $post = Post::find(2);

    $post->title = 'Even Newer title inserted';
    $post->content = 'The newest content';

    $post->save();

});

