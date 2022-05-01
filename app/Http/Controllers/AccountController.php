<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        $users =  DB::table('users')->get() ;
        return view('repositori.users_data',['users' => $users]);
    }

    public function index1()
    {
        $users =  DB::table('users')->get() ;
        return view('repositori.users_profile',['users' => $users]);
    }

    public function adding_form()
    {
        return view('repositori/add_data');
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
                'name' => ['required', 'string', 'max:50'],
                'username' => ['required'],
                'email' => ['required'],
                'password' => ['required', 'string', 'min:8'],
                'tanggal_lahir' => ['required'],
                'alamat' => ['required'],
                'no_hp' => ['required'],
                'role' => ['required'],
                'section_id' => ['required', 'numeric']
            ]);
            
            // $users = new user;
            // $users->name = $request->name;
            // $users->username = $request->username;
            // $users->email = $request->email;
            // $users->tanggal_lahir = $request->tanggal_lahir;
            // $users->alamat = $request->alamat;
            // $users->no_hp = $request->no_hp;
            // $users->role = $request->role;
            // $users->section_id = $request->section_id;
            // $users->save();

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
            return redirect('/Data_Users')->with('message' , 'Selamat, Produk baru berhasil disimpan!');
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /*
    public function edit($id)
    {
        $users = DB::table('users')->where('id',$id)->get();
        return view('edit',['users' => $users]);
    }

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
        $users= DB::table('users')->where('id',$id)->get();
        return view('repositori/edit_data', compact('users'));
    }

    public function update(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'username' => ['required'],
            'email' => ['required'],
            // 'password' => ['required', 'string', 'min:8'],
            'tanggal_lahir' => ['required'],
            'alamat' => ['required'],
            'no_hp' => ['required'],
            'role' => ['required'],
            'section_id' => ['required', 'numeric']
        ]);

        DB::table('users')->where('id', $request->id)
        ->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'role' => $request->role,
            'section_id' => $request->section_id,
        ]);
    //     return redirect('/Data_Users')->with('message' , 'Selamat, Data berhasil diperbarui!');
        
        // $users = User::find($request->id);
        // $users->name = $request->name;
        // $users->email = $request->email;
        // $users->username = $request->username;
        // $users->tanggal_lahir = $request->tanggal_lahir;
        // $users->alamat = $request->alamat;
        // $users->no_hp = $request->no_hp;
        // $users->role = $request->role;
        // $users->section_id = $request->section_id;
        // $users->update();

        if($request->password != NULL)
        {
            User::where('id', $request->id)
            ->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return redirect('/Data_Users')->with('message' , 'Selamat, Data berhasil diperbarui!');
    }
    
    //method untuk halaman profile
    public function edit_prof(Request $request, $id)
    {
        $users= DB::table('users')->where('id',$id)->get();
        return view('repositori/edit_profil', compact('users'));
    }

    public function update_prof(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'username' => ['required'],
            'email' => ['required'],
            // 'password' => ['required', 'string', 'min:8'],
            'tanggal_lahir' => ['required'],
            'alamat' => ['required'],
            'no_hp' => ['required'],
            //'role' => ['required'],
            //'section_id' => ['required', 'numeric']
        ]);

        DB::table('users')->where('id', $request->id)
        ->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            //'password' => $request->password,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            //'role' => $request->role,
            //'section_id' => $request->section_id,
        ]);

        // $users = User::find($request->id);
        // $users->name = $request->name;
        // $users->email = $request->email;
        // $users->username = $request->username;
        // $users->tanggal_lahir = $request->tanggal_lahir;
        // $users->alamat = $request->alamat;
        // $users->no_hp = $request->no_hp;
        // $users->role = $request->role;
        // $users->section_id = $request->section_id;
        // $users->update();

        return redirect('/profil_user')->with('message' , 'Selamat, Data berhasil diperbarui!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hapus($id)
    {
        $users= DB::table('users')->where('id',$id)->delete();
        //User::destroy($id);
        return redirect('/Data_Users');
    }
}
