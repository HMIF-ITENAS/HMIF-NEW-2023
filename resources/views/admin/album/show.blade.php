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
                            <h4>Album {{ $album->name }}</h4>
                        </div>
                        <a href="{{ route('admin.photo.create', $album->id) }}" class="btn btn-primary">
                            <svg class="c-icon">
                                <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-pencil') }}">
                                </use>
                            </svg>
                            Tambah Foto
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @forelse  ($photos as $photo)
                                <div class="col-md-3">
                                    <img src="{{ asset("assets/album/$album->slug/$photo->photo") }}" alt=""
                                        class="img-fluid">
                                    <div>
                                        <form action="{{ route('admin.photo.delete', $photo->id) }}" method="post"
                                            class="d-flex justify-content-center mt-4" id="form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="album_id" value="{{ $album->id }}">
                                            <input type="hidden" name="album_slug" value="{{ $album->slug }}">
                                        </form>
                                        <div class="text-center">
                                            <a href="" class="btn btn-success mx-1">Edit</a>
                                            <a href="{{ route('admin.photo.delete', $photo->id) }}"
                                                class="btn btn-danger mx-1"
                                                onclick="event.preventDefault();document.getElementById('form-delete').submit();">Delete</a>
                                        </div>

                                    </div>
                                </div>
                            @empty
                                <h1>Belum ada foto!</h1>
                            @endforelse
                        </div>
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
@endpush
