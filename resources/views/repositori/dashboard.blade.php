@extends('repositori.layouts.main')

@section('content')
    {{-- Sidebar --}}
    @include('repositori.layouts.sidebar')
    {{-- End Sidebar --}}

    <!-- Page Content  -->
  <div id="content" class="p-4 p-md-5 pt-5"> {{-- wajib pakai --}}
      <div class="card">
        <div class="card-header">
          Welcome
        </div>
        <div class="card-body">
          <h5 class="card-title">Selamat Datang di Aplikasi Repositori Dokumen Sekolah</h5>
          <p class="card-text">{{Auth::user()->section_id}} , {{Auth::user()->role}}</p>
        </div>
      </div>
      </div> {{-- wajib pakai --}}
	</div> {{-- wajib pakai --}}
@endsection

