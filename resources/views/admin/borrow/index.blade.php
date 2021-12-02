@extends('layouts.backend')

@push('styles')
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/dt-1.10.25/fh-3.1.9/r-2.2.9/sb-1.1.0/datatables.min.css" />
@endpush

@section('content')
    <main class="c-main">
        @if (session('success'))
            <div class="success-session" data-flashdata="{{ session('success') }}"></div>
        @endif
        <div class="container-fluid">
            <div class="fade-in">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <h4>List Peminjaman Barang</h4>
                        </div>
                        <a href="{{ route('admin.borrow.create') }}" class="btn btn-primary">
                            <svg class="c-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-pencil">
                                </use>
                            </svg>
                            Bikin Peminjaman Barang
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-md table-bordered table-striped table-md" id="borrow-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice</th>
                                    <th>Peminjam</th>
                                    <th>Total Barang</th>
                                    <th>Status</th>
                                    <th>Deskripsi</th>
                                    <th>Dibuat</th>
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
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/dt-1.10.25/fh-3.1.9/r-2.2.9/sb-1.1.0/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.5/dist/sweetalert2.all.min.js"
        integrity="sha256-NHQE05RR3vZ0BO0PeDxbN2N6dknQ7Z4Ch4Vfijn9Y+0=" crossorigin="anonymous"></script>
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

        let table = $('#borrow-table').DataTable({
            fixedHeader: true,
            pageLength: 25,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.borrow.list') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'invoice',
                    name: 'invoice'
                },
                {
                    data: 'user',
                    name: 'user'
                },
                {
                    data: 'item_count',
                    name: 'item_count'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
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

        $('#borrow-table').on('click', '.hapus_record', function(e) {
            let id = $(this).data('id')
            let invoice = $(this).data('invoice')
            e.preventDefault()
            Swal.fire({
                title: 'Apakah Yakin?',
                text: `Apakah Anda yakin ingin menghapus peminjaman dengan invoice : ${invoice}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: "{{ url('admin/borrow/delete') }}/" + id,
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            _method: "delete",
                        },
                        dataType: 'JSON',
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                `Peminjaman Barang dengan invoice : ${invoice} berhasil terhapus.`,
                                'success'
                            )
                            reload_table(null, true)
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            Swal.fire({
                                icon: 'error',
                                type: 'error',
                                title: 'Error saat delete data',
                                showConfirmButton: true
                            })
                        }
                    })
                }
            })
        })
    </script>
@endpush
