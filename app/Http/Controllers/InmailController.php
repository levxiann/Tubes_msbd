<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Disposition;
use App\Models\Inmail;
use App\Models\MailType;
use App\Models\Section;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class InmailController extends Controller
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
        session()->put('menu','inmail');
        session()->put('submenu','rekapinmail');

        $types = MailType::all();
        $sections = Section::all();

        if(Auth::user()->role == "lainnya")
        {
            $inmails = Inmail::where('section_id', Auth::user()->section_id)->get();

            return view('repositori.inmailslainnya', compact('inmails', 'types'));
        }
        else
        {
            $inmails = Inmail::all();

            return view('repositori.inmails', compact('inmails', 'types', 'sections'));
        }
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

        session()->put('menu','inmail');
        session()->put('submenu','insertinmail');

        $types = MailType::all();
        $sections = Section::all();

        return view('repositori.createinmail', compact('types', 'sections'));
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

        session()->put('menu','inmail');
        session()->put('submenu','insertinmail');

        $request->validate([
            'noinmail' => 'required|string|max:50|unique:inmails,no',
            'jenis' => 'required',
            'bagian' => 'required',
            'tanggalmasuk' => 'required|before:tomorrow',
            'perihal' => 'required|string|max:255',
            'pokok' => 'required|string|max:255',
            'dispo' => 'required',
            'filesurat' => 'required|mimes:pdf'
        ]);

        $name = date('dmY_His') . "_" . $request->file('filesurat')->getClientOriginalName();

        $request->file('filesurat')->move(public_path('inmails'), $name);

        try
        {
            Inmail::create([
                'no' => rtrim($request->noinmail, '/'),
                'mail_type_id' => $request->jenis,
                'section_id' => $request->bagian,
                'tanggal_masuk' => $request->tanggalmasuk,
                'perihal' => $request->perihal,
                'pokok_masalah' => $request->pokok,
                'disposisi' => 2,
                'status' => 1,
                'file_surat' => $name 
            ]);
        }
        catch (QueryException $e)
        {
            return redirect('/inmail')->with('error', 'Terjadi Kesalahan');
        }

        if($request->dispo == 'Y')
        {
            return redirect('/inmailss/dispo/create/'.rtrim($request->noinmail, '/'))->with('success', 'Surat Masuk Berhasil Ditambah');
        }
        else
        {   
            return redirect('/inmail')->with('success', 'Surat Masuk Berhasil Ditambah');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        session()->put('menu','inmail');
        session()->put('submenu','rekapinmail');

        $inmail = Inmail::findOrFail($id);

        if((Auth::user()->role == 'lainnya') && $inmail->section_id != Auth::user()->section_id)
        {
            return redirect('/inmail');
        }

        return view('repositori.inmaildetail', compact('inmail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','inmail');
        session()->put('submenu','rekapinmail');

        $types = MailType::all();
        $sections = Section::all();
        $inmail = Inmail::findOrFail($id);

        return view('repositori.editinmail', compact('inmail', 'types', 'sections'));
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

        session()->put('menu','inmail');
        session()->put('submenu','rekapinmail');

        $request->validate([
            'noinmail' => 'required|string|max:50|unique:inmails,no,'.$id.',no',
            'jenis' => 'required',
            'bagian' => 'required',
            'tanggalmasuk' => 'required|before:tomorrow',
            'perihal' => 'required|string|max:255',
            'pokok' => 'required|string|max:255',
            'filesurat' => 'mimes:pdf'
        ]);

        try
        {
            Inmail::where('no', $id)->update([
                'no' => rtrim($request->noinmail, '/'),
                'mail_type_id' => $request->jenis,
                'section_id' => $request->bagian,
                'tanggal_masuk' => $request->tanggalmasuk,
                'perihal' => $request->perihal,
                'pokok_masalah' => $request->pokok,
            ]);
        }
        catch(QueryException $e)
        {
            return redirect('/inmail')->with('error', 'Terjadi Kesalahan');
        }

        if($request->has('filesurat'))
        {
            $name = date('dmY_His') . "_" . $request->file('filesurat')->getClientOriginalName();

            $request->file('filesurat')->move(public_path('inmails'), $name);

            Inmail::where('no', rtrim($request->noinmail, '/'))->update([
                'file_surat' => $name
            ]);
        }

        return redirect('/inmail/'.rtrim($request->noinmail, '/'))->with('success', 'Surat Masuk Berhasil Diubah');
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

        session()->put('menu','inmail');
        session()->put('submenu','rekapinmail');

        Inmail::destroy($id);

        return redirect('inmail')->with('success', 'Surat Masuk berhasil dihapus');
    }

    public function search(Request $request)
    {
        session()->put('menu','inmail');
        session()->put('submenu','rekapinmail');

        $types = MailType::all();
        $sections = Section::all();

        if(Auth::user()->role == "lainnya")
        {
            $inmails = Inmail::where('section_id', Auth::user()->section_id)
                    ->when($request->type != '0', function($query) use ($request){
                        return $query->where('mail_type_id', $request->type);
                    })
                    ->when($request->tahun != NULL, function($query) use ($request){
                        return $query->where('tanggal_masuk', '>=', date('Y-m-d', strtotime("1 January " . $request->tahun)))->where('tanggal_masuk', '<=', date('Y-m-d', strtotime("31 December " . $request->tahun)));
                    })->get();
        
            return view('repositori.inmailslainnya', compact('inmails', 'types'));
        }
        else
        {
            $inmails = Inmail::select('*')
                    ->when($request->type != '0', function($query) use ($request){
                        return $query->where('mail_type_id', $request->type);
                    })
                    ->when($request->section != '0', function($query) use ($request){
                        return $query->where('section_id', $request->section);
                    })
                    ->when($request->tahun != NULL, function($query) use ($request){
                        return $query->where('tanggal_masuk', '>=', date('Y-m-d', strtotime("1 January " . $request->tahun)))->where('tanggal_masuk', '<=', date('Y-m-d', strtotime("31 December " . $request->tahun)));
                    })->get();

            return view('repositori.inmails', compact('inmails', 'types', 'sections'));
        }
    }

    public function dispo()
    {
        if(Auth::user()->role != 'lainnya')
        {
            return redirect('/inmail');
        }

        session()->put('menu','inmail');
        session()->put('submenu','rekapdispo');

        $types = MailType::all();
        $sections = Section::all();
        $dispositions = Destination::where('section_id', Auth::user()->section_id)->get();

        return view('repositori.dispo', compact('dispositions', 'types', 'sections'));
    }

    public function disposhow($id)
    {
        if(Auth::user()->role != 'lainnya')
        {
            return redirect('/inmail');
        }

        session()->put('menu','inmail');
        session()->put('submenu','rekapdispo');

        $inmail = Inmail::findOrFail($id);

        $cek = 'no';

        if($inmail->disposition == NULL)
        {
            return redirect('/inmails/dispo');
        }

        if(Auth::user()->role == 'lainnya')
        {
            foreach($inmail->disposition->destinations as $dest)
            {
                if($dest->section_id == Auth::user()->section_id)
                {
                    $cek = 'ada';
                    break;
                }
            }
            if($cek == 'no')
            {
                return redirect('/inmails/dispo');
            }
        }

        return view('repositori.dispodetail', compact('inmail'));
    }

    public function disposearch(Request $request)
    {
        if(Auth::user()->role != 'lainnya')
        {
            return redirect('/inmail');
        }

        session()->put('menu','inmail');
        session()->put('submenu','rekapdispo');

        $types = MailType::all();
        $sections = Section::all();
        $dispositions = Destination::where('section_id', Auth::user()->section_id)
                        ->when($request->type != '0', function($query) use($request){
                            return $query->whereHas('disposition', function($qry) use ($request){
                                $qry->whereHas('inmail', function($q) use ($request){
                                    $q->where('mail_type_id', $request->type);
                                });
                            });
                        })
                        ->when($request->section != '0', function($query) use($request){
                            return $query->whereHas('disposition', function($qry) use ($request){
                                $qry->whereHas('inmail', function($q) use ($request){
                                    $q->where('section_id', $request->section);
                                });
                            });
                        })->get();

        return view('repositori.dispo', compact('dispositions', 'types', 'sections'));
    }

    public function dispocreate($no)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','inmail');
        session()->put('submenu','rekapinmail');

        $inmail = Inmail::findOrFail($no);
        $sections = Section::all();

        return view('repositori.createdispo', compact('inmail', 'sections'));
    }

    public function dispostore(Request $request, $no)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','inmail');
        session()->put('submenu','rekapinmail');

        $request->validate([
            'nodispo' => 'required|string|max:50|unique:dispositions,no',
            'tanggaldispo' => 'required',
            'isidispo' => 'required|string|max:255',
            'dituju' => 'required',
        ]);

        $dispo = Disposition::where('inmail_no', $no)->count();

        if($dispo > 0)
        {
            return redirect('inmail/'.$no)->with('error', 'Disposisi untuk surat tersebut sudah ada');
        }
        else
        {
            try 
            {
                Disposition::create([
                    'no' => rtrim($request->nodispo, '/'),
                    'inmail_no' => $no,
                    'tanggal_disposisi' => $request->tanggaldispo,
                    'isi_disposisi' => $request->isidispo,
                    'status' => 1
                ]);
            } 
            catch (QueryException $e) 
            {
                return redirect('/inmail')->with('error', 'Terjadi Kesalahan');
            }
        }

        foreach($request->dituju as $dituju)
        {
            Destination::create([
                'disposition_no' => rtrim($request->nodispo, '/'),
                'section_id' => $dituju
            ]);
        }

        return redirect('inmail/'.$no)->with('success', 'Disposisi berhasil ditambah');
    }

    public function dispoedit(Request $request, $id)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','inmail');
        session()->put('submenu','rekapinmail');

        $sections = Section::all();
        $disposition = Disposition::findOrFail($id);

        return view('repositori.editdispo', compact('disposition', 'sections'));
    }

    public function dispoupdate(Request $request, $id)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','inmail');
        session()->put('submenu','rekapinmail');

        $request->validate([
            'nodispo' => 'required|string|max:50|unique:dispositions,no,'.$id.',no',
            'tanggaldispo' => 'required',
            'isidispo' => 'required|string|max:255',
            'dituju' => 'required'
        ]);

        $dispo = Disposition::findOrFail($id);

        try
        {
            Disposition::where('no', $id)->update([
                'no' => rtrim($request->nodispo, '/'),
                'inmail_no' => $dispo->inmail_no,
                'tanggal_disposisi' => $request->tanggaldispo,
                'isi_disposisi' => $request->isidispo,
            ]);
        }
        catch (QueryException $e)
        {
            return redirect('/inmail')->with('error', 'Terjadi Kesalahan');
        }

        Destination::where('disposition_no', rtrim($request->nodispo, '/'))->delete();

        try 
        {
            foreach($request->dituju as $dituju)
            {
                Destination::create([
                    'disposition_no' => rtrim($request->nodispo, '/'),
                    'section_id' => $dituju
                ]);
            }
        } 
        catch (QueryException $e) 
        {
            return redirect('/inmail')->with('error', 'Terjadi Kesalahan');
        }
        
        return redirect('/inmail/'.$dispo->inmail_no)->with('success', 'Disposisi Berhasil Diubah');
    }

    public function dispodelete($id)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','inmail');
        session()->put('submenu','rekapinmail');

        $dispo = Disposition::findOrFail($id);

        Disposition::destroy($id);

        return redirect('inmail/'.$dispo->inmail_no)->with('success', 'Disposisi berhasil dihapus');
    }

    public function markToRead($id)
    {
        Inmail::where('no', $id)->update([
            'status' => 2
        ]);

        return redirect('inmail/'.$id)->with('success', 'Status berhasil diubah');
    }

    public function markToReadDispo($id)
    {

        Disposition::where('no', $id)->update([
            'status' => 2
        ]);

        $dispo = Disposition::findOrFail($id);

        return redirect('inmails/dispo/'.$dispo->inmail_no)->with('success', 'Status berhasil diubah');
    }

    public function cetakInmail($id)
    {
        $inmail = Inmail::findOrFail($id);

        if(file_exists(public_path('inmails/'.$inmail->file_surat)))
        {
            return response()->download(public_path('inmails/'.$inmail->file_surat));
        }
        else
        {
            return redirect()->back()->with('error', 'File Tidak Ditemukan');
        } 
    }

    public function cetakDispo($id)
    {
        $disposition = Disposition::findOrFail($id);

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $contxt = stream_context_create([ 
            'ssl' => [ 
                'verify_peer' => FALSE, 
                'verify_peer_name' => FALSE,
                'allow_self_signed'=> TRUE
            ] 
        ]);
        $dompdf->setHttpContext($contxt);

        set_time_limit(600);
        
        $pdf = PDF::loadView('repositori.cetakdispo', compact('disposition'));
     
        return $pdf->stream(date('dmY_His').'_'.$disposition->no.'.pdf');
    }
}
