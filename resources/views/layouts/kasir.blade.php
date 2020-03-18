<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- App Desc -->
    <meta name="description" content="Halaman Kasir" />
    <meta name="author" content="tukangkode.id" />
    <title>Pengguna | App</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="../../assets/favicon/favicon.ico" type="image/x-icon" />
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet" />
    <!-- Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" />
    <!-- CSS -->
    <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui@3.0.0-rc.0/dist/css/coreui.min.css">
    <!--
            [if lt IE 9]>
                <script src="http://css3-mediaqueries-js.googlecode.com/files/css3-mediaqueries.js"></script>
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <![endif]
    -->
    <style>
        html {
            position: relative;
            min-height: 100%;
        }

        body {
            height: 100%;
            overflow: hidden;
            background-color: rgb(235, 235, 235);
            font-family: 'Lato', sans-serif;
            font-weight: 400;
            font-size: 14px;
            margin-bottom: 40px;
            /* Margin bottom by footer height */
        }

        .c-header-dark {
            background-color: rgb(31, 40, 51) !important;
        }

        .c-footer {
            position: absolute;
            color: #1f2833;
            font-size: 12px;
            bottom: 0;
            width: 100%;
            height: 40px;
            /* Set the fixed height of the footer here */
            line-height: 40px;
            /* Vertically center the text there */
            background-color: rgb(197, 198, 199);
        }
    </style>
    @stack('css')
</head>
<body>
    <!-- Header -->
    <header class="c-header c-header-fixed c-header-dark px-3">
        <a class="c-header-brand" href="#">
            <img src="../../uploads/logos/1584062395kasirku.png" height="30px" alt="Nama Aplikasi">
        </a>
        <div class="c-header-nav ml-auto">
            <span class="c-header-nav-item text-light">Selamat datang,</span>
            <a class="c-header-nav-item c-header-nav-link" href="#">{{auth()->user()->employee->nama}}</a>
            <div class="c-header-nav-item dropdown"><a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="c-avatar"><img class="rounded-circle" src="{{asset("/uploads/".auth()->user()->employee->foto)}}" height="40px" alt="Avatar"></div>
                </a>
                <div class="dropdown-menu dropdown-menu-right pt-0">
                    <div class="dropdown-header bg-light border-bottom py-2"><strong>Settings</strong></div>
                    <a class="dropdown-item" href="{{route('pengguna.profile')}}">
                        <i class="fas fa-user mr-2"></i> Profile
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </header>
    <!-- End of header -->
    <!-- Content -->
    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                <div class="fade-in">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
    <!-- End of content -->
    <!-- Footer -->
    <footer class="c-footer">
        <!-- Footer content here -->
        <p class="mx-auto">
            &copy; 2020 | Developed with
            <span style="color:#b71c1c"><i class="fas fa-heart"></i></span>
            by
            <a href="#"><img src="{{asset('img/logo-dev.png')}}" height="12px" alt="tukangkode.id"></a>
        </p>
    </footer>
    <!-- End of footer -->
    <!-- Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://unpkg.com/@coreui/coreui@3.0.0-rc.0/dist/js/coreui.min.js"></script>

    @stack('js')
</body>
</html>
