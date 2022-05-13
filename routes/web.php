<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\InmailController;
use App\Http\Controllers\OutmailController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\TypeController;
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

Route::get('/inmail/{no}', [InmailController::class, 'show'])->where('no', '.*');

Route::get('/inmails/status/{no}', [InmailController::class, 'markToRead'])->where('no', '.*');

Route::get('/inmails/create', [InmailController::class, 'create']);

Route::post('/inmail/store', [InmailController::class, 'store']);

Route::get('/inmails/edit/{no}', [InmailController::class, 'edit'])->where('no', '.*');

Route::patch('/inmails/update/{no}', [InmailController::class, 'update'])->where('no', '.*');

Route::delete('/inmails/hapus/{no}', [InmailController::class, 'destroy'])->where('no', '.*');

Route::get('/inmails/dispo', [InmailController::class, 'dispo']);

Route::get('/inmails/dispo/{no}', [InmailController::class, 'disposhow'])->where('no', '.*');

Route::get('/inmailss/dispo/search', [InmailController::class, 'disposearch']);

Route::get('/inmailss/dispo/create/{no}', [InmailController::class, 'dispocreate'])->where('no', '.*');

Route::post('/inmails/dispo/store/{no}', [InmailController::class, 'dispostore'])->where('no', '.*');

Route::get('/inmailss/dispo/edit/{no}', [InmailController::class, 'dispoedit'])->where('no', '.*');

Route::patch('/inmail/dispo/update/{id}', [InmailController::class, 'dispoupdate'])->where('id', '.*');

Route::delete('/inmails/dispo/hapus/{id}', [InmailController::class, 'dispodelete'])->where('id', '.*');

Route::get('/inmailss/dispo/status/{no}', [InmailController::class, 'markToReadDispo'])->where('no', '.*');

Route::get('/inmailss/dispo/preview/{no}', [InmailController::class, 'cetakDispo'])->where('no', '.*');

Route::get('/inmails/download/{no}', [InmailController::class, 'cetakInmail'])->where('no', '.*');

Route::get('/outmail', [OutmailController::class, 'index']);

Route::get('/outmail/search', [OutmailController::class, 'search']);

Route::get('/outmail/{no}', [OutmailController::class, 'show'])->where('no', '.*');

Route::get('/outmails/status/{no}', [OutmailController::class, 'markToRead'])->where('no', '.*');

Route::get('/outmails/create', [OutmailController::class, 'create']);

Route::post('/outmail/store', [OutmailController::class, 'store']);

Route::get('/outmails/edit/{no}', [OutmailController::class, 'edit'])->where('no', '.*');

Route::patch('/outmails/update/{no}', [OutmailController::class, 'update'])->where('no', '.*');

Route::get('/outmails/download/{no}', [OutmailController::class, 'cetakOutmail'])->where('no', '.*');

Route::delete('/outmails/hapus/{no}', [OutmailController::class, 'destroy'])->where('no', '.*');

Route::get('/Data_Users', [AccountController::class, 'index'])->name('users_data');

Route::get('/Data_Users/add', [AccountController::class, 'adding_form']);

Route::post('/Data_Users/Tambah_Data', [AccountController::class, 'store'])->name('add_data');

Route::get('/Data_Users/edit/{id}', [AccountController::class, 'edit'] );

Route::patch('/Data_Users/update_data/{id}',[AccountController::class, 'update'] );

Route::delete('/Data_Users/hapus/{id}', [AccountController::class, 'hapus'] );

Route::get('/profil_user', [AccountController::class, 'index1'])->name('users_profile');

Route::get('/profil_user/edit', [AccountController::class, 'edit_prof'] );

Route::patch('/profil_user/update_profil',[AccountController::class, 'update_prof'] );

Route::get('/laporan_inmail',[PrintController::class, 'viewInmail'])->name('laporan_inmail');

Route::get('/print_inmail',[PrintController::class, 'printInmail'])->name('print-inmail');

Route::get('/laporan_outmail',[PrintController::class, 'viewOutmail'])->name('laporan_outmail');

Route::get('/print_outmail',[PrintController::class, 'printOutmail'])->name('print-outmail');

Route::get('/laporan_disposisi',[PrintController::class, 'viewDisposition'])->name('laporan-disposisi');

Route::get('/print_disposisi',[PrintController::class, 'printDisposition'])->name('print-disposisi');

Route::get('/document', [DocumentController::class, 'index']);

Route::get('/document/search', [DocumentController::class, 'search']);

Route::get('/document/inputdocument', [DocumentController::class, 'create']);

Route::post('/document/inputdocument', [DocumentController::class, 'store']);

Route::get('/document/editdocument/{no}', [DocumentController::class, 'edit'])->where('no', '.*');

Route::put('/document/editdocument/{no}', [DocumentController::class, 'update'])->where('no', '.*');

Route::delete('/document/{no}', [DocumentController::class, 'destroy'])->where('no', '.*');

Route::get('/document/download/{file_dokumen}', [DownloadController::class, 'download'])->where('file_dokumen', '.*');

Route::get('/document/detaildocument/{no}', [DocumentController::class, 'detail'])->where('no', '.*'); 

Route::get('/document_group', [TypeController::class, 'group']);

Route::get('/document_group/update/{id}', [TypeController::class, 'group_edit']);

Route::put('/document_group/update/{id}', [TypeController::class, 'group_update']);

Route::get('/document_group/create', [TypeController::class, 'group_create']);

Route::post('/document_group/store', [TypeController::class, 'group_insert']);

Route::get('/document_type', [TypeController::class, 'type']);

Route::get('/document_type/update/{id}', [TypeController::class, 'type_edit']);

Route::put('/document_type/update/{id}', [TypeController::class, 'type_update']);

Route::get('/document_type/create', [TypeController::class, 'type_create']);

Route::post('/document_type/store', [TypeController::class, 'type_insert']);

Route::get('/mail_type', [TypeController::class, 'mail']);

Route::get('/mail_type/update/{id}', [TypeController::class, 'mail_edit']);

Route::put('/mail_type/update/{id}', [TypeController::class, 'mail_update']);

Route::get('/mail_type/create', [TypeController::class, 'mail_create']);

Route::post('/mail_type/store', [TypeController::class, 'mail_insert']);

Route::get('/section', [TypeController::class, 'section']);

Route::get('/section/update/{id}', [TypeController::class, 'section_edit']);

Route::put('/section/update/{id}', [TypeController::class, 'section_update']);

Route::get('/section/create', [TypeController::class, 'section_create']);

Route::post('/section/store', [TypeController::class, 'section_insert']);

Route::get('/logout',function(){

    auth()->logout();

    if(session('status'))
    {
        $status = session('status');

        return Redirect::to('/login')->with('status', $status);
    }

    return Redirect::to('/login');
    
})->name('logout');

Route::get('/register', function(){

    return Redirect::to('/login');
})->name('register');

