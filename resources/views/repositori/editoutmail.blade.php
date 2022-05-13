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
        <h3>Edit Surat Keluar</h3>
        <form method="POST" action="{{url('/outmails/update/'.$outmail->no)}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group mb-3">
                <label class="label" for="nooutmail">No Surat</label>
                <input id="nooutmail" name="nooutmail" type="text" class="form-control @error('nooutmail') is-invalid @enderror" placeholder="No Surat" value="{{$outmail->no}}" autocomplete="name" autofocus>
                @error('nooutmail')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="label" for="jenis">Jenis Surat</label>
                <select id="jenis" name="jenis" class="form-control @error('jenis') is-invalid @enderror" aria-label="select medium">
                    @foreach ($types as $type)
                        @if ($outmail->mail_type_id == $type->id)
                            <option value="{{$type->id}}" selected>{{$type->nama_jenis_surat}}</option>
                        @else
                            <option value="{{$type->id}}">{{$type->nama_jenis_surat}}</option>
                        @endif
                    @endforeach
                </select>
                @error('jenis')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="label" for="bagian">Bagian</label>
                <select id="bagian" name="bagian" class="form-control @error('bagian') is-invalid @enderror" aria-label="select medium">
                    @foreach ($sections as $section)
                        @if ($outmail->section_id == $section->id)
                            <option value="{{$section->id}}" selected>{{$section->nama_bagian}}</option>
                        @else
                            <option value="{{$section->id}}">{{$section->nama_bagian}}</option>
                        @endif
                    @endforeach
                </select>
                @error('bagian')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="label" for="tanggalkeluar">Tanggal Keluar</label>
                <input id="tanggalkeluar" name="tanggalkeluar" type="date" class="form-control @error('tanggalkeluar') is-invalid @enderror" placeholder="Tanggal Keluar" value="{{$outmail->tanggal_keluar}}" autocomplete="name" autofocus>
                @error('tanggalkeluar')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="label" for="perihal">Perihal</label>
                <input id="perihal" name="perihal" type="text" class="form-control @error('perihal') is-invalid @enderror" placeholder="Perihal" value="{{$outmail->perihal}}" autocomplete="name" autofocus>
                @error('perihal')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="label" for="pokok">Pokok Masalah</label>
                <input id="pokok" name="pokok" type="text" class="form-control @error('pokok') is-invalid @enderror" placeholder="Pokok Masalah" value="{{$outmail->pokok_masalah}}" autocomplete="name" autofocus>
                @error('pokok')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="label" for="filesurat">File Surat</label>
                <input type="file" class="form-control @error('filesurat') is-invalid @enderror" name="filesurat" id="filesurat">
                @error('filesurat')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Edit Surat Keluar</button>
        </form>
    </div> {{-- wajib pakai --}}
</div> {{-- wajib pakai --}}

<script src="{{asset('sidebar_template/js/jquery.min.js')}}"></script>
@endsection
