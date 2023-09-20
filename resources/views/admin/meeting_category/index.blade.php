@extends('layouts.backend')

@push('styles')
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

        table#meeting-category-table tbody {
            background-color: #141414 !important;
            color: rgba(255, 255, 255, .85) !important;
        }

        table#meeting-category-table thead {
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

        .btn.btn-info.meeting_category_edit {
            color: #2c7adc;
            background-color: #111a2c;
            border: 1px solid #142c4f;
            min-width: 5vw;
            max-width: 5vw;
        }

        .btn.btn-info.meeting_category_edit:hover {
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
        @endif
        <div class="container-fluid">
            <div class="fade-in">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <h4>List Kategori Meetingggg</h4>
                        </div>
                        <a href="{{ route('admin.meeting_category.create') }}" class="btn btn-primary">
                            <i class="far fa-plus-circle"></i>
                            Buat Kategori Rapat
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-md table-hover table-outline table-md"
                            id="meeting-category-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Dibuat</th>
                                    <th>Total</th>
                                    <th>Status</th>
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

        let table = $('#meeting-category-table').DataTable({
            fixedHeader: true,
            pageLength: 25,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.meeting_category.list') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'meeting_count',
                    name: 'meeting_count'
                },
                {
                    data: 'status',
                    name: 'status'
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

        $('#meeting-category-table').on('click', '.hapus_record', function(e) {
            let id = $(this).data('id')
            let name = $(this).data('name')
            e.preventDefault()
            Swal.fire({
                title: 'Apakah Yakin?',
                text: `Apakah Anda yakin ingin menghapus kategori meeting dengan nama : ${name}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: "{{ url('admin/meeting_category/delete') }}/" + id,
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            _method: "delete",
                        },
                        dataType: 'JSON',
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                `Kategori Meeting dengan nama : ${name} berhasil terhapus.`,
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
