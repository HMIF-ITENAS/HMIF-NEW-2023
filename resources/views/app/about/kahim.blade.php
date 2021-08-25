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
          <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="our-team">
              <div class="picture">
                <img class="img-fluid" src="https://picsum.photos/130/130?image=1027">
              </div>
              <div class="team-content">
                <h3 class="name">Michele Miller</h3>
                <h4 class="title">Web Developer</h4>
              </div>
            </div>
          </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    
@endpush
