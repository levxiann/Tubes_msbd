@extends('repositori.layouts.main')

@section('content')

<div class="container mt-3">
    <h2>Tambah Data Baru</h2><hr>
    <form action="{{ ('/Data_Users/Tambah_Data') }}" method="POST" enctype="multipart/form-data">
      @csrf
    
      </div>
      <div class="form-group mb-3">
          <label for="name">Nama</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Masukkan nama" name="name" value="{{old('name')}}">
          @error('name')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
      </div>
      <div class="form-group mb-3">
          <label for="username">Username</label>
          <input type="long-text" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Masukkan username" name="username" value="{{old('username')}}">
          @error('username')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
      </div>
      <div class="form-group mb-3">
          <label for="email">email</label>
          <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukkan email" name="email" value="{{old('email')}}">
          @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
      </div>
      <div class="form-group mb-3">
          <label for="password">password</label>
          <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Masukkan password" name="password" value="{{old('password')}}">
          @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
      </div>
      <div class="form-group mb-3">
          <label for="tanggal_lahir">tanggal lahir</label>
          <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" placeholder="Masukkan tanggal_lahir" name="tanggal_lahir" value="{{old('tanggal_lahir')}}">
          @error('tanggal_lahir')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
      </div>    
      <div class="form-group mb-3">
          <label for="alamat">Alamat</label>
          <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="alamat" name="alamat" value="{{old('alamat')}}">
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
        <label for="role">Role</label>
        <input type="text" class="form-control @error('role') is-invalid @enderror" id="role" placeholder="role" name="role" value="{{old('role')}}">

        @error('role')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group mb-3">
        <label for="section_id">Section id</label>
        <input type="number" class="form-control @error('section_id') is-invalid @enderror" id="section_id" placeholder="section_id" name="section_id" value="{{old('section_id')}}">
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
  </div>
  
  @endsection