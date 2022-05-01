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
        <h3>Tambah Data User</h3>
        <form action="{{ url('/Data_Users/Tambah_Data') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Masukkan nama" name="name" value="{{old('name')}}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="username">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Masukkan username" name="username" value="{{old('username')}}">
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukkan email" name="email" value="{{old('email')}}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Masukkan password" name="password" value="{{old('password')}}">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="conpass">Confirm Password</label>
                <input type="password" class="form-control @error('conpass') is-invalid @enderror" id="conpass" placeholder="Konfirmasi password" name="conpass" value="{{old('conpass')}}">
                @error('conpass')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" placeholder="Masukkan tangga lahir" name="tanggal_lahir" value="{{old('tanggal_lahir')}}">
                @error('tanggal_lahir')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>    
            <div class="form-group mb-3">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Masukkan alamat" name="alamat" value="{{old('alamat')}}">
                @error('alamat')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="no_hp">No Hp</label>
                <input type="number" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" placeholder="no_hp" name="no_hp" value="{{old('no_hp')}}">
                @error('no_hp')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="role">Peran</label>
                <select id="role" name="role" class="form-control @error('role') is-invalid @enderror" aria-label="select medium">
                    @if (old('role') == 'admin')
                            <option value="admin" selected>Admin</option>
                    @else
                            <option value="admin">Admin</option>
                    @endif
                    @if (old('role') == 'kepala sekolah')
                            <option value="kepala sekolah" selected>Kepala Sekolah</option>
                    @else
                            <option value="kepala sekolah">Kepala Sekolah</option>
                    @endif 
                    @if (old('role') == 'lainnya')
                            <option value="lainnya" selected>Lainnya</option>
                    @else
                            <option value="lainnya">Lainnya</option>
                    @endif 
                </select>
                @error('role')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="section_id">Bagian</label>
                <select id="section_id" name="section_id" class="form-control @error('section_id') is-invalid @enderror" aria-label="select medium">
                    @foreach ($sections as $section)
                        @if (old('section_id') == $section->id)
                            <option value="{{$section->id}}" selected>{{$section->nama_bagian}}</option>
                        @else
                            <option value="{{$section->id}}">{{$section->nama_bagian}}</option>
                        @endif
                    @endforeach
                </select>
                @error('section_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <a class="btn btn-light" href="{{ url('/Data_Users') }}">Cancel</a>
                <button type="submit" class="btn btn-primary confirm-button"><span class="far fa-save"></span> Save</button>
            </div>
        </form>
    </div> {{-- wajib pakai --}}
</div> {{-- wajib pakai --}}
<script src="{{asset('sidebar_template/js/jquery.min.js')}}"></script>
  @endsection