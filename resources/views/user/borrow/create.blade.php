@extends('layouts.backend')

@push('styles')
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
        <div class="container-fluid">
            <div class="fade-in">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <div class="d-inline-block">
                                <a href="">
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                                <h4>List Item</h4>
                            </div>
                        </div>
                        <a href="{{ route('user.home') }}" class="btn btn-primary">
                            <i class="fas fa-shopping-cart mr-1"></i>
                            Lihat Cart ({{ $cart->count() }})
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-md table-bordered table-striped table-md" id="item-table">
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
    </main>
@endsection

@push('scripts')
    <!-- select2 -->
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/dt-1.10.25/fh-3.1.9/r-2.2.9/sb-1.1.0/datatables.min.js"></script>
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
            e.preventDefault()
            {{-- Swal.fire({ --}}
            {{-- title: 'Apakah Yakin?', --}}
            {{-- text: `Apakah Anda yakin ingin menghapus peminjaman dengan invoice : ${invoice}`, --}}
            {{-- icon: 'warning', --}}
            {{-- showCancelButton: true, --}}
            {{-- confirmButtonColor: '#3085d6', --}}
            {{-- cancelButtonColor: '#d33', --}}
            {{-- confirmButtonText: 'Hapus' --}}
            {{-- }).then((result) => { --}}
            {{-- if (result.isConfirmed) { --}}
            {{-- let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'); --}}
            {{-- $.ajax({ --}}
            {{-- url: "{{ url('user/borrow/delete') }}/" + id, --}}
            {{-- type: 'POST', --}}
            {{-- data: { --}}
            {{-- _token: CSRF_TOKEN, --}}
            {{-- _method: "delete", --}}
            {{-- }, --}}
            {{-- dataType: 'JSON', --}}
            {{-- success: function(response) { --}}
            {{-- Swal.fire( --}}
            {{-- 'Deleted!', --}}
            {{-- `Peminjaman Barang dengan invoice : ${invoice} berhasil terhapus.`, --}}
            {{-- 'success' --}}
            {{-- ) --}}
            {{-- reload_table(null, true) --}}
            {{-- }, --}}
            {{-- error: function(jqXHR, textStatus, errorThrown) { --}}
            {{-- Swal.fire({ --}}
            {{-- icon: 'error', --}}
            {{-- type: 'error', --}}
            {{-- title: 'Error saat delete data', --}}
            {{-- showConfirmButton: true --}}
            {{-- }) --}}
            {{-- } --}}
            {{-- }) --}}
            {{-- } --}}
            {{-- }) --}}
            const {
                value: qty
            } = Swal.fire({
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
            if (qty) {
                let statusQty = fetch(`${window.baseurl}/user/item/checkQty`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            "X-CSRF-Token": CSRF_TOKEN
                        },
                        body: JSON.stringify({
                            id,
                            qty: result.inputValue
                        })
                    }).then(response => {
                        if (!response.status) {
                            throw new Error(response.message)
                        }
                        return response.status
                    })
                    .catch(error => {
                        Swal.showValidationMessage(
                            `Request failed: ${error.message}`
                        )
                    })
            }
        })
    </script>
@endpush
