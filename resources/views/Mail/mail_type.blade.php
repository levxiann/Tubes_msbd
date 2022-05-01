@extends('repositori.layouts.main')

@section('content')
    {{-- Sidebar --}}
    @include('repositori.layouts.sidebar')
    {{-- End Sidebar --}}

    <!-- Page Content  -->
  <div id="content" class="p-4 p-md-5 pt-5"> {{-- wajib pakai --}}
      <!-- Alert -->
      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Sukses!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      <div class="card">
        <div class="card-header">
          
          <div class="d-grid d-md-flex justify-content-between">
              Jenis Surat
            <a href="{{url('mail_type/create')}}" class="btn btn-sm btn-flat btn-success" style="font-size: 0.8em;">Add mail type</a>
          </div>
        </div>
        <div class="card-body">
            <table class="table w-100 table-bordered table-hover text-center table-striped" id="document_group">
                <thead style="text-align: center">
                    <tr class="align-middle">
                    <th>ID</th>
                    <th>Nama Jenis Surat</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody style="vertical-align: middle">
                    @foreach($mails as $mail)
                    <tr>
                        <td>{{$mail->id}}</td>
                        <td>{{$mail->nama_jenis_surat}}</td>
                        <td><a href="{{url('mail_type/update/'.$mail->id) }}" class="btn btn-sm btn-flat btn-warning"><span class="far fa-edit"></span> Update</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!--Pagination-->
        <div class="d-flex mt-3 justify-content-center me-2">
            {!! $mails->links() !!}
        </div>
      </div>
      </div> {{-- wajib pakai --}}
  </div> {{-- wajib pakai --}}
@endsection