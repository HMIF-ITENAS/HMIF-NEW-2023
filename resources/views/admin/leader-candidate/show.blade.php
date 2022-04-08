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
                            <h4>Detail Kandidat</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p>Nama Kandidat : {{ $leaderCandidate->user->name }}</p>
                                <p>NRP Kandidat : {{ $leaderCandidate->user->nrp }}</p>
                                <p>Angkatan Kandidat : {{ $leaderCandidate->user->angkatan }}</p>
                            </div>
                            <div class="col-md-6">
                                <p>Visi : {{ $leaderCandidate->visi }}</p>
                                <p>Misi : {!! $leaderCandidate->misi !!}</p>
                                <p>Nomor Urut : {{ $leaderCandidate->nomor_urut }}</p>
                            </div>
                            <div class="col-md-12 text-center">
                                <p>Foto Kandidat :</p>
                                @php
                                    $status = $leaderCandidate->status == 1 ? 'kahim' : 'bpa';
                                @endphp
                                <img src="{{ asset("assets/kandidat/$status/$leaderCandidate->foto") }}"
                                    class="img-fluid" alt="">
                            </div>
                        </div>
                        <table class="table table-responsive-md table-bordered table-striped table-md" id="voters-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NRP</th>
                                    <th>Angkatan</th>
                                    <th>Waktu Pilih</th>
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

        let table = $('#voters-table').DataTable({
            pageLength: 25,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.leader-candidate.voters', $leaderCandidate->id) }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'nrp',
                    name: 'nrp'
                },
                {
                    data: 'angkatan',
                    name: 'angkatan'
                },
                {
                    data: 'waktu_pilih',
                    name: 'waktu_pilih',
                    render: function(data) {
                        return moment(data).locale("id").format('DD-MM-YYYY hh:mm:ss');
                    }
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

        $('#voters-table').on('click', '.hapus_record', function(e) {
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
                        url: "{{ url('admin/voters') }}/" + id,
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
