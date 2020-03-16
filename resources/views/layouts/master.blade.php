<!DOCTYPE html>
<html lang="en">
    @php
    use App\Application;
    $app = Application::first();
    @endphp
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet" />
    <title>{{ ucfirst(Request::segment(1)) }} | {{$app->nama}}</title>
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="shortcut icon" href="{{asset('/img/favico.png')}}" type="image/x-icon">
    <!-- Main styles for this application-->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
   <link href="{{asset('/adminlte/css/style.css')}}" rel="stylesheet">
    <style>
        body {
            font-family: 'Lato', sans-serif;
            font-weight: 400;
            font-size: 14px;
        }
      .c-sidebar{
        width: 200px;
      }
      .c-wrapper{
        margin-left: 200px !important;
      }
      .c-sidebar.c-sidebar-dark,.c-header.c-header-dark{
        background: #1F2833;
      }
      .c-sidebar-brand{
        background: rgba(0, 0, 0, 0) !important;
      }
      .c-sidebar .c-sidebar-nav-link.c-active, .c-sidebar .c-active.c-sidebar-nav-dropdown-toggle{
        background: #038ACA !important;
      }
      .c-sidebar .c-sidebar-nav-link:hover{
        background: #038ACA;
      }
      .c-footer{
        background: #C5C6C7;
        border-top: 0px;
        max-height: 40px;
      }
      .c-subheader{
        background: #C5C6C7;
      }
      body, .c-app{
        background-color: #EBEBEB;
      }
      .c-header.c-header-dark{
        border-bottom: 0px;
      }
      .c-sidebar-nav{
        margin-top: 48px;
      }
      .c-main{
          padding-top: 20px;
          color: black;
          padding-bottom: 20px
      }
      .table{
          color:black;
      }
      div .container-fluid{
          padding: 0px 10px;
      }
      @media (min-width: 768px){
            div .container-fluid{
            padding: 0px 5px !important;
        }
      }
      .card {
          margin-bottom: 0px;
      }
      .card-footer{
        background-color: #C5C6C7;
      }
      .c-footer.c-footer-fixed{
          position: fixed !important;
          margin-left: 200px;
      }
      .card{
          margin-bottom: 40px
      }
      .c-header-dark {
            background-color: rgb(31, 40, 51) !important;
        }
        .c-subheader{
            margin-left:200px;
        }
    </style>
    @stack('css')
  </head>
  <body class="c-app">
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
      <div class="c-sidebar-brand d-lg-down-none">
        <img height="50px" src="{{asset('/uploads/'.$app->logo)}}" alt="" style="margin-left:10px; height:25px;">
      </div>
      @if (auth()->user()->level_id == 2)
      <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link {{ Request::segment(1) == 'beranda'?'c-active':'' }}" href="{{ route('beranda') }}">
            <i class="c-sidebar-nav-icon fa fa-home"></i> Beranda</a>
          </li>
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link {{ Request::segment(1) == 'penjualan'?'c-active':'' }}" href="{{ route('penjualan.index') }}">
          <i class="c-sidebar-nav-icon fa fa-shopping-cart"></i> Penjualan</a></li>
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link {{ Request::segment(1) == 'piutang'?'c-active':'' }}" href="{{ route('piutang.index') }}">
          <i class="c-sidebar-nav-icon fa fa-credit-card"></i> Piutang</a>
        </li>
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link {{ Request::segment(1) == 'pelanggan'?'c-active':'' }}" href="{{ route('pelanggan.index') }}">
          <i class="c-sidebar-nav-icon fa fa-users"></i> Pelanggan</a>
        </li>
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link {{ Request::segment(1) == 'barang'?'c-active':'' }}" href="{{ route('barang.index') }}">
            <i class="c-sidebar-nav-icon fa fa-th-large"></i> Barang</a>
        </li>
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link {{ Request::segment(1) == 'stok'?'c-active':'' }}" href="{{ route('stok.index') }}">
          <i class="c-sidebar-nav-icon fa fa-list"></i> Stok Barang</a>
        </li>
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link {{ Request::segment(1) == 'karyawan'?'c-active':'' }}" href="{{ route('karyawan.index') }}">
          <i class="c-sidebar-nav-icon fa fa-user"></i> Karyawan</a>
        </li>
        </li>
      </ul>
      @else
      <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link {{ Request::segment(1) == 'beranda'?'c-active':'' }}" href="{{ route('beranda') }}">
            <i class="c-sidebar-nav-icon fa fa-home"></i> Beranda</a>
          </li>
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link {{ Request::segment(1) == 'penjualan'?'c-active':'' }}" href="{{ route('penjualan.index') }}">
          <i class="c-sidebar-nav-icon fa fa-shopping-cart"></i> Penjualan</a></li>
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link {{ Request::segment(1) == 'piutang'?'c-active':'' }}" href="{{ route('piutang.index') }}">
          <i class="c-sidebar-nav-icon fa fa-credit-card"></i> Piutang</a>
        </li>
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link {{ Request::segment(1) == 'pelanggan'?'c-active':'' }}" href="{{ route('pelanggan.index') }}">
          <i class="c-sidebar-nav-icon fa fa-users"></i> Pelanggan</a>
        </li>
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link {{ Request::segment(1) == 'cabang'?'c-active':'' }}" href="{{ route('cabang.index') }}">
          <i class="c-sidebar-nav-icon fa fa-flag"></i> Cabang</a>
        </li>
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link {{ Request::segment(1) == 'jenis'?'c-active':'' }}" href="{{ route('jenis.index') }}">
          <i class="c-sidebar-nav-icon fa fa-barcode"></i> Jenis Barang</a>
        </li>
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link {{ Request::segment(1) == 'barang'?'c-active':'' }}" href="{{ route('barang.index') }}">
          <i class="c-sidebar-nav-icon fa fa-th-large"></i> Barang</a>
        </li>
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link {{ Request::segment(1) == 'stok'?'c-active':'' }}" href="{{ route('stok.index') }}">
          <i class="c-sidebar-nav-icon fa fa-list"></i> Stok Barang</a>
        </li>
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link {{ Request::segment(1) == 'karyawan'?'c-active':'' }}" href="{{ route('karyawan.index') }}">
          <i class="c-sidebar-nav-icon fa fa-user"></i> Karyawan</a>
        </li>
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link {{ Request::segment(1) == 'pengguna'?'c-active':'' }}" href="{{ route('pengguna.index') }}">
          <i class="c-sidebar-nav-icon fa fa-user-circle"></i> Pengguna</a>
        </li>
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link {{ Request::segment(1) == 'tentang'?'c-active':'' }}" href="{{ route('tentang.index') }}">
          <i class="c-sidebar-nav-icon fa fa-info-circle"></i> Tentang</a>
        </li>
      </ul>
      @endif
    </div>
        <header class="c-header c-header-dark c-header-fixed c-header-with-subheader">
            <a class="c-header-brand px-3" href="#" style="font-size:18px">
                <img src="{{asset('/uploads/'.$app->logo)}}" height="30px" alt="Nama Aplikasi" style="margin-right:10px">
                @if (auth()->user()->level_id == 1)
                Pusat
                @else
                Cabang {{ ucfirst(auth()->user()->employee->branch->nama) }}
                @endif
                {{-- <img src="{{asset('/uploads/'.$app->logo)}}" height="30px" alt="Nama Aplikasi" style="margin-right:10px"> CABANG {{ strtoupper(auth()->user()->employee->branch->nama) }} --}}

            </a>
            <div class="c-header-nav ml-auto px-3">
                <span class="c-header-nav-item text-light">Selamat datang,</span>
                <a class="c-header-nav-item c-header-nav-link" href="#">{{auth()->user()->employee->nama}}</a>
                <div class="c-header-nav-item c-header-nav-link">
                    <img class="rounded-circle" src="{{asset("/uploads/".auth()->user()->employee->foto)}}" height="40px" alt="Avatar">
                </div>
                <a class="c-header-nav-item c-header-nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
          <div class="c-subheader px-3">
            <!-- Breadcrumb-->
            <ol class="breadcrumb border-0 m-0">
              @yield('breadcumb')
              <!-- Breadcrumb Menu-->
            </ol>
          </div>
        </header>
    <div class="c-wrapper c-fixed-components">
      <div class="c-body" style="margin-top:100px">
        <main class="c-main">
          <div class="container-fluid">
            <div class="fade-in">
                @yield('content')
            </div>
          </div>
        </main>
        <footer class="c-footer c-footer-fixed">
            <div class="m-auto" style="font-size:12px">&copy; {{ now()->year }} | Developed with <span style="color:#b71c1c">&hearts;</span> by <img src="{{asset('/img/logo-dev.png')}}" alt="logo-dev" height="10px"></div>
        </footer>
      </div>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="{{asset('/adminlte/vendors/@coreui/coreui/js/coreui.bundle.min.js')}}"></script>
      <!-- jQuery -->
  <script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!--<![endif]-->
    <!-- Plugins and scripts required by this view-->
    <script src="{{asset('/adminlte/vendors/@coreui/utils/js/coreui-utils.js')}}"></script>
    @stack('script')

  </body>
</html>
