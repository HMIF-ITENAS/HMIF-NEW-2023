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
                <h1>Sejarah</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sejarah</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!--================ Hero sm Banner end =================-->

    <section class="section-padding--small bg-magnolia">
        <div class="container">
            <div class="section-intro pb-5 text-center">
                <h2 class="section-intro__title">Sejarah HMIF Itenas</h2>
                <p class="section-intro__subtitle">Himpunan Mahasiswa Teknik Informatika (HMIF) Beridiri pada tanggal 15
                    Maret 2005 oleh Rendi
                    Mawardi dkk sekaligus sebagai Ketua Himpunan pertama. VIsi awal didirikannya HMIF adalah
                    dibutuhkannya membuat suatu wadah mahasiswa informatika, rekan rekan IF pada saat itu
                    ber-koordinasi dengan jurusan. Pada saat itu, langsung didukung penuh oleh Pak Winarno
                    Sugeng yang menjabat Ketua Jurusan. </p>
            </div>
            <div class="row align-items-center mb-5"">
                <div class=" col-lg-6">
                <div class="solution__img text-center text-lg-left mb-4 mb-lg-0">
                    <img class="img-fluid" src="{{ asset('app/img/logo/logohmif.png') }}" alt="">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="solution__content text-justify">
                    <p>
                        Pemilihan Ketua Himpunan (Kahim) dan sekertaris kahim berlangsung, dengan dilakukan dengan
                        pemungutan suara terbanyak, disaksikan oleh beberapa orang dari jurusan IF ( termasuk Pak
                        Winarno ) dan juga ketua angkatan 2004 ( Asep Septriyana ).
                        Segala kondisi tekait pemenuhan kebutuhan guna tebentuknya suatu himpunan yang “utuh” yang
                        dilakukan pada saat itu, terutama pembuatan AD/ART Himpunan dan Struktur Organisasi.
                        Terbentuknya AD/ART, banyak melakukan komunikasi dan referensi dari rekan rekan Himpunan
                        Teknik Elektro. Selain itu, tidak lupa kita juga sering ber-koordinasi dan mencari bahan
                        referensi lainnya diluar kampus, semisal : ITB (Informatika, Planologi), Unpad (Hukum).
                        AD/ART Himpunan IF terbentuk dengan tetap berdasarkan kepara kebutuhan mahasiswa IF itu
                        sendiri.
                    </p>
                </div>
            </div>
        </div>
        <div class="row align-items-center mb-5">
            <div class=" col-lg-6">
                <div class="solution__img  text-justify">

                    <p>
                        Selanjutnya Himpunan IF dikenal dengan HIMPUNAN MAHASISWA TEKNIK INFORMATIKA ITENAS, yang
                        disingkat dengan HMIF ITENAS. Berkenaan dengan inisiasi berdirinya HMIF, dilakukan berbagai
                        konsolidasi ke berbagai pihak didalam Kampus Itenas, diantaranya : Pihak Dekan Rektor dan
                        juga Keluarga Mahasiswa Itenas (KM). dalam waktu singkat HMIF telah diakui oleh Itenas dan
                        Juga mendapatkan dan himpunan pertamanya untuk menajalankan Program Kerja pada saat itu :
                        Pembuatan Seminar, Kunjungan Industri dan Program dukungan Jurusan untuk Penerimaan
                        Mahasiswa Baru.
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="solution__content text-center text-lg-left mb-4 mb-lg-0">
                    <img class="img-fluid" src="{{ asset('app/img/home/solution.png') }}" alt="">
                </div>
            </div>
        </div>
        </div>
    </section>

    <section class="section-padding--small">
        <div class="container">
            <div class="section-intro pb-5 text-center">
                <h2 class="section-intro__title">Visi Misi HMIF Itenas</h2>
                <p class="section-intro__subtitle">
                    Berikut ini adalah Visi dan Misi Himpunan Mahasiswa Teknik Informatika Periode 2020-2021
                </p>
            </div>

            <div class="row">
                <h1>Visi</h1>
                <p>
                    Menjadikan HMIF sebagai wadah untuk mengembangkan potensi setiap anggota, dengan menciptakan rasa
                    tanggung jawab, kekeluargaan dan profesionalisme yang tinggi agar bermanfaat bagi institusi dan
                    masyarakat.
                </p>
            </div>
            <div class="row">
                <h1>Misi</h1>
                <ol>
                    <li>Menjaga komunikasi dan keharmonisan baik secara internal maupun eksternal </li>
                    <li>Meningkatkan kemampuan anggota HMIF Itenas baik akademik maupun non akademik </li>
                    <li>Memaksimalkan fungsi HMIF menjadi tempat bagi para anggotanya untuk menyalurkan kreativitas dan
                        ikut serta membangun HMIF dengan ide dan kinerja. </li>
                    <li>Memberikan Apresiasi kepada Anggota HMIF</li>
                </ol>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    
@endpush