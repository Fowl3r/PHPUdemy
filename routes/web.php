<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\User;
use App\Models\Country;
// use App\Models\Role;

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
    $post->is_admin= 0;

    $post->save();


});

Route::get('/basicinsert1', function(){

    $post = Post::find(2);

    $post->title = 'Even Newer title inserted';
    $post->content = 'The newest content';

    $post->save();

});

Route::get('/create', function(){

    Post::create(['title'=>'newly created', 'content'=>'Wow I\' am learning sooo much', 'is_admin'=>0]);

});

Route::get('/update1',function(){

    Post::where('id', 2)->where('is_admin', 0)->update(['title'=>'NEW PHP TITLE', 'content'=>'I love learning ']);

});

Route::get('/delete', function() {

    $post = Post::find(2);

    $post->delete();


});

Route::get('/delete2',function(){

    // Post::destroy(3);

    Post::where('is_admin', 0)->delete();


});

Route::get('/softdelete',function(){

    Post::find(2)->delete();

});

Route::get('/readsoftdelete', function(){


        // $post = Post::withTrashed()->where('id', 2)->get();
        // return $post;

        $post = Post::onlyTrashed()->where('is_admin',0)->get();
        
        return $post;

});

Route::get('/restore', function(){

    Post::withTrashed()->where('is_admin', 0)->restore();



});

Route::get('/forcedelete', function() {
    Post::withTrashed()->where('id', 2)->forceDelete();
});

Route::get('/user/{id}/post', function($id) {

    return User::find($id)->post;

});

Route::get('/post/{id}/user', function($id){

    return Post::find($id)->user->name;

});

Route::get('/posts', function(){

    $user = User::find(1);

    forEach($user->posts as $post){
     echo  $post->title . "<br>";
    }

});

Route::get('/user/{id}/role', function($id) {

$user = User::find($id)->roles()->orderBy('id', 'desc')->get();

 return $user;

 forEach($user->roles as $role){
    return $role->name;
 }

});

Route::get('/user/pivot', function(){

    $user = User::find(1);

    forEach($user->roles as $role){
        echo $role->pivot->created_at;
    }

});

Route::get('/user/country', function(){

    $country = Country::find(4);

    forEach($country->posts as $post) {
        return $post->title;
    }

});

// Polymorphic relations

Route::get('user/photos', function(){

    $user = User::find(1);

    forEach($user->photos as $photo) {
        return $photo;
    }

});

Route::get('post/{id}/photos', function ($id){

    $post = Post::find($id);

    forEach($post->photos as $photo){
        echo $photo . "<br>";
    }

});