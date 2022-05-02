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
      <li class = "@if(session()->has('menu') && session()->get('menu') == 'jenis') active @endif">
        <a href="#jenis" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> <span class="far fa-list"></span> Data Jenis</a>
        <ul class="collapse list-unstyled" id="jenis">
          <li class = "@if(session()->has('submenu') && session()->get('submenu') == 'group') active @endif">
              <a href="{{url('/document_group') }}">Kelompok Dokumen</a>
          </li>
          <li class = "@if(session()->has('submenu') && session()->get('submenu') == 'doc_type') active @endif">
              <a href="{{url('/document_type')}}">Jenis Dokumen</a>
          </li>
          <li class = "@if(session()->has('submenu') && session()->get('submenu') == 'mailtype') active @endif">
              <a href="{{url('/mail_type')}}">Jenis Surat</a>
          </li>
          <li class = "@if(session()->has('submenu') && session()->get('submenu') == 'section') active @endif">
              <a href="{{url('/section')}}">Bagian</a>
          </li>
        </ul>
      </li>
      @endif
      <li class = "@if(session()->has('menu') && session()->get('menu') == 'document') active @endif">
        <a href="#dokumen" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> <span class="far fa-file"></span> Data Dokumen</a>
        <ul class="collapse list-unstyled" id="dokumen">
          @if (Auth::user()->role != 'lainnya')
          <li class = "@if(session()->has('submenu') && session()->get('submenu') == 'insertdoc') active @endif">
              <a href="{{url('/document/inputdocument')}}">Input Dokumen</a>
          </li>
          @endif
          <li class = "@if(session()->has('submenu') && session()->get('submenu') == 'rekapdoc') active @endif">
              <a href="{{url('/document')}}">Rekap Dokumen</a>
          </li>
        </ul>
      </li>
      <li class = "@if(session()->has('menu') && session()->get('menu') == 'inmail') active @endif">
        <a href="#suratmasuk" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> <span class="far fa-inbox-in"></span> Data Surat Masuk</a>
        <ul class="collapse list-unstyled" id="suratmasuk">
          @if (Auth::user()->role != 'lainnya')
          <li class = "@if(session()->has('submenu') && session()->get('submenu') == 'insertinmail') active @endif">
              <a href="{{url('/inmails/create')}}">Input Surat Masuk</a>
          </li>
          @endif
          <li class = "@if(session()->has('submenu') && session()->get('submenu') == 'rekapinmail') active @endif">
              <a href="{{url('/inmail')}}">Rekap Surat Masuk</a>
          </li>
          @if (Auth::user()->role == 'lainnya')
          <li class = "@if(session()->has('submenu') && session()->get('submenu') == 'rekapdispo') active @endif">
              <a href="{{url('/inmails/dispo')}}">Rekap Surat Disposisi</a>
          </li>
          @endif
        </ul>
      </li>
      @if (Auth::user()->role != 'lainnya')
      <li class = "@if(session()->has('menu') && session()->get('menu') == 'outmail') active @endif">
        <a href="#suratkeluar" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> <span class="far fa-inbox-out"></span> Data Surat Keluar</a>
        <ul class="collapse list-unstyled" id="suratkeluar">
          <li class = "@if(session()->has('submenu') && session()->get('submenu') == 'insertoutmail') active @endif">
              <a href="{{url('/outmails/create')}}">Input Surat Keluar</a>
          </li>
          <li class = "@if(session()->has('submenu') && session()->get('submenu') == 'rekapoutmail') active @endif">
              <a href="{{url('/outmail')}}">Rekap Surat Keluar</a>
          </li>
        </ul>
      </li>
      <li class="@if(session()->has('menu') && session()->get('menu') == 'laporan') active @endif">
        <a href="#laporan" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> <span class="far fa-print"></span> Laporan</a>
        <ul class="collapse list-unstyled" id="laporan">
          <li class="@if(session()->has('submenu') && session()->get('submenu') == 'laporaninmail') active @endif">
              <a href="/laporan_inmail">Laporan Surat Masuk</a>
          </li>
          <li class="@if(session()->has('submenu') && session()->get('submenu') == 'laporanoutmail') active @endif">
              <a href="/laporan_outmail">Laporan Surat Keluar</a>
          </li>
          <li class="@if(session()->has('submenu') && session()->get('submenu') == 'laporandispo') active @endif">
              <a href="{{route('laporan-disposisi')}}">Laporan Surat Disposisi</a>
          </li>
        </ul>
      </li>
      @endif
      @if (Auth::user()->role == 'admin')
      <li class = "@if(session()->has('menu') && session()->get('menu') == 'users') active @endif">
          <a href="{{ Route('users_data') }}"> <span class="far fa-users"></span> Data User</a>
      </li>
      @endif
      <li class = "@if(session()->has('menu') && session()->get('menu') == 'profil') active @endif">
        <a href="{{ Route('users_profile') }}"> <span class="far fa-user"></span> Profile</a>
      </li>
      <li>
        <a href="{{url('/logout')}}"><span class="far fa-sign-out"></span> Logout</a>
      </li>
    </ul>
  </div>
</nav>