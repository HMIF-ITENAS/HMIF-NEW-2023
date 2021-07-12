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
    @if (session('success'))
        <div class="success-session" data-flashdata="{{ session('success') }}"></div>
    @elseif (session('danger'))    
        <div class="danger-session" data-flashdata="{{ session('danger') }}"></div>
    @endif
    <div class="container-fluid">
      <div class="fade-in">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('user.home') }}" class="btn btn-link">
                    <svg class="c-icon">
                        <use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-arrow-circle-left') }}">
                        </use>
                    </svg>
                </a>
                <strong>Detail User</strong>
            </div>
            <div class="card-body">
              <form class="form-horizontal">
                @csrf
                <div class="form-group row">
                  <label class="col-md-3 col-form-label" for="title-input">Nama</label>
                  <div class="col-md-9">
                    {{ $user->name }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 col-form-label" for="title-input">NRP</label>
                  <div class="col-md-9">
                    {{ $user->nrp }}
                  </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="title-input">Angkatan</label>
                    <div class="col-md-9">
                      <p>{{ $user->angkatan }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="title-input">Email</label>
                    <div class="col-md-9">
                      <p>{{ $user->email }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="title-input">Nomor Handphone</label>
                    <div class="col-md-9">
                      <p>{{ $user->handphone ?? "Belum Ada" }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="title-input">Alamat</label>
                    <div class="col-md-9">
                      <p>{{ $user->address ?? "Belum Ada" }}</p>
                    </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 col-form-label" for="title-input">Email Verified</label>
                  <div class="col-md-9">
                    @if($user->email_verified_at != null)
                      Verified
                    @else
                      Not Verified
                    @endif
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 col-form-label" for="title-input">Status</label>
                  <div class="col-md-9">
                    @if($user->status === 'active')
                        <!-- <span class="badge rounded-pill px-3 py-2 bg-info text-white"> -->
                            Active
                        <!-- </span> -->
                    @else
                        <!-- <span class="badge rounded-pill px-3 py-2 bg-success text-white"> -->
                            Non-Active
                        <!-- </span> -->
                    @endif
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 col-form-label" for="title-input">Level</label>
                  <div class="col-md-9">
                    @if($user->level === 'admin')
                        <!-- <span class="badge rounded-pill px-3 py-2 bg-info text-white"> -->
                            Admin
                        <!-- </span> -->
                    @else
                        <!-- <span class="badge rounded-pill px-3 py-2 bg-success text-white"> -->
                            User
                        <!-- </span> -->
                    @endif
                  </div>
                </div>          
                <!-- <div class="form-group row">
                  <label class="col-md-3 col-form-label" for="title-input">Dibuat</label>
                  <div class="col-md-9">
                        <p>{{ $user->created_at->diffForHumans() }}</p>
                  </div>
                </div> -->
                <div class="card-footer">
                  <a href="{{ route('profile.edit', $user) }}" class="btn btn-primary">
                      Edit
                  </a>
                </div>
            </form>
          </div>
      </div>
    </div>
</main>
@endsection

@push('scripts')
<!-- select2 -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.25/b-1.7.1/b-html5-1.7.1/b-print-1.7.1/fh-3.1.9/r-2.2.9/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.5/dist/sweetalert2.all.min.js" integrity="sha256-NHQE05RR3vZ0BO0PeDxbN2N6dknQ7Z4Ch4Vfijn9Y+0=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
            let flashdatasukses = $('.success-session').data('flashdata');
            let flashdatagagal = $('.danger-session').data('flashdata');
            if (flashdatasukses) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: flashdatasukses,
                    type: 'success'
                })
            }
            if (flashdatagagal) {
                Swal.fire({
                    icon: 'error',
                    title: 'Danger!',
                    text: flashdatagagal,
                    type: 'error'
                })
            }
      })

</script>
@endpush

