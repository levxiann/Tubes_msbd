@extends('repositori.layouts.main')

@section('content')
@include('repositori.layouts.sidebar')

<div class="container mt-3 ml-3 mr-4">
  <h2>Detail Dokumen</h2><hr>
  <form method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/document')}}">Rekap Dokumen</a></li>
          <li class="breadcrumb-item active" aria-current="page">Data Dokumen {{$documents->no}}</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

    <div class="col-md-8">
        <div class="card mb-3">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">No. Dokumen</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                {{$documents->no}}
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Nama Dokumen</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                {{$documents->nama_dokumen}}
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Perihal</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                {{$documents->perihal}}
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Jenis Dokumen</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                {{$documents->document_type->nama_jenis_dokumen}}
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Pemilik Dokumen</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                {{$documents->section->nama_bagian}}
              </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Sifat Dokumen</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  {{$documents->sifat_dokumen}}
                </div>
              </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Tanggal Terbit</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  {{$documents->tanggal_terbit}}
                </div>
              </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">File Dokumen</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  {{$documents->file_dokumen}}
                </div>
              </div>
            <hr>
            
          </div>
        </div> 
@endsection
       