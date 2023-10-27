<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

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
//pagina principal
Route::get('/',HomeController::class)->name('home');
Route::get('/register',[RegisterController::class,'index'])->name('register');
Route::post('/register',[RegisterController::class,'store']);

Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'store']);
Route::post('/logout',[LogOutController::class,'store'])->name('logout');

//Rutas para el perfil
Route::get('/editar-perfil',[PerfilController::class,'index'])->name('perfil.index');
Route::post('/editar-perfil',[PerfilController::class,'store'])->name('perfil.store');

//Ruta comentario
Route::post('/post/{user:username}/{post}',[ComentarioController::class,'store'])->name('comentarios.store');

//Ruta imágenes
Route::post('/imagenes',[ImagenController::class,'store'])->name('imagenes.store');

//Rutas Likes
Route::post('/posts({post}/likes',[LikeController::class,'store'])->name('posts.likes.store');
Route::delete('/posts({post}/likes',[LikeController::class,'destroy'])->name('posts.likes.destroy');

//Rutas Followers
Route::post('/{user:username}/follow',[FollowerController::class,'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow',[FollowerController::class,'destroy'])->name('users.unfollow');

//Rutas post
Route::get('/posts/create',[PostController::class,'create'])->name('posts.create');
Route::post('/posts',[PostController::class,'store'])->name('posts.store');
Route::get('/post/{user:username}/{post}',[PostController::class,'show'])->name('posts.show');
Route::delete('/post/{post}',[PostController::class,'destroy'])->name('posts.destroy');
Route::get('/{user:username}',[PostController::class,'index'])->name('posts.index');