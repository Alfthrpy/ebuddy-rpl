@extends('layouts.base2')

{{-- @push('style')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@endpush --}}

<style>
    .bi {
        display: inline-block;
        width: 1rem;
        height: 1rem;
    }

    /*
 * Sidebar
 */

    @media (min-width: 768px) {
        .sidebar .offcanvas-lg {
            position: -webkit-sticky;
            position: sticky;
            top: 48px;
        }

        .navbar-search {
            display: block;
        }
    }

    .sidebar .nav-link {
        font-size: .875rem;
        font-weight: 500;
    }

    .sidebar .nav-link.active {
        color: #2470dc;
    }

    .sidebar-heading {
        font-size: .75rem;
    }

    /*
 * Navbar
 */

    .navbar-brand {
        padding-top: .75rem;
        padding-bottom: .75rem;
        background-color: rgba(0, 0, 0, .25);
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
    }

    .navbar .form-control {
        padding: .75rem 1rem;
    }
</style>

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

                    <div class="row">
                        <div class="col-md-3 mb-4">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                    <h6 class="card-title">Data Jabatan</h6>
                                    <h4 class="card-text">{{ $positionCount }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card bg-success text-white shadow">
                                <div class="card-body">
                                    <h6 class="card-title">Data Karyawan</h6>
                                    <h4 class="card-text">{{ $userCount }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card   shadow">
                                <div class="card-body">
                                    <h6 class="card-title">Surat Dibuat</h6>
                                    <h4 class="card-text">{{ $letterCount }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card   shadow">
                                <div class="card-body">
                                    <h6 class="card-title">Laporan Dibuat</h6>
                                    <h4 class="card-text">{{ $overtimeCount }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card shadow border-primary">
                                <div class="card-body">
                                    <h6 class="card-title text-primary">
                                        <i class="fas fa-users"></i> User Terbaru
                                    </h6>
                                    <ul class="list-unstyled">
                                        @foreach ($latestUsers as $user)
                                            <li class="mb-3">
                                                <h4 class="fw-bold text-secondary">
                                                    <i class="fas fa-user"></i> {{ $user->name }}
                                                </h4>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card shadow border-success">
                                <div class="card-body">
                                    <h6 class="card-title text-success">
                                        <i class="fas fa-briefcase"></i> Jabatan Terbaru
                                    </h6>
                                    <ul class="list-unstyled">
                                        @foreach ($latestPositions as $position)
                                            <li class="mb-3">
                                                <h4 class="fw-bold text-secondary">
                                                    <i class="fas fa-id-badge"></i> {{ $position->name }}
                                                </h4>
                                            </li>
                                        @endforeach
                                    </ul>
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
