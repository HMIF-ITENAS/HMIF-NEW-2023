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
                <a href="{{ route('admin.aspiration.external') }}" class="btn btn-link">
                    <svg class="c-icon">
                        <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-arrow-circle-left') }}">
                        </use>
                    </svg>
                </a>
                <strong>Detail Aspirasi</strong>
            </div>
            <div class="card-body">
              <form class="form-horizontal">
                @csrf
                <div class="form-group row">
                  <label class="col-md-3 col-form-label" for="title-input">Judul</label>
                  <div class="col-md-9">
                    {{ $aspiration->title }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 col-form-label" for="title-input">Konten</label>
                  <div class="col-md-9">
                    {!! $aspiration->content !!}
                  </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="title-input">Nama</label>
                    <div class="col-md-9">
                      <p>{{ $aspiration->name }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="title-input">Instansi</label>
                    <div class="col-md-9">
                      <p>{{ $aspiration->from }}</p>
                    </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 col-form-label" for="title-input">Status</label>
                  <div class="col-md-9">
                    @if($aspiration->status === 'alumni')
                        <span class="badge rounded-pill px-3 py-2 bg-info text-white">
                            Alumni
                        </span>
                    @else
                        <span class="badge rounded-pill px-3 py-2 bg-success text-white">
                            Publik
                        </span>
                    @endif
                  </div>
                </div>
                
                
                <div class="form-group row">
                  <label class="col-md-3 col-form-label" for="title-input">Dibuat</label>
                  <div class="col-md-9">
                        <p>{{ $aspiration->created_at->diffForHumans() }}</p>
                  </div>
                </div>
                <div class="card-footer">
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

