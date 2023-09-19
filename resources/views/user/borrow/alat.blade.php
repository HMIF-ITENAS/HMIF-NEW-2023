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

        table#item-table tbody {
            background-color: #141414 !important;
            color: rgba(255, 255, 255, .85) !important;
        }

        table#item-table thead {
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

        .btn-primary {
            background-color: #3b89e8;
            font-size: 14px;
        }

        .btn-primary:hover {
            background-color: #41b8f8;
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
                            <div class="d-flex align-items-center">
                                <a href="{{ route('user.borrow') }}" class="btn btn-link">
                                    <svg class="c-icon">
                                        <use
                                            xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-arrow-circle-left') }}">
                                        </use>
                                    </svg>
                                </a>
                                List Item
                                {{-- <p>List item yang tersedia periode {{ $peminjaman_alat['begin_date'] }} hingga
                                    {{ $peminjaman_alat['end_date'] }} </p> --}}
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-shopping-cart mr-1"></i>
                                Keranjang
                                <span id="cart-count">
                                    ({{ $cart->count() }})
                                </span>
                            </button>
                            @if ($cart->count() > 0)
                                <a href="{{ route('user.borrow.confirm') }}" class="btn btn-success text-white">
                                    Konfirmasi
                                </a>
                            @endif
                        </div>

                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-md table-bordered table-striped table-md" id="item-table"
                            style="min-width: 100% !important;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Stok</th>
                                    <th>Unit</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Keranjang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-responsive-md table-bordered table-striped table-md" id="cart-table"
                        style="width: 100% !important;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Qty</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- select2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.5/dist/sweetalert2.all.min.js"
        integrity="sha256-NHQE05RR3vZ0BO0PeDxbN2N6dknQ7Z4Ch4Vfijn9Y+0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
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
                    title: 'Error!',
                    text: flashdatagagal,
                    type: 'error'
                })
            }

            $("#status").select2({
                theme: 'bootstrap4',
                placeholder: "-Pilih-",
                allowClear: true
            })
        })
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        let table = $('#item-table').DataTable({
            fixedHeader: true,
            pageLength: 25,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.item.list') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'stock',
                    name: 'stock'
                },
                {
                    data: 'unit',
                    name: 'unit'
                },
                {
                    data: 'unit_price',
                    name: 'unit_price'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        function reload_table(callback, resetPage = false) {
            table.ajax.reload(callback, resetPage); //reload datatable ajax
        }

        $('#item-table').on('click', '.add_cart', function(e) {
            let id = $(this).data('id')
            let name = $(this).data('name')
            e.preventDefault();
            (async () => {

                const {
                    value: text
                } = await Swal.fire({
                    title: name,
                    text: 'Masukkan Quantity',
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
                        url: "{{ url('user/item') }}/" + id + "/cart",
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            qty: text
                        },
                        dataType: 'JSON',
                        success: function(response) {
                            if (response.status) {
                                Swal.fire({
                                    icon: 'success',
                                    type: 'success',
                                    title: "Berhasil Memasukkan Data Ke Keranjang",
                                    showConfirmButton: true
                                }).then((result) => {
                                    location.reload()
                                })
                                reload_cart();
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

        function reload_cart() {
            $.ajax({
                url: "{{ url('/user/item/getCartCount') }}/",
                type: 'GET',
                dataType: 'JSON',
                success: function(response) {
                    console.log(response.data)
                    $("#cart-count").html(response.count)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus)
                }
            })
        }

        var exampleModalEl = document.getElementById('exampleModal')
        let cartTable = $('#cart-table').DataTable({
            fixedHeader: true,
            pageLength: 25,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.item.cartList') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'quantity',
                    name: 'quantity'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
        exampleModalEl.addEventListener('show.bs.modal', function(event) {
            cartTable.ajax.reload(null, false)
        })
    </script>
@endpush
