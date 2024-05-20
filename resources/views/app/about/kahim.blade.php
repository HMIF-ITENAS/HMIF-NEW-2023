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
                <h1>Ketua Himpunan</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Sejarah</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ketua Himpunan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="section-padding--small bg-magnolia">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="our-team">
                        <div class="picture">
                            <img class="img-fluid" src="{{ asset('app/img/kahim/rendymawardi.jpg') }}">
                        </div>
                        <div class="team-content px-3">
                            <h2 class="name">Rendy Mawardi</h2>
                            <h4 class="font-weight-bold text-white">2005/2006</h4>
                            <p class="title">Masuk tahun 2005, Mahasiswa Baru angkatan 2005 telah masuk, awal
                                terdapat sekitar 200 mahasiswa, yang tercatat aktif di himpunan ada 50 orang (walaupun datan
                                dan pergi). Rendi Mawardi masih dipercaya memegang sebagai Ketua Himpunan periode 2005 –
                                2006 dan ditahun ini Himpunan Mahasiswa Teknik Informatika di-hadiahi ruangan himpunan oleh
                                Jurusan terletak di gedung 18 yang masih bergabung dengan geodesi.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="our-team">
                        <div class="picture">
                            <img class="img-fluid" src="{{ asset('app/img/kahim/rizkywihardi.jpg') }}">
                        </div>
                        <div class="team-content px-3">
                            <h2 class="name">Rizky Wihardi</h2>
                            <h4 class="font-weight-bold text-white">2006/2007</h4>
                            <p class="title">Awal dibentuknya HMIF pada saat itu hanya beranggotakan 24 orang.
                                Pada tahun 2006 ketua HMIF digantikan oleh Rizky Wihardi angkatan 2005 dengan wakilnya
                                adalah khairul lukman dengan masa jabatan 1 periode yaitu tahun 2006 sampai 2007.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="our-team">
                        <div class="picture">
                            <img class="img-fluid" src="{{ asset('app/img/kahim/zicodesriera.jpg') }}">
                        </div>
                        <div class="team-content px-3">
                            <h2 class="name">Zico Desriera</h2>
                            <h4 class="font-weight-bold text-white">2007-2009</h4>
                            <p class="title">Pada tahun 2007, pertama kali di adakannya mubes atau musyawarah
                                besar untuk anggota HMIF. Di dalam mubes tersebut menghasilkan kesimpulan yaitu HMIF
                                memiliki lambang dan warna sebagai icon HMIF. Awal Warna pada HMIF adalah berwarna biru
                                muda, namun berganti menjadi warna merah dan lambangnya adalah seperti pada background di
                                atas. Pada tahun 2007, Zico Desriera angkatan 2006 menjadi ketua HMIF menggantikan ketua
                                sebelumnya, wakil ketuanya adalah Arwin Djoko Nugroho dan Adji Zulfikar dengan masa jabatan
                                satu periode satu tahun setengah yaitu tahun 2007 sampai 2009.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="our-team">
                        <div class="picture">
                            <img class="img-fluid" src="{{ asset('app/img/kahim/hendradinata.jpg') }}">
                        </div>
                        <div class="team-content px-3">
                            <h2 class="name">
                                Hendra Dinata</h2>
                            <h4 class="font-weight-bold text-white">2010/2011</h4>
                            <p class="title">
                                Pada tahun 2010 ketuanya digantikan oleh Hendra Dinata angkatan 2008 dengan masa jabatan
                                satu periode yaitu tahun 2010 sampai 2011 dengan wakil ketuanya adalah Radit angkatan 2008.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="our-team">
                        <div class="picture">
                            <img class="img-fluid" src="{{ asset('app/img/kahim/enggar.jpg') }}">
                        </div>
                        <div class="team-content px-3">
                            <h2 class="name">
                                Enggar Winulyo Hadi</h2>
                            <h4 class="font-weight-bold text-white">2011/2012</h4>
                            <p class="title">
                                Enggar Winulyo Hadi angkatan 2009 menjadi ketua HMIF pada tahun 2011 sampai 2012 dengan masa
                                jabatan satu periode dengan wakil ketuanya adalah Idham Ramdhani angkatan 2009.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="our-team">
                        <div class="picture">
                            <img class="img-fluid" src="{{ asset('app/img/kahim/agung.jpg') }}">
                        </div>
                        <div class="team-content px-3">
                            <h2 class="name">
                                Agung Prasetya K
                            </h2>
                            <h4 class="font-weight-bold text-white">2012/2013</h4>
                            <p class="title">
                                Pada tahun 2012 yang menjadi ketua selanjutnya adalah Agung Prasetya K angkatan 2010
                                menjabat selama satu periode yaitu tahun 2012 sampai 2013 dengan wakil ketuanya adalah
                                Kunyahya dan Putu joli A angkatan 2010.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="our-team">
                        <div class="picture">
                            <img class="img-fluid" src="{{ asset('app/img/kahim/annaziat.jpg') }}">
                        </div>
                        <div class="team-content px-3">
                            <h2 class="name">
                                Annaziat Jusuf
                            </h2>
                            <h4 class="font-weight-bold text-white">2013/2014</h4>
                            <p class="title">
                                Di Tahun 2013 yang menjadi ketua adalah Annaziat Jusuf angkatan 2011 menjabat satu periode
                                yaitu tahun 2013 sampai 2014 dengan wakilnya adalah Dian Afritama dan Nurlaily Sri Utami.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="our-team">
                        <div class="picture">
                            <img class="img-fluid" src="{{ asset('app/img/kahim/akbarb.jpg') }}">
                        </div>
                        <div class="team-content px-3">
                            <h2 class="name">
                                M Akbar Bernovaldy
                            </h2>
                            <h4 class="font-weight-bold text-white">2014/2015</h4>
                            <p class="title">
                                Pada tahun 2014 yang menjadi ketua adalah M Akbar Bernovaldy angkatan 2012 menjabat satu
                                periode yaitu tahun 2014 sampai 2015 dengan wakil ketuanya adalah M Fazrian Samhudi.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="our-team">
                        <div class="picture">
                            <img class="img-fluid" src="{{ asset('app/img/kahim/ifsan.jpg') }}">
                        </div>
                        <div class="team-content px-3">
                            <h2 class="name">
                                Ifsan Effendy
                            </h2>
                            <h4 class="font-weight-bold text-white">2015/2016</h4>
                            <p class="title">
                                Tahun 2016 yang menjadi ketua adalah Ifsan effendy angkatan 2013 menjabat satu periode yaitu
                                tahun 2015 sampai 2016 dengan wakil ketuanya adalah Rifky Kartiko dan Rahman Siddieq
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="our-team">
                        <div class="picture">
                            <img class="img-fluid" src="{{ asset('app/img/kahim/nashir.jpg') }}">
                        </div>
                        <div class="team-content px-3">
                            <h2 class="name">
                                Muhammad Nashir
                            </h2>
                            <h4 class="font-weight-bold text-white">2016/2017</h4>
                            <p class="title">
                                Tahun 2017 yang menjadi ketua adalah angkatan 2014 menjabat satu periode yaitu tahun 2016
                                sampai 2017 dengan wakil ketuanya adalah Lutfi Darmawan
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="our-team">
                        <div class="picture">
                            <img class="img-fluid" src="{{ asset('app/img/kahim/fuadhasan.png') }}">
                        </div>
                        <div class="team-content px-3">
                            <h2 class="name">
                                Fuad Hasan
                            </h2>
                            <h4 class="font-weight-bold text-white">2017/2018</h4>
                            <p class="title">
                                Tahun 2018 yang menjadi ketua adalah angkatan 2015 menjabat satu periode yaitu tahun 2017
                                sampai 2018 dengan wakil ketuanya adalah Raden Memo dan Reza Mahandika
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="our-team">
                        <div class="picture">
                            <img class="img-fluid" src="{{ asset('app/img/kahim/ocan.jpg') }}">
                        </div>
                        <div class="team-content px-3">
                            <h2 class="name">
                                Muhammad Fauzan Raspati
                            </h2>
                            <h4 class="font-weight-bold text-white">2018/2019</h4>
                            <p class="title">
                                Tahun 2019 yang menjadi ketua adalah angkatan 2016 menjabat satu periode yaitu tahun 2018
                                sampai 2019 dengan wakil ketuanya adalah Ismail dan Dwi Adi Lenggana Putra
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="our-team">
                        <div class="picture">
                            <img class="img-fluid" src="{{ asset('app/img/kahim/revi.jpeg') }}">
                        </div>
                        <div class="team-content px-3">
                            <h2 class="name">
                                Revi M. Fikri
                            </h2>
                            <h4 class="font-weight-bold text-white">2019/2020</h4>
                            <p class="title">
                                Tahun 2020 yang menjadi ketua adalah angkatan 2017 menjabat satu periode yaitu tahun 2019
                                sampai 2020 dengan wakil ketuanya adalah Cikal Bingah Palenda
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="our-team">
                        <div class="picture">
                            <img class="img-fluid" src="{{ asset('app/img/kahim/aldin.jpg') }}">
                        </div>
                        <div class="team-content px-3">
                            <h2 class="name">
                                Muhammad Aldin Permana
                            </h2>
                            <h4 class="font-weight-bold text-white">2020/2021</h4>
                            <p class="title">
                                Tahun 2021 yang menjadi ketua adalah angkatan 2018 menjabat satu periode yaitu tahun 2020
                                sampai 2021 dengan wakil ketuanya adalah Gilang Rama Mahardhika dan Syafiq Salim Kleb
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="our-team">
                        <div class="picture">
                            <img class="img-fluid" src="{{ asset('app/img/kahim/revi.jpegg') }}">
                        </div>
                        <div class="team-content px-3">
                            <h2 class="name">
                                XX
                            </h2>
                            <h4 class="font-weight-bold text-white">2021/2022</h4>
                            <p class="title">
                                Tahun 2022 yang menjadi ketua adalah angkatan 2019 menjabat satu periode yaitu tahun 2021
                                sampai 2022 dengan wakil ketuanya adalah Rio Dwianto
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="our-team">
                        <div class="picture">
                            <img class="img-fluid" src="{{ asset('app/img/kahim/rafi.jpg') }}">
                        </div>
                        <div class="team-content px-3">
                            <h2 class="name">
                                Abdur Rafi Syach Ridwan
                            </h2>
                            <h4 class="font-weight-bold text-white">2022/2023</h4>
                            <p class="title">
                                Tahun 2023 yang menjadi ketua adalah angkatan 2020 menjabat satu periode yaitu tahun 2022
                                sampai 2023 dengan wakil ketuanya adalah Abdullah Marwan Hadid
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
