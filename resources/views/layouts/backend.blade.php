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
    <meta name="description" content="HMIF ITENAS - Himpunan Mahasiswa Teknik Informatika (HMIF) Beridiri pada tanggal 15 Maret 2005 oleh Rendi Mawardi dkk sekaligus sebagai Ketua Himpunan pertama. Visi awal didirikannya HMIF adalah dibutuhkannya membuat suatu wadah mahasiswa informatika, rekan rekan IF pada saat itu ber-koordinasi dengan jurusan.">
    <meta name="author" content="HMIF Devs">
    <meta name="keyword" content="HMIF ITENAS, HMIF Itenas, Himpunan Mahasiswa Teknik Informatika, HIMPUNAN MAHASISWA TEKNIK INFORMATIKA, Himpunan Mahasiswa Teknik Informatika ITENAS">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'HMIF ITENAS') }} - {{ $title }}</title>
    <link rel="shortcut icon" href="{{ asset('hmif-favicon.ico') }}" type="image/x-icon">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- Main styles for this application-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <link href="{{ asset('admin/vendors/@coreui/chartjs/css/coreui-chartjs.css') }}" rel="stylesheet">
    @stack('styles')
  </head>
  <body class="c-app">
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
      <div class="c-sidebar-brand d-lg-down-none">
        <img src="{{ asset('admin/assets/img/logo/logo.png') }}" class="img-fluid" alt="">
      </div>
      @if(auth()->user()->level === 'admin')
        <ul class="c-sidebar-nav">
          <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ (request()->is('admin/home')) ? 'c-active' : '' }}" href="{{ route('admin.home') }}">
              <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-speedometer') }}"></use>
              </svg> Dashboard
            </a>
          </li>
          <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('profile.show', auth()->user()->id) }}">
            <svg class="c-sidebar-nav-icon">
              <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-user') }}"></use>
            </svg> Profile</a>
          </li>
          <li class="c-sidebar-nav-title">Post Management</li>
          <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link {{ (request()->is('admin/album')) ? 'c-active' : '' }}" href="{{ route('admin.album') }}">
              <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-filter-photo') }}"></use>
              </svg> Album</a></li>
          <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link {{ (request()->is('admin/post')) ? 'c-active' : '' }}" href="{{ route('admin.post') }}">
              <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-drop') }}"></use>
              </svg> Post</a>
            </li>
          <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link {{ (request()->is('admin/tag')) ? 'c-active' : '' }}" href="{{ route('admin.tag') }}">
              <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-pencil') }}"></use>
              </svg> Tag</a></li>
          <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link {{ (request()->is('admin/tag')) ? 'c-active' : '' }}" href="{{ route('admin.category') }}">
              <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-puzzle') }}"></use>
              </svg> Kategori</a></li>
          <li class="c-sidebar-nav-title">Member Management</li>
          <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a class="c-sidebar-nav-link " href="{{ route('admin.users') }}">
              <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-user') }}"></use>
              </svg> User</a>
          </li>
          <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle {{ (request()->is('admin/aspiration/internal') || request()->is('admin/aspiration/external')) ? 'c-active' : '' }}" href="#">
              <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-cursor') }}"></use>
              </svg>Aspirasi</a>
            <ul class="c-sidebar-nav-dropdown-items">
              <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link {{ (request()->is('admin/aspiration/internal')) ? 'c-active' : '' }}" href="{{ route('admin.aspiration.internal') }}"><span class="c-sidebar-nav-icon"></span> Aspirasi Internal</a></li>
              <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link {{ (request()->is('admin/aspiration/external')) ? 'c-active' : '' }}" href="{{ route('admin.aspiration.external') }}"><span class="c-sidebar-nav-icon"></span> Aspirasi Eksternal</a></li>
            </ul>
          </li>
          <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle {{ (request()->is('admin/meeting/') || request()->is('admin/meeting_category/')) ? 'c-active' : '' }}" href="#">
            <svg class="c-sidebar-nav-icon">
              <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-chart-pie') }}"></use>
            </svg> Presensi</a>
            <ul class="c-sidebar-nav-dropdown-items">
              <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link {{ (request()->is('admin/meeting')) ? 'c-active' : '' }}" href="{{ route('admin.meeting') }}"><span class="c-sidebar-nav-icon"></span> Rapat</a></li>
              <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.meeting_category') }}"><span class="c-sidebar-nav-icon"></span> Kategori Rapat</a></li>
            </ul>
          </li>
        </ul>
      @else
        <ul class="c-sidebar-nav">
          <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ (request()->is('home')) ? 'c-active' : '' }}" href="{{ route('user.home') }}">
              <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-speedometer') }}"></use>
              </svg> Homepage
            </a>
          </li>
          <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('profile.show', auth()->user()->id) }}">
            <svg class="c-sidebar-nav-icon">
              <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-user') }}"></use>
            </svg> Profile</a>
          </li>
          <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('user.aspiration.create') }}">
            <svg class="c-sidebar-nav-icon">
              <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-pencil') }}"></use>
            </svg> Buat Aspirasi</a>
          </li>
        </ul>
      @endif

      <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
    </div>
    <div class="c-wrapper c-fixed-components">
      <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
        <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
          <svg class="c-icon c-icon-lg">
            <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-menu') }}"></use>
          </svg>
        </button>
        <a class="c-header-brand d-lg-none" href="#">
          <img src="{{ asset('admin/assets/img/logo/logohmif-crop-1.png') }}" class="img-fluid" alt="">
        </a>
        <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
          <svg class="c-icon c-icon-lg">
            <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-menu') }}"></use>
          </svg>
        </button>
        <ul class="c-header-nav ml-auto mr-4">
          <li class="c-header-nav-item dropdown"><a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
              <div class="c-avatar"><img class="c-avatar-img" src="{{ asset('admin/assets/img/avatars/6.jpg') }}" alt="user@email.com"></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right pt-0">
              <div class="dropdown-header bg-light py-2"><strong>Settings</strong></div><a class="dropdown-item" href="{{ route('profile.show', auth()->user()->id) }}">
                <svg class="c-icon mr-2">
                  <use xlink:href=" {{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-user') }}"></use>
                </svg> Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  <svg class="c-icon mr-2">
                    <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-account-logout') }}"></use>
                  </svg>
                  Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
            </div>
          </li>
        </ul>
      </header>
      <div class="c-body">
        @yield('content')

        <footer class="c-footer">
          <div><a href="https://coreui.io">HMIF</a> © 2021.</div>
          <div class="ml-auto">Powered by&nbsp;<a href="https://coreui.io/">CoreUI</a></div>
        </footer>
      </div>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('admin/vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--[if IE]><!-->
    <script src="{{ asset('admin/vendors/@coreui/icons/js/svgxuse.min.js') }}"></script>
    <!--<![endif]-->
    <!-- Plugins and scripts required by this view-->
    <script src="{{ asset('admin/vendors/@coreui/chartjs/js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('admin/vendors/@coreui/utils/js/coreui-utils.js') }}"></script>

    @stack('scripts')

    <script src="{{ asset('admin/js/main.js') }}"></script>
  </body>
</html>
