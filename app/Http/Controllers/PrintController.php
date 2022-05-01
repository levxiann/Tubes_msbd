<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inmail;
use App\Models\Outmail;
use App\Models\Disposition;
use Carbon\Carbon;
use PDF;
class PrintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function viewInmail(){
        return view('repositori.laporan_inmail');
    }

    public function printInmail(Request $request){
        if(request()->tgl1 || request()->tgl2){
            $tgl1 = Carbon::parse(request()->tgl1)->toDateTimeString();
            $tgl2 = Carbon::parse(request()->tgl2)->toDateTimeString();
            $data = inmail::whereBetween('tanggal_masuk',[$tgl1,$tgl2])->get();
        }
        else{
            $data = inmail::latest()->get();
        }
        $pdf = PDF::loadview('repositori.print_inmail',['data'=>$data]);
        return $pdf->stream('laporan-inmail.pdf');
        
    }

    public function viewOutmail(){
        return view('repositori.laporan_outmail');
    }
    
    public function printOutmail(Request $request){
        if(request()->tgl1 || request()->tgl2){
            $tgl1 = Carbon::parse(request()->tgl1)->toDateTimeString();
            $tgl2 = Carbon::parse(request()->tgl2)->toDateTimeString();
            $data = Outmail::whereBetween('tanggal_keluar',[$tgl1,$tgl2])->get();
        }
        else{
            $data = Outmail::latest()->get();
        }
        $pdf = PDF::loadview('repositori.print_outmail',['data'=>$data]);
        return $pdf->stream('laporan-outmail.pdf');
        
    }

    public function viewDisposition(){
        return view('repositori.laporan_disposisi');
    }

    public function printDisposition(Request $request){
        if(request()->tgl1 || request()->tgl2){
            $tgl1 = Carbon::parse(request()->tgl1)->toDateTimeString();
            $tgl2 = Carbon::parse(request()->tgl2)->toDateTimeString();
            $data = Disposition::whereBetween('tanggal_disposisi',[$tgl1,$tgl2])->get();
        }
        else{
            $data = Disposition::latest()->get();
        }
        $pdf = PDF::loadview('repositori.print_disposisi',['data'=>$data]);
        return $pdf->stream('laporan-disposisi.pdf');
        
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
