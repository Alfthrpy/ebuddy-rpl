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

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-3">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Data User</h1>

                        <a href="{{ route('employees.create') }}" class="btn btn-sm btn-secondary">
                            <span data-feather="plus-circle" class="align-text-bottom me-1"></span>
                            Tambah Pegawai
                        </a>

                    </div>
                    <livewire:user-table />
                </main>
            </div>
        </div>

        @push('script')
            <script src="dashboard.js"></script>
        @endpush
    </body>
@endsection
