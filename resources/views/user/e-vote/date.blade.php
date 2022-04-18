@extends('layouts.backend')

@section('content')
    <main class="c-main">
        <div class="d-flex flex-row align-items-center text-dark">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="clearfix">
                            <h1 class="float-start display-3 me-4">404</h1>
                            <h2>Pemilihan Dimulai tanggal {{ $evote_setting->begin_date }}</h2>
                            <h4 class="pt-3">Oops! {{ $text }}</h4>
                        </div>
                        <div class="input-group"><span class="input-group-text">
                                <svg class="icon">
                                    <use
                                        xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-magnifying-glass') }}">
                                    </use>
                                </svg></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
