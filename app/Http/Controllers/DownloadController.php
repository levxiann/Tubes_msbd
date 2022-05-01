<?php

namespace App\Http\Controllers;
use App\Models\Document;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function download($namafile){
        return response()->download(public_path('documents/'.$namafile));
    }
}