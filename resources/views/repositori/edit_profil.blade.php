@extends('repositori.layouts.main')

@section('content')

{{-- Sidebar --}}
@include('repositori.layouts.sidebar')
{{-- End Sidebar --}}
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
    <h3>Edit Data Profil</h3>
    <form action="{{ url('/profil_user/update_profil') }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Masukkan nama" name="name" value="{{Auth::user()->name}}">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="username">Username</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Masukkan username" name="username" value="{{Auth::user()->username}}">
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukkan email" name="email" value="{{Auth::user()->email}}">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" placeholder="Masukkan tangga lahir" name="tanggal_lahir" value="{{Auth::user()->tanggal_lahir}}">
            @error('tanggal_lahir')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>    
        <div class="form-group mb-3">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Masukkan alamat" name="alamat" value="{{Auth::user()->alamat}}">
            @error('alamat')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="no_hp">No Hp</label>
            <input type="number" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" placeholder="no_hp" name="no_hp" value="{{Auth::user()->no_hp}}">
            @error('no_hp')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <a class="btn btn-light" href="{{ url('/profil_user') }}">Cancel</a>
            <button type="submit" class="btn btn-primary confirm-button"><span class="far fa-save"></span> Save</button>
        </div>
    </form>
</div> {{-- wajib pakai --}}
</div> {{-- wajib pakai --}}
<script src="{{asset('sidebar_template/js/jquery.min.js')}}"></script>
  @endsection