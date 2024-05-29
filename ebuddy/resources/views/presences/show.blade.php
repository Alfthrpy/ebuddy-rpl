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
                <div class="col-md-7">
                    <div
                        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Daftar Detail Kehadiran</h1>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <h5 class="card-title">{{ $attendance->title }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $attendance->description }}</h6>
                                    <div class="d-flex align-items-center gap-2">
                                        @include('partials.attendance-badges')
                                        <a href="{{ route('presences.not-present', $attendance->id) }}"
                                            class="badge text-bg-danger">Belum
                                            Absen</a>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-2">
                                                <small class="fw-bold text-muted d-block">Range Jam Masuk</small>
                                                <span>{{ $attendance->start_time }} -
                                                    {{ $attendance->batas_start_time }}</span>
                                            </div>
                                            <div class="mb-2">
                                                <small class="fw-bold text-muted d-block">Range Jam Pulang</small>
                                                <span>{{ $attendance->end_time }} - {{ $attendance->batas_end_time }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="mb-2">
                                                <small class="fw-bold text-muted d-block">Jabatan / Posisi</small>
                                                <div>
                                                    @foreach ($attendance->positions as $position)
                                                        <span
                                                            class="badge text-bg-success d-inline-block me-1">{{ $position->name }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <livewire:presence-table attendanceId="{{ $attendance->id }}" />
                    </div>  
                </div>
            </div>

        </div>


        @push('script')
            <script src="dashboard.js"></script>
        @endpush
    </body>
@endsection
