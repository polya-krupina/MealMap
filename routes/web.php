<?php

use App\Http\Controllers\ParentController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserGroupController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [UserGroupController::class, 'index'])->middleware('auth')->name('home');

Route::get('login', [SessionController::class,'login'])->middleware('guest')->name('login');
Route::post('sessions', [SessionController::class,'store'])->middleware('guest');
Route::get('logout', [SessionController::class,'destroy'])->middleware('auth');


Route::get('kids/{kid:id}', [ParentController::class,'show'])->middleware('auth');