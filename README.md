<<<<<<< HEAD
# Absensi Seminar - Fakultas Kedokteran Universitas Riau

Sistem absensi seminar berbasis QR code untuk Fakultas Kedokteran Universitas Riau.

## Fitur

- **Publik:** Daftar event seminar, detail event, pendaftaran (nama, NIM, instansi), QR absensi peserta
- **User:** Login/daftar, daftar event, lihat QR absensi pribadi setelah verifikasi
- **Admin:** Dashboard, CRUD event, kelola peserta (tambah/verifikasi/hapus), generate QR event, toggle aktif/nonaktif event, scan absensi peserta
- **Absensi:** Panitia scan QR peserta → konfirmasi → tercatat hadir

## Kebutuhan

- PHP 8.2+
- Composer
- MySQL / SQLite
- Node.js & NPM (untuk Vite/asset)

## Instalasi

1. **Clone / masuk ke folder project**
   ```bash
   cd c:\laragon\www\presensi
   ```

2. **Install dependency PHP**
   ```bash
   composer install
   ```
   Jika belum ada, install paket QR code:
   ```bash
   composer require simplesoftwareio/simple-qrcode
   ```

3. **Environment**
   ```bash
   copy .env.example .env
   php artisan key:generate
   ```
   Edit `.env`: set `APP_NAME="Absensi Seminar"`, dan konfigurasi database (mis. MySQL atau `DB_CONNECTION=sqlite` dan kosongkan `DB_DATABASE` lalu buat file `database/database.sqlite`).

4. **Database**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

5. **Asset (opsional)**
   ```bash
   npm install
   npm run build
   ```
   Tanpa build, layout tetap berfungsi jika Vite fallback ke inline style.

6. **Jalankan server**
   ```bash
   php artisan serve
   ```
   Buka http://127.0.0.1:8000

## Akun default (setelah seed)

| Role | Email | Password |
|------|--------|----------|
| Admin | admin@example.com | password |
| User | user@example.com | password |

## Alur singkat

1. **Admin:** Login → Dashboard Admin → Buat Event → (opsional) Tambah Peserta & Verifikasi → QR Event / QR per peserta lewat halaman "QR Absensi Saya" peserta.
2. **Peserta:** Daftar di event (form: nama, NIM, instansi) → menunggu verifikasi → setelah verifikasi bisa buka "QR Absensi Saya" untuk ditunjukkan ke panitia.
3. **Panitia:** Scan QR peserta (atau buka URL di QR) → konfirmasi "Ya, Catat Hadir" → absensi tersimpan.

## Tech stack

- Laravel 12
- Blade + Tailwind (Vite)
- SimpleSoftwareIO/simple-qrcode

---

© Fakultas Kedokteran Universitas Riau
=======
# Repo-github
>>>>>>> d26032ab4cf14c822535d37ab603e28fd73602c6
