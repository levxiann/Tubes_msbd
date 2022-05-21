<?php

namespace App\Http\Controllers;

use App\Models\Inmail;
use App\Models\MailType;
use App\Models\Outmail;
use App\Models\Section;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OutmailController extends Controller
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
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','outmail');
        session()->put('submenu','rekapoutmail');

        $types = MailType::all();
        $sections = Section::all();
        $outmails = Outmail::all();

        return view('repositori.outmails', compact('outmails', 'types', 'sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','outmail');
        session()->put('submenu','insertoutmail');

        $types = MailType::all();
        $sections = Section::all();

        return view('repositori.createoutmail', compact('types', 'sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','outmail');
        session()->put('submenu','insertoutmail');

        $request->validate([
            'nooutmail' => 'required|string|max:50|unique:outmails,no',
            'jenis' => 'required',
            'bagian' => 'required',
            'tanggalkeluar' => 'required|before:tomorrow',
            'perihal' => 'required|string|max:255',
            'pokok' => 'required|string|max:255',
            'filesurat' => 'required|mimes:pdf'
        ]);

        $name = date('dmY_His') . "_" . $request->file('filesurat')->getClientOriginalName();

        $request->file('filesurat')->move(public_path('outmails'), $name);

        try
        {
            Outmail::create([
                'no' => rtrim($request->nooutmail, '/'),
                'mail_type_id' => $request->jenis,
                'section_id' => $request->bagian,
                'tanggal_keluar' => $request->tanggalkeluar,
                'perihal' => $request->perihal,
                'pokok_masalah' => $request->pokok,
                'file_surat' => $name,
                'status' => 1 
            ]);
        }
        catch(QueryException $e)
        {
            return redirect('/outmail')->with('error', 'Terjadi Kesalahan');
        }

        return redirect('/outmail')->with('success', 'Surat Keluar Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','outmail');
        session()->put('submenu','rekapoutmail');

        $outmail = Outmail::findOrFail($id);

        return view('repositori.outmaildetail', compact('outmail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','outmail');
        session()->put('submenu','rekapoutmail');

        $types = MailType::all();
        $sections = Section::all();
        $outmail = Outmail::findOrFail($id);

        return view('repositori.editoutmail', compact('outmail', 'types', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','outmail');
        session()->put('submenu','rekapoutmail');

        $request->validate([
            'nooutmail' => 'required|string|max:50|unique:outmails,no,'.$id.',no',
            'jenis' => 'required',
            'bagian' => 'required',
            'tanggalkeluar' => 'required|before:tomorrow',
            'perihal' => 'required|string|max:255',
            'pokok' => 'required|string|max:255',
            'filesurat' => 'mimes:pdf'
        ]);

        try
        {
            Outmail::where('no', $id)->update([
                'no' => rtrim($request->nooutmail, '/'),
                'mail_type_id' => $request->jenis,
                'section_id' => $request->bagian,
                'tanggal_keluar' => $request->tanggalkeluar,
                'perihal' => $request->perihal,
                'pokok_masalah' => $request->pokok,
            ]);
        }
        catch(QueryException $e)
        {
            return redirect('/outmail')->with('error', 'Terjadi Kesalahan');
        }
        

        if($request->has('filesurat'))
        {
            $name = date('dmY_His') . "_" . $request->file('filesurat')->getClientOriginalName();

            $request->file('filesurat')->move(public_path('outmails'), $name);

            Outmail::where('no', rtrim($request->nooutmail, '/'))->update([
                'file_surat' => $name
            ]);
        }

        return redirect('/outmail/'.rtrim($request->nooutmail, '/'))->with('success', 'Surat Keluar Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','outmail');
        session()->put('submenu','rekapoutmail');

        Outmail::destroy($id);

        return redirect('/outmail')->with('success', 'Surat Keluar berhasil dihapus');
    }

    public function search(Request $request)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','outmail');
        session()->put('submenu','rekapoutmail');

        $types = MailType::all();
        $sections = Section::all();
        $outmails = Outmail::select('*')
                    ->when($request->type != '0', function($query) use ($request){
                        return $query->where('mail_type_id', $request->type);
                    })
                    ->when($request->section != '0', function($query) use ($request){
                        return $query->where('section_id', $request->section);
                    })
                    ->when($request->tahun != NULL, function($query) use ($request){
                        return $query->where('tanggal_keluar', '>=', date('Y-m-d', strtotime("1 January " . $request->tahun)))->where('tanggal_keluar', '<=', date('Y-m-d', strtotime("31 December " . $request->tahun)));
                    })->get();

        return view('repositori.outmails', compact('outmails', 'types', 'sections'));
    }

    public function markToRead($id)
    {

        Outmail::where('no', $id)->update([
            'status' => 2
        ]);

        return redirect('outmail/'.$id)->with('success', 'Status berhasil diubah');
    }

    public function cetakOutmail($id)
    {
        $outmail = Outmail::findOrFail($id);

        if(file_exists(public_path('outmails/'.$outmail->file_surat)))
        {
            return response()->download(public_path('outmails/'.$outmail->file_surat));
        }
        else
        {
            return redirect()->back()->with('error', 'File Tidak Ditemukan');
        } 
    }
}
