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
            <h1>Himpunan Mahasiswa Teknik Informatika</h1>
            <p>Himpunan Mahasiswa Teknik Informatika (HMIF) Itenas berdiri pada tanggal 15 Maret 2005</p>
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
        <h2 class="section-intro__title">Fakta HMIF Itenas</h2>
        <p class="section-intro__subtitle">
            Berikut ini adalah fakta dari Himpunan Teknik Informatika (HMIF) Itenas
        </p>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="card card-feature text-center text-lg-left mb-4 mb-lg-0">
              <span class="card-feature__icon">
                <i class="ti-package"></i>
                <h1>{{ $user_count }} Orang</h1>
              </span>
              <h3 class="card-feature__title">Total Anggota Aktif</h3>
              <p class="card-feature__subtitle">
                  Saat ini HMIF Itenas mempunyai {{ $user_count }} anggota aktif yang berasal dari angkatan 2018, 2019 dan 2020.
              </p>
            </div>
          </div>
          <div class="col-lg-4">
              <div class="card card-feature text-center text-lg-left mb-4 mb-lg-0">
                  <span class="card-feature__icon">
                    <i class="ti-package"></i>
                    <h1 id="usia"></h1>
                  </span>
                  <h3 class="card-feature__title">Usia</h3>
                  <p class="card-feature__subtitle">
                      Sampai saat ini HMIF Itenas berdiri dari 2005 hingga sekarang.
                  </p>
                </div>
          </div>
          <div class="col-lg-4">
              <div class="card card-feature text-center text-lg-left mb-4 mb-lg-0">
                  <span class="card-feature__icon">
                    <i class="ti-package"></i>
                    <h1>Podcast</h1>
                  </span>
                  <h3 class="card-feature__title">HMIF Podcast Amplifier</h3>
                  <p class="card-feature__subtitle">
                      Saat ini HMIF Itenas mempunyai program podcast yang bernama HMIF Podcast Amplifier. Dapat dilihat melalui platform Spotify.
                  </p>
                </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================ Feature section end =================-->

  <section class="blog_area">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="blog_left_sidebar">
            @foreach ($posts as $post)
            <article class="row blog_item">
                <div class="col-md-6">
                  <img src="{{ $post->getBanner() }}" class="img-fluid" alt="">
                </div>
                <div class="col-md-6">
                  <div class="blog_post">
                    <div class="blog_info">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="post_category d-flex">
                            <div class="icon">
                              <i class="fas fa-th-list mr-3" style="font-size: 18px;"></i>
                            </div>
                            <div>
                              <a class="active" href="{{ $post->category->slug }}" target="_blank">{{ $post->category->name }}</a>
                            </div>
                          </div>
                          <div class="post_tag d-flex">
                            <div class="icon">
                              <i class="fas fa-tags mr-3"></i>
                            </div>
                            <div>
                                @foreach ($post->tags as $post_tags)
                                    <a class="active" href="{{ $post_tags->slug }}">#{{ $post_tags->name }}, </a>
                                @endforeach
                            </div>
  
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="post_meta">
                            <div>
                              <i class="fas fa-user mr-3" style="font-size: 18px;"></i>
                              <span>{{ $post->user->name }}</span>
                            </div>
                            <div>
                              <i class="fas fa-calendar-alt mr-3" style="font-size: 18px;"></i>
                              <span>{{ $post->created_at->diffForHumans() }}</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="blog_details">
                      <a href="{{ $post->slug }}">
                        <h2>{{ $post->title }}</h2>
                      </a>
                      <p> {!! \Illuminate\Support\Str::limit($post->content, 80) !!} </p>
                      <a class="button button-blog" href="{{ route('app.post.show', $post->slug) }}">Lanjutkan</a>
                    </div>
                  </div>
                </div>
              </article>
            @endforeach
            <a href="{{ route('app.post') }}" class="d-flex justify-content-center button button-blog lg">Lihat Semua</a>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="blog_right_sidebar">
            <aside class="single_sidebar_widget search_widget">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search Posts">
                <span class="input-group-btn">
                  <button class="btn btn-default" type="button">
                    <i class="lnr lnr-magnifier"></i>
                  </button>
                </span>
              </div>
              <!-- /input-group -->
              <div class="br"></div>
            </aside>
            <aside class="single_sidebar_widget ads_widget">
              <a href="#">
                <img class="img-fluid" src="{{ asset('app/img/blog/add.jpg') }}" alt="">
              </a>
              <div class="br"></div>
            </aside>
            <aside class="single_sidebar_widget post_category_widget">
              <h4 class="widget_title">Post Catgories</h4>
              <ul class="list cat-list">
                @foreach ($categories as $category)
                  <li>
                    <a href="{{ $category->slug }}" class="d-flex justify-content-between">
                      <p>{{ $category->name }}</p>
                      <p>{{ $category->posts->where('status', '=', 1)->count() }}</p>
                    </a>
                  </li>
                @endforeach
              </ul>
              <div class="br"></div>
            </aside>
            <aside class="single-sidebar-widget tag_cloud_widget">
              <h4 class="widget_title">Tag</h4>
              <ul class="list">
                  @foreach ($tags as $tag)
                    <li>
                        <a href="{{ $tag->slug }}">#{{ $tag->name }}</a>
                    </li>
                  @endforeach   
              </ul>
            </aside>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--================ Offer section start =================-->
  <section class="mt-5">
    <div class="container">
      <div class="section-intro text-center">
        <h2 class="section-intro__title">Platform Sosial Media</h2>
        <p class="section-intro__subtitle">Berikut ini adalah platform sosial media dari HMIF Itenas yang dapat kalian kunjungi atau hubungi.</p>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-4 offer-single">
                <a href="https://instagram.com/hmifitenas" target="_blank">
                    <div class="card offer-single__content text-center">
                      <span class="offer-single__icon">
                        <i class="fab fa-instagram" style="font-size: 35px;"></i>
                      </span>
                      <h4>Instagram</h4>
                      <p>Mempunyai instagram dengan username @hmifitenas </p>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 offer-single">
              <a href="https://www.youtube.com/channel/UCMsgcKdfrGVvXSxsb7c7Efw" target="_blank">
                  <div class="card offer-single__content text-center">
                  <span class="offer-single__icon">
                      <i class="fab fa-youtube" style="font-size: 35px;"></i>
                  </span>
                  <h4>Youtube</h4>
                  <p>Mempunyai channel Youtube bernama HMIF Itenas</p>
                  </div>
              </a>
            </div>
            <div class="col-lg-4 offer-single">
                <a href="https://open.spotify.com/show/5KGkZSqglyQCRjoXFLVbIM" target="_blank">
                    <div class="card offer-single__content text-center">
                      <span class="offer-single__icon">
                        <i class="fab fa-spotify" style="font-size: 35px;"></i>
                      </span>
                      <h4>Spotify</h4>
                      <p>Mempunyai akun spotify bernama HMIF Podcast Amplifier</p>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 offer-single">
                <a href="mailto:hmif@itenas.ac.id">
                    <div class="card offer-single__content text-center">
                      <span class="offer-single__icon">
                        <i class="fas fa-envelope" style="font-size: 35px;"></i>
                      </span>
                      <h4>Email</h4>
                      <p>Mempunyai email : hmif@itenas.ac.id</p>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 offer-single">
                <a href="https://liff.line.me/1645278921-kWRPP32q?accountId=dlm5805p#mst_challenge=LJQFzUspWOYYKjZwMMgU4hddV1PdFlGxRiA2qXdf2Sc" target="_blank">
                    <div class="card offer-single__content text-center">
                      <span class="offer-single__icon">
                        <i class="fab fa-line" style="font-size: 35px;"></i>
                      </span>
                      <h4>Line</h4>
                      <p>Mempunyai ID Line : @dlm5805p</p>
                    </div>
                </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================ Offer section end =================-->
@endsection

@push('scripts')
    <script>
        document.getElementById("usia").innerHTML = new Date().getFullYear() - 2005 + ' Tahun'
    </script>
@endpush