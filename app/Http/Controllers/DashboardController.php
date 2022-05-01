<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        session()->put('menu','dash');
        session()->put('submenu','dash');

        return view('repositori.dashboard');
    }
}
