@extends('repositori.layouts.main')

@section('content')
@include('repositori.layouts.sidebar')

<div class="container mt-3 ml-3 mr-4">
  <h2>Input Dokumen Baru</h2><hr>
  <form action="{{url('/document/inputdocument')}}" method="POST" enctype="multipart/form-data">
    @csrf
     <!-- Alert -->
     @if (session('success'))
     <div class="alert alert-success alert-dismissible fade show" role="alert">
       <strong>Sukses!</strong> {{ session('success') }}
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>
     @endif
   
    <div class="form-group mb-3 ml-4 mr-4">
        <label for="no">No. Dokumen</label>
        <input type="text"  class="form-control @error('no') is-invalid @enderror" id="no" placeholder="Masukkan no. dokumen" name="no" value="{{old('no')}}">
        @error('no')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group mb-3 ml-4 mr-4">
        <label for="nama_dokumen">Nama Dokumen</label>
        <input type="text" class="form-control @error('nama_dokumen') is-invalid @enderror" id="nama_dokumen" placeholder="Masukkan nama dokumen" name="nama_dokumen" value="{{old('nama_dokumen')}}">
        @error('nama_dokumen')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group mb-3 ml-4 mr-4">
        <label for="perihal">Perihal</label>
        <input type="text" class="form-control @error('perihal') is-invalid @enderror" id="perihal" placeholder="Masukkan perihal dokumen" name="perihal" value="{{old('perihal')}}">
        @error('perihal')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group mb-3 ml-4 mr-4">
        <label for="position-option">Jenis Dokumen</label>
        <select class="form-control" id="document_type_id" name="document_type_id">
           @foreach ($document_types as $type)
              <option value="{{ $type->id }}">{{ $type->nama_jenis_dokumen }}</option>
           @endforeach
        </select>
    </div>
    <div class="form-group mb-3 ml-4 mr-4">
        <label for="position-option">Pemilik Dokumen</label>
        <select class="form-control" id="section_id" name="section_id">
           @foreach ($sections as $section)
              <option value="{{ $section->id }}">{{ $section->nama_bagian }}</option>
           @endforeach
        </select>
    </div>
    <div class="form-group mb-3 ml-4 mr-4">
        <label for="sifat_dokumen">Sifat Dokumen</label> <br>
        <div class="form-check form-check-inline form-control @error('sifat_dokumen') is-invalid @enderror">
        <label for="sifat_dokumen">
            <input type="radio" name="sifat_dokumen" value="umum" id="sifat_dokumen" {{old('sifat_dokumen') == 'umum'? 'checked' : ''}} >Umum
            <input type="radio" name="sifat_dokumen" value="rahasia" id="sifat_dokumen" {{old('sifat_dokumen') == 'rahasia'? 'checked' : ''}} >Rahasia
        </label>
        </div>
        @error('sifat_dokumen')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
    <div class="form-group mb-3 ml-4 mr-4">
        <label for="nama_dokumen">Tanggal Terbit</label>
        <input type="date" class="form-control @error('tanggal_terbit') is-invalid @enderror" id="tanggal_terbit" name="tanggal_terbit" value="{{old('tanggal_terbit')}}">
        @error('tanggal_terbit')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group mb-3 ml-4 mr-4">
        <label for="file_dokumen">File Dokumen</label>
        <input type="file" class="form-control @error('file_dokumen') is-invalid @enderror" id="file_dokumen" name="file_dokumen" value="{{old('file_dokumen')}}">
        @error('file_dokumen')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group mb-3 ml-4 mr-4">
        <a class="btn btn-light" href="{{url('/document/inputdocument')}}">Cancel</a>
        <button type="submit" name="submit" class="btn btn-primary confirm-button"><span class="fa fa-save"></span>Save</button>
    </div>
  </form>
</div>

@endsection