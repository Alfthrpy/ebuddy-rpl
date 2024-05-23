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

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-3">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div
                        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Absensi</h1>

                        <a href="{{ route('attendances.create') }}" class="btn btn-sm btn-secondary">
                            <span data-feather="plus-circle" class="align-text-bottom me-1"></span>
                            Tambah Data Absensi
                        </a>

                    </div>
                    <livewire:attendance-table />
                </main>
            </div>
        </div>

        @push('script')
            <script src="dashboard.js"></script>
        @endpush
    </body>
@endsection
