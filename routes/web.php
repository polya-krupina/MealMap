<?php

use App\Http\Controllers\AllergyController;
use App\Http\Controllers\DishesController;
use App\Http\Controllers\KidController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TemplatesController;
use App\Http\Controllers\UserGroupController;
use App\Http\Controllers\WorkerController;
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
// Parent routes;

Route::get('/', [UserGroupController::class, 'index'])->middleware('auth')->name('home');

Route::get('login', [SessionController::class,'login'])->middleware('guest')->name('login');
Route::post('sessions', [SessionController::class,'store'])->middleware('guest');
Route::get('logout', [SessionController::class,'destroy'])->middleware('auth');


Route::get('kids/{kid:id}', [ParentController::class,'show'])->middleware('parent')->name('kid');
Route::get('kids/{kid:id}/order', [OrderController::class,'show'])->middleware('parent');
Route::get('kids/{kid:id}/allergies', [ParentController::class, 'allergy'])->middleware('parent');

Route::get('/payment', [ParentController::class, 'payment'])->middleware('parent');
Route::get('/payment/history', [ParentController::class, 'history'])->middleware('parent');
Route::post('pay', [ParentController::class, 'pay'])->middleware('parent');

Route::post('orders', [OrderController::class, 'store']);

Route::get('/templates', [TemplatesController::class, 'show'])->middleware('parent');
Route::get('/templates/create', [TemplatesController::class, 'create'])->middleware('parent');
Route::post('/templates/save', [TemplatesController::class, 'save'])->middleware('parent');
Route::post('/templates/{preset:id}/delete', [TemplatesController::class, 'destroy'])->middleware('parent');
Route::get('/templates/{preset:id}/edit', [TemplatesController::class, 'edit'])->middleware('parent');
Route::post('/templates/{preset:id}/update', [TemplatesController::class, 'update'])->middleware('parent');

Route::post('meals/add', [MealController::class, 'add']);

Route::delete('/order/{order:id}/delete', [OrderController::class,'destroy'])->middleware('parent');

Route::post('allergy', [AllergyController::class,'create'])->middleware('parent');
Route::delete('allergy', [AllergyController::class,'delete'])->middleware('parent');

Route::get('/dishes',[DishesController::class, 'show'])->middleware('parent');
Route::get('/dish/{dish:id}',[DishesController::class, 'send'])->middleware('auth');
Route::post('/dish/remove', [DishesController::class, 'destroy'])->middleware('auth');

Route::post('/upload-avatar', [KidController::class, 'avatarChange'])->middleware('parent');
Route::post('/save', [OrderController::class, 'save']);



// Worker routes
Route::get('/schedule', [WorkerController::class, 'schedule'])->middleware('canteen');
Route::get('/menu', [WorkerController::class, 'menu'])->middleware('canteen');
Route::post('/menu/save', [WorkerController::class, 'save'])->middleware('canteen');

Route::post('/send-message', [MessageController::class, 'create'])->middleware('auth');
Route::get('/get-messages/{group:id}', [MessageController::class, 'get'])->middleware('auth');