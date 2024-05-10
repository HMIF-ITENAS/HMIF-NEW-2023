@extends('layouts.backend')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
        integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .select2-selection__choice__remove {
            border: none !important;
            background: #fff !important;
        }
    </style>
@endpush

@section('content')
    <style>
        .card {
            background-color: #141414;
            border: transparent;
            border-radius: .5vw;
        }

        .card-header {
            font-size: 18px;
            background-color: #1d1d1d;
            border-bottom: 1px solid #2d2d2d;
            border-top-left-radius: .5vw !important;
            border-top-right-radius: .5vw !important;
            align-items: center;
            min-height: 4vw;
            max-height: 4vw;
        }

        .card-footer {
            background-color: #141414;
            border: none;
            padding-left: 0px;
            padding-right: 0px;
            display: flex;
            justify-content: end;
        }

        .card-footer a {
            min-width: 10vw;
            max-width: 10vw;
        }

        .btn-primary {
            background-color: #3b89e8;
            font-size: 14px;
        }

        .btn-primary:hover {
            background-color: #41b8f8;
        }

        .container-fluid {
            min-height: 600px;
            color: rgba(255, 255, 255, .85);
        }

        .card-body {
            min-height: 15vw;
        }

        .form-group {
            margin-left: 30px;
        }

        .c-icon {
            color: #3b89e8;
        }

        .c-icon:hover {
            color: #41b8f8;
        }
    </style>
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('admin.leader-candidate.index') }}" class="btn btn-link">
                            <svg class="c-icon">
                                <use
                                    xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-arrow-circle-left') }}">
                                </use>
                            </svg>
                        </a>
                        <strong>Tambah Kandidat</strong>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin.leader-candidate.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="title-input">Kandidat</label>
                                <div class="col-md-9">
                                    <select id="user_id" name="user_id"
                                        class="form-control form-control-lg @error('user_id') is-invalid @enderror">
                                        <option></option>
                                    </select>
                                    @error('user_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="title-input">Visi</label>
                                <div class="col-md-9">
                                    <input class="form-control @error('visi') is-invalid @enderror" id="visi-input"
                                        type="text" name="visi" placeholder="Masukkan visi"
                                        value="{{ old('visi') }}">
                                    @error('visi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="title-input">Misi</label>
                                <div class="col-md-9">
                                    <textarea class="form-control @error('misi') is-invalid @enderror" id="editor" name="misi" rows="9"
                                        placeholder="Content..">{{ old('misi') }}</textarea>
                                    @error('misi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="foto">Foto Kandidat</label>
                                <div class="col-md-9">
                                    <input type="file" class="dropify form-control" name="foto" id="foto"
                                        data-max-file-size="5M" data-allowed-file-extensions="jpg png jpeg">
                                    @error('foto')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="title-input">Nomor Urut</label>
                                <div class="col-md-9">
                                    <input class="form-control @error('nomor_urut') is-invalid @enderror"
                                        id="nomor_urut-input" type="text" name="nomor_urut"
                                        placeholder="Masukkan nomor urut seperti (1,2,3..dst)"
                                        value="{{ old('nomor_urut') }}">
                                    @error('nomor_urut')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Status</label>
                                <div class="col-md-9">
                                    <select id="status" name="status"
                                        class="form-control form-control-lg @error('status') is-invalid @enderror">
                                        <option></option>
                                        <option value="1">Ketua Himpunan</option>
                                        <option value="2">Ketua BPA</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-lg btn-primary" type="submit"> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </main>
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <!-- select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- dropify js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
        CKEDITOR.replace('editor', options);
        $("#status").select2({
            theme: 'bootstrap4',
            placeholder: "- Pilih Salah Satu -",
            allowClear: true
        })
        $('#user_id').select2({
            placeholder: "- Pilih Salah Satu -",
            ajax: {
                url: "{{ route('admin.users.candidate') }}",
                dataType: 'json',
                theme: "bootstrap4",
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(response) {
                    let results = [];
                    response.forEach(data => {
                        results.push({
                            "id": data.id,
                            "text": data.text
                        })
                    })
                    return {
                        results
                    };
                },
                cache: true
            }
        });

        $('.dropify').dropify()
    </script>
@endpush
