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
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div
                        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Pegawai yang tidak hadir</h1>

                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <h5 class="card-title">{{ $attendance->title }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $attendance->description }}</h6>
                                    <div class="d-flex align-items-center gap-2">
                                        <span href="" class="badge text-bg-warning">Tidak Hadir</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <form action="" method="get">
                                        <div class="mb-3">
                                            <label for="filterDate" class="form-label fw-bold">Tampilkan Berdasarkan
                                                Tanggal</label>
                                            <div class="input-group mb-3">
                                                <input type="date" class="form-control" id="filterDate"
                                                    name="display-by-date" value="{{ request('display-by-date') }}">
                                                <button class="btn btn-primary" type="submit"
                                                    id="button-addon1">Tampilkan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (count($notPresentData) === 0)
                        <small class="text-danger fw-bold">Tidak ada data yang bisa ditampilkan, <a href="">Tampilkan
                                data berdasarkan hari
                                ini.</a></small>
                    @endif


                    <div>
                        @foreach ($notPresentData as $data)
                            <div class="p-3 rounded bg-light border my-3 d-flex align-items-center justify-content-between">
                                <div>Hari : <span class="fw-bold">
                                        {{ \Carbon\Carbon::parse($data['not_presence_date'])->dayName }}
                                        {{ \Carbon\Carbon::parse($data['not_presence_date'])->isCurrentDay() ? '(Hari ini)' : '' }}
                                    </span>
                                </div>
                                <div>Tanggal : <span class="fw-bold">{{ $data['not_presence_date'] }}</span></div>
                                <div>Jumlah : <span class="fw-bold">{{ count($data['users']) }}</span></div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Karyawan</th>
                                            <th scope="col">Kontak</th>
                                            <th scope="col">Posisi</th>
                                            <th scope="col">Handle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['users'] as $user)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $user['name'] }}</td>
                                                <td>
                                                    <a href="mailto:{{ $user['email'] }}">{{ $user['email'] }}</a>
                                                    <span class="fw-bold"> / </span>
                                                    <a href="tel:{{ $user['phone'] }}">{{ $user['phone'] }}</a>
                                                </td>
                                                <td>{{ $user['position']['name'] }}</td>
                                                <td>
                                                    <form action="{{ route('presences.present', $attendance->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{ $user['id'] }}">
                                                        <input type="hidden" name="presence_date"
                                                            value="{{ $data['not_presence_date'] }}">
                                                        <button class="badge text-bg-primary border-0"
                                                            type="submit">Hadir</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>
                </main>
            </div>
        </div>

        @push('script')
            <script src="dashboard.js"></script>
        @endpush
    </body>
@endsection
