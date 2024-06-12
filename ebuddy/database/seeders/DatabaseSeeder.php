<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Position;
use App\Models\Role;
use App\Models\Overtime;
use App\Models\Letter;
use App\Models\Template;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memasukkan data roles terlebih dahulu
        $role1 = Role::create([
            'name' => 'Admin',
        ]);
        $role2 = Role::create([
            'name' => 'Pejabat',
        ]);
        $role3 = Role::create([
            'name' => 'Pegawai',
        ]);

        // Memasukkan data position
        $position1 = Position::create([
            'name' => 'staff',
        ]);

        $position2 = Position::create([
            'name' => 'Sekretaris',
        ]);

        // Memasukkan data user
        $user1 = User::create([
            'name' => 'Pegawai1',
            'email' => 'pegawai1@gmail.com',
            'password' => bcrypt('password'),
            'phone' => '123-456-789',
            'role_id' => 3, // nilai role_id harus sesuai dengan data yang ada di tabel roles
            'position_id' => 1,
        ]);

        $user2 = User::create([
            'name' => 'Pejabat1',
            'email' => 'pejabat1@gmail.com',
            'phone' => '124-356-789',
            'password' => bcrypt('password'),
            'role_id' => 2, // nilai role_id harus sesuai dengan data yang ada di tabel roles
            'position_id' => 2,
        ]);

        $user3 = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '143-256-789',
            'password' => bcrypt('password'),
            'role_id' => 1, // nilai role_id harus sesuai dengan data yang ada di tabel roles
            'position_id' => 1,
        ]);

        $template1 = Template::create([
            'nama_template' => 'Surat Pengumuman',
            'template' => '<!DOCTYPE html>
        <html lang="en">
        
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Surat Pengumuman</title>
            <style>
                body {
                    font-family: \'Times New Roman\', Times, serif;
                }
        
                .container {
                    width: 600px;
                    margin: 0 auto;
                    border: 1px solid #ccc;
                    padding: 20px;
                }
        
                h1,
                h2,
                h3,
                h4,
                h5,
                h6 {
                    font-weight: bold;
                }
        
                .header {
                    text-align: center;
                    margin-bottom: 15px;
                    border-bottom: 2px solid #000;
                    padding-bottom: 10px;
                    line-height: 0.5;
                    display: flex;
                    align-items: center;
                }
        
                .header img {
                    width: 80px;
                    height: auto;
                    margin-right: 10px;
                }
        
                .header-text {
                    text-align: center;
                    flex: 1;
                    font-size: small;
                }
        
                .titimangsa {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }
        
                .info {
                    display: flex;
                    margin-bottom: 2px;
                }
        
                .info .label {
                    width: 100px;
                    font-weight: bold;
                }
        
                .info .value::before {
                    content: ": ";
                    padding-right: 5px;
                }
        
                .content {
                    margin-bottom: 15px;
                    line-height: 1.2;
                    text-align: justify;
                }
        
                .signature-grid {
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    justify-items: center;
                    align-items: center;
                    margin-top: 20px;
                    gap: 50px;
                }
        
                .signature {
                    text-align: center;
                    margin-top: 20px;
                    line-height: 0.3;
                }
        
                .signature .name {
                    font-weight: bold;
                }
        
                .signature .title,
                .signature .nip {
                    font-size: 12px;
                }
        
                .signature .nip {
                    margin-top: 5px;
                }
        
                .signature img {
                    width: 120px;
                    height: auto;
                    margin-top: 10px;
                }
            </style>
        </head>
        
        <body>
            <div class="container">
                <div class="header">
                    <img src="http://127.0.0.1:8000/storage/logo/logo.jpeg" alt="Company Logo">
                    <div class="header-text">
                        <h2>PEMERINTAH KOTA SIDOARJO</h2>
                        <h1>DINAS PEMERINTAHAN</h1>
                        <p>Jl. Ki Hajar Dewantara No. 20, Medan, 20028. Email: pendidikan@medan.go.id</p>
                    </div>
                </div>
                <div class="titimangsa">
                    <div class="info">
                        <div class="label">No</div>
                        <div class="value">{{no_letter}}</div>
                    </div>
                    <div class="date">
                        <p>{{date_out}}</p>
                    </div>
                </div>
                <div class="info">
                    <div class="label">Lampiran</div>
                    <div class="value">{{attachment}}</div>
                </div>
                <div class="info">
                    <div class="label">Perihal</div>
                    <div class="value">{{subject}}</div>
                </div>
                <div class="content">
                    <p>Yth, {{destination}}</p>
                    <p>{{destination_position}}</p>
                    <p>di tempat</p>
                    <p>Dengan hormat,</p>
                    <p>{{content}}</p>
                </div>
                <div class="signature-grid">
                    <div class="signature">
                        <p>Hormat Kami,</p>
                        <img src="{{wm_creator}}" alt="Signature Image">
                        <p class="name">{{creator_name}}</p>
                        <p class="title">{{creator_position}}</p>
                        <p class="nip">{{creator_id}}</p>
                    </div>
                    <div class="signature">
                        <p>Mengetahui,</p>
                        <img src="{{wm_approver}}" alt="Signature Image">
                        <p class="name">{{approver_name}}</p>
                        <p class="title">{{approver_position}}</p>
                        <p class="nip">{{approver_id}}</p>
                    </div>
                </div>
            </div>
        </body>
        
        </html>'
        ]);
        
        

        // Uncomment baris berikut jika ingin membuat user menggunakan factory
        User::factory(10)->create();
        Overtime::factory(10)->create();
        Letter::factory(10)->create();
    }
}