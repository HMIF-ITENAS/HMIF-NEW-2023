@extends('layouts.app')

@push('styles')
    <style>
        .item {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            box-sizing: border-box;
            color: #fff;
            box-shadow: -2px 2px 10px 0px rgb(68 68 68 / 40%);
            transition: transform 0.3s ease-in-out;
            cursor: pointer;
        }

        .item__details {
            position: relative;
            z-index: 1;
            padding: 15px;
            color: #444;
            background: #fff;
            letter-spacing: 1px;
            color: #828282;
        }

        .item:after {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            transition: opacity 0.3s ease-in-out;
        }
    </style>
@endpush

@section('content')
<section class="hero-banner hero-banner--sm mb-30px">
    <div class="container">
        <div class="hero-banner--sm__content">
            <h1>Album Kegiatan</h1>
            <nav aria-label="breadcrumb" class="banner-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Homepage</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Album Kegiatan</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<section class="section-margin">
    <div class="container">
        <div class="section-intro pb-5 text-center">
            <h2 class="section-intro__title">Album Kegiatan</h2>
            <p class="section-intro__subtitle">Berikut ini adalah album kegiatan dari HMIF Itenas</p>
        </div>
        <div class="row">
            @foreach ($albums as $album)
                <div class="col-md-4 pb-4">
                    <a href="{{ route('app.album.show', $album->slug) }}">
                        <div class="item">
                            <img src="{{ asset('assets/album/' . $album->slug . '/' . $album->photos[0]->photo ) }}" class="img-fluid" alt="">
                            <div class="item__details">
                                {{ $album->name }}
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@push('scripts')
    
@endpush