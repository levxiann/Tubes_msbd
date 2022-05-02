@extends('repositori.layouts.main')

@section('content')
    {{-- Sidebar --}}
    @include('repositori.layouts.sidebar')
    {{-- End Sidebar --}}

    <!-- Page Content  -->
  <div id="content" class="p-4 p-md-5 pt-5"> {{-- wajib pakai --}}
      <div class="card">
        <div class="card-header">
          Update Jenis Surat
        </div>
        <div class="card-body">
        <form action="{{url('mail_type/update/'.$mail->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="id">ID</label>
                <input type="number" class="form-control" id="id" value="{{$mail->id}}" name="id" disabled>
            </div>
            <div class="form-group mb-3">
                <label for="name">Nama Jenis Surat</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Masukkan nama jenis surat baru" name="name" value="{{$mail->nama_jenis_surat}}">
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