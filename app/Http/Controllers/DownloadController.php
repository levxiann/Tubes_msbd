<?php

namespace App\Http\Controllers;
use App\Models\Document;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function download($namafile)
    {
        if(file_exists(public_path('documents/'.$namafile)))
        {
            return response()->download(public_path('documents/'.$namafile));
        }
        else
        {
            return redirect()->back()->with('error', 'File Tidak Ditemukan');
        } 
    }
}