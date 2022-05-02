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
        </div>
      @endif
      <div class="card">
        <div class="card-header">
          
          <div class="d-grid d-md-flex justify-content-between">
              Jenis Surat
            <a href="{{url('mail_type/create')}}" class="btn btn-sm btn-flat btn-success" style="font-size: 0.8em;"><span class="far fa-plus"></span> Tambah jenis surat</a>
          </div>
        </div>
        <div class="card-body">
            <table class="table w-100 table-bordered table-hover text-center table-striped" id="mail_types">
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
                        <td>
                          <form method="GET" action="{{url('mail_type/update/'.$mail->id) }}" style="display: inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-warning"><span class="far fa-edit"></span> Edit</button>
                          </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
      </div> {{-- wajib pakai --}}
  </div> {{-- wajib pakai --}}
  <script src="{{asset('sidebar_template/js/jquery.min.js')}}"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
  <script>
      $(document).ready( function () {
      $('#mail_types').DataTable();
      } );
  </script>
@endsection