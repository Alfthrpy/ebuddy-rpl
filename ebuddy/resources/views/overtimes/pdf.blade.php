<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Dinas Luar</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 20px;
        }

        .header img {
            width: 80px;
            height: auto;
            margin-right: 10px;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .header .subtitle {
            font-size: 14px;
        }

        .info-section {
            margin-top: 20px;
        }

        .info-section .label {
            font-weight: bold;
            display: inline-block;
            width: 200px;
        }

        .info-section .value {
            display: inline-block;
        }

        .section-title {
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 10px;
        }

        .signature-section {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }

        .signature-section div {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="storage/logo/logo.jpeg" alt="Company Logo">
            <div class="header-text">
                <h2>LAPORAN DINAS LUAR</h2>
                <h1>DINAS PEMERINTAHAN</h1>
                <p>Jl. Ki Hajar Dewantara No. 20, Medan, 20028. Email: pendidikan@medan.go.id</p>
            </div>
        </div>



        <div class="info-section">
            <div class="label">Tujuan Kegiatan:</div>
            <div class="value">{{ $objective }}</div>
        </div>

        <div class="info-section">
            <div class="label">Nama Petugas:</div>
            <div class="value">{{ $creator }}</div>
        </div>

        <div class="info-section">
            <div class="label">Tempat Pelaksanaan:</div>
            <div class="value">{{ $place }}</div>
        </div>

        <div class="info-section">
            <div class="label">Tanggal Dimulai</div>
            <div class="value">{{ $start_date }}</div>
        </div>

        <div class="info-section">
            <div class="label">Tanggal selesai</div>
            <div class="value">{{ $end_date }}</div>
        </div>

        <div class="info-section section-title">Hasil Kegiatan:</div>
        <div class="info-section">
            <div class="value">{{ $result }}</div>
        </div>
 

        <div class="signature-section">
            <div>
                Mengetahui,<br>{{ $approver }}<br><br><br>
            </div>
        </div>
    </div>
</body>

</html>
