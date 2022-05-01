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
        <h3>Detail Dokumen</h3>
        <table class="table table-striped" id="inmail">
            <thead>
                <tr>
                    <th scope="col">No Dokumen</th>
                    <th scope="col">{{$documents->no}}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Nama Dokumen</th>
                    <td>{{$documents->nama_dokumen}}</td>
                </tr>
                <tr>
                  <th scope="row">Kelompok Dokumen</th>
                  <td>{{$documents->document_type->document_group->nama_kelompok_dokumen}}</td>
                </tr>
                <tr>
                    <th scope="row">Jenis Dokumen</th>
                    <td>{{$documents->document_type->nama_jenis_dokumen}}</td>
                </tr>
                <tr>
                    <th scope="row">Pemilik Dokumen</th>
                    <td>{{$documents->section->nama_bagian}}</td>
                </tr>
                <tr>
                    <th scope="row">Tanggal Terbit</th>
                    <td>{{date('d F Y', strtotime($documents->tanggal_terbit))}}</td>
                </tr>
                <tr>
                    <th scope="row">Perihal</th>
                    <td>{{$documents->perihal}}</td>
                </tr>
                <tr>
                  <th scope="row">Sifat</th>
                  <td>{{$documents->sifat_dokumen}}</td>
                </tr>
                <tr>
                    <th scope="row">File</th>
                    <td>
                        <object data="{{asset('documents/'.$documents->file_dokumen)}}" type="application/pdf">
                            <iframe src="https://docs.google.com/viewer?url=your_url_to_pdf&embedded=true"></iframe>
                        </object>
                    </td>
                </tr>
            </tbody>
        </table>
        <a href="{{url('/document')}}" class="btn btn-sm btn-primary">Kembali</a>
    </div> {{-- wajib pakai --}}
</div> {{-- wajib pakai --}}

<script src="{{asset('sidebar_template/js/jquery.min.js')}}"></script>
@endsection
       