@extends('repositori.layouts.main')

@section('content')
    {{-- Sidebar --}}
    @include('repositori.layouts.sidebar')
    {{-- End Sidebar --}}

    <!-- Page Content  -->
  <div id="content" class="p-4 p-md-5 pt-5"> {{-- wajib pakai --}}
      <div class="card">
        <div class="card-header">
            <h5 class="card-title">Laporan Surat Disposisi</h5>
            
        </div>
        
        <div class="card-body">
        <p class="card-text">Silahkan Isi Form Berikut Untuk Mencetak Laporan Surat Disposisi</p>
            <form action="{{route ('print-disposisi')}}" method="get">
                <table cellpadding="13">
                    <tr>
                        <td><label for="">Tanggal Awal</label></td>
                        <td>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="icon-calendar22"></i></div>
                                    <input type="date" name="tgl1" class="form-control daterange-single @error('tgl1') is-invalid @enderror" value="{{old('tgl1')}}" maxlength="10">
                                    @error('tgl1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Tanggal Akhir</label>
                        </td>
                        <td>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="icon-calendar22"></i></div>
                                        <input type="date" name="tgl2" class="form-control daterange-single @error('tgl2') is-invalid @enderror" value="{{old('tgl2')}}" maxlength="10">
                                        @error('tgl2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                 </div>
                        </td>
                    </tr>
                    
                </table>
                <button type="submit" class="btn btn-success text-right"><span class="glyphicon glyphicon-search"> <span class="far fa-print"></span> Print Laporan</button>
            </form>
        </div>
      </div>
      </div> {{-- wajib pakai --}}
    </div> {{-- wajib pakai --}}
    <script src="{{asset('sidebar_template/js/jquery.min.js')}}"></script>
@endsection

