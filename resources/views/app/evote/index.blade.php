@extends('layouts.app')

@push('styles')
@endpush

@section('content')
    <!--================ Hero sm Banner start =================-->
    <section class="hero-banner mb-30px">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="hero-banner__img d-flex justify-content-center">
                        <img class=" img-fluid" src="{{ asset('app/img/logo/logohmif.png') }}" alt="HMIF Logo">
                    </div>
                </div>
                <div class="col-lg-5 pt-5">
                    <div class="hero-banner__content text-center">
                        <h1>HMIF E-Vote</h1>
                        <p>Berikut ini adalah platform untuk setiap anggota HMIF Itenas memberikan suaranya dalam pemilihan
                            Calon Ketua Himpunan dan Ketua Badan Perwakilan Anggota</p>
                        <a class="button bg" href="#">Pelajari</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Hero sm Banner end =================-->

    <!--================ Feature section start =================-->
    <section class="section-margin">
        <div class="container">
            <div class="section-intro pb-85px text-center">
                <h2 class="section-intro__title">Aturan Pemilihan</h2>
                <p class="section-intro__subtitle">
                    Berikut ini adalah aturan pemilihan yang harus diperhatikan oleh setiap anggota HMIF Itenas.
                </p>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card text-center card-pricing">
                        <div class="card-pricing__header">
                            <h4>Aturan</h4>
                        </div>
                        <ul class="card-pricing__list px-5">
                            <li><i class="ti-check"></i>Setiap pemilih hanya boleh memilih satu calon ketua himpunan
                                dan calon ketua BPA.</li>
                            <li><i class="ti-check"></i>Setiap pemilih hanya boleh memilih menggunakan akun masing -
                                masing dan suara tidak dapat diwakilkan.</li>
                            <li><i class="ti-check"></i>Apabila terdapat hasil suara yang sama antar calon, akan ada
                                pemilihan ulang. <b class="text-danger">*</b></li>
                            <li><i class="ti-check"></i>Apabila ada calon yang melakukan kecurangan terhadap
                                pemilihan maka akan di diskualifikasi.</li>
                            <li><i class="ti-check"></i>Pemilih tidak diperkenankan untuk golput (tidak memilih
                                siapapun).</li>
                            <li><i class="ti-check"></i>Pemilih diharuskan memilih sesuai dengan jadwal yang telah
                                ditentukan, apabila melewati jadwal maka suara dianggap tidak sah.
                            </li>
                        </ul>
                        <p class="text-danger font-weight-bold py-3">
                            * Jadwal pemilihan ulang akan diberitahukan selanjutnya </p>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Feature section end =================-->

    <section class="section-padding bg-magnolia">
        <div class="container">
            <div class="section-intro pb-5 text-center">
                <h2 class="section-intro__title">Kandidat Calon Ketua Himpunan</h2>
                <p class="section-intro__subtitle">Berikut ini adalah kandidat calon ketua himpunan. </p>
            </div>

            <div class="owl-carousel owl-theme testimonial">
                @forelse ($kandidatKahim as $kahim)
                    <div class="testimonial__item text-center">
                        <div class="testimonial__img">
                            <img src="{{ $kahim->getFoto() }}" class="img-fluid" alt="">
                        </div>
                        <div class="testimonial__content">
                            <h3>{{ $kahim->user->name }}</h3>
                            <p>{{ $kahim->user->nrp }}</p>
                            <p class="font-weight-bold">{{ 'Nomor Urut : ' . $kahim->nomor_urut }}</p>
                            <p class="font-weight-bold">Visi : </p>
                            <p class="testimonial__i">{{ $kahim->visi }}</p>
                        </div>
                    </div>
                @empty
                    <h3 class="text-center">Belum ada kandidat calon ketua himpunan</h3>
                @endforelse
            </div>

            <div class="section-intro py-5 text-center">
                <h2 class="section-intro__title">Kandidat Calon Ketua Badan Perwakilan Anggota</h2>
                <p class="section-intro__subtitle">Berikut ini adalah kandidat calon ketua badan perwakilan anggota. </p>
            </div>
            <div class="owl-carousel owl-theme testimonial">
                @forelse ($kandidatBpa as $bpa)
                    <div class="testimonial__item text-center">
                        <div class="testimonial__img">
                            <img src="{{ $bpa->getFoto() }}" class="img-fluid" alt="">
                        </div>
                        <div class="testimonial__content">
                            <h3>{{ $bpa->user->name }}</h3>
                            <p>{{ $bpa->user->nrp }}</p>
                            <p class="font-weight-bold">{{ 'Nomor Urut : ' . $bpa->nomor_urut }}</p>
                            <p class="font-weight-bold">Visi : </p>
                            <p class="testimonial__i">{{ $bpa->visi }}</p>
                        </div>
                    </div>
                @empty
                    <h3 class="text-center">Belum ada kandidat calon ketua badan perwakilan anggota</h3>
                @endforelse
            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
