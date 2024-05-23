@extends('layouts.base2')

@push('style')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@endpush

@section('base')

@include('partials.sticky-navbar')
<body>
    <div class="container-fluid">
        <div class="row">
            @include('partials.sidebar')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                    @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                </div>
                <div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h6 class="fs-6 fw-light">Data Jabatan</h6>
                                    <h4 class="fw-bold">{{ $positionCount }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h6 class="fs-6 fw-light">Data Karyawan</h6>
                                    <h4 class="fw-bold">{{ $userCount }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    @push('script')
    <script src="dashboard.js"></script>
    @endpush
</body>
@endsection
