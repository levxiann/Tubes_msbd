@extends('repositori.layouts.main')

@section('content')
    {{-- Sidebar --}}
    @include('repositori.layouts.sidebar')
    {{-- End Sidebar --}}

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5 pt-5"> {{-- wajib pakai --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> {{ session('error') }}
            </div>
        @endif
        <h3>Rekap Surat Masuk</h3>
        <div class="searching mt-2 mb-2">
            <p>Cari Berdasarkan :</p>
            <form method = "GET" action="{{url('/inmail/search')}}">
                @csrf
                <div class="form-group mb-3">
                    <select name="type" class="form-select mr-3" aria-label="Default select example">
                        <option value = "0">Pilih Jenis Surat</option>
                        @foreach ($types as $type)
                            <option value = "{{$type->id}}" <?php if(isset($_GET['type'])){ if($_GET['type'] == $type->id) echo "selected"; }?>>{{$type->nama_jenis_surat}}</option>
                        @endforeach
                    </select>
                    <input id="tahun" name="tahun" type="number" class="mr-3" placeholder="Masukkan Tahun" value="<?php if(isset($_GET['tahun'])){ echo $_GET['tahun']; }?>" autofocus>
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>
        </div>
      <table class="table table-striped" id="inmail">
        <thead>
            <tr>
                <th scope="col">No Surat</th>
                <th scope="col">Jenis Surat</th>
                <th scope="col">Bagian</th>
                <th scope="col">Perihal Surat</th>
                <th scope="col">Tanggal Masuk</th>
                <th scope="col">Disposisi</th>
                <th scope="col">Preview</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inmails as $inmail)
            <tr>
                <th scope="row">{{$inmail->no}}</th>
                <td>{{$inmail->mail_type->nama_jenis_surat}}</td>
                <td>{{$inmail->section->nama_bagian}}</td>
                <td>{{$inmail->perihal}}</td>
                <td>{{date('d F Y',strtotime($inmail->tanggal_masuk))}}</td>
                <td>
                    @if ($inmail->disposisi == 'Y')
                        <button type="button" class="btn btn-sm btn-success" disabled>Ya</button>
                    @else
                        <button type="button" class="btn btn-sm btn-danger" disabled>Tidak</button> 
                    @endif
                </td>
                <td>
                    <a href="{{url('/inmail/'.$inmail->no)}}" class="link-warning">Lihat Detail</a>
                </td>
                <td>
                    @if ($inmail->status == 'unread')
                        <button type="button" class="btn btn-sm btn-danger" disabled>Unread</button>
                    @else
                        <button type="button" class="btn btn-sm btn-success" disabled>Read</button> 
                    @endif
                </td>
                <td>
                    <a href="{{url('inmails/download/'.$inmail->no)}}" class="btn btn-sm btn-secondary"><span class="far fa-download"></span> Download</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div> {{-- wajib pakai --}}
</div> {{-- wajib pakai --}}

<script src="{{asset('sidebar_template/js/jquery.min.js')}}"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
    $('#inmail').DataTable();
    } );
</script>
@endsection
