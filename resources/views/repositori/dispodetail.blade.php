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
        <h3>Detail Disposisi</h3>
        <table class="table table-striped" id="inmail">
            <thead>
                <tr>
                    <th scope="col">No Surat</th>
                    <th scope="col">{{$inmail->no}}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">No Disposisi</th>
                    <td>{{$inmail->disposition->no}}</td>
                </tr>
                <tr>
                    <th scope="row">Jenis Surat</th>
                    <td>{{$inmail->mail_type->nama_jenis_surat}}</td>
                </tr>
                <tr>
                    <th scope="row">Bagian</th>
                    <td>{{$inmail->section->nama_bagian}}</td>
                </tr>
                <tr>
                    <th scope="row">Tanggal Disposisi</th>
                    <td>{{date('d F Y', strtotime($inmail->disposition->tanggal_disposisi))}}</td>
                </tr>
                <tr>
                    <th scope="row">Perihal</th>
                    <td>{{$inmail->perihal}}</td>
                </tr>
                <tr>
                    <th scope="row">Disposisi</th>
                    <td>
                        @if ($inmail->disposisi == 'Y')
                            <a href="{{url('inmailss/dispo/preview/'.$inmail->disposition->no)}}" class="btn btn-sm btn-secondary"><span class="far fa-eye"></span> Preview</a>
                        @else
                            @if (Auth::user()->role == 'lainnya')
                                Tidak
                            @else
                                <a href="{{url('inmails/dispo/create/'.$inmail->no)}}" class="btn btn-sm btn-primary"><span class="far fa-plus"></span> Tambah</a>
                            @endif
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">Pokok Masalah</th>
                    <td>{{$inmail->pokok_masalah}}</td>
                </tr>
                <tr>
                    <th scope="row">Status</th>
                    <td>
                        @if ($inmail->disposition->status == 'unread')
                            <a href="{{url('inmailss/dispo/status/'.$inmail->disposition->no)}}" class="btn btn-sm btn-danger">Mark as read</a>
                        @else
                            <button type="button" class="btn btn-sm btn-success" disabled>Read</button> 
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">File</th>
                    <td>
                        <object data="{{asset('inmails/'.$inmail->file_surat)}}" type="application/pdf">
                            <iframe src="https://docs.google.com/viewer?url=your_url_to_pdf&embedded=true"></iframe>
                        </object>
                    </td>
                </tr>
            </tbody>
        </table>
        <a href="{{url('/inmails/dispo')}}" class="btn btn-sm btn-primary">Kembali</a>
    </div> {{-- wajib pakai --}}
</div> {{-- wajib pakai --}}

<script src="{{asset('sidebar_template/js/jquery.min.js')}}"></script>
@endsection
