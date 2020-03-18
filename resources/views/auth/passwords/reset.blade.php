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
    <title>Pemulihan Sandi | {{$app->nama}}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('img/logo-dev.png')}}" type="image/x-icon" />
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

        h2,
        h3,
        p {
            color: #1f2833;
        }
    </style>
</head>
<body class="c-app text-center">
    <!-- Form recover password -->
    <form class="form-signin" action="{{ route('password.update') }}" method="POST">
        <!-- Head -->
        <h3 class="mt-4"><i class="fa fa-lock fa-4x"></i></h3>
        <h2 class="mt-3">Atur ulang password</h2>
        <p>Silahkan masukkan password baru Anda di sini.</p>
        <input id="email" type="hidden" name="email" value="{{ $email }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        <!-- Input group -->
        <div class="input-group mb-3">
            <input type="password" id="inputPass" class="form-control  @error('password') is-invalid @enderror" name="password" required placeholder="Password baru">
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input type="password" id="inputPass" name="password_confirmation" class="form-control" placeholder="Konfirmasi password" required>
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
            </div>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Simpan</button>
        <!-- Copyright -->
        <p class="mt-5 small">
            &copy; 2020 | Developed with
            <span style="color:#b71c1c"><i class="fas fa-heart"></i></span>
            by
            <a href="#"><img src="{{asset('/img/logo-dev.png')}}" height="12px" alt="tukangkode.id"></a>
        </p>
    </form>
    <!-- End of form recover password -->
    <!-- Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://unpkg.com/@coreui/coreui@3.0.0-rc.0/dist/js/coreui.min.js"></script>
</body>
</html>
