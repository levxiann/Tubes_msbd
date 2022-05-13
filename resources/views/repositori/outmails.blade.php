@extends('repositori.layouts.main')

@section('content')
    {{-- Sidebar --}}
    @include('repositori.layouts.sidebar')
    {{-- End Sidebar --}}

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5 pt-5"> {{-- wajib pakai --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sukses!</strong> {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> {{ session('error') }}
            </div>
        @endif
        <h3>Rekap Surat Keluar</h3>
        <div class="searching mt-2 mb-2">
            <p>Cari Berdasarkan :</p>
            <form method = "GET" action="{{url('/outmail/search')}}">
                @csrf
                <div class="form-group mb-3">
                    <select name="type" class="form-select mr-3" aria-label="Default select example">
                        <option value = "0">Pilih Jenis Surat</option>
                        @foreach ($types as $type)
                            <option value = "{{$type->id}}" <?php if(isset($_GET['type'])){ if($_GET['type'] == $type->id) echo "selected"; }?>>{{$type->nama_jenis_surat}}</option>
                        @endforeach
                    </select>
                    <select name="section" class="form-select mr-3" aria-label="Default select example">
                        <option value = "0">Pilih Bagian</option>
                        @foreach ($sections as $section)
                            <option value = "{{$section->id}}" <?php if(isset($_GET['section'])){ if($_GET['section'] == $section->id) echo "selected"; }?>>{{$section->nama_bagian}}</option>
                        @endforeach
                    </select>
                    <input id="tahun" name="tahun" type="number" class="mr-3" placeholder="Masukkan Tahun" value="<?php if(isset($_GET['tahun'])){ echo $_GET['tahun']; }?>" autofocus>
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>
        </div>
      <table class="table table-striped" id="outmail">
        <thead>
            <tr>
                <th scope="col">No Surat</th>
                <th scope="col">Jenis Surat</th>
                <th scope="col">Bagian</th>
                <th scope="col">Perihal Surat</th>
                <th scope="col">Tanggal Keluar</th>
                <th scope="col">Preview</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($outmails as $outmail)
            <tr>
                <th scope="row">{{$outmail->no}}</th>
                <td>{{$outmail->mail_type->nama_jenis_surat}}</td>
                <td>{{$outmail->section->nama_bagian}}</td>
                <td>{{$outmail->perihal}}</td>
                <td>{{date('d F Y',strtotime($outmail->tanggal_keluar))}}</td>
                <td>
                    <a href="{{url('/outmail/'.$outmail->no)}}" class="link-warning">Lihat Detail</a>
                </td>
                <td>
                    @if ($outmail->status == 'unread')
                        <button type="button" class="btn btn-sm btn-danger" disabled>Unread</button>
                    @else
                        <button type="button" class="btn btn-sm btn-success" disabled>Read</button> 
                    @endif
                </td>
                <td>
                    <form method="GET" action="{{url('outmails/edit/'.$outmail->no) }}" style="display: inline-block;">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-warning"><span class="far fa-edit"></span> Edit</button>
                    </form>
                    <form method="POST" action="{{url('outmails/hapus/'.$outmail->no) }}" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus Surat Keluar?')"><span class="far fa-trash-alt"></span> Hapus</button>
                    </form>
                    <p></p>
                    <a href="{{url('outmails/download/'.$outmail->no)}}" class="btn btn-sm btn-secondary"><span class="far fa-download"></span> Download</a>
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
    $('#outmail').DataTable();
    } );
</script>
@endsection
