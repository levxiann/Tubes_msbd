<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');

Route::get('/', [DashboardController::class, 'index']);

Route::get('/logout',function(){

    auth()->logout();

    return Redirect::to('/');
    
})->name('logout');

Route::get('/document_group', [App\Http\Controllers\TypeController::class, 'group']);

Route::get('/document_group/update/{id}', [App\Http\Controllers\TypeController::class, 'group_edit']);

Route::put('/document_group/update/{id}', [App\Http\Controllers\TypeController::class, 'group_update']);

Route::get('/document_group/create', [App\Http\Controllers\TypeController::class, 'group_create']);

Route::put('/document_group/create', [App\Http\Controllers\TypeController::class, 'group_insert']);

Route::get('/document_type', [App\Http\Controllers\TypeController::class, 'type']);

Route::get('/document_type/update/{id}', [App\Http\Controllers\TypeController::class, 'type_edit']);

Route::put('/document_type/update/{id}', [App\Http\Controllers\TypeController::class, 'type_update']);

Route::get('/document_type/create', [App\Http\Controllers\TypeController::class, 'type_create']);

Route::put('/document_type/create', [App\Http\Controllers\TypeController::class, 'type_insert']);

Route::get('/mail_type', [App\Http\Controllers\TypeController::class, 'mail']);

Route::get('/mail_type/update/{id}', [App\Http\Controllers\TypeController::class, 'mail_edit']);

Route::put('/mail_type/update/{id}', [App\Http\Controllers\TypeController::class, 'mail_update']);

Route::get('/mail_type/create', [App\Http\Controllers\TypeController::class, 'mail_create']);

Route::put('/mail_type/create', [App\Http\Controllers\TypeController::class, 'mail_insert']);

Route::get('/section', [App\Http\Controllers\TypeController::class, 'section']);

Route::get('/section/update/{id}', [App\Http\Controllers\TypeController::class, 'section_edit']);

Route::put('/section/update/{id}', [App\Http\Controllers\TypeController::class, 'section_update']);

Route::get('/section/create', [App\Http\Controllers\TypeController::class, 'section_create']);

Route::put('/section/create', [App\Http\Controllers\TypeController::class, 'section_insert']);