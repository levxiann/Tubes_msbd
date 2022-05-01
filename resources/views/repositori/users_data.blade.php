@extends('repositori.layouts.main')

@section('content')
    {{-- Sidebar --}}
    @include('repositori.layouts.sidebar')
    {{-- End Sidebar --}}

    <!-- Page Content  -->
  <div id="content" class="p-4 p-md-5 pt-5"> {{-- wajib pakai --}}
      <div class="card">
        <div class="card-header">
          Data Users
        </div>
        
        <div class="card mx-auto pull-right">
          <div class="card-header">
            <p>
              <a href="{{ url('/Data_Users/add') }}" class="btn btn-primary"><span class="far fa-plus"></span> Tambah Data</a>
            </p>

            <div class="card-body" id="stock">
              <table class="table w-100 table-bordered table-hover text-center table-striped">
                <thead style="text-align: center">
                  <tr class="align-middle">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>email</th>
                    <th>tanggal lahir</th>
                    <th>alamat</th>
                    <th>no Hp</th>
                    <th>role</th>
                    <th>section id</th>
                    <th colspan="5">Action</th>
                  </tr>
                </thead>

                <tbody style="vertical-align: middle">
                  @foreach($users as $user)
                  <tr>
                      <td>{{$user->id}}</td>
                      <td>{{$user->name}}</td>
                      <td>{{$user->username}}</td>
                      <td>{{$user->email}}</td>
                      <td>{{$user->tanggal_lahir}}</td>
                      <td>{{$user->alamat}}</td>
                      <td>{{$user->no_hp}}</td>
                      <td>{{$user->role}}</td>
                      <td>{{$user->section_id}}</td>
                      <td><a href="{{url('Data_Users/edit/' .$user->id) }}" class="btn btn-sm btn-flat btn-primary"><span class="far fa-plus"></span>Edit</a></td>
                     
                      @if ($user->role == 'kepala sekolah' || $user->role == 'lainnya')
                      <form action="{{ url('Data_Users/hapus/' .$user->id) }}" method="POST">         
                        @csrf 
                        @method('DELETE')
                      <td><a href="{{url('Data_Users/hapus/' .$user->id) }}" class="btn btn-sm btn-flat btn-danger" onclick="return confirm ('Are you sure to delete this data?')" span class="far fa-edit">Hapus</a></span></td>  
                    </form>
                      @endif

                  </tr>
                     @endforeach
                </tbody>
              </table>

@endsection