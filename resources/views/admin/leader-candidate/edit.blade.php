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
                        <form class="form-horizontal"
                            action="{{ route('admin.leader-candidate.update', $leaderCandidate->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="title-input">Kandidat</label>
                                <div class="col-md-9">
                                    <select id="user_id" name="user_id"
                                        class="form-control form-control-lg @error('user_id') is-invalid @enderror">
                                        <option value="{{ $leaderCandidate->user_id }}" selected>
                                            {{ $leaderCandidate->user->nrp . ' - ' . $leaderCandidate->user->name }}
                                        </option>
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
                                        value="{{ old('visi') ?? $leaderCandidate->visi }}">
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
                                        placeholder="Content..">{{ old('misi') ?? $leaderCandidate->misi }}</textarea>
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
                                        data-max-file-size="5M" data-allowed-file-extensions="jpg png jpeg"
                                        data-default-file="{{ $leaderCandidate->getFoto() }}">
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
                                        value="{{ old('nomor_urut') ?? $leaderCandidate->nomor_urut }}">
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
                                        <option value="1" @if ($leaderCandidate->status == 1) selected @endif>Ketua Himpunan
                                        </option>
                                        <option value="2" @if ($leaderCandidate->status == 2) selected @endif>Ketua BPA
                                        </option>
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
