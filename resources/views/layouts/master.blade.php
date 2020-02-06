<!DOCTYPE html>
<html>
<head>
    @php
    use App\Application;
      $app = Application::first();
  @endphp
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $app->toko }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  @stack('css')
  <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">



</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-black navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          {{auth()->user()->username}} <i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset("/storage/".auth()->user()->employee->foto)}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                    {{auth()->user()->employee->nama}}
                  <span class="float-right text-sm text-danger">{{auth()->user()->level->nama}}</i></span>
                </h3>
                <p class="text-sm">Cabang :  <b class="text-blue">{{auth()->user()->employee->branch->nama}}</b> </p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();" data-slide="true">
          <i class="fas fa-power-off"></i>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
            </form>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{asset("/storage/".$app->logo)}}"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{$app->toko}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               @if (auth()->user()->level->nama == "utama")
                {{-- Menut Role Utama --}}
                <li class="nav-item">
                    <a href="{{ route('beranda') }}" class="nav-link">
                      <i class="nav-icon fas fa-home"></i>
                      <p>
                        Beranda
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('penjualan.index') }}" class="nav-link">
                      <i class="nav-icon fas fa-shopping-cart"></i>
                      <p>
                        Penjualan
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('piutang.index') }}" class="nav-link">
                      <i class="nav-icon fas fa-credit-card"></i>
                      <p>
                        Piutang
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('pelanggan.index') }}" class="nav-link">
                      <i class="nav-icon fas fa-users"></i>
                      <p>
                        Pelanggan
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('cabang.index') }}" class="nav-link">
                      <i class="nav-icon fas fa-flag"></i>
                      <p>
                        Cabang
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('jenis.index') }}" class="nav-link">
                      <i class="nav-icon fas fa-barcode"></i>
                      <p>
                        Jenis Barang
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('barang.index') }}" class="nav-link">
                      <i class="nav-icon fas fa-th-large"></i>
                      <p>
                        Barang
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('stok.index') }}" class="nav-link">
                      <i class="nav-icon fas fa-list"></i>
                      <p>
                        Stok Barang
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('karyawan.index') }}" class="nav-link">
                      <i class="nav-icon fas fa-user"></i>
                      <p>
                        Karyawan
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('pengguna.index') }}" class="nav-link">
                      <i class="nav-icon fas fa-user-circle"></i>
                      <p>
                        Pengguna
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('tentang.index') }}" class="nav-link">
                      <i class="nav-icon fas fa-info"></i>
                      <p>
                        Tentang
                      </p>
                    </a>
                  </li>
               @elseif(auth()->user()->level->nama == "cabang")
                {{-- Menut Role Cabang --}}
                <li class="nav-item">
                    <a href="{{ route('beranda') }}" class="nav-link">
                      <i class="nav-icon fas fa-home"></i>
                      <p>
                        Beranda
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('penjualan.index') }}" class="nav-link">
                      <i class="nav-icon fas fa-shopping-cart"></i>
                      <p>
                        Penjualan
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('piutang.index') }}" class="nav-link">
                      <i class="nav-icon fas fa-credit-card"></i>
                      <p>
                        Piutang
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('pelanggan.index') }}" class="nav-link">
                      <i class="nav-icon fas fa-users"></i>
                      <p>
                        Pelanggan
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('stok.index') }}" class="nav-link">
                      <i class="nav-icon fas fa-list"></i>
                      <p>
                        Stok Barang
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('karyawan.index') }}" class="nav-link">
                      <i class="nav-icon fas fa-user"></i>
                      <p>
                        Karyawan
                      </p>
                    </a>
                  </li>
               @else()
                {{-- Menut Role Kasir --}}
                  <li class="nav-item">
                    <a href="{{ route('kasir.index') }}" class="nav-link">
                      <i class="nav-icon fas fa-shopping-cart"></i>
                      <p>
                        Kasir
                      </p>
                    </a>
                  </li>
               @endif

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2020 <a href="#">Link</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/adminlte/dist/js/demo.js"></script>

@stack('script')
</body>
</html>
