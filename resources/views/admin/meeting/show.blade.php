@extends('layouts.backend')

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.25/b-1.7.1/b-colvis-1.7.1/b-html5-1.7.1/b-print-1.7.1/fh-3.1.9/r-2.2.9/sc-2.0.4/sb-1.1.0/sl-1.3.3/datatables.min.css"/>

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
                            <h4>List Rapat</h4>
                        </div>
                        <div class="d-flex">
                            @if($meeting->status === "open")
                                <a href="{{ route('admin.meeting.edit.status', $meeting->id) }}" class="btn btn-danger mx-2" onclick="event.preventDefault();
                                    document.getElementById('form-status').submit();">
                                    <i class="fas fa-lock"></i>
                                    Tutup Rapat
                                </a>
                                <form id="form-status" action="{{ route('admin.meeting.edit.status', $meeting->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="closed">
                                </form>
                            @else
                                <a href="{{ route('admin.meeting.edit.status', $meeting->id) }}" class="btn btn-success mx-2" onclick="event.preventDefault();
                                    document.getElementById('form-status').submit();">
                                    <i class="fas fa-lock-open"></i>
                                    Buka Rapat
                                </a>
                                <form id="form-status" action="{{ route('admin.meeting.edit.status', $meeting->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="open">
                                </form>
                            @endif

                            <button data-toggle="modal" data-target="#modal-peserta" class="btn btn-primary mx-2">
                                <i class="fas fa-plus"></i>
                                Tambahkan Peserta Rapat
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3>{{ $meeting->name }}</h3>
                        <p>Detail : {{ $meeting->detail }}</p>
                        <p>Kategori : {{ $meeting->meeting_category->name }}</p>
                        <p>Status : 
                            @if($meeting->status === "open")
                                <span class="badge badge-pill badge-success py-1 px-2">Open</span>
                            @else
                                <span class="badge badge-pill badge-danger py-1 px-2">Closed</span>                            
                            @endif
                        </p>
                        <p>Tanggal : {{ $meeting->begin_date }}</p>
                        <p>Jam Mulai : {{ $meeting->start_meet_at }}</p>
                        <p>Jam Selesai : {{ $meeting->end_meet_at }}</p>
                        <p>Jam Absensi Mulai : {{ $meeting->start_presence }}</p>
                        <p>Jam Absensi Selesai : {{ $meeting->end_presence }}</p>
                        <table class="table table-responsive-md table-bordered table-striped table-md" id="meeting-table">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>NRP</th>
                                <th>Nama</th>
                                <th>Jam Absensi</th>
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
    <div class="modal fade" id="modal-peserta" tabindex="-1" aria-labelledby="modal-pesertaTitle" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modal-pesertaTitle">Modal Daftar Mahasiswa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered table-striped w-100" id="peserta-table">
                <thead>
                <tr>
                    <th>No</th>
                    <th>NRP</th>
                    <th>Nama</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" id="save-peserta" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.meeting.user.edit') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="pivot_id" id="pivot_id" value="">
                    <input type="hidden" name="user_id" id="user_id" value="">
                    <input type="hidden" name="meeting_id" id="meeting_id" value="">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" readonly="true" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">NRP</label>
                        <input type="text" class="form-control @error('nrp') is-invalid @enderror" id="nrp" name="nrp" readonly="true" required>
                        @error('nrp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" name="status" id="" required>
                            <option value="">- Pilih Salah Satu -</option>
                            <option value="hadir">Hadir</option>
                            <option value="izin">Izin</option>
                            <option value="alfa">Alfa</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.25/b-1.7.1/b-colvis-1.7.1/b-html5-1.7.1/b-print-1.7.1/fh-3.1.9/r-2.2.9/sc-2.0.4/sb-1.1.0/sl-1.3.3/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.5/dist/sweetalert2.all.min.js" integrity="sha256-NHQE05RR3vZ0BO0PeDxbN2N6dknQ7Z4Ch4Vfijn9Y+0=" crossorigin="anonymous"></script>
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

        let pesertaTable = $('#peserta-table').DataTable({
            pageLength: 25,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.meeting.user.get', $meeting->id) }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nrp', name: 'nrp'},
                {data: 'name', name: 'name'},
                
            ],
            select: {
                style: 'multi'
            }
        });

        let table = $('#meeting-table').DataTable({
            pageLength: 25,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.meeting.byid', $meeting->id) }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nrp', name: 'nrp'},
                {data: 'name', name: 'name'},
                {data: 'created_at', name: 'created_at'},
                {data: 'status', name: 'status'},
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

        $('#meeting-table').on('click', '.hapus_record', function(e) {
            let pivot = $(this).data('pivot')
            let name = $(this).data('name')
            let meeting_name = "{{ $meeting->name }}"
            e.preventDefault()
            Swal.fire({
                title: 'Apakah Yakin?',
                text: `Apakah Anda yakin ingin menghapus ${name} pada rapat dengan nama : ${meeting_name}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: "{{ url('admin/meeting/user/delete') }}",
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            _method: "delete",
                            pivot
                            },
                        dataType: 'JSON',
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                `${name} berhasil dihapus pada rapat dengan nama : ${meeting_name}.`,
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
        $('#meeting-table').on('click', '.edit_record', function(e) {
            e.preventDefault()
            let meeting_id = "{{ $meeting->id }}"
            let id = $(this).data('id')
            let name = $(this).data('name')
            let nrp = $(this).data('nrp')
            let pivot_id = $(this).data('pivot')
            $("#user_id").val(id)
            $("#meeting_id").val(meeting_id)
            $("#nrp").val(nrp)
            $("#name").val(name)
            $("#pivot_id").val(pivot_id)
        })
        $('#save-peserta').click( function () {
            let dataMahasiswa = pesertaTable.rows('.selected').data()
            let peserta = []
            dataMahasiswa.map(mahasiswa => {
                peserta.push(mahasiswa)  
            })
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ route('admin.meeting.user.create', $meeting->id) }}",
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    peserta
                    },
                dataType: 'JSON',
                success: function(response) {
                    Swal.fire(
                        'Updated!',
                        `Peserta telah diupdate`,
                        'success'
                    )
                    pesertaTable.ajax.reload(null, false)
                    reload_table(null, true)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire({
                        icon: 'error',
                        type: 'error',
                        title: 'Error saat update data',
                        showConfirmButton: true
                    })
                }
            })
        });
    </script>
@endpush
