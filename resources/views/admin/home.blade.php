@extends('layouts.backend')
@section('content')
    <style>
        .card {
            background-color: #141414;
            color: rgba(255, 255, 255, .85);
            border: transparent;
            border-radius: .5vw;
        }

        .card-footer {
            background-color: #141414;
            color: rgba(255, 255, 255, .85);
            border: transparent;
            border-radius: .5vw;
        }

        .card.total-anggota {
            background-color: #111a2c;
            color: rgba(255, 255, 255, .85);
            border-radius: .5vw;
        }

        .card.total-anggota:hover {
            border: 1px solid #142c4f;
            margin-top: -1px;
            margin-bottom: -1px;
            filter: brightness(120%);
        }

        .card.total-post {
            background-color: #112123;
            color: rgba(255, 255, 255, .85);
            border: transparent;
            border-radius: .5vw;
        }

        .card.total-post:hover {
            border: 1px solid #133e3f;
            margin-top: -1px;
            margin-bottom: -1px;
            filter: brightness(120%);
        }

        .card.total-aspirasi-internal {
            background-color: #2b1d11;
            color: rgba(255, 255, 255, .85);
            border: transparent;
            border-radius: .5vw;
        }

        .card.total-aspirasi-internal:hover {
            border: 1px solid #4d3114;
            margin-top: -1px;
            margin-bottom: -1px;
            filter: brightness(120%);
        }

        .card.total-aspirasi-eksternal {
            background-color: #2a1215;
            color: rgba(255, 255, 255, .85);
            border: transparent;
            border-radius: .5vw;
        }

        .card.total-aspirasi-eksternal:hover {
            border: 1px solid #4c161a;
            margin-top: -1px;
            margin-bottom: -1px;
            filter: brightness(120%);
        }

        .card-header {
            font-size: 18px;
            background-color: #1d1d1d;
            color: rgba(255, 255, 255, .85);
            border-bottom: 1px solid #2d2d2d;
            border-top-left-radius: .5vw !important;
            border-top-right-radius: .5vw !important;
            align-items: center;
            min-height: 4vw;
            max-height: 4vw;
        }

        table#meeting-table tbody {
            background-color: #141414 !important;
            color: rgba(255, 255, 255, .85) !important;
        }

        table#meeting-table thead {
            background-color: #1d1d1d !important;
            color: rgba(255, 255, 255, .85) !important;
        }

        .container-fluid {
            min-height: 600px;
        }

        .c-icon {
            color: #3b89e8;
        }

        .c-icon:hover {
            color: #41b8f8;
        }

        .btn.btn-success.check_record {
            color: #56a22a;
            background-color: #162312;
            border: 1px solid #223d14;
            min-width: 5vw;
            max-width: 5vw;
        }

        .btn.btn-danger {
            color: #da3735;
            background-color: #2a1215;
            border: 1px solid #4c161a;
            min-width: 5vw;
            max-width: 5vw;
        }

        .fas.fa-check-circle {
            color: #1f8329;
        }

        .badge {
            min-width: 4vw;
        }

        .bg-hadir {
            background-color: #59a52a;
        }

        .bg-sakit {
            background-color: #26a5a3;
        }

        .bg-izin {
            background-color: #2c78da;
        }

        .bg-alfa {
            background-color: #d7862c;
        }

        .dataTables_length select {
            appearance: none;
            color: rgba(255, 255, 255, .85) !important;
            background-color: #141414 !important;
            border: 1px solid #363636 !important;
            border-radius: 5px !important;
            padding: 5px !important;
            width: 4vw !important;
        }

        .dataTables_length .custom-select::after {
            color: #141414 !important;
        }

        .dataTables_length option {
            color: rgba(255, 255, 255, .85) !important;
            background-color: #141414 !important;
        }

        .dataTables_length option:hover {
            background-color: #41b8f8 !important;
            color: #fff !important;
        }

        .dataTables_length select:focus {
            border-color: #41b8f8 !important;
            outline: 0 !important;
        }

        .dataTables_filter input {
            color: white !important;
            background-color: #141414 !important;
            border: 1px solid #363636 !important;
            border-radius: 5px !important;
            padding: 5px !important;
        }

        .dataTables_filter input::before {
            color: white !important;
        }

        .dataTables_filter input:focus {
            border-color: #41b8f8 !important;
            outline: 0 !important;
        }
    </style>
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card total-anggota">
                            <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-value-lg">{{ $user_count }}</div>
                                    <div>Total Anggota</div>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-transparent dropdown-toggle p-0" type="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg class="c-icon">
                                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item"
                                            href="{{ route('admin.users') }}">Manage User</a><a class="dropdown-item"
                                            href="{{ route('admin.meeting') }}">Presensi</a></div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                <canvas class="chart" id="card-chart1" height="70"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card total-post">
                            <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-value-lg">{{ $post_count }}</div>
                                    <div>Total Post</div>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-transparent dropdown-toggle p-0" type="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg class="c-icon">
                                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item"
                                            href="{{ route('admin.post') }}">Manage Post</a></div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                <canvas class="chart" id="card-chart2" height="70"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card total-aspirasi-internal">
                            <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-value-lg">{{ $internal }}</div>
                                    <div>Aspirasi Internal</div>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-transparent dropdown-toggle p-0" type="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg class="c-icon">
                                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item"
                                            href="{{ route('admin.aspiration.internal') }}">Manage Aspirasi Internal</a>
                                    </div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3" style="height:70px;">
                                <canvas class="chart" id="card-chart3" height="70"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card total-aspirasi-eksternal">
                            <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-value-lg">{{ $external }}</div>
                                    <div>Aspirasi External</div>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-transparent dropdown-toggle p-0" type="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg class="c-icon">
                                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item"
                                            href="{{ route('admin.aspiration.external') }}">Manage Aspirasi Eksternal</a>
                                    </div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                <canvas class="chart" id="card-chart4" height="70"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                </div>
                <!-- /.row-->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="card-title mb-0">Kehadiran Rapat</h4>
                                <div class="small text-muted"></div>
                            </div>
                        </div>
                        <div class="c-chart-wrapper" style="height:300px;margin-top:40px;">
                            <canvas class="chart" id="main-chart" height="300"></canvas>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row text-center">
                            <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                <div class="text-muted">Hadir</div>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-hadir" role="progressbar" style="width: 40%"
                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                <div class="text-muted">Izin</div>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-izin" role="progressbar" style="width: 40%"
                                        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                <div class="text-muted">Alfa</div>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-alfa" role="progressbar" style="width: 40%"
                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                <div class="text-muted">Sakit</div>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-sakit" role="progressbar" style="width: 40%"
                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="card-title mb-0">Kehadiran Rapat Per Angkatan</h4>
                            </div>
                            <div class="w-50">
                                <select name="angkatan" class="form-control" id="select-angkatan">
                                    <option value="2018">Angkatan 2018</option>
                                    <option value="2019">Angkatan 2019</option>
                                    <option value="2020">Angkatan 2020</option>
                                </select>
                            </div>
                        </div>
                        <div class="c-chart-wrapper" style="height:300px;margin-top:40px;">
                            <canvas class="chart" id="angkatan-chart" height="300"></canvas>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row text-center">
                            <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                <div class="text-muted">Hadir</div>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-hadir" role="progressbar" style="width: 40%"
                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                <div class="text-muted">Izin</div>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-izin" role="progressbar" style="width: 40%"
                                        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                <div class="text-muted">Alfa</div>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-alfa" role="progressbar" style="width: 40%"
                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                <div class="text-muted">Sakit</div>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-sakit" role="progressbar" style="width: 40%"
                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div>
                                <h4 class="card-title mb-0">Kehadiran Rapat BP</h4>
                            </div>
                        </div>
                        <div class="c-chart-wrapper" style="height:300px;margin-top:40px;">
                            <canvas class="chart" id="bp-chart" height="300"></canvas>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row text-center">
                            <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                <div class="text-muted">Hadir</div>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-hadir" role="progressbar" style="width: 40%"
                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                <div class="text-muted">Izin</div>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-izin" role="progressbar" style="width: 40%"
                                        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                <div class="text-muted">Alfa</div>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-alfa" role="progressbar" style="width: 40%"
                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                <div class="text-muted">Sakit</div>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-sakit" role="progressbar" style="width: 40%"
                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
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
@endpush
