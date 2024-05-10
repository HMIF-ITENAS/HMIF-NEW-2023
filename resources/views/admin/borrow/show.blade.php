@extends('layouts.backend')

@push('styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/dt-1.10.25/fh-3.1.9/r-2.2.9/sb-1.1.0/datatables.min.css" />
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
            color: rgba(255, 255, 255, .85);
            border: transparent;
            border-radius: .5vw;
        }

        .card-header {
            font-size: 18px;
            background-color: #1d1d1d;
            color: rgba(255, 255, 255, .85);
            border-bottom: 1px solid #2d2d2d;
            border-top-left-radius: .5vw !important;
            border-top-right-radius: .5vw !important;
            align-items: center;
            min-height: 4vw;
            max-height: 4vw;
        }

        table#meeting-table tbody {
            background-color: #141414 !important;
            color: rgba(255, 255, 255, .85) !important;
        }

        table#meeting-table thead {
            background-color: #1d1d1d !important;
            color: rgba(255, 255, 255, .85) !important;
        }

        .container-fluid {
            min-height: 600px;
        }

        .c-icon {
            color: #3b89e8;
        }

        .c-icon:hover {
            color: #41b8f8;
        }

        .btn-primary {
            background-color: #3b89e8;
            font-size: 14px;
        }

        .btn-primary:hover {
            background-color: #41b8f8;
        }

        .btn.btn-success.borrow_detail {
            color: #56a22a;
            background-color: #162312;
            border: 1px solid #223d14;
            min-width: 5vw;
            max-width: 5vw;
        }

        .btn.btn-success.borrow_detail:hover {
            filter: brightness(120%);
        }

        .btn.btn-info.edit_record {
            color: #2c7adc;
            background-color: #111a2c;
            border: 1px solid #142c4f;
            min-width: 5vw;
            max-width: 5vw;
        }

        .btn.btn-info.edit_record:hover {
            filter: brightness(120%);
        }

        .btn.btn-danger.hapus_record {
            color: #da3735;
            background-color: #2a1215;
            border: 1px solid #4c161a;
            min-width: 5vw;
            max-width: 5vw;
        }

        .btn.btn-danger.hapus_record:hover {
            filter: brightness(120%);
        }

        .fas.fa-check-circle {
            color: #1f8329;
        }

        .badge {
            min-width: 4vw;
        }

        .badge.badge-primary {
            padding: 5px 10px;
            color: #59a52a;
            background-color: #162312;
            border: 1px solid #234015;
        }

        .badge.badge-primary.sakit {
            padding: 5px 10px;
            color: #26a5a3;
            background-color: #112123;
            border: 1px solid #133e3f;
        }

        .badge.badge-primary.izin {
            padding: 5px 10px;
            color: #2c78da;
            background-color: #111a2c;
            border: 1px solid #142c4f;
        }

        .badge.badge-primary.alfa {
            padding: 5px 10px;
            color: #d7862c;
            background-color: #2b1d11;
            border: 1px solid #4d3114;
        }

        .dataTables_length select {
            appearance: none;
            color: rgba(255, 255, 255, .85) !important;
            background-color: #141414 !important;
            border: 1px solid #363636 !important;
            border-radius: 5px !important;
            padding: 5px !important;
            width: 4vw !important;
        }

        .dataTables_length .custom-select::after {
            color: #141414 !important;
        }

        .dataTables_length option {
            color: rgba(255, 255, 255, .85) !important;
            background-color: #141414 !important;
        }

        .dataTables_length option:hover {
            background-color: #41b8f8 !important;
            color: #fff !important;
        }

        .dataTables_length select:focus {
            border-color: #41b8f8 !important;
            outline: 0 !important;
        }

        .dataTables_filter input {
            color: white !important;
            background-color: #141414 !important;
            border: 1px solid #363636 !important;
            border-radius: 5px !important;
            padding: 5px !important;
        }

        .dataTables_filter input::before {
            color: white !important;
        }

        .dataTables_filter input:focus {
            border-color: #41b8f8 !important;
            outline: 0 !important;
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
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <a href="{{ route('user.home') }}" class="btn btn-link">
                                <svg class="c-icon">
                                    <use
                                        xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-arrow-circle-left') }}">
                                    </use>
                                </svg>
                            </a>
                            <strong>Detail Peminjaman</strong>
                        </div>
                        <div>
                            @if ($borrow->status === 'Sedang Diajukan')
                                <div class="row">
                                    <div class="col">
                                        <form action="{{ route('admin.borrow.status', $borrow->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="1">
                                            <button type="submit" class="btn btn-success text-white">
                                                Approve
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col">
                                        <button id="tolak" class="btn btn-danger text-white"
                                            data-id="{{ $borrow->id }}">
                                            Tolak
                                        </button>
                                    </div>
                                </div>
                            @elseif($borrow->status === 'Disetujui')
                                <form action="{{ route('admin.borrow.returned', $borrow->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="1">
                                    <button type="submit" class="btn btn-success text-white">
                                        Kembalikan
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="title-input">Peminjam</label>
                            <div class="col-md-9">
                                <p class="col-form-label">{{ $borrow->user->name }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="title-input">NRP</label>
                            <div class="col-md-9">
                                <p class="col-form-label">{{ $borrow->user->nrp }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="title-input">Invoice</label>
                            <div class="col-md-9">
                                <p class="col-form-label">{{ $borrow->invoice }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="title-input">Status</label>
                            <div class="col-md-9">
                                @if ($borrow->status == 'Sedang Diajukan')
                                    <span class="badge bg-warning">
                                        Sedang Diajukan
                                    </span>
                                @elseif($borrow->status == 'Disetujui')
                                    <span class="badge bg-success">
                                        Disetujui
                                    </span>
                                @elseif($borrow->status == 'Tidak Disetujui')
                                    <span class="badge bg-danger">
                                        Tidak Disetujui
                                    </span>
                                @elseif($borrow->status == 'Sudah Dikembalikan')
                                    <span class="badge bg-info">
                                        Sudah Dikembalikan
                                    </span>
                                @endif
                            </div>
                        </div>
                        @if ($borrow->status === 'Tidak Disetujui' && $borrow->pesan_tolak)
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="title-input">Pesan Tolak</label>
                                <div class="col-md-9">
                                    <p class="col-form-label font-weight-bold text-danger">{{ $borrow->pesan_tolak }}</p>
                                </div>
                            </div>
                        @endif
                        @if ($borrow->status === 'Sudah Dikembalikan')
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="title-input">Tanggal Dikembalikan</label>
                                <div class="col-md-9">
                                    <p class="col-form-label">{{ $borrow->returned_at }}</p>
                                </div>
                            </div>
                        @endif
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="title-input">Tanggal Mulai</label>
                            <div class="col-md-9">
                                <p class="col-form-label">{{ $borrow->begin_date }}</p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="no_ruangan"
                                class="col-sm-3
                                  col-form-label form-label">Tanggal
                                Akhir</label>
                            <div class="col-md-9">
                                <p class="col-form-label">{{ $borrow->end_date }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Perihal</label>
                            <div class="col-md-9">
                                <p class="col-form-label">{{ $borrow->description }}</p>
                            </div>
                        </div>
                        <table class="table table-responsive-md table-bordered table-striped table-md" id="item-table"
                            style="min-width: 100% !important;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/dt-1.10.25/fh-3.1.9/r-2.2.9/sb-1.1.0/datatables.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"
        integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.5/dist/sweetalert2.all.min.js"
        integrity="sha256-NHQE05RR3vZ0BO0PeDxbN2N6dknQ7Z4Ch4Vfijn9Y+0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            let flashdatasukses = $('.success-session').data('flashdata');
            if (flashdatasukses) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: flashdatasukses,
                    type: 'success'
                })
            }
        })

        let table = $('#item-table').DataTable({
            fixedHeader: true,
            pageLength: 25,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.borrow.listDetail', $borrow->id) }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'qty',
                    name: 'qty'
                }
            ]
        });

        function reload_table(callback, resetPage = false) {
            table.ajax.reload(callback, resetPage); //reload datatable ajax
        }

        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $("#tolak").click(function(e) {
            let id = $(this).data('id');
            (async () => {
                const {
                    value: text
                } = await Swal.fire({
                    title: name,
                    text: 'Masukkan Pesan Penolakan',
                    input: 'text',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Look up',
                    showLoaderOnConfirm: true,
                    allowOutsideClick: () => !Swal.isLoading()
                })

                if (text) {
                    $.ajax({
                        url: "{{ url('admin/borrow') }}/" + id + "/tolak",
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            pesan_tolak: text
                        },
                        dataType: 'JSON',
                        success: function(response) {
                            if (response.status) {
                                Swal.fire({
                                    icon: 'success',
                                    type: 'success',
                                    title: "Peminjaman telah ditolak!",
                                    showConfirmButton: true
                                }).then((result) => {
                                    location.reload();
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    type: 'error',
                                    title: response.message,
                                    showConfirmButton: true
                                })
                            }
                            console.log(response)
                            reload_table(null, true)
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            Swal.fire({
                                icon: 'error',
                                type: 'error',
                                title: 'Error saat memasukkan data',
                                showConfirmButton: true
                            })
                        }
                    })
                }

            })()
        })
    </script>
@endpush
