<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');





//route for profile
Route::get('/profile', 'ProfileController@index' )->name('profile');
Route::put('/profile/update', 'ProfileController@update' )->name('profile.update');

// Routes for Posts
Route::get('/posts', 'PostController@index' )->name('posts');
Route::get('/posts/trashed', 'PostController@posttrashed' )->name('posts.trashed');
Route::get('/post/create', 'PostController@create' )->name('post.create');
Route::post('/post/store', 'PostController@store' )->name('post.store');
Route::get('/post/show/{slug}', 'PostController@show' )->name('post.show');
Route::get('/post/edit/{id}', 'PostController@edit' )->name('post.edit');
Route::post('/post/update/{id}', 'PostController@update' )->name('post.update');
Route::get('/post/destroy/{id}', 'PostController@destroy' )->name('post.destroy');
Route::get('/post/hdelete/{id}', 'PostController@sdelete' )->name('post.hdelete');
Route::get('/post/restore/{id}', 'PostController@restore' )->name('post.restore');





//route for Site UI
Route::get('/', 'SiteUIController@index' )->name('siteui.index');
Route::get('/ui/tag/{id}', 'SiteUIController@tag' )->name('siteui.tag');
 Route::get('/ui/post/show/{slug}', 'SiteUIController@showPost' )->name('siteui.post.show');








