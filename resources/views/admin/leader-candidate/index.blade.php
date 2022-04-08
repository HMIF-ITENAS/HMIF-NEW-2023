@extends('layouts.backend')

@push('styles')
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
                            <h4>List Kandidat</h4>
                        </div>
                        <a href="{{ route('admin.leader-candidate.create') }}" class="btn btn-primary">
                            <svg class="c-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-pencil">
                                </use>
                            </svg>
                            Bikin Kandidat
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-md table-bordered table-striped table-md"
                            id="leader-candidate-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kandidat</th>
                                    <th>Angkatan</th>
                                    <th>Status</th>
                                    <th>Nomor Urut</th>
                                    <th>Jumlah</th>
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

        let table = $('#leader-candidate-table').DataTable({
            pageLength: 25,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.leader-candidate.list') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'user.name',
                    name: 'user.name'
                },
                {
                    data: 'user.angkatan',
                    name: 'user.angkatan'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'nomor_urut',
                    name: 'nomor_urut'
                },
                {
                    data: 'voters',
                    name: 'voters'
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

        $('#leader-candidate-table').on('click', '.hapus_record', function(e) {
            let id = $(this).data('id')
            let name = $(this).data('name')
            e.preventDefault()
            Swal.fire({
                title: 'Apakah Yakin?',
                text: `Apakah Anda yakin ingin menghapus kandidate dengan nama : ${name}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: "{{ url('admin/leader-candidate') }}/" + id,
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            _method: "delete",
                        },
                        dataType: 'JSON',
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                `Kandidat dengan nama : ${name} berhasil terhapus.`,
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
