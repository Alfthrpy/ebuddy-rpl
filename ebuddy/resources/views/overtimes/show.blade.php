@extends('layouts.base2')

@push('style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
@endpush

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

    .btn-back {
        margin-left: auto;
        margin-top: 10px;
    }

    .section-heading {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
        margin-top: 10px;
    }
</style>

{{-- <style>
    .bi {
        display: inline-block;
        width: 1.5rem;
        height: 1.5rem;
    }

    .sidebar .offcanvas-lg {
        position: sticky;
        top: 48px;
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

    .navbar-brand {
        padding-top: .75rem;
        padding-bottom: .75rem;
        background-color: rgba(0, 0, 0, .25);
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
    }

    .navbar .form-control {
        padding: .75rem 1rem;
    }

    .card-title {
        font-weight: 600;
        color: #495057;
    }

    .list-group-item {
        border: none;
        padding-left: 0;
    }

    .list-group-item strong {
        display: block;
        font-weight: 600;
        color: #333;
    }

    .container-fluid {
        background-color: #f8f9fa;
    }

    .content-wrapper {
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    .section-heading {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .section-heading .bi {
        font-size: 1.5rem;
    }

    .btn-back {
        margin-left: auto;
    }
</style> --}}

@section('base')
    @include('partials.sticky-navbar')

    <body>
        <div class="container-fluid">
            <div class="row">
                @include('partials.sidebar')

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div class="content-wrapper">
                        <div class="d-flex align-items-center mb-3">
                            <div class="section-heading">
                                <i class="bi2 bi-file-earmark-text"></i>
                                <h1 class="h2">Laporan Dinas Luar {{ $overtime->creator->name }}</h1>
                                <h5 class="mt-2">
                                    <span
                                        class="badge 
                                @if ($overtime->status == 'approved') bg-success
                                @elseif($overtime->status == 'pending')
                                    bg-warning text-dark
                                @elseif($overtime->status == 'rejected')
                                    bg-danger
                                @else
                                    bg-secondary @endif">
                                        {{ ucfirst($overtime->status) }}
                                    </span>
                                </h5>
                            </div>
                            <a href="/overtimes" class="btn btn-secondary btn-back mb-4">Kembali</a>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Informasi Dinas Luar</h5>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <strong>Tujuan Dinas Luar:</strong> {{ $overtime->objective }}
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Tempat Dinas Luar:</strong> {{ $overtime->place }}
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Tanggal Mulai:</strong> {{ $overtime->start_date }}
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Tanggal Selesai:</strong> {{ $overtime->end_date }}
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Penyetuju:</strong> {{ $overtime->approver->name }}
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Hasil Dinas Luar:</strong> {{ $overtime->result }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Komentar Penyetuju</h5>
                                        <p>{{ $overtime->comment ?? 'Tidak ada komentar' }}</p>
                                    </div>
                                </div>
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Aksi</h5>
                                        @if (auth()->user()->id == $overtime->user_id_approver)
                                            @if ($overtime->status == 'pending')
                                                <form method="POST"
                                                    action="{{ route('overtimes.approve', $overtime->id) }}">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <textarea class="form-control" name="approver_comment" placeholder="Isi komentar"></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-success">Approve</button>
                                                    <button type="submit"
                                                        formaction="{{ route('overtimes.reject', $overtime->id) }}"
                                                        class="btn btn-danger">Reject</button>
                                                </form>
                                            @elseif($overtime->status == 'approved')
                                                <div class="alert alert-success mt-3">
                                                    Laporan ini telah anda setujui.
                                                </div>
                                            @elseif($overtime->status == 'rejected')
                                                <div class="alert alert-danger mt-3">
                                                    Laporan ini telah anda tolak.
                                                </div>
                                            @endif
                                        @else
                                            @if ($overtime->status == 'approved')
                                                <div class="alert alert-success mt-3">
                                                    Laporan ini telah di-{{ $overtime->status }}.
                                                </div>
                                            @elseif($overtime->status == 'rejected')
                                                <div class="alert alert-danger mt-3">
                                                    Laporan ini ditolak!.
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                    <a href="{{ route('overtimes.download', $overtime->id) }}" class="btn btn-outline">Download PDF</a>
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
