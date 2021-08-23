@extends('layouts.backend')

@push('styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                        <a href="{{ route('admin.meeting') }}" class="btn btn-link">
                            <svg class="c-icon">
                                <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-arrow-circle-left') }}">
                                </use>
                            </svg>
                        </a>
                        <strong>Edit Rapat</strong>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin.meeting.update', $meeting->id) }}" method="post" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="title-input">Nama Rapat</label>
                                <div class="col-md-9">
                                    <input class="form-control @error('name') is-invalid @enderror" id="name-input" type="text" name="name" placeholder="Masukkan nama meeting" value="{{ old('name') ?? $meeting->name }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="title-input">Detail Rapat</label>
                                <div class="col-md-9">
                                    <input class="form-control @error('detail') is-invalid @enderror" id="detail-input" type="text" name="detail" placeholder="Masukkan detail" value="{{ old('detail') ?? $meeting->detail }}">
                                    @error('detail')
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="date-input">Pilih Kategori</label>
                                <div class="col-md-9">
                                    <select id="meeting_category" name="meeting_category_id" class="form-control @error('meeting_category_id') is-invalid @enderror">
                                        <option></option>
                                        @foreach ($meetingCategories as $category)
                                            <option value="{{ $category->id }}" @if($meeting->meeting_category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('meeting_category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="title-input">Tanggal Mulai</label>
                                <div class="col-md-9">
                                    <input id="begin_date" class="form-control @error('begin_date') is-invalid @enderror" type="text" name="begin_date" placeholder="Masukkan tanggal mulai" value="{{ old('begin_date') ?? $meeting->begin_date }}" required>
                                    @error('begin_date')
                                    <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="title-input">Jam Mulai</label>
                                <div class="col-md-9">
                                    <input id="start_meet_at" class="form-control @error('start_meet_at') is-invalid @enderror" type="time" name="start_meet_at" placeholder="Masukkan jam mulai" value="{{ old('start_meet_at') ?? $meeting->start_meet_at }}" required>
                                    @error('start_meet_at')
                                    <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="title-input">Jam Selesai</label>
                                <div class="col-md-9">
                                    <input id="end_meet_at" class="form-control @error('end_meet_at') is-invalid @enderror" type="time" name="end_meet_at" placeholder="Masukkan jam mulai" value="{{ old('end_meet_at') ?? $meeting->end_meet_at }}">
                                    @error('end_meet_at')
                                    <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="title-input">Status</label>
                                <div class="col-md-9">
                                    <select id="status" name="status" class="form-control @error('status') is-invalid @enderror">
                                        <option></option>
                                        <option value="open" @if($meeting->status == "open") selected @endif>
                                            Open
                                        </option>
                                        <option value="closed" @if($meeting->status == "closed") selected @endif>
                                            Closed
                                        </option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-9 offset-md-3">
                                    <div class="ustom-control custom-switch">
                                        <input class="custom-control-input" type="checkbox" name="presence" id="presence">
                                        <label class="custom-control-label" for="presence">
                                            Atur Jam Absensi?
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div id="start_presence_container" class="form-group row d-none">
                                <label class="col-md-3 col-form-label" for="title-input">Jam Mulai Absensi</label>
                                <div class="col-md-9">
                                    <input id="start_presence" class="form-control @error('start_presence') is-invalid @enderror" type="time" name="start_presence" placeholder="Masukkan absen mulai" value="{{ old('start_presence') ?? $meeting->start_presence }}">
                                    @error('start_presence')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div id="end_presence_container" class="form-group row d-none">
                                <label class="col-md-3 col-form-label" for="title-input">Jam Selesai Absensi</label>
                                <div class="col-md-9">
                                    <input id="end_presence" class="form-control @error('end_presence') is-invalid @enderror" type="time" name="end_presence" placeholder="Masukkan absen mulai" value="{{ old('end_presence') ?? $meeting->end_presence }}">
                                    @error('end_presence')
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
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js" integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function() {
            $("#begin_date").datepicker({
                dateFormat: 'yy-mm-dd',
            });
        })

        $('#begin_date').on('keydown keyup change', function(e) {
            e.preventDefault();
            return false;
        })

        $("#meeting_category, #status").select2({
            theme: 'bootstrap4',
            placeholder: "-Pilih-",
            allowClear: true
        })
        let start_presence = $("#start_presence").val()
        let end_presence = $("#end_presence").val()
        let start_meet_at = $("#start_meet_at").val()
        let end_meet_at = $("#end_meet_at").val()
        // jika user memilih jenis
        $(document).on('change', '#presence', function() {
            let isChecked = $(this).is(':checked')
            if(isChecked){
                console.log("Checked")
                start_meet_at = $("#start_meet_at").val()
                end_meet_at = $("#end_meet_at").val()
                $("#start_presence_container").removeClass("d-none")
                $("#start_presence").prop('required',true)
                $("#end_presence_container").removeClass("d-none")
                $("#end_presence").prop('required',true)
            }else{
                console.log("Not Checked")
                start_presence = $("#start_presence").val()
                end_presence = $("#end_presence").val()
                $("#start_presence_container").addClass("d-none")
                $("#start_presence").prop('required',false)
                $("#end_presence_container").addClass("d-none")
                $("#end_presence").prop('required',false)
            }
        })
    </script>
@endpush

