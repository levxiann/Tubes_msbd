<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inmail;
use App\Models\Outmail;
use App\Models\Disposition;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Auth;
use PDF;
class PrintController extends Controller
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
        //
    }

    public function viewInmail()
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','laporan');
        session()->put('submenu','laporaninmail');

        return view('repositori.laporan_inmail');
    }

    public function printInmail(Request $request)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','laporan');
        session()->put('submenu','laporaninmail');

        $request->validate([
            'tgl1' => 'required|before:tgl2',
            'tgl2' => 'required|before:tomorrow',
        ]);

        if(request()->tgl1 || request()->tgl2)
        {
            $tgl1 = Carbon::parse(request()->tgl1)->toDateTimeString();
            $tgl2 = Carbon::parse(request()->tgl2)->toDateTimeString();
            $data = Inmail::whereBetween('tanggal_masuk',[$tgl1, $tgl2])->orderBy('tanggal_masuk')->get();
        }
        else
        {
            $data = Inmail::latest()->get();
        }

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

        $pdf = PDF::loadview('repositori.print_inmail', ['data' => $data, 'tgl1' => $request->tgl1, 'tgl2' => $request->tgl2]);

        return $pdf->stream(date('dmY_His').'_laporan-inmail.pdf');
        
    }

    public function viewOutmail()
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','laporan');
        session()->put('submenu','laporanoutmail');

        return view('repositori.laporan_outmail');
    }
    
    public function printOutmail(Request $request)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','laporan');
        session()->put('submenu','laporanoutmail');

        $request->validate([
            'tgl1' => 'required|before:tgl2',
            'tgl2' => 'required|before:tomorrow',
        ]);

        if(request()->tgl1 || request()->tgl2)
        {
            $tgl1 = Carbon::parse(request()->tgl1)->toDateTimeString();
            $tgl2 = Carbon::parse(request()->tgl2)->toDateTimeString();
            $data = Outmail::whereBetween('tanggal_keluar', [$tgl1, $tgl2])->orderBy('tanggal_keluar')->get();
        }
        else
        {
            $data = Outmail::latest()->get();
        }

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

        $pdf = PDF::loadview('repositori.print_outmail',['data'=>$data, 'tgl1' => $request->tgl1, 'tgl2' => $request->tgl2]);
        
        return $pdf->stream(date('dmY_His').'_laporan-outmail.pdf');
        
    }

    public function viewDisposition()
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','laporan');
        session()->put('submenu','laporandispo');

        return view('repositori.laporan_disposisi');
    }

    public function printDisposition(Request $request)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','laporan');
        session()->put('submenu','laporandispo');

        $request->validate([
            'tgl1' => 'required|before:tgl2',
            'tgl2' => 'required|before:tomorrow',
        ]);

        if(request()->tgl1 || request()->tgl2)
        {
            $tgl1 = Carbon::parse(request()->tgl1)->toDateTimeString();
            $tgl2 = Carbon::parse(request()->tgl2)->toDateTimeString();
            $data = Disposition::whereBetween('tanggal_disposisi',[$tgl1,$tgl2])->orderBy('tanggal_disposisi')->get();
        }
        else
        {
            $data = Disposition::latest()->get();
        }

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

        $pdf = PDF::loadview('repositori.print_disposisi',['data'=>$data, 'tgl1' => $request->tgl1, 'tgl2' => $request->tgl2]);
        return $pdf->stream(date('dmY_His').'_laporan-disposisi.pdf');
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
