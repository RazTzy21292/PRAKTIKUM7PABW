# Laporan Pengerjaan LaporBanjir

## Ringkasan

LaporBanjir adalah aplikasi pelaporan banjir BPBD Kabupaten Bandung. Warga dapat
mengirim informasi kejadian dan foto bukti, sedangkan petugas yang sudah login
dapat melihat, memperbarui status, mengganti foto, dan menghapus laporan.

## Fitur

- Form publik dengan validasi data wajib dan foto JPG/JPEG/PNG maksimal 2 MB.
- Foto disimpan pada disk `public` di folder `storage/app/public/laporan`.
- Daftar laporan petugas dengan thumbnail, pagination, detail, edit, dan hapus.
- Status penanganan `Menunggu`, `Diproses`, atau `Selesai`.
- Foto lama dihapus saat foto diganti dan foto dihapus bersama laporannya.
- Pesan berhasil dan pesan kesalahan validasi pada setiap input.

## Pilihan Autentikasi

Pengerjaan ini menggunakan autentikasi manual, bukan Laravel Breeze. Project
yang tersedia sudah memiliki halaman login/register, controller autentikasi,
serta middleware `auth`; mempertahankan implementasi tersebut menghindari
penambahan scaffolding dan dependensi yang tidak diperlukan. Seluruh route
pengelolaan laporan dilindungi middleware `auth`, sementara form pengaduan
warga tetap dapat diakses tanpa login.

## Menjalankan Aplikasi

1. Buat database MySQL bernama `db_laporbanjir` melalui phpMyAdmin (tab **SQL**):

   ```sql
   CREATE DATABASE db_laporbanjir CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

2. Salin `.env.example` menjadi `.env` bila belum ada. Atur koneksi database
   (`DB_CONNECTION=mysql`, `DB_DATABASE=db_laporbanjir`, dan kredensial MySQL).
3. Jalankan perintah berikut dari root project:

   ```sh
   composer install
   php artisan key:generate
   php artisan migrate --seed
   php artisan storage:link
   php artisan serve
   ```

4. Buka URL yang ditampilkan oleh `php artisan serve`. Akun petugas demo:
   `admin@bpbd.test` dengan kata sandi `admin12345`.

Migration upgrade akan mempertahankan data tinggi genangan dan tanggal kejadian
dari skema sebelumnya. Gunakan `php artisan migrate:fresh --seed` hanya jika
memang ingin menghapus seluruh tabel beserta datanya.
