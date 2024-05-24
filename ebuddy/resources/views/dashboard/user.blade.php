@extends('layouts.base2')

{{-- @push('style')
    <link href="css/dashboard.css" rel="stylesheet">
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

                    <div
                        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Selamat Datang {{ auth()->user()->name }}</h1>
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                    <div class="container py-2">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card shadow-sm mb-2">
                                    <div class="card-header">
                                        Daftar Absensi Hari Ini
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group">
                                            @foreach ($attendances as $attendance)
                                                <a href="{{ route('dashboard.show', $attendance->id) }}"
                                                    class="list-group-item d-flex justify-content-between align-items-start py-3">
                                                    <div class="ms-2 me-auto">
                                                        <div class="fw-bold">{{ $attendance->title }}</div>
                                                        <p class="mb-0">{{ $attendance->description }}</p>
                                                    </div>
                                                    @include('partials.attendance-badges')
                                                </a>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card shadow-sm">
                                    <div class="card-header">
                                        Informasi Karyawan
                                    </div>
                                    <div class="card-body">
                                        <ul class="ps-3">
                                            <li class="mb-1">
                                                <span class="fw-bold d-block">Nama : </span>
                                                <span>{{ auth()->user()->name }}</span>
                                            </li>
                                            <li class="mb-1">
                                                <span class="fw-bold d-block">Email : </span>
                                                <a href="mailto:{{ auth()->user()->email }}">{{ auth()->user()->email }}</a>
                                            </li>
                                            <li class="mb-1">
                                                <span class="fw-bold d-block">No. Telp : </span>
                                                <a href="tel:{{ auth()->user()->phone }}">{{ auth()->user()->phone }}</a>
                                            </li>
                                            <li class="mb-1">
                                                <span class="fw-bold d-block">Bergabung Pada : </span>
                                                <span>{{ auth()->user()->created_at->diffForHumans() }}
                                                    ({{ auth()->user()->created_at->format('d M Y') }})</span>
                                            </li>
                                        </ul>
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
