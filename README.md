# Portal Akademik – PBKK Pertemuan 10

## Identitas

| Nama       | Shifa Alya Dewi |
| NRP        | 5025241176      |
| Kelas      | PBKK C          |

## Deskripsi Proyek

Portal Akademik merupakan aplikasi berbasis web yang dikembangkan menggunakan Laravel untuk memenuhi tugas PBKK Pertemuan 10. Aplikasi ini menyediakan sistem pengelolaan data akademik dengan pembagian hak akses berdasarkan peran pengguna (*Role-Based Access Control*).

Aplikasi memiliki dua tampilan antarmuka yang berbeda, yaitu halaman pengguna menggunakan Laravel Breeze dan Tailwind CSS, serta halaman admin menggunakan AdminLTE dan Bootstrap.

## Fitur Utama

### 1. Multi-User Authentication

- Sistem login dan autentikasi pengguna.
- Pengelolaan hak akses berdasarkan role menggunakan Spatie Laravel Permission.

### 2. Role-Based Access Control (RBAC)

| Role           | Hak Akses                                                          |
| -------------- | ------------------------------------------------------------------ |
| Admin          | Mengakses seluruh fitur admin, mengelola data, dan menghapus data. |
| Staf           | Melihat data dan mengakses halaman admin tanpa hak menghapus data. |
| User/Mahasiswa | Mengakses dashboard pengguna dan fitur Kalkulator IPK.             |

### 3. Admin Dashboard

- Menampilkan ringkasan jumlah mahasiswa.
- Menampilkan jumlah dosen.
- Menampilkan jumlah tugas.
- Data ditampilkan secara dinamis berdasarkan database.

### 4. Manajemen Data Mahasiswa

- Menampilkan daftar mahasiswa.
- Melakukan pencarian data mahasiswa.
- Melakukan filter data.
- Menggunakan pagination untuk membatasi jumlah data yang ditampilkan.
- Menggunakan `when()` untuk menerapkan pencarian dan filter secara kondisional.
- Menggunakan `withQueryString()` agar parameter pencarian dan filter tetap terbawa saat berpindah halaman.

### 5. Keamanan dan Pembatasan Akses

- Menggunakan middleware untuk membatasi akses berdasarkan role.
- Menggunakan `@can` untuk mengatur tampilan fitur berdasarkan permission.
- Menggunakan `abort_unless()` untuk memastikan pengguna memiliki izin sebelum menjalankan tindakan tertentu.

### 6. Kalkulator IPK

- Menyediakan fitur perhitungan Indeks Prestasi Kumulatif (IPK) bagi pengguna.

## Teknologi yang Digunakan

- Laravel
- Laravel Breeze
- Tailwind CSS
- AdminLTE
- Bootstrap
- Spatie Laravel Permission
- SQLite
- Vite

## Instalasi dan Menjalankan Proyek

### 1. Clone Repository

```bash
git clone <URL_REPOSITORY>
cd <NAMA_FOLDER_PROJECT>
```

### 2. Install Dependency

```bash
composer install
```

### 3. Konfigurasi Environment

Salin file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

### 4. Konfigurasi Database

Proyek menggunakan SQLite. Buat file database jika belum tersedia:

```bash
touch database/database.sqlite
```

Pastikan konfigurasi database pada file `.env` menggunakan SQLite:

```env
DB_CONNECTION=sqlite
```

Jalankan migrasi dan seeder:

```bash
php artisan migrate:fresh --seed
```

### 5. Install Dependency Frontend

```bash
npm install
```

### 6. Jalankan Aplikasi

Jalankan server Laravel:

```bash
php artisan serve
```

Jalankan Vite pada terminal terpisah:

```bash
npm run dev
```

Aplikasi dapat diakses melalui:

```text
http://127.0.0.1:8000
```

## Akun Pengguna untuk Pengujian

Berikut akun yang dapat digunakan untuk menguji hak akses setiap role:

| Role           | Email                                        | Password |
| -------------- | -------------------------------------------- | -------- |
| Admin          | [admin@pbkk.test](mailto\:admin@pbkk.test)   | password |
| Staf           | [staf@pbkk.test](mailto\:staf@pbkk.test)     | password |
| User/Mahasiswa | [test@example.com](mailto\:test@example.com) | password |

## Struktur Area Aplikasi

| Area           | Teknologi                    | Keterangan                                              |
| -------------- | ---------------------------- | ------------------------------------------------------- |
| User           | Laravel Breeze, Tailwind CSS | Halaman dashboard pengguna dan Kalkulator IPK.          |
| Admin          | AdminLTE, Bootstrap          | Halaman dashboard admin dan pengelolaan data mahasiswa. |
| Authentication | Laravel Breeze               | Sistem autentikasi pengguna.                            |
| Authorization  | Spatie Laravel Permission    | Pengaturan role dan permission pengguna.                |

## Catatan

- Tampilan User dan Admin menggunakan framework CSS yang berbeda dan dipisahkan agar tidak terjadi konflik styling.
- Hak akses setiap pengguna diatur menggunakan sistem Role-Based Access Control (RBAC).
- Pengguna dengan role Staf tidak memiliki izin untuk menghapus data mahasiswa.
- Pengguna dengan role Admin memiliki akses penuh terhadap fitur pengelolaan data.

---

