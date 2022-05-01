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
      <h3>Rekap Dokumen</h3>
      <div class="searching mt-2 mb-2">
        <p>Cari Berdasarkan :</p>
        <form method = "GET" action="{{url('/document/search')}}">
            @csrf
            <div class="form-group mb-3">
                <select name="type" class="form-select mr-3" aria-label="Default select example">
                    <option value = "0">Pilih Jenis Dokumen</option>
                    @foreach ($types as $type)
                        <option value = "{{$type->id}}" <?php if(isset($_GET['type'])){ if($_GET['type'] == $type->id) echo "selected"; }?>>{{$type->nama_jenis_dokumen}}</option>
                    @endforeach
                </select>
                <select name="section" class="form-select mr-3" aria-label="Default select example">
                    <option value = "0">Pilih Bagian</option>
                    @foreach ($sections as $section)
                        <option value = "{{$section->id}}" <?php if(isset($_GET['section'])){ if($_GET['section'] == $section->id) echo "selected"; }?>>{{$section->nama_bagian}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>
    </div>
    <table class="table text-center table-striped" id="document">
      <thead style="text-align: center">
        <tr class="align-middle">
          <th>No. Dokumen</th>
          <th>Nama Dokumen</th>
          <th>Kelompok Dokumen</th>
          <th>Jenis Dokumen</th>
          <th>Pemilik Dokumen</th>
          <th>Tanggal Terbit</th>
          <th>Sifat</th>
          <th>Preview</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody style="vertical-align: middle">
        @foreach($documents as $document)
        <tr>
            <td>{{$document->no}}</td>
            <td>{{$document->nama_dokumen}}</td>
            <td>{{$document->document_type->document_group->nama_kelompok_dokumen}}</td>
            <td>{{$document->document_type->nama_jenis_dokumen}}</td>
            <td>{{$document->section->nama_bagian}}</td>
            <td>{{date('d F Y',strtotime($document->tanggal_terbit))}}</td>
            <td>
                @if ($document->sifat_dokumen == 'umum')
                    <button type="button" class="btn btn-sm btn-success" disabled>Umum</button>
                @else
                    <button type="button" class="btn btn-sm btn-danger" disabled>Rahasia</button> 
                @endif
            </td>
            <td>
              <a href="{{url('document/detaildocument/'.$document->no) }}" class="link-warning">Lihat Detail</a>
            </td>
            <td>
                @if (Auth::user()->role != 'lainnya')
                  <form method="GET" action="{{url('document/editdocument/'.$document->no)}}" style="display: inline-block;">
                      @csrf
                      <button type="submit" class="btn btn-sm btn-warning"><span class="far fa-edit"></span> Edit</button>
                  </form>
                  <form method="POST" action="{{url('document/'.$document->no) }}" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus Data Dokumen?')"><span class="far fa-trash"></span> Hapus</button>
                  </form>
                  <p></p>
                @endif
                <a href="{{url('document/download/'.$document->file_dokumen) }}" class="btn btn-sm btn-flat btn-secondary"><span class="far fa-download"></span> Download</a>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table> 
    </div> {{-- wajib pakai --}}
</div> {{-- wajib pakai --}}

<script src="{{asset('sidebar_template/js/jquery.min.js')}}"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
    $('#document').DataTable();
    } );
</script>
@endsection