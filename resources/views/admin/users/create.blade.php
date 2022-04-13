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
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('admin.users') }}" class="btn btn-link">
                            <svg class="c-icon">
                                <use
                                    xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-arrow-circle-left') }}">
                                </use>
                            </svg>
                        </a>
                        <strong>Buat User Baru</strong>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin.users.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="title-input">Nama</label>
                                <div class="col-md-9">
                                    <input class="form-control @error('name') is-invalid @enderror" id="name-input"
                                        type="text" name="name" placeholder="Masukkan nama lengkap"
                                        value="{{ old('name') }}">
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
                                        type="text" name="nrp" placeholder="Masukkan NRP" value="{{ old('nrp') }}">
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
                                        value="{{ old('angkatan') }}">
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
                                        type="email" name="email" placeholder="Masukkan Email" value="{{ old('email') }}">
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
                                        <option value="active">Aktif</option>
                                        <option value="non-active">Non-Aktif</option>
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
                                    <select id="jabatan" name="jabatan"
                                        class="form-control form-control-lg @error('jabatan') is-invalid @enderror">
                                        <option></option>
                                        <option value="0">Anggota Tidak Aktif</option>
                                        <option value="1">Anggota Aktif</option>
                                        <option value="2">Badan Pengurus</option>
                                        <option value="3">Badan Perwakilan Anggota</option>
                                    </select>
                                    @error('jabatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Jabatan</label>
                                <div class="col-md-9">
                                    <select id="level" name="level"
                                        class="form-control form-control-lg @error('level') is-invalid @enderror">
                                        <option></option>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                    @error('level')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Password</label>
                                <div class="col-md-9">
                                    <input class="form-control @error('password') is-invalid @enderror" id="title-input"
                                        type="password" name="password" placeholder="Masukkan Password"
                                        value="{{ old('password') }}">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Password Confirmation</label>
                                <div class="col-md-9">
                                    <input class="form-control @error('password_confirmation') is-invalid @enderror"
                                        id="title-input" type="password" name="password_confirmation"
                                        placeholder="Konfirmasi Password" value="{{ old('password_confirmation') }}">
                                    @error('password_confirmation')
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
            allowClear: true
        })
        $("#level,#jabatan").select2({
            theme: 'bootstrap4',
            placeholder: "-Pilih-",
            allowClear: true
        })
    </script>
@endpush
