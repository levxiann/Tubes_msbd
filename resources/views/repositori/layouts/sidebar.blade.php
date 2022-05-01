<div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar">
        <div class="custom-menu">
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
      <i class="fa fa-bars"></i>
      <span class="sr-only">Toggle Menu</span>
    </button>
</div>
        <div class="p-4 pt-5">
          <h4><a href="{{url('/')}}" class="logo" style="color: white">{{Auth::user()->name}}</a></h4>
    <ul class="list-unstyled components mb-5">
      @if (Auth::user()->role != 'lainnya')
      <li class="active">
        <a href="#jenis" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Data Jenis</a>
        <ul class="collapse list-unstyled" id="jenis">
          <li>
              <a href="#">Kelompok Dokumen</a>
          </li>
          <li>
              <a href="#">Jenis Dokumen</a>
          </li>
          <li>
              <a href="#">Jenis Surat</a>
          </li>
          <li>
              <a href="#">Bagian</a>
          </li>
        </ul>
      </li>
      @endif
      <li class="active">
        <a href="#dokumen" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Data Dokumen</a>
        <ul class="collapse list-unstyled" id="dokumen">
          @if (Auth::user()->role != 'lainnya')
          <li>
              <a href="#">Input Dokumen</a>
          </li>
          @endif
          <li>
              <a href="#">Rekap Dokumen</a>
          </li>
        </ul>
      </li>
      <li class="active">
        <a href="#suratmasuk" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Data Surat Masuk</a>
        <ul class="collapse list-unstyled" id="suratmasuk">
          @if (Auth::user()->role != 'lainnya')
          <li>
              <a href="#">Input Surat Masuk</a>
          </li>
          @endif
          <li>
              <a href="#">Rekap Surat Masuk</a>
          </li>
        </ul>
      </li>
      @if (Auth::user()->role != 'lainnya')
      <li class="active">
        <a href="#suratkeluar" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Data Surat Keluar</a>
        <ul class="collapse list-unstyled" id="suratkeluar">
          <li>
              <a href="#">Input Surat Keluar</a>
          </li>
          <li>
              <a href="#">Rekap Surat Keluar</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="#">Laporan</a>
      </li>
      @endif
      @if (Auth::user()->role == 'admin')
      <li>
          <a href="{{ Route('users_data') }}">Data User</a>
      </li>
      @endif
      <li>
        <a href="{{ Route('users_profile') }}">Profile</a>
      </li>
      <li>
        <a href="{{url('/logout')}}">Logout</a>
      </li>
    </ul>
  </div>
</nav>