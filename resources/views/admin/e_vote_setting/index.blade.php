@extends('layouts.backend')

@push('styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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

        .card-footer a {
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
    </style>
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('admin.evote.settings.index') }}" class="btn btn-link">
                            <svg class="c-icon">
                                <use
                                    xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-arrow-circle-left') }}">
                                </use>
                            </svg>
                        </a>
                        <strong>E-Vote Settings</strong>
                    </div>
                    @if (session('success'))
                        <div class="success-session" data-flashdata="{{ session('success') }}"></div>
                    @endif
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin.evote.settings.update') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="title-input">Tanggal Mulai</label>
                                <div class="col-md-9">
                                    <input id="begin_date" class="form-control @error('begin_date') is-invalid @enderror"
                                        type="text" name="begin_date" placeholder="Masukkan tanggal mulai"
                                        value="{{ old('begin_date') ?? ($data ? $data->begin_date : '') }}" required>
                                    @error('begin_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="title-input">Jam Mulai</label>
                                <div class="col-md-9">
                                    <input id="start_vote_at"
                                        class="form-control @error('start_vote_at') is-invalid @enderror" type="time"
                                        name="start_vote_at" placeholder="Masukkan jam mulai"
                                        value="{{ old('start_vote_at') ?? ($data ? $data->start_vote_at : '') }}" required>
                                    @error('start_vote_at')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Jam Selesai</label>
                                <div class="col-md-9">
                                    <input id="end_vote_at" class="form-control @error('end_vote_at') is-invalid @enderror"
                                        type="time" name="end_vote_at" placeholder="Masukkan jam selesai"
                                        value="{{ old('end_vote_at') ?? ($data ? $data->end_vote_at : '') }}" required>
                                    @error('end_vote_at')
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
    <script>
        let flashdatasukses = $('.success-session').data('flashdata');
        if (flashdatasukses) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: flashdatasukses,
                type: 'success'
            })
        }
        $(function() {
            $("#begin_date").datepicker({
                dateFormat: 'yy-mm-dd',
            });
        })

        $('#begin_date').on('keydown keyup change', function(e) {
            e.preventDefault();
            return false;
        })
    </script>
@endpush
