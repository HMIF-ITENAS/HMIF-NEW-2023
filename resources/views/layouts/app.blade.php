<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HMIF ITENAS - {{ $title }}</title>
    <link rel="icon" href="{{ asset('app/img/logo/hmif-favicon.ico') }}" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description"
        content="HMIF ITENAS - Himpunan Mahasiswa Teknik Informatika (HMIF) Beridiri pada tanggal 15 Maret 2005 oleh Rendi Mawardi dkk sekaligus sebagai Ketua Himpunan pertama. Visi awal didirikannya HMIF adalah dibutuhkannya membuat suatu wadah mahasiswa informatika, rekan rekan IF pada saat itu ber-koordinasi dengan jurusan.">
    <meta name="author" content="HMIF Devs">
    <meta name="keyword"
        content="HMIF ITENAS, HMIF Itenas, Himpunan Mahasiswa Teknik Informatika, HIMPUNAN MAHASISWA TEKNIK INFORMATIKA, Himpunan Mahasiswa Teknik Informatika ITENAS">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('app/vendors/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app/vendors/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link rel="stylesheet" href="{{ asset('app/vendors/owl-carousel/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app/vendors/owl-carousel/owl.carousel.min.css') }}">

    <link rel="stylesheet" href="{{ asset('app/css/style.css') }}">
    @stack('styles')
</head>

<body>
    <!--================Header Menu Area =================-->
    <header class="header_area">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container box_1620">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="{{ route('app.home') }}"><img
                            src="{{ asset('app/img/logo/logohmif-crop-1.png') }}" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav justify-content-end">
                            <li class="nav-item {{ request()->is('/') ? 'active' : '' }}"><a class="nav-link"
                                    href="{{ route('app.home') }}">Homepage</a></li>
                            <li class="nav-item submenu dropdown {{ request()->is('/sejarah') ? 'active' : '' }}">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">Tentang HMIF</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('app.about.sejarah') }}">Sejarah & Visi Misi</a></li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('app.about.struktur') }}">Struktur Organisasi</a></li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('app.about.kahim') }}">Ketua Himpunan</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Ketua BPA</a></li>
                                </ul>
                            </li>
                            <li
                                class="nav-item submenu dropdown {{ request()->is('/post') || request()->is('/album') ? 'active' : '' }}">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">Informasi</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item {{ request()->is('/post') ? 'active' : '' }}"><a
                                            class="nav-link" href="{{ route('app.post') }}">Postingan</a></li>
                                    <li class="nav-item {{ request()->is('/album') ? 'active' : '' }}"><a
                                            class="nav-link" href="{{ route('app.album') }}">Album Kegiatan</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item {{ request()->is('/aspiration') ? 'active' : '' }}"><a
                                    class="nav-link" href="{{ route('app.aspiration') }}">Aspirasi</a>
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">HMIF E-Vote</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="#">Aturan</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">FAQ</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Kandidat</a></li>
                                </ul>
                            </li>
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">Sumber Daya</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="#">AD/ART</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">GBHO</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Kalender Akademik</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                        <ul class="navbar-right">
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="button button-header">Masuk</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!--================Header Menu Area =================-->


    <main class="side-main">
        @yield('content')
    </main>


    <!-- ================ start footer Area ================= -->
    <footer class="footer-area section-gap">
        <div class="container">
            <div class="row">
                <div class="col-md-7 single-footer-widget">
                    <h4>Kontak Kami</h4>
                    <ul>
                        <li>
                            <i class="fas fa-map-marker-alt text-white mr-3" style="font-size: 25px"></i>
                            <a href="https://goo.gl/maps/CBAPRHdH8kWudzt99" target="_blank">Jl. Phh. Mustofa No. 23,
                                Bandung, Jawa Barat 40123. Sekretariat: Gedung 2 lantai 2</a>
                        </li>
                        <li>
                            <i class="fas fa-envelope text-white mr-3" style="font-size: 20px"></i>
                            <a href="malto:hmif@itenas.ac.id" target="_blank">hmif@itenas.ac.id</a>
                        </li>
                        <li>
                            <i class="fas fa-phone text-white mr-3" style="font-size: 20px"></i>
                            <span class="text-white">+62227272215</span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-5 single-footer-widget">
                    <h4>Newsletter</h4>
                    <p>You can trust us. we only send promo offers,</p>
                    <div class="form-wrap" id="mc_embed_signup">
                        <form target="_blank"
                            action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                            method="get" class="form-inline">
                            <input class="form-control" name="EMAIL" placeholder="Your Email Address"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address '"
                                required="" type="email">
                            <button class="click-btn btn btn-default">subscribe</button>
                            <div style="position: absolute; left: -5000px;">
                                <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                            </div>

                            <div class="info"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="footer-bottom row align-items-center text-center text-lg-left">
                <p class="footer-text m-0 col-lg-8 col-md-12">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | <b>HMIF Dev's</b>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
                <div class="col-lg-4 col-md-12 text-center text-lg-right footer-social">
                    <a href="#" target="_blank"><i class="fab fa-line"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-spotify"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <!-- ================ End footer Area ================= -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <script src="{{ asset('app/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('app/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('app/js/mail-script.js') }}"></script>
    <script src="{{ asset('app/js/main.js') }}"></script>
    @stack('scripts')
</body>

</html>
