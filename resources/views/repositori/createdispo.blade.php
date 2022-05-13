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
        <h3>Tambah Disposisi</h3>
        <form method="POST" action="{{url('/inmails/dispo/store/'.$inmail->no)}}">
            @csrf
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                No Surat : {{$inmail->no}}
            </div>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Bagian : {{$inmail->section->nama_bagian}}
            </div>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Perihal : {{$inmail->perihal}}
            </div>
            <div class="form-group mb-3">
                <label class="label" for="nodispo">No Disposisi</label>
                <input id="nodispo" name="nodispo" type="text" class="form-control @error('nodispo') is-invalid @enderror" placeholder="No Disposisi" value="{{old('nodispo')}}" autocomplete="name" autofocus>
                @error('nodispo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="label" for="tanggaldispo">Tanggal Disposisi</label>
                <input id="tanggaldispo" name="tanggaldispo" type="date" class="form-control @error('tanggaldispo') is-invalid @enderror" placeholder="Tanggal Disposisi" value="{{old('tanggaldispo')}}" autocomplete="name" autofocus>
                @error('tanggaldispo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="label" for="isidispo">Isi Disposisi</label>
                <input id="isidispo" name="isidispo" type="text" class="form-control @error('isidispo') is-invalid @enderror" placeholder="Isi Disposisi" value="{{old('isidispo')}}" autocomplete="name" autofocus>
                @error('isidispo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="label" for="dituju">Ditujukan Ke</label>
                <select id="dituju" name="dituju[]" class="form-control @error('dituju') is-invalid @enderror" multiple aria-label="multiple select medium">
                    @foreach ($sections as $section)
                         <option value="{{$section->id}}">{{$section->nama_bagian}}</option>
                    @endforeach
                </select>
                @error('dituju')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Tambah Disposisi</button>
        </form>
    </div> {{-- wajib pakai --}}
</div> {{-- wajib pakai --}}

<script src="{{asset('sidebar_template/js/jquery.min.js')}}"></script>
@endsection
