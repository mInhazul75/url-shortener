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

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UrlsController;



Route::get('/login', [AuthController::class, 'loginView']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'authenticate'])->name('login');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('/home', [AuthController::class, 'home'])->name('home');
Route::post('/register', [AuthController::class, 'registerUser'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('shorten-urls', UrlsController::class);
Route::get('/{slug}', [UrlsController::class, 'redirect'] )->name('shorten.redirect');
