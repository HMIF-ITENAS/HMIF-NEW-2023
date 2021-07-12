@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css"
integrity="sha512-Velp0ebMKjcd9RiCoaHhLXkR1sFoCCWXNp6w4zj1hfMifYB5441C+sKeBl/T/Ka6NjBiRfBBQRaQq65ekYz3UQ=="
crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
<section class="hero-banner hero-banner--sm mb-30px">
    <div class="container">
        <div class="hero-banner--sm__content">
            <h1>Detail Album Kegiatan</h1>
            <nav aria-label="breadcrumb" class="banner-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Homepage</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Album Kegiatan</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<section class="section-margin">
    <div class="container">
        <div class="section-intro pb-5 text-center">
            <h2 class="section-intro__title">{{ $album->name }}</h2>
            <p class="section-intro__subtitle">Berikut ini adalah detail album kegiatan untuk {{ $album->name }} </p>
        </div>
        <div class="row">
            @foreach ($album->photos as $photo)
                <a href="{{ asset('assets/album/' . $album->slug . '/' . $photo->photo) }}" data-toggle="lightbox" data-gallery="gallery"
                    class="col-md-3 pb-3">
                    <img src="{{ asset('assets/album/' . $album->slug . '/' . $photo->photo) }}" class="img-fluid rounded">
                </a>
            @endforeach
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"
integrity="sha512-Y2IiVZeaBwXG1wSV7f13plqlmFOx8MdjuHyYFVoYzhyRr3nH/NMDjTBSswijzADdNzMyWNetbLMfOpIPl6Cv9g=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
$(document).on("click", '[data-toggle="lightbox"]', function (event) {
    event.preventDefault();
    $(this).ekkoLightbox({
        alwaysShowClose: true,
        showArrows: true,
    });
});
</script>
@endpush