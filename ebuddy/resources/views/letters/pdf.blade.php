<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pengumuman</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 20px;
        }

        .container {
            width: 600px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
        }

        h1, h2 {
            font-weight: bold;
            margin: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            line-height: 1;
        }

        .header img {
            width: 80px;
            height: auto;
            margin-right: 10px;
            float: left;
        }

        .header-text {
            text-align: center;
            font-size: small;
        }

        .titimangsa {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .date {
            text-align: right;
            flex: 1;
        }

        .info {
            text-align: left;
            margin-bottom: 5px;
            flex: 1;
        }

        .info .label {
            font-weight: bold;
            display: inline-block;
            width: 80px;
        }

        .info .value {
            display: inline-block;
        }

        .content {
            margin-top: 20px;
            line-height: 1.5;
        }

        .signature-row {
            text-align: center;
            margin-top: 40px;
        }

        .signature {
            display: inline-block;
            text-align: center;
            margin-top: 20px;
            width: 45%;
            vertical-align: top;
        }

        .signature .name {
            font-weight: bold;
        }

        .signature .title, .signature .nip {
            font-size: 12px;
        }

        .signature img {
            width: 120px;
            height: auto;
            margin-top: 10px;
        }

        .signature:not(:last-child) {
            margin-right: 10%;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="storage/logo/logo.jpeg" alt="Company Logo">
            <div class="header-text">
                <h2>PEMERINTAH KOTA SIDOARJO</h2>
                <h1>DINAS PEMERINTAHAN</h1>
                <p>Jl. Ki Hajar Dewantara No. 20, Medan, 20028. Email: pendidikan@medan.go.id</p>
            </div>
        </div>
        <div class="titimangsa">
            <div class="date">
                <p>{{ $date_out }}</p>
            </div>
            <div class="info">
                <div class="label">No : </div>
                <div class="value">{{ $no_letter }}</div>
            </div>
        </div>
        <div class="info">
            <div class="label">Lampiran : </div>
            <div class="value">{{ $attachment }}</div>
        </div>
        <div class="info">
            <div class="label">Perihal : </div>
            <div class="value">{{ $subject }}</div>
        </div>
        <div class="content">
            <p>Yth, {{ $destination }}</p>
            <p>{{ $destination_position }}</p>
            <p>di tempat</p>
            <p>Dengan hormat,</p>
            <p>{{ $content }}</p>
        </div>
        <div class="signature-row">
            <div class="signature">
                <p>Hormat Kami,</p>
                <img src="{{$wm_creator}}" alt="Signature Image">
                <p class="name">{{ $creator_name }}</p>
                <p class="title">{{ $creator_position }}</p>
                <p class="nip">{{ $creator_id }}</p>
            </div>
            <div class="signature">
                <p>Mengetahui,</p>
                <img src="{{ $wm_approver }}" alt="Signature Image">
                <p class="name">{{ $approver_name }}</p>
                <p class="title">{{ $approver_position }}</p>
                <p class="nip">{{ $approver_id }}</p>
            </div>
        </div>
    </div>
</body>

</html>
