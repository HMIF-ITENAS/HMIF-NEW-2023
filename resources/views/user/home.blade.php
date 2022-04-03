@extends('layouts.backend')

@push('styles')
@endpush

@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Daftar Rapat HMIF
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive-sm table-hover table-outline mb-0" id="meeting-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th>Nama Rapat</th>
                                        <th>Tanggal</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                        <th>Jam Mulai Absensi</th>
                                        <th>Jam Selesai Absensi</th>
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

        let table = $('#meeting-table').DataTable({
            pageLength: 25,
            responsive: true,
            processing: true,
            serverSide: true,
            order: [
                [7, "desc"]
            ],
            ajax: "{{ route('user.meeting.list') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'begin_date',
                    name: 'begin_date'
                },
                {
                    data: 'start_meet_at',
                    name: 'start_meet_at'
                },
                {
                    data: 'end_meet_at',
                    name: 'end_meet_at'
                },
                {
                    data: 'start_presence',
                    name: 'start_presence'
                },
                {
                    data: 'end_presence',
                    name: 'end_presence'
                },
                {
                    data: 'kehadiran',
                    name: 'kehadiran'
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

        $('#meeting-table').on('click', '.check_record', function(e) {
            let id = $(this).data('id')
            let name = $(this).data('name')
            e.preventDefault()
            Swal.fire({
                title: 'Apakah Yakin?',
                text: `Apakah Anda yakin ingin menghadir rapat : ${name}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hadir'
            }).then((result) => {
                if (result.isConfirmed) {
                    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: "{{ url('user/meeting/check') }}/" + id,
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                        },
                        dataType: 'JSON',
                        success: function(response) {
                            if (response.status === true) {
                                Swal.fire(
                                    'Success!',
                                    `Anda berhasil hadir rapat dengan nama : ${name}`,
                                    'success'
                                )
                            } else {
                                Swal.fire(
                                    'Error!',
                                    `Anda ${response.error}`,
                                    'error'
                                )
                            }

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
