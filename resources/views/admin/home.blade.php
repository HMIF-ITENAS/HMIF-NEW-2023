@extends('layouts.backend')

@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-primary">
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
                                            href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a
                                            class="dropdown-item" href="#">Something else here</a></div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                <canvas class="chart" id="card-chart1" height="70"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-info">
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
                                            href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a
                                            class="dropdown-item" href="#">Something else here</a></div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                <canvas class="chart" id="card-chart2" height="70"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-warning">
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
                                            href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a
                                            class="dropdown-item" href="#">Something else here</a></div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3" style="height:70px;">
                                <canvas class="chart" id="card-chart3" height="70"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-danger">
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
                                            href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a
                                            class="dropdown-item" href="#">Something else here</a></div>
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
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 40%"
                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                <div class="text-muted">Izin</div>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 40%"
                                        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                <div class="text-muted">Alfa</div>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 40%"
                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                <div class="text-muted">Sakit</div>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
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
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 40%"
                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                <div class="text-muted">Izin</div>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 40%"
                                        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                <div class="text-muted">Alfa</div>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 40%"
                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                <div class="text-muted">Sakit</div>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-->
            </div>
        </div>
    </main>
@endsection
