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
        <h3>Data Users</h3>
        <a href="{{ url('/Data_Users/add') }}" class="btn btn-primary mb-3"><span class="far fa-plus"></span> Tambah Data</a>
        <table class="table text-center table-striped" id="users">
          <thead style="text-align: center">
            <tr class="align-middle">
              <th>ID</th>
              <th>Name</th>
              <th>Username</th>
              <th>Email</th>
              <th>Tanggal Lahir</th>
              <th>Alamat</th>
              <th>No. Hp</th>
              <th>Peran</th>
              <th>Bagian</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody style="vertical-align: middle">
            @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->email}}</td>
                <td>{{date('d F Y', strtotime($user->tanggal_lahir))}}</td>
                <td>{{$user->alamat}}</td>
                <td>{{$user->no_hp}}</td>
                <td>{{$user->role}}</td>
                <td>{{$user->section->nama_bagian}}</td>
                <td>
                  @if ($user->id == Auth::user()->id)
                    <button type="button" class="btn btn-sm btn-primary" disabled>Me</button>
                  @else
                    <form method="GET" action="{{url('/Data_Users/edit/'.$user->id) }}" style="display: inline-block;">
                      @csrf
                      <button type="submit" class="btn btn-sm btn-warning"><span class="far fa-edit"></span> Edit</button>
                    </form>
                    <form method="POST" action="{{url('/Data_Users/hapus/'.$user->id) }}" style="display: inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus User?')"><span class="far fa-trash-alt"></span> Hapus</button>
                    </form>
                  @endif
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
        $('#users').DataTable();
      } );
  </script>
@endsection