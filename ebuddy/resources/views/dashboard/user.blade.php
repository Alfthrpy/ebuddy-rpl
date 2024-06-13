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
        <div class="container-fluid bg-light">
            <div class="row">
                @include('partials.sidebar')

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Selamat Datang {{ auth()->user()->name }}</h1>
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                    <div class="container py-2">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card shadow-sm mb-2 border-primary">
                                    <div class="card-header bg-primary text-white">
                                        <i class="bi bi-calendar-check"></i> Daftar Absensi Hari Ini
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group">
                                            @forelse ($attendances as $attendance)
                                                <a href="{{ route('dashboard.show', $attendance->id) }}" class="list-group-item d-flex justify-content-between align-items-start py-3 border rounded">
                                                    <div class="ms-2 me-auto">
                                                        <div class="fw-bold">{{ $attendance->title }}</div>
                                                        <p class="mb-0">{{ $attendance->description }}</p>
                                                    </div>
                                                    @include('partials.attendance-badges')
                                                </a>
                                            @empty
                                                <div class="list-group-item">Tidak ada Absensi</div>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col mt-3 mb-3">
                                        <div class="card shadow-sm border-success">
                                            <div class="card-header bg-success text-white">
                                                <h5 class="mb-0"><i class="bi bi-file-earmark-check"></i> Surat yang Baru Disetujui</h5>
                                            </div>
                                            <div class="card-body">
                                                @if ($latestApprovedLetter)
                                                <a href="{{ route('letters.show', $latestApprovedLetter->id) }}" class="list-group-item d-flex justify-content-between align-items-start py-3 border rounded">
                                                    <div class="ms-2 me-auto">
                                                        <div class="fw-bold">{{ $latestApprovedLetter->subject }}</div>
                                                        <p class="mb-0">{{ $latestApprovedLetter->no_letter }}</p>
                                                    </div>
                                                </a>
                                                    <div class="mb-0">
                                                        <span class="fw-bold">Diperbarui pada:</span>
                                                        <div>{{ $latestApprovedLetter->updated_at->format('l, d M Y') }}</div>
                                                    </div>
                                                @else
                                                    <div>Tidak ada surat yang telah disetujui.</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col mt-3 mb-3">
                                        <div class="card shadow-sm border-success">
                                            <div class="card-header bg-success text-white">
                                                <h5 class="mb-0"><i class="bi bi-file-earmark-text"></i> Laporan yang Baru Disetujui</h5>
                                            </div>
                                            <div class="card-body">
                                                @if ($latestApprovedOvertime)
                                                <a href="{{ route('overtimes.show', $latestApprovedOvertime->id) }}" class="list-group-item d-flex justify-content-between align-items-start py-3 border rounded">
                                                    <div class="ms-2 me-auto">
                                                        <div class="fw-bold">{{ $latestApprovedOvertime->objective }}</div>
                                                        <p class="mb-0">{{ $latestApprovedOvertime->place }}</p>
                                                    </div>
                                                </a>
                                                    <div class="mb-0">
                                                        <span class="fw-bold">Diperbarui pada:</span>
                                                        <div>{{ $latestApprovedOvertime->updated_at->format('l, d M Y') }}</div>
                                                    </div>
                                                @else
                                                    <div>Tidak ada laporan yang telah disetujui.</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>





                            </div>
                            <div class="col-md-4">
                                <div class="card shadow-sm mb-2">
                                    <div class="card-header ">
                                        <i class="bi bi-person-badge"></i> Informasi Karyawan
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
                                                <span>{{ auth()->user()->created_at->diffForHumans() }} ({{ auth()->user()->created_at->format('d M Y') }})</span>
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

