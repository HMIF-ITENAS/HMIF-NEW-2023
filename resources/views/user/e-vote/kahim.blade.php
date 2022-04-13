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
                            Daftar Ketua Himpunan
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($data as $kahim)
                                    <div class="col-md-4">
                                        <div class="card text-white text-center"
                                            style="background: linear-gradient(to right, #cb356b, #bd3f32);">
                                            <div class="card-body">
                                                <i class="fas fa-user-tie fa-7x my-3"></i>
                                                <h2>{{ $kahim->user->name }}</h2>
                                                <p>Visi : {{ $kahim->visi }}</p>
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
    </script>
@endpush
