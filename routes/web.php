<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\BoardController;
use GuzzleHttp\Middleware;

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

Route::get('/login', [CustomAuthController::class, 'login'])->middleware('alreadyLoggedIn');
Route::get('/auth/login/naver', [CustomAuthController::class, 'loginNaver']);
Route::get('/auth/login/naver/callback', [CustomAuthController::class, 'loginNaverCallBack']);
Route::post('/login-user', [CustomAuthController::class, 'loginUser'])->name('login-user');
Route::get('/logout',[CustomAuthController::class,'logout']);

Route::get('/registeration', [CustomAuthController::class, 'registeration'])->middleware('alreadyLoggedIn');
Route::post('/register-user', [CustomAuthController::class, 'registerUser'])->name('register-user');

Route::get('/board', [BoardController::class, 'board']);
Route::get('/board/{page}', [BoardController::class, 'pagingBoard']);
Route::get('/board/write/post', [BoardController::class, 'write'])->middleware('isLoggedIn');
Route::post('/board/write/post', [BoardController::class, 'writePost'])->middleware('isLoggedIn');
Route::post('/board/upload/img', [BoardController::class,'uploadImg'])->Middleware('isLoggedIn');

Route::get('/board/post/{id}',[BoardController::class,'showPost']);
Route::post('/board/post/write/comment',[BoardController::class,'writeComment'])->middleware('isLoggedIn');
Route::get('/board/post/comment/get/{id}/{page}',[BoardController::class,'getComment']);

Route::get('/board/search/post',[BoardController::class, 'searchPost']);
