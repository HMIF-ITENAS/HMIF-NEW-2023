@extends('layouts.backend')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
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
                        <a href="{{ route('admin.item') }}" class="btn btn-link">
                            <svg class="c-icon">
                                <use
                                    xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-arrow-circle-left') }}">
                                </use>
                            </svg>
                        </a>
                        <strong>Buat Item</strong>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin.item.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="title-input">Nama Item</label>
                                <div class="col-md-9">
                                    <input class="form-control @error('name') is-invalid @enderror" id="name-input"
                                        type="text" name="name" placeholder="Masukkan nama item"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="title-input">Stok</label>
                                <div class="col-md-9">
                                    <input class="form-control @error('stock') is-invalid @enderror" id="stock-input"
                                        type="number" name="stock" placeholder="Masukkan stok" value="{{ old('stock') }}">
                                    @error('stock')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="date-input">Unit</label>
                                <div class="col-md-9">
                                    <select id="unit_id" name="unit_id"
                                        class="form-control form-control-lg @error('unit_id') is-invalid
                      @enderror">
                                        <option></option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('unit_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="title-input">Harga</label>
                                <div class="col-md-9">
                                    <input class="form-control @error('unit_price') is-invalid @enderror"
                                        id="unit_price-input" type="number" name="unit_price"
                                        placeholder="Masukkan harga per unit" value="{{ old('unit_price') }}">
                                    @error('unit_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="title-input">Deskripsi</label>
                                <div class="col-md-9">
                                    <input class="form-control @error('description') is-invalid @enderror"
                                        id="description-input" type="text" name="description"
                                        placeholder="Masukkan deksripsi barang" value="{{ old('description') }}">
                                    @error('description')
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
                                        class="form-control form-control-lg @error('status') is-invalid
                      @enderror">
                                        <option></option>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
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
        $("#unit_id, #status").select2({
            theme: 'bootstrap4',
            placeholder: "-Pilih-",
            allowClear: true
        })
    </script>
@endpush
