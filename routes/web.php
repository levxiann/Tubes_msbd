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
Route::get('/laporan_inmail',[App\Http\Controllers\PrintController::class, 'viewInmail'])->name('laporan_inmail');
Route::get('/print_inmail',[App\Http\Controllers\PrintController::class, 'printInmail'])->name('print-inmail');

Route::get('/laporan_outmail',[App\Http\Controllers\PrintController::class, 'viewOutmail'])->name('laporan_outmail');
Route::get('/print_outmail',[App\Http\Controllers\PrintController::class, 'printOutmail'])->name('print-outmail');

Route::get('/laporan_disposisi',[App\Http\Controllers\PrintController::class, 'viewDisposition'])->name('laporan-disposisi');
Route::get('/print_disposisi',[App\Http\Controllers\PrintController::class, 'printDisposition'])->name('print-disposisi');

Route::get('/', [DashboardController::class, 'index']);

Route::get('/logout',function(){

    auth()->logout();

    return Redirect::to('/');
    
})->name('logout');
