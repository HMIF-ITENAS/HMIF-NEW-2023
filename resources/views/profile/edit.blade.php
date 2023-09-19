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
                    <div class="card-header d-flex">
                        <a href="{{ route('profile.show', $user) }}" class="btn btn-link">
                            <svg class="c-icon">
                                <use
                                    xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-arrow-circle-left') }}">
                                </use>
                            </svg>
                        </a>
                        Edit Profile
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('profile.update', $user->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="name-input">Nama</label>
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
                                <label class="col-md-3 col-form-label" for="nrp-input">NRP</label>
                                <div class="col-md-9">
                                    <input class="form-control @error('nrp') is-invalid @enderror" id="nrp-input"
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
                                <label class="col-md-3 col-form-label" for="angkatan-input">Angkatan</label>
                                <div class="col-md-9">
                                    <input class="form-control @error('angkatan') is-invalid @enderror" id="angkatan-input"
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
                                    <input class="form-control @error('email') is-invalid @enderror" id="email-input"
                                        type="email" name="email" placeholder="Masukkan Email"
                                        value="{{ old('email') ?? $user->email }}">
                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="handphone-input">Nomor Handphone</label>
                                <div class="col-md-9">
                                    <input class="form-control @error('handphone') is-invalid @enderror"
                                        id="handphone-input" type="text" name="handphone"
                                        placeholder="Masukkan handphone"
                                        value="{{ old('handphone') ?? $user->handphone }}">
                                    @error('handphone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="address-input">Alamat</label>
                                <div class="col-md-9">
                                    <textarea name="address" id="address" cols="30" rows="10"
                                        class="form-control @error('address') is-invalid @enderror" id="address-input" placeholder="Masukkan alamat">{{ old('address') ?? $user->address }}</textarea>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                                <label class="col-md-3 col-form-label">Status</label>
                                <div class="col-md-9">
                                    @if ($user->status === 'active')
                                        <p>Aktif</p>
                                    @else
                                        <p>Non Aktif</p>
                                    @endif
                                </div>
                            </div> --}}
                            {{-- <div class="form-group row">
                                <label class="col-md-3 col-form-label">Level</label>
                                <div class="col-md-9 mt-2">
                                    @if ($user->level === 'admin')
                                        <p>Admin</p>
                                    @else
                                        <p>User</p>
                                    @endif
                                </div>
                            </div> --}}
                            <div class="card-footer">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-header password d-flex">
                        Edit Password
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('profile.updatepass', $user->id) }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="password_current-input">Password
                                    Sekarang</label>
                                <div class="col-md-9">
                                    <input class="form-control @error('password_current') is-invalid @enderror"
                                        id="password_current-input" type="password" name="password_current"
                                        placeholder="Masukkan Password" value="{{ old('password_current') }}">
                                    @error('password_current')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="password-input">Password</label>
                                <div class="col-md-9">
                                    <input class="form-control @error('password') is-invalid @enderror"
                                        id="password-input" type="password" name="password"
                                        placeholder="Masukkan Password" value="{{ old('password') }}">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="confirmation-input">Konfirmasi
                                    Password</label>
                                <div class="col-md-9">
                                    <input class="form-control @error('password_confirmation') is-invalid @enderror"
                                        id="confirmation-input" type="password" name="password_confirmation"
                                        placeholder="Konfirmasi Password" value="">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary" type="submit">Save Password</button>
                            </div>
                        </form>
                    </div>
                </div>
    </main>
@endsection

@push('scripts')
    <!-- select2 -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.25/b-1.7.1/b-html5-1.7.1/b-print-1.7.1/fh-3.1.9/r-2.2.9/datatables.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.5/dist/sweetalert2.all.min.js"
        integrity="sha256-NHQE05RR3vZ0BO0PeDxbN2N6dknQ7Z4Ch4Vfijn9Y+0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
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
        $("#status").select2({
            theme: 'bootstrap4',
            placeholder: "-Pilih-",
            allowClear: true
        })
        $("#level").select2({
            theme: 'bootstrap4',
            placeholder: "-Pilih-",
            allowClear: true
        })
    </script>
@endpush
