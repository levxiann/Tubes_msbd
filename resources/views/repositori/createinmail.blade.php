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
        <h3>Tambah Surat Masuk</h3>
        <form method="POST" action="{{url('/inmail/store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label class="label" for="noinmail">No Surat</label>
                <input id="noinmail" name="noinmail" type="text" class="form-control @error('noinmail') is-invalid @enderror" placeholder="No Surat" value="{{old('noinmail')}}" autocomplete="name" autofocus>
                @error('noinmail')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="label" for="jenis">Jenis Surat</label>
                <select id="jenis" name="jenis" class="form-control @error('jenis') is-invalid @enderror" aria-label="select medium">
                    @foreach ($types as $type)
                        @if (old('jenis') == $type->id)
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
                        @if (old('bagian') == $section->id)
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
                <label class="label" for="tanggalmasuk">Tanggal Masuk</label>
                <input id="tanggalmasuk" name="tanggalmasuk" type="date" class="form-control @error('tanggalmasuk') is-invalid @enderror" placeholder="Tanggal Masuk" value="{{old('tanggalmasuk')}}" autocomplete="name" autofocus>
                @error('tanggalmasuk')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="label" for="perihal">Perihal</label>
                <input id="perihal" name="perihal" type="text" class="form-control @error('perihal') is-invalid @enderror" placeholder="Perihal" value="{{old('perihal')}}" autocomplete="name" autofocus>
                @error('perihal')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="label" for="pokok">Pokok Masalah</label>
                <input id="pokok" name="pokok" type="text" class="form-control @error('pokok') is-invalid @enderror" placeholder="Pokok Masalah" value="{{old('pokok')}}" autocomplete="name" autofocus>
                @error('pokok')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="label" for="dispo">Disposisi</label>
                <select id="dispo" name="dispo" class="form-control @error('dispo') is-invalid @enderror" aria-label="select medium">
                    <option value="Y">Ya</option>
                    <option value="T">Tidak</option>
                </select>
                @error('dispo')
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
            <button type="submit" class="btn btn-primary">Tambah Surat Masuk</button>
        </form>
    </div> {{-- wajib pakai --}}
</div> {{-- wajib pakai --}}

<script src="{{asset('sidebar_template/js/jquery.min.js')}}"></script>
@endsection
