<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\UserController;
// use App\Http\Controllers\Web\HomeController;
use  App\Http\Controllers\HomeController;
// use HomeController;



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

// Route::get('/', function () {

//     $images = Image::all();
//     foreach ($images as $image) {
//         echo $image->id . '<br>';
//         echo $image->image_path . '<br>';
//         echo $image->created_at . '<br>';
//         echo $image->updated_at . '<br>';
//         echo $image->user->surname . '<br>';
//         foreach ($image->comments as $comment) {
//             echo $comment->id . '<br>';
//             echo $comment->user->name . '<br>';
//             echo $comment->content . '<br>';
//         }
//     }
//     die();
//     // return view('welcome');
// });

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/configuracion', [UserController::class, 'config'])->name('configuracion');
Route::post('/configuracion/edit', [UserController::class, 'update'])->name('editConfig');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
