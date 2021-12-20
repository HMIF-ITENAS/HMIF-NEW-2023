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
                                        <button id="tolak" class="btn btn-danger text-white" data-id="{{ $borrow->id }}">
                                            Tolak
                                        </button>
                                    </div>
                                </div>
                            @elseif($borrow->status === "Disetujui")
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
                                @elseif($borrow->status == "Disetujui")
                                    <span class="badge bg-success">
                                        Disetujui
                                    </span>
                                @elseif($borrow->status == "Tidak Disetujui")
                                    <span class="badge bg-danger">
                                        Tidak Disetujui
                                    </span>
                                @elseif($borrow->status == "Sudah Dikembalikan")
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
