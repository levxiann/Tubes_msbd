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
              Kelompok Dokumen
            <a href="{{url('document_group/create')}}" class="btn btn-sm btn-flat btn-success" style="font-size: 0.8em;">Add document group</a>
          </div>
        </div>
        <div class="card-body">
            <table class="table w-100 table-bordered table-hover text-center table-striped" id="document_group">
                <thead style="text-align: center">
                    <tr class="align-middle">
                    <th>ID</th>
                    <th>Nama Kelompok Dokumen</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody style="vertical-align: middle">
                    @foreach($groups as $group)
                    <tr>
                        <td>{{$group->id}}</td>
                        <td>{{$group->nama_kelompok_dokumen}}</td>
                        <td><a href="{{url('document_group/update/'.$group->id) }}" class="btn btn-sm btn-flat btn-warning"><span class="far fa-edit"></span> Update</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!--Pagination-->
        <div class="d-flex mt-3 justify-content-center me-2">
            {!! $groups->links() !!}
        </div>
      </div>
      </div> {{-- wajib pakai --}}
  </div> {{-- wajib pakai --}}
@endsection