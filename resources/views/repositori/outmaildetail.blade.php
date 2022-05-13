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
        <h3>Detail Surat Keluar</h3>
        <table class="table table-striped" id="inmail">
            <thead>
                <tr>
                    <th scope="col">No Surat</th>
                    <th scope="col">{{$outmail->no}}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Jenis Surat</th>
                    <td>{{$outmail->mail_type->nama_jenis_surat}}</td>
                </tr>
                <tr>
                    <th scope="row">Bagian</th>
                    <td>{{$outmail->section->nama_bagian}}</td>
                </tr>
                <tr>
                    <th scope="row">Tanggal Keluar</th>
                    <td>{{date('d F Y', strtotime($outmail->tanggal_keluar))}}</td>
                </tr>
                <tr>
                    <th scope="row">Perihal</th>
                    <td>{{$outmail->perihal}}</td>
                </tr>
                <tr>
                    <th scope="row">Pokok Masalah</th>
                    <td>{{$outmail->pokok_masalah}}</td>
                </tr>
                <tr>
                    <th scope="row">Status</th>
                    <td>
                        @if ($outmail->status == 'unread')
                            <a href="{{url('outmails/status/'.$outmail->no)}}" class="btn btn-sm btn-danger">Mark as read</a>
                        @else
                            <button type="button" class="btn btn-sm btn-success" disabled>Read</button> 
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">File</th>
                    <td>
                        <object data="{{asset('outmails/'.$outmail->file_surat)}}" type="application/pdf">
                            <iframe src="https://docs.google.com/viewer?url=your_url_to_pdf&embedded=true"></iframe>
                        </object>
                    </td>
                </tr>
            </tbody>
        </table>
        <a href="{{url('/outmail')}}" class="btn btn-sm btn-primary">Kembali</a>
    </div> {{-- wajib pakai --}}
</div> {{-- wajib pakai --}}

<script src="{{asset('sidebar_template/js/jquery.min.js')}}"></script>
@endsection
