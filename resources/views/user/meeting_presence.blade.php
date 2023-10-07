@extends('layouts.backend')

@push('styles')
@endpush

@section('content')
    <style>
        .card {
            background-color: #141414;
            color: rgba(255, 255, 255, .85);
            border: transparent;
            border-radius: .5vw;
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

        .badge.badge-primary {
            padding: 5px 10px;
            color: #59a52a;
            background-color: #162312;
            border: 1px solid #234015;
        }

        .badge.badge-primary.sakit {
            padding: 5px 10px;
            color: #26a5a3;
            background-color: #112123;
            border: 1px solid #133e3f;
        }

        .badge.badge-primary.izin {
            padding: 5px 10px;
            color: #2c78da;
            background-color: #111a2c;
            border: 1px solid #142c4f;
        }

        .badge.badge-primary.alfa {
            padding: 5px 10px;
            color: #d7862c;
            background-color: #2b1d11;
            border: 1px solid #4d3114;
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex">
                            Informasi dan Presensi Rapat Terkiniiiiii
                        </div>
                        <div class="card-body">
                            <div id="reader" width="600px"></div>
                            <form action="{{ route('user.meeting.presence.record') }}" method="post" id="search-form"
                                style="width: 100%;">
                                @csrf
                                <div class="input-group" style="width: 100%;">
                                    <input class="form-control" type="text" name="check" id="scan" autofocus
                                        readonly>
                                    <div class="input-group-append">
                                        <button class="input-group btn btn-primary" id="basic-addon2" type="submit">Check<i
                                                class="fas fa-arrow-right"
                                                style="margin-top: 5px; margin-left: 4px;"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            function onScanSuccess(decodedText, decodedResult) {
                // handle the scanned code as you like, for example:
                console.log(`Code matched = ${decodedText}`, decodedResult);
                // get element to inject QR code
                var element = document.getElementById("scan");
                // inject QR code
                element.value = decodedText;

                // after that you can automatically submit form from id="search-form"
                document.getElementById("search-form").submit();

                // and then stop scanning
                html5QrcodeScanner.clear();
                html5QrcodeScanner.stop();
            }

            function onScanFailure(error) {
                // handle scan failure, usually better to ignore and keep scanning.
                // for example:
                console.warn(`Code scan error = ${error}`);
            }

            let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", {
                    fps: 10,
                    qrbox: {
                        width: 250,
                        height: 250
                    }
                },
                /* verbose= */
                false);
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        });
    </script>
@endpush
