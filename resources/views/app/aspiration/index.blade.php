@extends('layouts.app')

@push('styles')
    <style>
        
    </style>
@endpush

@section('content')
<section class="hero-banner hero-banner--sm mb-30px">
    <div class="container">
        <div class="hero-banner--sm__content">
            <h1>Aspirasi</h1>
            <nav aria-label="breadcrumb" class="banner-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Homepage</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Aspirasi</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<section class="section-margin">
    <div class="container">
        @if (session('success'))
            <div class="success-session" data-flashdata="{{ session('success') }}"></div>
        @elseif (session('danger'))    
            <div class="danger-session" data-flashdata="{{ session('danger') }}"></div>
        @endif
        <div class="section-intro pb-5 text-center">
            <h2 class="section-intro__title">Buat Aspirasi</h2>
            <p class="section-intro__subtitle">Mempunyai aspirasi? ungkapkan aspirasi kalian untuk HMIF Itenas agar lebih baik kedepannya</p>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
              <div class="media contact-info">
                <span class="contact-info__icon"><i class="ti-home"></i></span>
                <div class="media-body">
                  <h3>Alamat</h3>
                  <p>Jl. Phh. Mustofa No. 23, Bandung, Jawa Barat 40123. Sekretariat: Gedung 2 lantai 2</p>
                </div>
              </div>
              <div class="media contact-info">
                <span class="contact-info__icon"><i class="ti-headphone"></i></span>
                <div class="media-body">
                  <h3>Publikasi</h3>
                  <p>Instagram : <a href="https://instagram.com/hmifitenas" target="_blank">@hmifitenas</a></p>
                </div>
              </div>
              <div class="media contact-info">
                <span class="contact-info__icon"><i class="ti-email"></i></span>
                <div class="media-body">
                  <h3>Kontak</h3>
                  <p><a href="mailto:hmif@itenas.ac.id">hmif@itenas.ac.id</a></p>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <form action="{{ route('app.aspiration.store') }}" class="form-contact contact_form" action="contact_process.php" method="post"
                id="contactForm" novalidate="novalidate">
                @csrf
                <div class="row">
                  <div class="col-lg-5">
                    <div class="form-group">
                      <input class="form-control @error('name') is-invalid
                      @enderror" name="name" id="name" type="text" placeholder="Masukkan nama Anda" {{ old('name') }} required>
                      @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <input class="form-control @error('from') is-invalid
                      @enderror" name="from" id="from" type="text" placeholder="Masukkan instansi" {{ old('from') }} required>
                      @error('from')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <input class="form-control @error('title') is-invalid
                      @enderror" name="title" id="title" type="text" placeholder="Masukkan perihal" value="{{ old('title') }}" required>
                      @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <select id="status" name="status" class="form-control @error('status') is-invalid
                        @enderror" required>
                              <option value="">Pilih</option>
                              <option value="dosen">Dosen</option>
                              <option value="alumni">Alumni</option>
                              <option value="public">Publik</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                  </div>
                  <div class="col-lg-7">
                    <div class="form-group">
                      <textarea class="form-control different-control w-100 @error('content') is-invalid
                      @enderror" name="content" id="content" cols="30" rows="7"
                        placeholder="Masukkan aspirasi di sini">{{ old('content') }}</textarea>
                        @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                  </div>
                </div>
                <div class="form-group text-center text-md-right mt-3">
                  <button type="submit" class="button button-contactForm">Send Message</button>
                </div>
              </form>
            </div>
          </div>
    </div>
</section>
<section class="bg-magnolia py-5">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="testimonial__content">
                <h3>Anda anggota HMIF Itenas? </h3>
                <p class="testimonial__i">
                    Login atau masuk melalui link berikut ini untuk membuat aspirasi Anda!
                </p>
                <a href="{{ route('login') }}" class="button button-contactForm my-3">Masuk</a>
              </div>
          </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.5/dist/sweetalert2.all.min.js" integrity="sha256-NHQE05RR3vZ0BO0PeDxbN2N6dknQ7Z4Ch4Vfijn9Y+0=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        let flashdatasukses = $('.success-session').data('flashdata');
        let flashdatagagal = $('.danger-session').data('flashdata');
        if (flashdatasukses) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: flashdatasukses,
                type: 'success'
            })
        }
        if (flashdatagagal) {
            Swal.fire({
                icon: 'error',
                title: 'Danger!',
                text: flashdatagagal,
                type: 'error'
            })
        }
    })
</script>
@endpush