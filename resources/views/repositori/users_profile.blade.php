@extends('repositori.layouts.main')

@section('content')
    {{-- Sidebar --}}
    @include('repositori.layouts.sidebar')
    {{-- End Sidebar --}}

    <!-- Page Content  -->
  <div id="content" class="p-4 p-md-5 pt-5"> {{-- wajib pakai --}}
      <div class="card">
        <div class="card-header">
          Profil User
        </div>

        <!-- Alert -->
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Sukses!</strong> {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
        
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
                 
                  <tr>
                      <td>{{ Auth::user()->id }}</td>
                      <td>{{ Auth::user()->name }}</td>
                      <td>{{ Auth::user()->username }}</td>
                      <td>{{ Auth::user()->email }}</td>
                      <td>{{ Auth::user()->tanggal_lahir}}</td>
                      <td>{{ Auth::user()->alamat}}</td>
                      <td>{{ Auth::user()->no_hp }}</td>
                      <td>{{ Auth::user()->role}}</td>
                      <td>{{ Auth::user()->section_id }}</td>
                      <td><a href="{{url('profil_user/edit/' .Auth::user()->id) }}" class="btn btn-sm btn-flat btn-primary"><span class="far fa-plus"></span>Edit</a></td>
                     
                      @if (Auth::user()->role != 'admin')
                      <form action="{{ url('profil_user/hapus/' .Auth::user()->id) }}" method="POST">         
                        @csrf 
                        @method('DELETE')
                      <td><a href="{{url('profil_user/hapus/' .Auth::user()->id) }}" class="btn btn-sm btn-flat btn-danger" onclick="return confirm ('Are you sure to delete this data?')" span class="far fa-edit">Hapus</a></span></td>
                      </form>
                      @endif
                  </tr>
                     
                </tbody>
              </table>

@endsection