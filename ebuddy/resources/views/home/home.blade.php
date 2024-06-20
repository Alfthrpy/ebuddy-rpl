@extends('layouts.base')

@push('style')
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="css/carousel.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" integrity="sha512-1cK78a1o+ht2JcaW6g8OXYwqpev9+6GqOkz9xmBN9iUUhIndKtxwILGWYOSibOKjLsEdjyjZvYDq/cZwNeak0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f8f9fa;
        }

        .container.marketing {
            margin-top: 50px;
        }

        .bd-placeholder-img {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .featurette-heading {
            font-weight: 700;
        }

        .text-body-secondary {
            color: #6c757d;
        }

        .btn-secondary {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-secondary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .featurette-divider {
            border-top: 1px solid #e0e0e0;
        }

        .welcome-section {
            background: url('https://static.pajakku.com/portal/uploads/webp/f50e9a6d-af76-4b4b-951d-c847a104bc0c.webp') no-repeat center center;
            background-size: cover;
            color: white;
            text-align: center;
            padding: 100px 0;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .welcome-section h1 {
            font-size: 3em;
            font-weight: 700;
        }

        .welcome-section p {
            font-size: 1.5em;
        }
    </style>
@endpush

@section('base')
<div class="container marketing mt-5">
    <!-- Welcome Section -->
    <div class="welcome-section" data-aos="fade-up">
        <h1>Welcome to EBuddy</h1>
        <p>Your trusted companion for government services</p>
    </div>

    <!-- START THE FEATURETTES -->
    <hr class="featurette-divider">

    <div class="row featurette" data-aos="fade-right">
        <div class="col-md-7">
            <h2 class="featurette-heading fw-normal lh-1">Kemudahan Administrasi</h2>
            <p class="lead">Dengan EBuddy, nikmati kemudahan proses adminitrasi kantor seperti absensi dan persuratan dalam gengaman tangan anda.</p>
        </div>
        <div class="col-md-5">
            <img src={{ asset('storage/img/pexels-jopwell-1325765.jpg') }} class="featurette-image img-fluid mx-auto" width="500" height="500" alt="Illustration">
        </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette" data-aos="fade-left">
        <div class="col-md-5">
            <img src={{ asset('storage/img/pexels-pixabay-48195.jpg') }} class="featurette-image img-fluid mx-auto" width="500" height="500" alt="Illustration">
        </div>
        <div class="col-md-7">
            <h2 class="featurette-heading fw-normal lh-1">Buat Surat dan Laporan Dimana Saja dan Kapan Saja</h2>
            <p class="lead">Dengan EBuddy, fleksibilitas dalam bekerja semakin nyata</p>
        </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette" data-aos="fade-right">
        <div class="col-md-7">
            <h2 class="featurette-heading fw-normal lh-1">Lakukan Absensi Semudah Anda Memegang Smartphone</h2>
            <p class="lead">Dengan EBuddy, melakukan absensi menjadi lebih mudah dan praktis. Cukup gunakan smartphone Anda kapan saja, di mana saja.</p>
        </div>
        <div class="col-md-5">
            <img src={{ asset('storage/img/pexels-pavel-danilyuk-8423046.jpg') }} class="featurette-image img-fluid mx-auto" width="500" height="500" alt="Illustration">
        </div>
    </div>
</div><!-- /.container -->
    @push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js" integrity="sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        AOS.init();
    </script>
    
    @endpush
@endsection
