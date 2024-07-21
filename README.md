# TECHNICAL TEST - Fullstack Developer - PT. Sekawan Media (Aplikasi Pemesanan Kendaraan)

## Description Test

Sebuah perusahaan tambang nikel membutuhkan sebuah aplikasi web untuk memonitoring kendaraan perusahaan. Aplikasi ini memungkinkan admin untuk menginput pemesanan kendaraan, menentukan driver, dan pihak yang menyetujui pemesanan. Persetujuan dilakukan berjenjang minimal dua level dan pihak yang menyetujui dapat melakukan persetujuan melalui aplikasi. Terdapat juga dashboard untuk menampilkan grafik pemakaian kendaraan dan laporan periodik pemesanan kendaraan yang dapat di-export dalam format Excel.

## Fitur Utama

### 1. Manajemen Pengguna:

Admin

Pihak yang menyetujui (Manager)

### 2. Pemesanan Kendaraan:

Admin dapat menginput pemesanan, menentukan driver, dan pihak yang menyetujui.

### 3. Persetujuan Berjenjang:

Persetujuan pemesanan dilakukan minimal dua level.

### 4. Dashboard:

Menampilkan grafik pemakaian kendaraan.

### 5. Laporan Periodik:

Laporan pemesanan kendaraan yang dapat diekspor ke Excel.

### 6. Log Aplikasi:

Setiap proses dalam aplikasi dicatat untuk keperluan audit.

## Teknologi yang Digunakan

Database: Postgresql 16 dan PGAdmin4

PHP: 8.2

Framework: Laravel 11.9, Jetstream

Front-end: Tailwind CSS, DaisyUI, Node.Js, Sweet Alert

Charts: Chart.js

Excel Export: Laravel Excel

## Panduan Penggunaan Aplikasi

### 1. Clone Repository

    git clone https://github.com/MuhamadAgungGumelar/vehicle-booking-app

### 2. Install Dependencies

    composer install
    npm install
    npm run dev

### 3. Setup Environment

Atur konfigurasi database postgresql dan mail yang digunakan sesuai environment yang dimiliki pada file .env

    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=(sesuaikan dengan nama database yang dimiliki)
    DB_USERNAME=(sesuaikan dengan user database yang dimiliki)
    DB_PASSWORD=(sesuiakan dengan password database yang dimiliki)

    MAIL_MAILER=smtp
    MAIL_HOST=sandbox.smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=(sesuaikan dengan username mailtrap yang dimiliki)
    MAIL_PASSWORD=(sesuaikan dengan password mailtrap yang dimiliki)
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS=(sesuaikan dengan email mailtrap yang dimiliki)
    MAIL_FROM_NAME=(sesuaikan dengan nama mailtrap yang dimiliki)

### 4. Migrasi Database

    php artisan migrate

### 5. Seed Database

Catatan: Jika ingin generate data dummy untuk database, lakukan seeding database

    php artisan db:seed

### 6. Menjalankan Aplikasi

    php artisan serve

## Pengguna Awal

Catatan: Buat akun menggunakan fitur registrasi yang sudah disediakan. Akun pertama kali akan otomatis menjadi role employee, sehingga jika ingin mengubah role, harap ubah di dalam database untuk menjadi role admin atau manager.

    Admin:
    Email: admin@gmail.com
    Password: superuser

    Manager:
    Username: manager@gmail.com
    Password: superuser

## Penggunaan

### 1. Login

Masuk ke aplikasi menggunakan kredensial di atas.

### 2. Pemesanan Kendaraan

Admin dapat menginput pemesanan kendaraan melalui halaman pemesanan atau navbar booking.

### 3. Persetujuan

Manager dapat menyetujui atau menolak pemesanan kendaraan melalui halaman persetujuan atau navbar Approval.

### 4. Dashboard

Semua Role dapat melihat grafik pemakaian kendaraan di dashboard atau navbar dashboard

### 5. Laporan Periodik

Admin dapat mengekspor laporan pemesanan kendaraan dalam format Excel dari halaman pemesanan atau navbar booking.

### 6. Log

Semua Role dapat melihat aktivitas yang dilakukan user pada aplikasi di halaman log atau navbar log

## Physical Data Model

Berikut adalah Physical Data Model yang digunakan dalam aplikasi ini:
![Screenshot 2024-07-21 100931](https://github.com/user-attachments/assets/cc1a0452-2986-4204-97b5-96f8140cc4d4)

## Activity Diagram

Berikut adalah Activity Diagram untuk fitur pemesanan kendaraan:

    +------------------------------------------------------------+
    |                    Mulai                                   |
    +------------------------------------------------------------+
            |                             |                    |
            v                             |                    v
    [Admin Login]                         |              [Manager Login]
            |                             |                    |
            v                             |                    v
    [Masuk ke halaman pemesanan]          |            [Masuk ke halaman persetujuan]
            |                             |                    |
            v                             |                    v
    [Input pemesanan]                     |              [Pilih pemesanan]
            |                             |                    |
            v                             |                    v
    [Pilih driver dan approver]           |            [Setujui/Tolak pemesanan]
            |                             |                    |
            v                             |                    v
    [Simpan pemesanan]                    |            [Simpan status pemesanan]
            |                             |                    |
            v                             |                    v
        [Logout]                          |                  [Logout]
            |                             |                    |
            v                             |                    v
        Selesai                       Selesai              Selesai

## Demo

https://drive.google.com/file/d/1pmZL8OxbznJhICmL48YkfzSkd8xfeAuZ/view?usp=sharing
