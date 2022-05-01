<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccountController;
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

Route::get('/Data_Users', [App\Http\Controllers\AccountController::class, 'index'])->name('users_data');

Route::get('/Data_Users/add', [AccountController::class, 'adding_form']);

Route::post('/Data_Users/Tambah_Data', [App\Http\Controllers\AccountController::class, 'store'])->name('add_data');

Route::get('/Data_Users/edit/{id}', [App\Http\Controllers\AccountController::class, 'edit'] );

Route::post('/Data_Users/update_data',[App\Http\Controllers\AccountController::class, 'update'] );

Route::get('/Data_Users/hapus/{id}', [App\Http\Controllers\AccountController::class, 'hapus'] );

Route::get('/profil_user', [App\Http\Controllers\AccountController::class, 'index1'])->name('users_profile');

Route::get('/profil_user/edit/{id}', [App\Http\Controllers\AccountController::class, 'edit_prof'] );

Route::post('/profil_user/update_profil',[App\Http\Controllers\AccountController::class, 'update_prof'] );

Route::get('/logout',function(){

    auth()->logout();

    return Redirect::to('/');
    
})->name('logout');
