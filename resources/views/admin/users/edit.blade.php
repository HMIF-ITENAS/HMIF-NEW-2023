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
                        Edit User
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin.users.update', $user->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="title-input">Nama</label>
                                <div class="col-md-9">
                                    <input class="form-control @error('name') is-invalid @enderror" id="name-input"
                                        type="text" name="name" placeholder="Masukkan nama lengkap"
                                        value="{{ old('name') ?? $user->name }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="from-input">NRP</label>
                                <div class="col-md-9">
                                    <input class="form-control @error('nrp') is-invalid @enderror" id="from-input"
                                        type="text" name="nrp" placeholder="Masukkan NRP"
                                        value="{{ old('nrp') ?? $user->nrp }}">
                                    @error('nrp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="title-input">Angkatan</label>
                                <div class="col-md-9">
                                    <input class="form-control @error('angkatan') is-invalid @enderror" id="title-input"
                                        type="text" name="angkatan" placeholder="Masukkan Angkatan"
                                        value="{{ old('angkatan') ?? $user->angkatan }}">
                                    @error('angkatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Email</label>
                                <div class="col-md-9">
                                    <input class="form-control @error('email') is-invalid @enderror" id="title-input"
                                        type="email" name="email" placeholder="Masukkan Email"
                                        value="{{ old('email') ?? $user->email }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Status</label>
                                <div class="col-md-9">
                                    <select id="status" name="status"
                                        class="form-control form-control-lg @error('status') is-invalid @enderror">
                                        <option></option>
                                        <option value="active" @if ($user->status === 'active') selected @endif>Aktif
                                        </option>
                                        <option value="non-active" @if ($user->status === 'non-active') selected @endif>
                                            Non-Aktif</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Level</label>
                                <div class="col-md-9">
                                    <select id="level" name="level"
                                        class="form-control form-control-lg @error('level') is-invalid @enderror">
                                        <option></option>
                                        <option value="admin" @if ($user->level === 'admin') selected @endif>Admin
                                        </option>
                                        <option value="user" @if ($user->level === 'user') selected @endif>User
                                        </option>
                                    </select>
                                    @error('level')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Jabatan</label>
                                <div class="col-md-9">
                                    <select id="jabatan" name="jabatan"
                                        class="form-control form-control-lg @error('jabatan') is-invalid @enderror">
                                        <option></option>
                                        <option value="0" @if ($user->jabatan === 0) selected @endif>Anggota
                                            Tidak
                                            Aktif</option>
                                        <option value="1" @if ($user->jabatan === 1) selected @endif>Anggota
                                            Aktif
                                        </option>
                                        <option value="2" @if ($user->jabatan === 2) selected @endif>Badan
                                            Pengurus
                                        </option>
                                        <option value="3" @if ($user->jabatan === 3) selected @endif>Badan
                                            Perwakilan Anggota</option>
                                    </select>
                                    @error('jabatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-lg btn-primary" type="submit"> Submit</button>
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
            allowClear: true,
            minimumResultsForSearch: Infinity
        })
        $("#level,#jabatan").select2({
            theme: 'bootstrap4',
            placeholder: "-Pilih-",
            allowClear: true,
            minimumResultsForSearch: Infinity
        })
    </script>
@endpush
