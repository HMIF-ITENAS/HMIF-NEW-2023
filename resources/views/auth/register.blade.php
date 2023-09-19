<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v3.4.0
* @link https://coreui.io
* Copyright (c) 2020 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description"
        content="HMIF ITENAS - Himpunan Mahasiswa Teknik Informatika (HMIF) Beridiri pada tanggal 15 Maret 2005 oleh Rendi Mawardi dkk sekaligus sebagai Ketua Himpunan pertama. VIsi awal didirikannya HMIF adalah dibutuhkannya membuat suatu wadah mahasiswa informatika, rekan rekan IF pada saat itu ber-koordinasi dengan jurusan.">
    <meta name="author" content="HMIF Devs">
    <meta name="keyword"
        content="HMIF ITENAS, HMIF Itenas, Himpunan Mahasiswa Teknik Informatika, HIMPUNAN MAHASISWA TEKNIK INFORMATIKA, Himpunan Mahasiswa Teknik Informatika ITENAS">
    <title>{{ config('app.name', 'HMIF ITENAS') }} - Register</title>
    <link rel="shortcut icon" href="{{ asset('hmif-favicon.ico') }}" type="image/x-icon">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- Main styles for this application-->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        // Shared ID
        gtag('config', 'UA-118965717-3');
        // Bootstrap ID
        gtag('config', 'UA-118965717-5');
    </script>
</head>

<body class="c-app flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mx-4">
                    <div class="card-body p-4">
                        <h1>Register</h1>
                        <p class="text-muted">Registrasi sudah ditutup, jika belum memiliki akun mohon hubungi
                            administrator</p>
                        <form method="POST" action="">
                            @csrf
                            <div class="form-group">
                                <label for="">Name</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text">
                                            <svg class="c-icon">
                                                <use
                                                    xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-user') }}">
                                                </use>
                                            </svg></span></div>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" placeholder="Name"
                                        autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">NRP</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text">
                                            <svg class="c-icon">
                                                <use
                                                    xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-fingerprint') }}">
                                                </use>
                                            </svg></span></div>
                                    <input type="text" class="form-control @error('nrp') is-invalid @enderror"
                                        name="nrp" value="{{ old('nrp') }}" required autocomplete="nrp"
                                        placeholder="NRP tanpa tanda strip (-)" autofocus>
                                    @error('nrp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Angkatan</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text">
                                            <svg class="c-icon">
                                                <use
                                                    xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-calendar') }}">
                                                </use>
                                            </svg></span>
                                    </div>
                                    <input type="text" class="form-control @error('angkatan') is-invalid @enderror"
                                        name="angkatan" value="{{ old('angkatan') }}" required
                                        autocomplete="angkatan" placeholder="Angkatan, contoh : 2018" autofocus>
                                    @error('angkatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">E-mail</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text">
                                            <svg class="c-icon">
                                                <use
                                                    xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-envelope-open') }}">
                                                </use>
                                            </svg></span></div>
                                    <input class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Password</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text">
                                            <svg class="c-icon">
                                                <use
                                                    xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-lock-locked') }}">
                                                </use>
                                            </svg></span></div>
                                    <input class="form-control @error('password') is-invalid @enderror" type="password"
                                        name="password" placeholder="Password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Password Confirmation</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text">
                                            <svg class="c-icon">
                                                <use
                                                    xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-lock-locked') }}">
                                                </use>
                                            </svg></span></div>
                                    <input class="form-control" type="password" name="password_confirmation" required
                                        autocomplete="new-password" placeholder="Repeat password">
                                </div>
                            </div>

                            <button class="btn btn-block btn-success" type="submit">Create Account</button>
                            <a href="{{ route('login') }}" class="btn btn-link">Have an account? Login here</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('admin/vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>
    <!--[if IE]><!-->
    <script src="{{ asset('admin/vendors/@coreui/icons/js/svgxuse.min.js') }}"></script>
    <!--<![endif]-->


</body>

</html>
