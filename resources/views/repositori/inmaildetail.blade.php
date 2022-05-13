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
        <h3>Detail Surat Masuk</h3>
        <table class="table table-striped" id="inmail">
            <thead>
                <tr>
                    <th scope="col">No Surat</th>
                    <th scope="col">{{$inmail->no}}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Jenis Surat</th>
                    <td>{{$inmail->mail_type->nama_jenis_surat}}</td>
                </tr>
                <tr>
                    <th scope="row">Bagian</th>
                    <td>{{$inmail->section->nama_bagian}}</td>
                </tr>
                <tr>
                    <th scope="row">Tanggal Masuk</th>
                    <td>{{date('d F Y', strtotime($inmail->tanggal_masuk))}}</td>
                </tr>
                <tr>
                    <th scope="row">Perihal</th>
                    <td>{{$inmail->perihal}}</td>
                </tr>
                <tr>
                    <th scope="row">Disposisi</th>
                    <td>
                        @if ($inmail->disposisi == 'Y' && $inmail->disposition != NULL)
                            <a href="{{url('inmailss/dispo/preview/'.$inmail->disposition->no)}}" class="btn btn-sm btn-secondary"><span class="far fa-eye"></span> Preview</a>
                            @if (Auth::user()->role != 'lainnya')
                                <form method="GET" action="{{url('inmailss/dispo/edit/'.$inmail->disposition->no) }}" style="display: inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-warning"><span class="far fa-edit"></span> Edit</button>
                                </form>
                                <form method="POST" action="{{url('inmails/dispo/hapus/'.$inmail->disposition->no) }}" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus Disposisi?')"><span class="far fa-trash-alt"></span> Hapus</button>
                                </form>
                            @endif
                        @else
                            @if (Auth::user()->role == 'lainnya')
                                Tidak
                            @else
                                <a href="{{url('inmailss/dispo/create/'.$inmail->no)}}" class="btn btn-sm btn-primary"><span class="far fa-plus"></span> Tambah</a>
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
                        @if ($inmail->status == 'unread')
                            <a href="{{url('inmails/status/'.$inmail->no)}}" class="btn btn-sm btn-danger">Mark as read</a>
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
        <a href="{{url('inmail')}}" class="btn btn-sm btn-primary">Kembali</a>
    </div> {{-- wajib pakai --}}
</div> {{-- wajib pakai --}}

<script src="{{asset('sidebar_template/js/jquery.min.js')}}"></script>
@endsection
