<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InmailController;
use App\Http\Controllers\OutmailController;
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

Route::get('/inmail', [InmailController::class, 'index']);

Route::get('/inmail/search', [InmailController::class, 'search']);

Route::get('/inmail/{no}', [InmailController::class, 'show']);

Route::get('/inmail/status/{no}', [InmailController::class, 'markToRead']);

Route::get('/inmails/create', [InmailController::class, 'create']);

Route::post('/inmail/store', [InmailController::class, 'store']);

Route::get('/inmail/edit/{no}', [InmailController::class, 'edit']);

Route::patch('/inmail/update/{no}', [InmailController::class, 'update']);

Route::delete('/inmail/hapus/{no}', [InmailController::class, 'destroy']);

Route::get('/inmails/dispo', [InmailController::class, 'dispo']);

Route::get('/inmail/dispo/{no}', [InmailController::class, 'disposhow']);

Route::get('/inmails/dispo/search', [InmailController::class, 'disposearch']);

Route::get('/inmail/dispo/create/{no}', [InmailController::class, 'dispocreate']);

Route::post('/inmail/dispo/store/{no}', [InmailController::class, 'dispostore']);

Route::get('/inmail/dispo/edit/{no}', [InmailController::class, 'dispoedit']);

Route::patch('/inmail/dispo/update/{id}/{nosurat}', [InmailController::class, 'dispoupdate']);

Route::delete('/inmail/dispo/hapus/{nosurat}/{id}', [InmailController::class, 'dispodelete']);

Route::get('/inmails/dispo/status/{no}', [InmailController::class, 'markToReadDispo']);

Route::get('/inmail/dispo/preview/{no}', [InmailController::class, 'cetakDispo']);

Route::get('/inmail/download/{no}', [InmailController::class, 'cetakInmail']);

Route::get('/outmail', [OutmailController::class, 'index']);

Route::get('/outmail/search', [OutmailController::class, 'search']);

Route::get('/outmail/{no}', [OutmailController::class, 'show']);

Route::get('/outmail/status/{no}', [OutmailController::class, 'markToRead']);

Route::get('/outmails/create', [OutmailController::class, 'create']);

Route::post('/outmail/store', [OutmailController::class, 'store']);

Route::get('/outmail/edit/{no}', [OutmailController::class, 'edit']);

Route::patch('/outmail/update/{no}', [OutmailController::class, 'update']);

Route::get('/outmail/download/{no}', [OutmailController::class, 'cetakOutmail']);

Route::delete('/outmail/hapus/{no}', [OutmailController::class, 'destroy']);

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

    if(session('status'))
    {
        $status = session('status');

        return Redirect::to('/login')->with('status', $status);
    }

    return Redirect::to('/login');
    
})->name('logout');
