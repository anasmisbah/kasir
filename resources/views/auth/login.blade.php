<!DOCTYPE html>
<html lang="en">
    @php
    use App\Application;
    $app = Application::first();
    @endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- App Desc -->
    <meta name="description" content="Halaman Login" />
    <meta name="author" content="tukangkode.id" />
    <title>Masuk | {{$app->nama}}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('/img/favico.png')}}" type="image/x-icon" />
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
        html,
        body {
            height: 100%;
        }

        body {
            font-family: 'Lato', sans-serif;
            display: -ms-flexbox;
            display: -webkit-box;
            display: flex;
            -ms-flex-align: center;
            -ms-flex-pack: center;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: rgb(235, 235, 235);
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }

        .form-signin .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px;
            font-size: 16px;
        }

        .modal-body .form-control {
            height: auto;
            padding-top: 10px;
            padding-bottom: 10px;
            font-size: 16px;
        }

        h2,
        h3,
        h4,
        p {
            color: #1f2833;
        }
    </style>
</head>
<body class="c-app text-center">
    <!-- Form login -->
    <form class="form-signin" action="{{ route('login') }}" method="post">
        @csrf
        <!-- Head -->
        <img class="mb-5" src="{{asset('/uploads/'.$app->logo)}}" height="40px" alt="Nama Aplikasi">
        <h4 class="mb-3">Silahkan masuk ke akun Anda</h4>
        <!-- Input group -->
        <div class="input-group mb-3">
            <input type="text" id="inputUser" class="form-control" name="username" placeholder="Username">
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="password" id="inputPass" name="password" class="form-control" placeholder="Password" required>
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
            </div>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Masuk</button>
        <button class="btn btn-link mt-3 px-0" type="button" data-toggle="modal" data-target="#resetModal">Lupa password?</button>
        <!-- Copyright -->
        <p class="mt-5 small">
            &copy; 2020 | Developed with
            <span style="color:#b71c1c"><i class="fas fa-heart"></i></span>
            by
            <a href="#"><img src="{{asset('img/logo-dev.png')}}" height="12px" alt="tukangkode.id"></a>
        </p>
    </form>
    <!-- End of form login -->
    <!-- Modal pelanggan -->
    <div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content col-md-8 offset-md-2">
                <div class="modal-body">
                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="mt-4"><i class="fa fa-lock fa-4x"></i></h3>
                        <h2 class="mt-3">Lupa password?</h2>
                        <p>Silahkan masukkan email akun Anda di sini.</p>
                        <div class="input-group mb-3">
                            <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://unpkg.com/@coreui/coreui@3.0.0-rc.0/dist/js/coreui.min.js"></script>
        <!-- jQuery -->
        <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
        <script src="/adminlte/plugins/sweetalert.min.js"></script>
        <script>
            $(function(){
                var error = '{{ $errors->first() }}'
                if (error) {
                   swal("Login Failed!", error, "error");
                }

                var status = "{{ session('status') }}"
                if (status) {
                   swal("Sukses", status, "success");
                }
            })
        </script>
</body>
</html>
