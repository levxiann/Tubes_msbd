<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->role != 'admin')
        {
            return redirect('/home');
        }

        session()->put('menu','users');
        session()->put('submenu','users');

        $users =  User::all();
        return view('repositori.users_data', compact('users'));
    }

    public function index1()
    {
        session()->put('menu','profil');
        session()->put('submenu','profil');
        
        return view('repositori.users_profile');
    }

    public function adding_form()
    {
        if(Auth::user()->role != 'admin')
        {
            return redirect('/home');
        }

        session()->put('menu','users');
        session()->put('submenu','users');

        $sections = Section::all();

        return view('repositori.add_data', compact('sections'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|min:3|max:20|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'conpass' => 'required|same:password',
            'tanggal_lahir' => 'required|before:tomorrow',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'role' => 'required',
            'section_id' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'role' => $request->role,
            'section_id' => $request->section_id
        ]);
        
        return redirect('/Data_Users')->with('success' , 'User berhasil ditambah');
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /*

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if(Auth::user()->role != 'admin')
        {
            return redirect('/home');
        }

        session()->put('menu','users');
        session()->put('submenu','users');

        $user = User::findOrFail($id);
        $sections = Section::all();

        return view('repositori.edit_data', compact('user', 'sections'));
    }

    public function update(Request $request, $id)
    {
        if(Auth::user()->role != 'admin')
        {
            return redirect('/home');
        }

        session()->put('menu','users');
        session()->put('submenu','users');

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|min:3|max:20|unique:users,username,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'tanggal_lahir' => 'required|before:tomorrow',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'role' => 'required',
            'section_id' => 'required'
        ]);

        User::where('id', $request->id)
        ->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'role' => $request->role,
            'section_id' => $request->section_id,
        ]);

        if($request->password != NULL)
        {
            $request->validate([
                'password' => 'required|string|min:8',
                'conpass' => 'required|same:password',
            ]);

            User::where('id', $request->id)
            ->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return redirect('/Data_Users')->with('success' , 'User berhasil diedit');
    }
    
    //method untuk halaman profile
    public function edit_prof(Request $request)
    {
        session()->put('menu','profil');
        session()->put('submenu','profil');

        return view('repositori.edit_profil');
    }

    public function update_prof(Request $request)
    {
        session()->put('menu','profil');
        session()->put('submenu','profil');

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|min:3|max:20|unique:users,username,'.Auth::user()->id,
            'email' => 'required|string|email|max:255|unique:users,email,'.Auth::user()->id,
            'tanggal_lahir' => 'required|before:tomorrow',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
        ]);

        User::where('id', Auth::user()->id)
        ->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        return redirect('/profil_user')->with('success' , 'Profil berhasil diedit');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hapus($id)
    {
        User::destroy($id);

        return redirect('/Data_Users')->with('success', 'User berhasil dihapus');
    }
}
