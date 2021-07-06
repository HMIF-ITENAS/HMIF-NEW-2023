@extends('layouts.backend')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <style>
        .select2-selection__choice__remove{
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
                <a href="{{ route('admin.tag') }}" class="btn btn-link">
                    <svg class="c-icon">
                        <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-arrow-circle-left') }}">
                        </use>
                    </svg>
                </a>
                <strong>Buat Aspirasi Eksternal</strong>
            </div>
            <div class="card-body">
              <form class="form-horizontal" action="{{ route('admin.aspiration.external.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                  <label class="col-md-3 col-form-label" for="title-input">Nama</label>
                  <div class="col-md-9">
                    <input class="form-control @error('name') is-invalid @enderror" id="name-input" type="text" name="name" placeholder="Masukkan nama lengkap" value="{{ old('name') }}">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 col-form-label" for="from-input">Instansi</label>
                  <div class="col-md-9">
                    <input class="form-control @error('from') is-invalid @enderror" id="from-input" type="text" name="from" placeholder="Masukkan instansi" value="{{ old('from') }}">
                    @error('from')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 col-form-label" for="title-input">Perihal</label>
                  <div class="col-md-9">
                    <input class="form-control @error('title') is-invalid @enderror" id="title-input" type="text" name="title" placeholder="Masukkan perihal" value="{{ old('title') }}">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Isi/Konten</label>
                    <div class="col-md-9">
                        <textarea name="content" id="content" cols="30" rows="10" class="form-control @error('content') is-invalid @enderror" placeholder="Masukkan isi konten"></textarea>
                        @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Status</label>
                    <div class="col-md-9">
                      <select id="status" name="status" class="form-control form-control-lg @error('status') is-invalid
                      @enderror">
                            <option></option>
                            <option value="alumni">Alumni</option>
                            <option value="public">Publik</option>
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
<!-- select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $("#status").select2({
        theme: 'bootstrap4',
        placeholder: "-Pilih-",
        allowClear: true
    })
</script>
@endpush

