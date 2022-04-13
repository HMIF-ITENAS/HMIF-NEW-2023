@extends('layouts.backend')

@push('styles')
    <style>
        .not-allowed {
            cursor: not-allowed ! important;

        }

    </style>
@endpush

@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            HMIF E-Vote
                        </div>
                        @if (session('success'))
                            <div class="success-session" data-flashdata="{{ session('success') }}"></div>
                        @elseif(session('danger'))
                            <div class="danger-session" data-flashdata="{{ session('danger') }}"></div>
                        @endif
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <a href="{{ route('user.kahim') }}"
                                        @if ($has_vote_kahim) class="text-decoration-none not-allowed" onclick="return false;" @else  class="text-decoration-none" @endif>
                                        <div class="card text-white text-center"
                                            style="background: linear-gradient(to right, #cb356b, #bd3f32);">
                                            <div class="card-body">
                                                <i class="fas fa-user-tie fa-7x my-3"></i>
                                                <h2>Pemilihan Calon Ketua Himpunan</h2>
                                                @if ($has_vote_kahim)
                                                    <button class="btn btn-success btn-lg my-2" type="button">Anda Sudah
                                                        Memilih
                                                        Calon
                                                        Ketua
                                                        Himpunan!</button>
                                                @else
                                                    <button class="btn btn-warning btn-lg my-2" type="button">Anda Belum
                                                        Memilih
                                                        Calon
                                                        Ketua
                                                        Himpunan!</button>
                                                @endif
                                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fuga,
                                                    consequatur
                                                    nisi
                                                    nulla veritatis aut optio odit repellendus hic perferendis ullam aliquid
                                                    error in
                                                    numquam animi saepe ratione, dolor deserunt debitis!</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <a href="{{ route('user.bpa') }}"
                                        @if ($has_vote_bpa) class="text-decoration-none not-allowed" onclick="return false;" @else  class="text-decoration-none" @endif>
                                        <div class="card text-white text-center"
                                            style="background: linear-gradient(to right, #cb356b, #bd3f32);">
                                            <div class="card-body">
                                                <i class="fas fa-user-tie fa-7x my-3"></i>
                                                <h2>Pemilihan Calon Ketua BPA (Badan Perwakilan Anggota)</h2>
                                                @if ($has_vote_bpa)
                                                    <button class="btn btn-success btn-lg my-2" type="button">Anda Sudah
                                                        Memilih
                                                        Calon
                                                        Ketua
                                                        BPA!</button>
                                                @else
                                                    <button class="btn btn-warning btn-lg my-2" type="button">Anda Belum
                                                        Memilih
                                                        Calon
                                                        Ketua
                                                        BPA!</button>
                                                @endif
                                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fuga,
                                                    consequatur
                                                    nisi
                                                    nulla veritatis aut optio odit repellendus hic perferendis ullam aliquid
                                                    error in
                                                    numquam animi saepe ratione, dolor deserunt debitis!</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
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
            let flashdatadanger = $('.danger-session').data('flashdata');
            if (flashdatadanger) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: flashdatadanger,
                    type: 'error'
                })
            }
        })
    </script>
@endpush
