<?php

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Postcontroller;
use App\Http\Controllers\Usercontroller;

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
    $posts = []; // Initialize $posts array

    if (auth()->check()) { // Check if the user is authenticated
        $posts = auth()->user()->userCoolPosts()->latest()->get(); // Fetch latest cool posts if authenticated
    }

// $post= Post:: where('user_id', auth()->id())->get();
    return view('home', ['posts'=> $posts]);
});

Route::post('/register', [Usercontroller::class, 'register']);
Route::post('/logout', [Usercontroller::class, 'logout']);
Route::post('/login', [Usercontroller::class, 'login']);

//blog post related route
Route::post('/create-post', [Postcontroller::class, 'createPost'])->name('createpost');
Route::get('/edit-post/{post}', [Postcontroller::class,'showEditScreens']);
Route::post('/update/{id}', [Postcontroller::class,'actuallyUpdatePost'])->name('update');
Route::delete('/delete-post/{post}', [Postcontroller::class,'deletePost']);
//edit-post/{posts}is used to take care of the variable coming from the eidt id


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
