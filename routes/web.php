<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DownloadController;
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

Route::get('/document', [DocumentController::class, 'index']);

Route::get('/document/inputdocument', [DocumentController::class, 'create']);

Route::post('/document/inputdocument', [DocumentController::class, 'store']);

Route::get('/document/editdocument/{no}', [DocumentController::class, 'edit']);

Route::put('/document/editdocument/{no}', [DocumentController::class, 'update']);

Route::delete('/document/{no}', [DocumentController::class, 'destroy']);

Route::get('/document/download/{file_dokumen}', [DownloadController::class, 'download']);

Route::get('/document/detaildocument/{no}', [DocumentController::class, 'detail']);

Route::get('/logout',function(){

    auth()->logout();

    return Redirect::to('/');
    
})->name('logout');
