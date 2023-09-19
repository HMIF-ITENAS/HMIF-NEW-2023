@extends('layouts.backend')

@push('styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                        <a href="{{ route('user.home') }}" class="btn btn-link">
                            <svg class="c-icon">
                                <use
                                    xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-arrow-circle-left') }}">
                                </use>
                            </svg>
                        </a>
                        Buat Peminjaman
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('user.borrow.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="title-input">Peminjam</label>
                                <div class="col-md-9">
                                    <p class="col-form-label">{{ auth()->user()->name }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="title-input">Tanggal Mulai</label>
                                <div class="col-md-9">
                                    <input id="begin_date" class="form-control @error('begin_date') is-invalid @enderror"
                                        type="text" name="begin_date" placeholder="Masukkan tanggal mulai"
                                        value="{{ old('begin_date') }}" required>
                                    @error('begin_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="no_ruangan"
                                    class="col-md-3
                                  col-form-label form-label">Tanggal
                                    Akhir</label>

                                <div class="col-md-9 col-12">
                                    <input id="end_date" class="form-control @error('end_date') is-invalid @enderror"
                                        type="text" name="end_date" placeholder="Masukkan tanggal akhir"
                                        value="{{ old('end_date') }}" required>
                                    @error('end_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Perihal</label>
                                <div class="col-md-9">
                                    <input name="description" id="description" type="text"
                                        class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Masukkan perihal/deskripsi" />
                                    @error('description')
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
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"
        integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.5/dist/sweetalert2.all.min.js"
        integrity="sha256-NHQE05RR3vZ0BO0PeDxbN2N6dknQ7Z4Ch4Vfijn9Y+0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#begin_date").datepicker({
                dateFormat: 'yy-mm-dd',
                beforeShowDay: function(date) {
                    let day = date.getDay();
                    return [(day != 0), ''];
                },
                minDate: +1
            });

            $('#end_date').datepicker({
                dateFormat: 'yy-mm-dd',
                beforeShowDay: function(date) {
                    let day = date.getDay();
                    return [(day != 0), ''];
                },
                minDate: +1,
                beforeShow: function(input, inst) {
                    let minDate = $('#begin_date').datepicker('getDate');
                    $('#end_date').datepicker('option', 'minDate', minDate);
                },

            })

            $('#begin_date').on('keydown keyup change', function(e) {
                e.preventDefault();
                return false;
            })
            let flashdatasukses = $('.success-session').data('flashdata');
            if (flashdatasukses) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: flashdatasukses,
                    type: 'success'
                })
            }

            $("#status").select2({
                theme: 'bootstrap4',
                placeholder: "-Pilih-",
                allowClear: true
            })
        })
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    </script>
@endpush
