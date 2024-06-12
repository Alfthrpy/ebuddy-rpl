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

    /* Custom styles for the report buttons */
    .report-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .report-buttons button {
        font-size: 0.875rem;
        padding: 0.5rem 1rem;
    }

    @media (max-width: 576px) {
        .report-buttons button {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }
    }
</style>

@section('base')
    @include('partials.sticky-navbar')

    <body>
        <div class="container-fluid">
            <div class="row">
                @include('partials.sidebar')

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div
                        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <div class="d-flex align-items-center">
                            <h1 class="h2">Laporan Dinas Luar</h1>
                        </div>
                        <div class="report-buttons">
                            <button type="button" class="btn btn-primary"
                                onclick="window.location.href='/overtimes/report/all'">Semua Laporan</button>
                            <button type="button" class="btn btn-secondary"
                                onclick="window.location.href='/overtimes/report/me'">Laporan Saya</button>
                            @if (auth()->user()->role_id == 2 || auth()->user()->role_id == 1)
                                <button type="button" class="btn btn-warning"
                                    onclick="window.location.href='/overtimes/report/pending'">Laporan yang perlu persetujuan</button>
                            @endif()
                        </div>
                    </div>
                    <livewire:overtime-table :condition="request()->condition ?? 'me'" />
                </main>
            </div>
        </div>

        @push('script')
            <script src="dashboard.js"></script>
        @endpush
    </body>
@endsection
