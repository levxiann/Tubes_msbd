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
                <strong>Sukses!</strong> {{ session('error') }}
            </div>
        @endif
        <h3>Edit Disposisi</h3>
        <form method="POST" action="{{url('/inmail/dispo/update/'.$disposition->no)}}">
            @csrf
            @method('PATCH')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                No Surat : {{$disposition->inmail->no}}
            </div>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Bagian : {{$disposition->inmail->section->nama_bagian}}
            </div>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Perihal : {{$disposition->inmail->perihal}}
            </div>
            <div class="form-group mb-3">
                <label class="label" for="nodispo">No Disposisi</label>
                <input id="nodispo" name="nodispo" type="text" class="form-control @error('nodispo') is-invalid @enderror" placeholder="No Disposisi" value="{{$disposition->no}}" autocomplete="name" autofocus>
                @error('nodispo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="label" for="tanggaldispo">Tanggal Disposisi</label>
                <input id="tanggaldispo" name="tanggaldispo" type="date" class="form-control @error('tanggaldispo') is-invalid @enderror" placeholder="Tanggal Disposisi" value="{{$disposition->tanggal_disposisi}}" autocomplete="name" autofocus>
                @error('tanggaldispo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="label" for="isidispo">Isi Disposisi</label>
                <input id="isidispo" name="isidispo" type="text" class="form-control @error('isidispo') is-invalid @enderror" placeholder="Isi Disposisi" value="{{$disposition->isi_disposisi}}" autocomplete="name" autofocus>
                @error('isidispo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="label" for="dituju">Ditujukan Ke</label>
                <select id="dituju" name="dituju[]" class="form-control @error('dituju') is-invalid @enderror" multiple aria-label="multiple select medium">
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($sections as $section)
                        @foreach ($disposition->destinations as $dest)
                            @if ($section->id == $dest->section_id)
                                <option value="{{$section->id}}" selected>{{$section->nama_bagian}}</option>
                                @php
                                    break;
                                @endphp
                            @elseif($i == $disposition->destinations->count()-1)
                                <option value="{{$section->id}}">{{$section->nama_bagian}}</option>
                            @else
                                @php
                                    $i++;
                                @endphp
                            @endif
                        @endforeach
                        @php
                             $i = 0;
                        @endphp
                    @endforeach
                </select>
                @error('dituju')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Edit Disposisi</button>
        </form>
    </div> {{-- wajib pakai --}}
</div> {{-- wajib pakai --}}

<script src="{{asset('sidebar_template/js/jquery.min.js')}}"></script>
@endsection
