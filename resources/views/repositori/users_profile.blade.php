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
        <h3>Profil User</h3>
        <table class="table table-striped" id="users">
          <tbody>
            <tr class="align-middle">
              <th>ID</th>
              <td>{{Auth::user()->id}}</td>
            </tr>
            <tr class="align-middle">
              <th>Name</th>
              <td>{{Auth::user()->name}}</td>
            </tr>
            <tr class="align-middle">
              <th>Username</th>
              <td>{{Auth::user()->username}}</td>
            </tr>
            <tr class="align-middle">
              <th>Email</th>
              <td>{{Auth::user()->email}}</td>
            </tr>
            <tr class="align-middle">
              <th>Tanggal Lahir</th>
              <td>{{date('d F Y', strtotime(Auth::user()->tanggal_lahir))}}</td>
            </tr>
            <tr class="align-middle">
              <th>Alamat</th>
              <td>{{Auth::user()->alamat}}</td>
            </tr>
            <tr class="align-middle">
              <th>No. Hp</th>
              <td>{{Auth::user()->no_hp}}</td>
            </tr>
            <tr class="align-middle">
              <th>Peran</th>
              <td>{{Auth::user()->role}}</td>
            </tr>
            <tr class="align-middle">
              <th>Bagian</th>
              <td>{{Auth::user()->section->nama_bagian}}</td>
            </tr>
          </tbody>
        </table>
        <form method="GET" action="{{url('/profil_user/edit') }}" style="display: inline-block;">
          @csrf
          <button type="submit" class="btn btn-sm btn-warning"><span class="far fa-edit"></span> Edit</button>
        </form>
      </div> {{-- wajib pakai --}}
    </div> {{-- wajib pakai --}}
  
  <script src="{{asset('sidebar_template/js/jquery.min.js')}}"></script>
@endsection