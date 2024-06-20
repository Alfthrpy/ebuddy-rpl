# Ebuddy

Ebuddy adalah aplikasi yang dikembangkan sebagai bagian dari tugas besar mata kuliah Rekayasa Perangkat Lunak. Aplikasi ini dirancang untuk memfasilitasi instansi pemerintah agar fleksibel dalam pembuatan surat, absensi, dan laporan dinas luar

## Fitur Utama

- **Pesan Instan**: Mengirim dan menerima pesan secara real-time.
- **Berbagi File**: Mengunggah dan mengunduh file dengan mudah.
- **Manajemen Proyek**: Membuat dan mengelola proyek, termasuk tugas dan milestone.

## Teknologi yang Digunakan

- **Frontend**: Bootstrap
- **Backend**: Laravel
- **Database**: MySQL
- **Autentikasi**: JSON Web Token (JWT)
- **Pengelolaan Versi**: Git dan GitHub

## Instalasi

Untuk menjalankan proyek ini secara lokal, ikuti langkah-langkah berikut:

1. Clone repository ini:
    ```bash
    git clone https://github.com/username/ebuddy.git
    ```
2. Masuk ke direktori proyek:
    ```bash
    cd ebuddy
    ```
3. Install dependencies dengan Composer dan npm:
    ```bash
    composer install
    npm install
    ```
4. Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
5. Jalankan migrasi untuk membuat tabel-tabel di database:
    ```bash
    php artisan migrate
    ```
6. Jalankan server Laravel:
    ```bash
    php artisan serve
    ```
7. Jalankan build untuk frontend:
    ```bash
    npm run dev
    ```

## Penggunaan

1. Buka aplikasi di browser dengan mengakses `http://localhost:8000`.
2. Daftar atau masuk ke akun Anda.
3. Mulai buat proyek, kirim pesan, dan berbagi file dengan pengguna lain.

## Kontribusi

Kami menyambut kontribusi dari siapa pun. Untuk berkontribusi, ikuti langkah-langkah berikut:

1. Fork repository ini.
2. Buat branch fitur baru:
    ```bash
    git checkout -b fitur-baru
    ```
3. Commit perubahan Anda:
    ```bash
    git commit -m 'Menambahkan fitur baru'
    ```
4. Push ke branch di fork Anda:
    ```bash
    git push origin fitur-baru
    ```
5. Buat Pull Request di GitHub.

## Anggota Kelompok

- **Anggota 1** Muhammad Rizki Al-Fathir
- **Anggota 2** Muhammad Aditya Hafizh Zahran
- **Anggota 3** Muhammad Arkan Raihan
- **Anggota 4** Michael
- **Anggota 5** Gevira Zahra Shofa
- **Anggota 6** Nazwa Hemalia Putri

## Lisensi

Proyek ini dilisensikan di bawah lisensi MIT. Lihat file `LICENSE` untuk informasi lebih lanjut.

## Kontak

Jika Anda memiliki pertanyaan atau saran, silakan hubungi kami melalui email di [alfthr@gmail.com].

---

Special thanks to all members Team 6 RPL IF22 :)
