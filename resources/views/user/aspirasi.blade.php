@extends('layouts.backend')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <style>
        .select2-selection__choice__remove {
            border: none !important;
            background: #fff !important;
        }
    </style>
@endpush

@section('content')
    <style>
        .card {
            background-color: #141414;
            border: transparent;
            border-radius: .5vw;
        }

        .card-header {
            font-size: 18px;
            background-color: #1d1d1d;
            border-bottom: 1px solid #2d2d2d;
            border-top-left-radius: .5vw !important;
            border-top-right-radius: .5vw !important;
            align-items: center;
            min-height: 4vw;
            max-height: 4vw;
        }

        .card-footer {
            background-color: #141414;
            border: none;
            padding-left: 0px;
            padding-right: 0px;
            display: flex;
            justify-content: end;
        }

        .card-footer button {
            min-width: 10vw;
            max-width: 10vw;
        }

        .btn-primary {
            background-color: #3b89e8;
            font-size: 14px;
        }

        .btn-primary:hover {
            background-color: #41b8f8;
        }

        .container-fluid {
            min-height: 600px;
            color: rgba(255, 255, 255, .85);
        }

        .card-body {
            min-height: 15vw;
        }

        .form-group {
            margin-left: 30px;
        }

        .c-icon {
            color: #3b89e8;
        }

        .c-icon:hover {
            color: #41b8f8;
        }

        input[type="text"],
        textarea {
            background-color: #141414 !important;
            color: white !important;
            border: 1px solid #363636 !important;
            transition: border-color 0.2s ease-in-out !important;
        }

        input[type="text"]:focus,
        textarea:focus {
            border-color: #41b8f8 !important;
            background-color: transparent !important;
        }

        .select2-container--bootstrap4 .select2-selection--single {
            background-color: #141414 !important;
            border: 1px solid #363636 !important;
            color: rgba(255, 255, 255, .85) !important;
        }

        .select2-container--bootstrap4 .select2-selection--single:focus {
            border-color: #41b8f8 !important;
            background-color: transparent !important;
        }

        .select2-container--bootstrap4 .select2-results__option {
            background-color: #141414 !important;
            color: rgba(255, 255, 255, .85) !important;
        }

        .select2-container--bootstrap4 .select2-results__option:hover {
            background-color: #41b8f8 !important;
            color: #fff !important;
        }
    </style>
    <main class="c-main">
        @if (session('success'))
            <div class="success-session" data-flashdata="{{ session('success') }}"></div>
        @elseif (session('danger'))
            <div class="danger-session" data-flashdata="{{ session('danger') }}"></div>
        @endif
        <div class="container-fluid">
            <div class="fade-in">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('user.home') }}" class="btn btn-link">
                            <svg class="c-icon">
                                <use
                                    xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-arrow-circle-left') }}">
                                </use>
                            </svg>
                        </a>
                        Buat Aspirasi Internal
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('user.aspiration.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="title-input">Perihal</label>
                                <div class="col-md-9">
                                    <input class="form-control @error('title') is-invalid @enderror" id="title-input"
                                        type="text" name="title" placeholder="Masukkan perihal"
                                        value="{{ old('title') }}">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Konten</label>
                                <div class="col-md-9">
                                    <textarea name="content" id="content" cols="30" rows="10"
                                        class="form-control @error('content') is-invalid @enderror" placeholder="Masukkan isi konten"></textarea>
                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Privasi</label>
                                <div class="col-md-9">
                                    <select id="privacy" name="privacy"
                                        class="form-control form-control-lg @error('privacy') is-invalid
                      @enderror">
                                        <option value="public">Publik</option>
                                        <option value="private">Privat</option>
                                    </select>
                                    @error('privacy')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-lg btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </main>
@endsection

@push('scripts')
    <!-- select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.5/dist/sweetalert2.all.min.js"
        integrity="sha256-NHQE05RR3vZ0BO0PeDxbN2N6dknQ7Z4Ch4Vfijn9Y+0=" crossorigin="anonymous"></script>
    <script>
        $("#privacy").select2({
            theme: 'bootstrap4',
            placeholder: "-Pilih-",
            allowClear: true,
            minimumResultsForSearch: Infinity
        })
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
    </script>
@endpush
