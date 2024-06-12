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
                                <h1 class="h2">Surat {{ $letter->subject }} oleh {{ $letter->creator->name }}</h1>
                                <h5 class="mt-2">
                                    <span
                                        class="badge 
                                @if ($letter->status == 'approved') bg-success
                                @elseif($letter->status == 'pending')
                                    bg-warning text-dark
                                @elseif($letter->status == 'rejected')
                                    bg-danger
                                @else
                                    bg-secondary @endif">
                                        {{ ucfirst($letter->status) }}
                                    </span>
                                </h5>
                            </div>
                            <a href="/letters" class="btn btn-secondary btn-back mb-4">Kembali</a>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <iframe id="letter-iframe" style="width: 100%; height: 100vh; border: none;"></iframe>
                            </div>

                            <div class="col-md-4">
                                <div class="card shadow-sm mb-4">
                                    <div class="card-header">
                                        <h5 class="card-title">Komentar Penyetuju</h5>
                                    </div>
                                    <div class="card-body">

                                        <p>{{ $letter->comment ?? 'Tidak ada komentar' }}</p>
                                    </div>
                                </div>
                                <div class="card shadow-sm mb-4">
                                    <div class="card-header">
                                        <h5 class="card-title">Aksi</h5>
                                    </div>
                                    <div class="card-body">
                                        @if (auth()->user()->id == $letter->user_id_approver)
                                            @if ($letter->status == 'pending')
                                                <form method="POST" action="{{ route('letters.approve', $letter->id) }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <textarea class="form-control" name="approver_comment" placeholder="Isi komentar"></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="signature">Tanda Tangan</label>
                                                        <input type="file" class="form-control" name="signature"
                                                            id="signature" accept="image/*">
                                                    </div>
                                                    <button type="submit" class="btn btn-success">Approve</button>
                                                    <button type="submit"
                                                        formaction="{{ route('letters.reject', $letter->id) }}"
                                                        class="btn btn-danger">Reject</button>
                                                </form>
                                            @elseif($letter->status == 'approved')
                                                <div class="alert alert-success mt-3">
                                                    Surat ini telah anda setujui.
                                                </div>
                                            @elseif($letter->status == 'rejected')
                                                <div class="alert alert-danger mt-3">
                                                    Surat ini telah anda tolak.
                                                </div>
                                            @endif
                                        @else
                                            @if ($letter->status == 'approved')
                                                <div class="alert alert-success mt-3">
                                                    Surat ini telah di-{{ $letter->status }}.
                                                </div>
                                            @elseif($letter->status == 'rejected')
                                                <div class="alert alert-danger mt-3">
                                                    Surat ini ditolak!.
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        @push('script')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var content = @json($content);
                    console.log(content);
                    var iframe = document.getElementById('letter-iframe');
                    var iframeDoc = iframe.contentDocument || iframe.contentWindow.document;

                    iframeDoc.open();
                    iframeDoc.write(content);
                    iframeDoc.close();
                });
            </script>
        @endpush
    </body>


@endsection
