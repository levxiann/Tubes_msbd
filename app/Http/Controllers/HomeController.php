<?php

namespace App\Http\Controllers;

use App\Models\Disposition;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Inmail;
use App\Models\MailType;
use App\Models\Outmail;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       return view('home');
    }
}
