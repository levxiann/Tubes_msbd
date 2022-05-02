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
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      <div class="card">
        <div class="card-header">
          
          <div class="d-grid d-md-flex justify-content-between">
              Bagian
            <a href="{{url('section/create')}}" class="btn btn-sm btn-flat btn-success" style="font-size: 0.8em;">Add Section</a>
          </div>
        </div>
        <div class="card-body">
            <table class="table w-100 table-bordered table-hover text-center table-striped" id="section">
                <thead style="text-align: center">
                    <tr class="align-middle">
                    <th>ID</th>
                    <th>Nama Bagian</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody style="vertical-align: middle">
                    @foreach($sections as $section)
                    <tr>
                        <td>{{$section->id}}</td>
                        <td>{{$section->nama_bagian}}</td>
                        <td><a href="{{url('section/update/'.$section->id) }}" class="btn btn-sm btn-flat btn-warning"><span class="far fa-edit"></span> Update</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!--Pagination-->
        <div class="d-flex mt-3 justify-content-center me-2">
            {!! $sections->links() !!}
        </div>
      </div>
      </div> {{-- wajib pakai --}}
  </div> {{-- wajib pakai --}}
@endsection