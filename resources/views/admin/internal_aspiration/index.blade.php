@extends('layouts.backend')

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.25/b-1.7.1/b-html5-1.7.1/b-print-1.7.1/fh-3.1.9/r-2.2.9/datatables.min.css"/>
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
                    <h4>List Aspirasi Internal</h4>
                </div>
                <a href="{{ route('admin.aspiration.internal.create') }}" class="btn btn-primary">
                    <svg class="c-icon">
                        <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-pencil') }}">
                        </use>
                    </svg>
                    Bikin Aspirasi
                </a>
            </div>
            <div class="card-body">
                <table class="table table-responsive-md table-bordered table-striped table-md" id="aspiration-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Konten</th>
                            <th>Privasi</th>
                            <th>Nama</th>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.25/b-1.7.1/b-html5-1.7.1/b-print-1.7.1/fh-3.1.9/r-2.2.9/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.5/dist/sweetalert2.all.min.js" integrity="sha256-NHQE05RR3vZ0BO0PeDxbN2N6dknQ7Z4Ch4Vfijn9Y+0=" crossorigin="anonymous"></script>
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
                    title: 'Danger!',
                    text: flashdatagagal,
                    type: 'error'
                })
            }
        })

        let table = $('#aspiration-table').DataTable({
            fixedHeader: true,
            pageLength: 25,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.aspiration.internal.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'title', name: 'title'},
                {data: 'content', name: 'content'},
                {data: 'privacy', name: 'privacy'},
                {data: 'user_name', name: 'user_name'},
                {data: 'created_at', name: 'created_at'},
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false
                },
            ],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

        function reload_table(callback, resetPage = false) {
            table.ajax.reload(callback, resetPage); //reload datatable ajax 
        }

        $('#aspiration-table').on('click', '.hapus_record', function(e) {
            let id = $(this).data('id')
            let title = $(this).data('title')
            e.preventDefault()
            Swal.fire({
                title: 'Apakah Yakin?',
                text: `Apakah Anda yakin ingin menghapus aspirasi dengan judul : ${title}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: "{{ url('admin/aspiration/external/delete') }}/" + id,
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            _method: "delete",
                            },
                        dataType: 'JSON',
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                `Aspirasi dengan judul : ${title} berhasil terhapus.`,
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