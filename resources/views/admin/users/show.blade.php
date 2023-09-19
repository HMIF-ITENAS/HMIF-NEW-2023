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

        .card-header.password {
            font-size: 18px;
            background-color: #1d1d1d;
            border-bottom: 1px solid #2d2d2d;
            border-top-left-radius: 0vw !important;
            border-top-right-radius: 0vw !important;
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
        input[type="email"],
        input[type="password"],
        textarea {
            background-color: #141414 !important;
            color: white !important;
            border: 1px solid #363636 !important;
            transition: border-color 0.2s ease-in-out !important;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        textarea:focus {
            border-color: #41b8f8 !important;
            background-color: transparent !important;
        }

        .center-vertically {
            display: flex;
            align-items: center;
        }
    </style>
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="card">
                    <div class="card-header d-flex">
                        <a href="{{ route('admin.users') }}" class="btn btn-link">
                            <svg class="c-icon">
                                <use
                                    xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-arrow-circle-left') }}">
                                </use>
                            </svg>
                        </a>
                        Detail User
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal">
                            @csrf
                            <div class="form-group row center-vertically">
                                <label class="col-md-3 col-form-label" for="title-input">Nama</label>
                                <div class="col-md-9">
                                    <p>{{ $user->name }}</p>
                                </div>
                            </div>
                            <div class="form-group row center-vertically">
                                <label class="col-md-3 col-form-label" for="title-input">NRP</label>
                                <div class="col-md-9">
                                    <p>{!! $user->nrp !!}</p>
                                </div>
                            </div>
                            <div class="form-group row center-vertically">
                                <label class="col-md-3 col-form-label" for="title-input">Angkatan</label>
                                <div class="col-md-9">
                                    <p>{{ $user->angkatan }}</p>
                                </div>
                            </div>
                            <div class="form-group row center-vertically">
                                <label class="col-md-3 col-form-label" for="title-input">Email</label>
                                <div class="col-md-9">
                                    <p>{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="form-group row center-vertically">
                                <label class="col-md-3 col-form-label" for="title-input">Email Verified</label>
                                <div class="col-md-9">
                                    @if ($user->email_verified_at != null)
                                        <span class="badge rounded-pill px-3 py-2 bg-info text-white">
                                            Verified
                                        </span>
                                    @else
                                        <span class="badge rounded-pill px-3 py-2 bg-success text-white">
                                            Not Verified
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row center-vertically">
                                <label class="col-md-3 col-form-label" for="title-input">Status</label>
                                <div class="col-md-9">
                                    @if ($user->status === 'active')
                                        <span class="badge rounded-pill px-3 py-2 bg-info text-white">
                                            Active
                                        </span>
                                    @else
                                        <span class="badge rounded-pill px-3 py-2 bg-success text-white">
                                            Non-Active
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row center-vertically">
                                <label class="col-md-3 col-form-label" for="title-input">Level</label>
                                <div class="col-md-9">
                                    @if ($user->level === 'admin')
                                        <span class="badge rounded-pill px-3 py-2 bg-info text-white">
                                            Admin
                                        </span>
                                    @else
                                        <span class="badge rounded-pill px-3 py-2 bg-success text-white">
                                            User
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row center-vertically">
                                <label class="col-md-3 col-form-label" for="title-input">Dibuat</label>
                                <div class="col-md-9">
                                    <p>{{ $user->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="card-footer">
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
    <script>
        $("#status").select2({
            theme: 'bootstrap4',
            placeholder: "-Pilih-",
            allowClear: true
        })
    </script>
@endpush
