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
    <meta name="description" content="HMIF ITENAS - Himpunan Mahasiswa Teknik Informatika (HMIF) Beridiri pada tanggal 15 Maret 2005 oleh Rendi Mawardi dkk sekaligus sebagai Ketua Himpunan pertama. VIsi awal didirikannya HMIF adalah dibutuhkannya membuat suatu wadah mahasiswa informatika, rekan rekan IF pada saat itu ber-koordinasi dengan jurusan.">
    <meta name="author" content="HMIF Devs">
    <meta name="keyword" content="HMIF ITENAS, HMIF Itenas, Himpunan Mahasiswa Teknik Informatika, HIMPUNAN MAHASISWA TEKNIK INFORMATIKA, Himpunan Mahasiswa Teknik Informatika ITENAS">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'HMIF ITENAS') }} - {{ $title }}</title>
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
    <link href="{{ asset('admin/vendors/@coreui/chartjs/css/coreui-chartjs.css') }}" rel="stylesheet">
    @stack('styles')
  </head>
  <body class="c-app">
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
      <div class="c-sidebar-brand d-lg-down-none">
        <svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
          <use xlink:href="{{ asset('admin/assets/brand/coreui.svg#full') }}"></use>
        </svg>
        <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
          <use xlink:href="{{ asset('admin/assets/brand/coreui.svg#signet') }}"></use>
        </svg>
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
          <li class="c-sidebar-nav-title">Post Management</li>
          <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="colors.html">
              <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-filter-photo') }}"></use>
              </svg> Galeri</a></li>
          <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link {{ (request()->is('admin/post')) ? 'c-active' : '' }}" href="{{ route('admin.post') }}">
              <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-drop') }}"></use>
              </svg> Post</a>
            </li>
          <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link {{ (request()->is('admin/tag')) ? 'c-active' : '' }}" href="{{ route('admin.tag') }}">
              <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-pencil') }}"></use>
              </svg> Tag</a></li>
          <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="typography.html">
              <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-puzzle') }}"></use>
              </svg> Kategori</a></li>
          <li class="c-sidebar-nav-title">Member Management</li>
          <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
              <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-user') }}"></use>
              </svg> User</a>
            <ul class="c-sidebar-nav-dropdown-items">
              <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/breadcrumb.html"><span class="c-sidebar-nav-icon"></span> Breadcrumb</a></li>
              <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/cards.html"><span class="c-sidebar-nav-icon"></span> Cards</a></li>
              <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/carousel.html"><span class="c-sidebar-nav-icon"></span> Carousel</a></li>
              <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/collapse.html"><span class="c-sidebar-nav-icon"></span> Collapse</a></li>
              <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/forms.html"><span class="c-sidebar-nav-icon"></span> Forms</a></li>
              <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/jumbotron.html"><span class="c-sidebar-nav-icon"></span> Jumbotron</a></li>
              <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/list-group.html"><span class="c-sidebar-nav-icon"></span> List group</a></li>
              <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/navs.html"><span class="c-sidebar-nav-icon"></span> Navs</a></li>
              <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/pagination.html"><span class="c-sidebar-nav-icon"></span> Pagination</a></li>
              <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/popovers.html"><span class="c-sidebar-nav-icon"></span> Popovers</a></li>
              <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/progress.html"><span class="c-sidebar-nav-icon"></span> Progress</a></li>
              <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/scrollspy.html"><span class="c-sidebar-nav-icon"></span> Scrollspy</a></li>
              <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/switches.html"><span class="c-sidebar-nav-icon"></span> Switches</a></li>
              <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/tables.html"><span class="c-sidebar-nav-icon"></span> Tables</a></li>
              <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/tabs.html"><span class="c-sidebar-nav-icon"></span> Tabs</a></li>
              <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/tooltips.html"><span class="c-sidebar-nav-icon"></span> Tooltips</a></li>
            </ul>
          </li>
          <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
              <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-cursor') }}"></use>
              </svg> Aspirasi</a>
            <ul class="c-sidebar-nav-dropdown-items">
              <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="buttons/buttons.html"><span class="c-sidebar-nav-icon"></span> Buttons</a></li>
              <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="buttons/button-group.html"><span class="c-sidebar-nav-icon"></span> Buttons Group</a></li>
              <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="buttons/dropdowns.html"><span class="c-sidebar-nav-icon"></span> Dropdowns</a></li>
              <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="buttons/brand-buttons.html"><span class="c-sidebar-nav-icon"></span> Brand Buttons</a></li>
            </ul>
          </li>
          <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="charts.html">
              <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-chart-pie') }}"></use>
              </svg> Presensi</a></li>
          <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
              <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-star') }}"></use>
              </svg> Icons</a>
            <ul class="c-sidebar-nav-dropdown-items">
              <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ asset('admin/icons/coreui-icons-free.html')}}"> CoreUI Icons<span class="badge badge-success">Free</span></a></li>
              <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ asset('admin/icons/coreui-icons-brand.html')}}"> CoreUI Icons - Brand</a></li>
              <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ asset('admin/icons/coreui-icons-flag.html')}}"> CoreUI Icons - Flag</a></li>
            </ul>
          </li>
        </ul>
      @else
        <ul class="c-sidebar-nav">
          <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ (request()->is('home')) ? 'c-active' : '' }} c-active" href="{{ route('admin.home') }}">
              <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-speedometer') }}"></use>
              </svg> Homepage
            </a>
          </li>
          <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="typography.html">
            <svg class="c-sidebar-nav-icon">
              <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-pencil') }}"></use>
            </svg> Buat Aspirasi</a></li>
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
        </button><a class="c-header-brand d-lg-none" href="#">
          <svg width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('admin/assets/brand/coreui.svg#full') }}"></use>
          </svg></a>
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
              <div class="dropdown-header bg-light py-2"><strong>Account</strong></div><a class="dropdown-item" href="#">
                <svg class="c-icon mr-2">
                  <use xlink:href=" {{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-bell') }}"></use>
                </svg> Updates<span class="badge badge-info ml-auto">42</span></a><a class="dropdown-item" href="#">
                <svg class="c-icon mr-2">
                  <use xlink:href=" {{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-envelope-open') }}"></use>
                </svg> Messages<span class="badge badge-success ml-auto">42</span></a><a class="dropdown-item" href="#">
                <svg class="c-icon mr-2">
                  <use xlink:href=" {{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-task') }}"></use>
                </svg> Tasks<span class="badge badge-danger ml-auto">42</span></a><a class="dropdown-item" href="#">
                <svg class="c-icon mr-2">
                  <use xlink:href=" {{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-comment-square') }}"></use>
                </svg> Comments<span class="badge badge-warning ml-auto">42</span></a>
              <div class="dropdown-header bg-light py-2"><strong>Settings</strong></div><a class="dropdown-item" href="#">
                <svg class="c-icon mr-2">
                  <use xlink:href=" {{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-user') }}"></use>
                </svg> Profile</a><a class="dropdown-item" href="#">
                <svg class="c-icon mr-2">
                  <use xlink:href=" {{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-settings') }}"></use>
                </svg> Settings</a><a class="dropdown-item" href="#">
                <svg class="c-icon mr-2">
                  <use xlink:href=" {{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-credit-card') }}"></use>
                </svg> Payments<span class="badge badge-secondary ml-auto">42</span></a><a class="dropdown-item" href="#">
                <svg class="c-icon mr-2">
                  <use xlink:href=" {{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-file') }}"></use>
                </svg> Projects<span class="badge badge-primary ml-auto">42</span></a>
              <div class="dropdown-divider"></div><a class="dropdown-item" href="#">
                <svg class="c-icon mr-2">
                  <use xlink:href=" {{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-lock-locked') }}"></use>
                </svg> Lock Account</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  <svg class="c-icon mr-2">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
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