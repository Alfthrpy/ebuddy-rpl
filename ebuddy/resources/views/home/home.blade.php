@extends('layouts.base')

@push('style')
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="css/carousel.css" rel="stylesheet">
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
        <div class="welcome-section">
            <h1>Welcome to EBuddy</h1>
            <p>Your trusted companion for government services</p>
        </div>

        <!-- START THE FEATURETTES -->
        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading fw-normal lh-1">Kemudahan Administrasi</h2>
                <p class="lead">Dengan EBuddy, nikmati kemudahan proses adminitrasi kantor seperti absensi dan persuratan
                    dalam gengaman tangan anda.</p>
            </div>
            <div class="col-md-5">
                <img src={{ asset('storage/img/pexels-jopwell-1325765.jpg') }} class="featurette-image img-fluid mx-auto"
                    width="500" height="500" alt="Illustration">
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-5">
                <img src={{ asset('storage/img/pexels-pixabay-48195.jpg') }} class="featurette-image img-fluid mx-auto"
                    width="500" height="500" alt="Illustration">
            </div>
            <div class="col-md-7">
                <h2 class="featurette-heading fw-normal lh-1">Buat Surat dan Laporan Dimana Saja dan Kapan Saja</h2>
                <p class="lead">Dengan EBuddy, fleksibilitas dalam bekerja semakin nyata</p>

            </div>
        </div>

        <hr class="featurette-divider">
        
        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading fw-normal lh-1">Lakukan Absensi Semudah Anda Memegang Smartphone</h2>
                <p class="lead">Dengan EBuddy, melakukan absensi menjadi lebih mudah dan praktis. Cukup gunakan smartphone Anda kapan saja, di mana saja.</p>
                
                
            </div>
            <div class="col-md-5">
                <img src={{ asset('storage/img/pexels-pavel-danilyuk-8423046.jpg') }} class="featurette-image img-fluid mx-auto"
                    width="500" height="500" alt="Illustration">
            </div>
        </div>
    </div><!-- /.container -->
@endsection
