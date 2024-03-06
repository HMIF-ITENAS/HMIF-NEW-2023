@extends('layouts.app')

@push('styles')
    <style>

    </style>
@endpush

@section('content')
    <!--================ Hero sm Banner start =================-->
    <section class="hero-banner hero-banner--sm mb-30px">
        <div class="container">
            <div class="hero-banner--sm__content">
                <h1>Struktur Organisasi</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Struktur Organisasi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="section-padding--small bg-magnolia">
        <div class="container-fluid">
            <div class="section-intro pb-5 text-center">
                <h2 class="section-intro__title">Struktur Organisasi BE (Badan Eksekutif) HMIF</h2>
                <p class="section-intro__subtitle">Berikut ini adalah struktur organisasi dari Badan Eksekutif Himpunan
                    Mahasiswa Teknik Informatika (BE HMIF).</p>
            </div>
            <div class="align-items-center mb-5">
                <div class="text-center text-lg-left mb-4 mb-lg-0">
                    <img class="img-fluid" src="{{ asset('app/img/struktur-be-sarasvata.png') }}" alt="">
                </div>
            </div>
            <div class="section-intro pb-5 text-center">
                <h2 class="section-intro__title">Struktur Organisasi BPA (Badan Perwakilan Anggota) HMIF</h2>
                <p class="section-intro__subtitle">Berikut ini adalah struktur organisasi dari Badan Perwakilan Anggota
                    Himpunan Mahasiswa Teknik Informatika (BPA HMIF).</p>
            </div>
            <div class="align-items-center mb-5">
                <div class="d-flex justify-content-center text-center text-lg-left mb-4 mb-lg-0">
                    <img class="img-fluid w-50" src="{{ asset('app/img/struktur-bpa-2223.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
