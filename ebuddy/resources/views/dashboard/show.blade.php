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
                    <div class="container py-5">
                        <div class="row">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <div class="mb-2">
                                    @include('partials.attendance-badges')
                                </div>
                                @include('partials.alerts')
                    
                                <h1 class="fs-2">{{ $attendance->title }}</h1>
                                <p class="text-muted">{{ $attendance->description }}</p>
                                <livewire:presence-form :attendance="$attendance" :data="$data">
                                
                                <div class="mb-4">
                                    <span class="badge text-bg-light border shadow-sm">Masuk : {{
                                        substr($attendance->data->start_time, 0 , -3) }} - {{
                                        substr($attendance->data->batas_start_time,0,-3 )}}</span>
                                    <span class="badge text-bg-light border shadow-sm">Pulang : {{
                                        substr($attendance->data->end_time, 0 , -3) }} - {{
                                        substr($attendance->data->batas_end_time,0,-3 )}}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5 class="mb-3">Histori 30 Hari Terakhir</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Jam Masuk</th>
                                                <th scope="col">Jam Pulang</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($priodDate as $date)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                {{-- not presence / tidak hadir --}}
                                                @php
                                                $histo = $history->where('presence_date', $date)->first();
                                                @endphp
                                                @if (!$histo)
                                                <td>{{ $date }}</td>
                                                <td colspan="3">
                                                    @if($date == now()->toDateString())
                                                    <div class="badge text-bg-info">Belum Hadir</div>
                                                    @else
                                                    <div class="badge text-bg-danger">Tidak Hadir</div>
                                                    @endif
                                                </td>
                                                @else
                                                <td>{{ $histo->presence_date }}</td>
                                                <td>{{ $histo->presence_enter_time }}</td>
                                                <td>@if($histo->presence_out_time)
                                                    {{ $histo->presence_out_time }}
                                                    @else
                                                    <span class="badge text-bg-danger">Belum Absensi Pulang</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="badge text-bg-success">Hadir</div>
                                                </td>
                                                @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div

                </main>
            </div>
        </div>

        @push('script')
            <script src="dashboard.js"></script>
        @endpush
    </body>
@endsection
