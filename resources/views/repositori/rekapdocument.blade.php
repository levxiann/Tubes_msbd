@extends('repositori.layouts.main')

@section('content')
    {{-- Sidebar --}}
    @include('repositori.layouts.sidebar')
    {{-- End Sidebar --}}
    
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper mt-3 ml-4 mr-4" style="width: 100%">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col">
                <h1 class="m-0 text-dark">Rekap Dokumen</h1>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
      
        <!-- Main content -->
        <div class="container mt-3 ml-2 mr-4" style="width: 100%">

            <!-- Alert -->
            @if (session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sukses!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            <div class="card ml-4 mr-4">
                <!--Searching-->
                <form action="{{url('/document')}}" method="GET" role="search">
                  <div class="input-group">
                      <span class="input-group-btn mr-5 mt-1 me-3">
                          <button class="btn btn-info" type="submit" title="Search projects">
                              <span class="fa fa-search"></span>
                          </button>
                      </span>

                      <input type="text" class="form-control mr-2" name="term" placeholder="Cari berdasarkan No. Dokumen, Nama Dokumen, dan Tahun" id="term">
                      <a href="{{url('/document')}}" class=" mt-1 ms-2">
                          <span class="input-group-btn">
                              <button class="btn btn-danger" type="button" title="Refresh page">
                                  <span class="fa fa-refresh"></span>
                              </button>
                          </span>
                      </a>
                  </div>
              </form>
              </div>
              <div class="card-body" id="document">
                <table class="table w-100 table-bordered table-hover text-center table-striped" id="document">
                  <thead style="text-align: center">
                    <tr class="align-middle">
                      <th>No. Dokumen</th>
                      <th>Nama Dokumen</th>
                      <th>Jenis Dokumen</th>
                      <th>Pemilik Dokumen</th>
                      <th>Tanggal Terbit</th>
                      <th colspan="5">Action</th>
                    </tr>
                  </thead>
                  <tbody style="vertical-align: middle">
                    @foreach($documents as $document)
                    @if (Auth::user()->role != 'lainnya' || $document->sifat_dokumen == 'umum')
                    <tr>
                        <td>{{$document->no}}</td>
                        <td>{{$document->nama_dokumen}}</td>
                        <td>{{$document->document_type->nama_jenis_dokumen}}</td>
                        <td>{{$document->section->nama_bagian}}</td>
                        <td>{{$document->tanggal_terbit}}</td>
                        @if (Auth::user()->role != 'lainnya')
                          <td><a href="{{url('document/editdocument/'.$document->no)}}" class="btn btn-sm btn-flat btn-primary"><span class="fa fa-edit"></span>Edit</a></td>
                        @endif
                        @if (Auth::user()->role != 'lainnya')
                        <td>
                          <form method="POST" action="{{url('document/'.$document->no) }}" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus Data Dokumen?')"><span class="fa fa-trash"></span>Hapus</button>
                          </form>
                          </td>
                        @endif
                        <td><a href="{{url('document/download/'.$document->file_dokumen) }}" class="btn btn-sm btn-flat btn-info" method="GET"><span class="fa fa-download"></span>Download</a></td>
                        <td><a href="{{url('document/detaildocument/'.$document->no) }}" class="btn btn-sm btn-flat btn-success"><span class="fa fa-folder"></span>Detail</a></td>
                    @endif
                    </tr>
                    @endforeach
                  </tbody>
                </table>

                <div class="d-flex mt-3 justify-content-end me-2">
                  {!! $documents->links() !!}
                </div>
              </div>
            </div>
          </div><!-- /.container-fluid -->  
          
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
    
@endsection