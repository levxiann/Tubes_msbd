@extends('repositori.layouts.main')

@section('content')
    {{-- Sidebar --}}
    @include('repositori.layouts.sidebar')
    {{-- End Sidebar --}}

    <!-- Page Content  -->
  <div id="content" class="p-4 p-md-5 pt-5"> {{-- wajib pakai --}}
      <div class="card">
        <div class="card-header">
          Tambah Jenis Surat
        </div>
        <div class="card-body">
        <form action="{{url('mail_type/store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="name">Nama Jenis Surat</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Masukkan nama jenis surat baru" name="name" value="{{old('name')}}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <a class="btn btn-light" href="{{url('/mail_type')}}">Cancel</a>
                <button type="submit" class="btn btn-primary confirm-button"><span class="far fa-save"></span> Save</button>
            </div>
        </form>
        </div>
      </div>
      </div> {{-- wajib pakai --}}
  </div> {{-- wajib pakai --}}
  <script src="{{asset('sidebar_template/js/jquery.min.js')}}"></script>
@endsection