@extends('repositori.layouts.main')

@section('content')
    {{-- Sidebar --}}
    @include('repositori.layouts.sidebar')
    {{-- End Sidebar --}}

    <!-- Page Content  -->
  <div id="content" class="p-4 p-md-5 pt-5"> {{-- wajib pakai --}}
      <div class="card">
        <div class="card-header">
          Update Jenis Dokumen
        </div>
        <div class="card-body">
        <form action="{{url('document_type/update/'.$type->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="id">ID</label>
                <input type="number" class="form-control" id="id" value="{{$type->id}}" name="id" disabled>
            </div>
            <div class="form-group mb-3">
                <label for="name">Nama Jenis Dokumen</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Masukkan nama jenis dokumen baru" name="name" value="{{$type->nama_jenis_dokumen}}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label for="group">Kelompok Dokumen</label>
                <select name="group" id="group" class="form-control @error('group') is-invalid @enderror">
                    <option value="" disabled>== Pilih Kelompok Dokumen ==</option>
                    @foreach ($groups as $group)
                        @if ($type->document_group_id == $group->id)
                            <option value="{{ $group->id }}" selected>{{ $group->nama_kelompok_dokumen }}</option>
                        @else
                            <option value="{{ $group->id }}">{{ $group->nama_kelompok_dokumen }}</option>
                        @endif
                    @endforeach
                </select>
                @error('group')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <a class="btn btn-light" href="{{url('/document_type')}}">Cancel</a>
                <button type="submit" class="btn btn-primary confirm-button"><span class="far fa-save"></span> Save</button>
            </div>
        </form>
        </div>
      </div>
      </div> {{-- wajib pakai --}}
  </div> {{-- wajib pakai --}}
  <script src="{{asset('sidebar_template/js/jquery.min.js')}}"></script>
@endsection