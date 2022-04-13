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
                            Daftar Calon Ketua Himpunan
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($data as $bpa)
                                    <div class="col-lg-4 col-md-6">
                                        <div class="card text-white text-center"
                                            style="background: linear-gradient(to right, #cb356b, #bd3f32);">
                                            <div class="card-body">
                                                <div>
                                                    @if (\File::exists(public_path('assets/kandidat/bpa/' . $bpa->foto)))
                                                        <img src="{{ asset('assets/kandidat/bpa/' . $bpa->foto) }}"
                                                            class="img-fluid mx-auto d-block"
                                                            style="border-radius: 50%;width:200px;height:200px" alt="">
                                                    @else
                                                        <i class="fas fa-user-tie fa-7x my-3"></i>
                                                    @endif
                                                </div>
                                                <h2>{{ $bpa->user->name }}</h2>
                                                <h4>{{ $bpa->user->nrp }}</h4>
                                                <h5>Nomor Urut : {{ $bpa->nomor_urut }}</h5>
                                                <p>Visi : {{ $bpa->visi }}</p>
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-12">
                                                        <button class="btn btn-success btn-lg btn-block btn-vote"
                                                            data-id="{{ $bpa->id }}"
                                                            data-nomor="{{ $bpa->nomor_urut }}">
                                                            Vote
                                                        </button>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12">
                                                        <button class="btn btn-info btn-lg btn-block" type="button"
                                                            data-toggle="modal" data-target="#exampleModal"
                                                            data-id="{{ $bpa->id }}">
                                                            Detail
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mx-auto">
                            <img src="#" class="img-fluid mx-auto d-block"
                                style="border-radius: 50%;width:200px;height:200px" id="foto">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nama:</label>
                            <input type="text" class="form-control" id="nama" disabled>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">NRP:</label>
                            <input type="text" class="form-control" id="nrp" disabled>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Angkatan:</label>
                            <input type="text" class="form-control" id="angkatan" disabled>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Visi:</label>
                            <input type="text" class="form-control" id="visi" disabled>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label" disabled>Misi:</label>
                            <div id="misi"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
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
            var myModal = document.getElementById('exampleModal')
            myModal.addEventListener('shown.coreui.modal', function() {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                $.ajax(`${window.baseurl}/user/bpa/` + id, {
                    method: 'GET',
                    success: function(response) {
                        let data = response.data
                        console.log(data)
                        $("#foto").attr('src',
                            `${window.baseurl}/assets/kandidat/bpa/${data.foto}`)
                        $('#nama').val(data.user.name)
                        $('#nrp').val(data.user.nrp)
                        $('#angkatan').val(data.user.angkatan)
                        $('#visi').val(data.visi)
                        $('#misi').html(data.misi)
                    }
                })
            })
            $(".btn-vote").on("click", function(e) {
                e.preventDefault()
                var button = $(e.target)
                var id = button.data('id')
                var nomorUrut = button.data('nomor')
                Swal.fire({
                    title: 'Apakah Yakin?',
                    text: `Apakah Anda yakin ingin memilih calon ketua BPA dengan nomor urut ${nomorUrut}`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2eb85c',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Vote'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url: "{{ url('user/vote') }}/" + id,
                            type: 'POST',
                            data: {
                                _token: CSRF_TOKEN,
                                status: 2,
                            },
                            dataType: 'JSON',
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        title: 'Success!',
                                        text: `Berhasil vote dengan nomor urut ${nomorUrut}`,
                                        icon: 'success',
                                        showConfirmButton: true,
                                        confirmButtonText: 'OK',
                                        confirmButtonColor: '#2eb85c',
                                    }).then(result => {
                                        if (result.isConfirmed) {
                                            window.location.href =
                                                "{{ route('user.vote') }}"
                                        }
                                    })
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: `Gagal vote dengan nomor urut ${nomorUrut}! ${response.message}`,
                                        icon: 'error',
                                        showConfirmButton: true,
                                        confirmButtonText: 'OK',
                                        confirmButtonColor: '#2eb85c',
                                    })
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                Swal.fire({
                                    icon: 'error',
                                    type: 'error',
                                    title: 'Error saat vote data! Pastikan Anda belum memilih Kahim.',
                                    showConfirmButton: true
                                })
                            }
                        })
                    }
                })
            })
        })
    </script>
@endpush
