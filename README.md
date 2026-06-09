# Presensi - Fakultas Kedokteran Universitas Riau

Sistem presensi digital berbasis QR code & geolokasi untuk event seminar dan kegiatan kampus.

## Fitur

- **Publik:** Daftar event, detail event, pendaftaran (nama, NIM, instansi)
- **User:** Login/daftar, QR presensi dinamis (berubah tiap 1 menit), presensi dengan validasi lokasi
- **Admin:** Dashboard, CRUD event, koordinat lokasi acara, kelola peserta, generate QR presensi event
- **Keamanan:** QR code rotasi per menit, geofencing lokasi acara

## Deploy Railway

Proyek ini terhubung ke GitHub `alexbell12/Repo-github`. Setiap push ke branch `main` akan memicu deploy otomatis di Railway.

**Release command** (lihat `railway.toml`): migrate database + seed akun default.

**Variables penting di Railway:**
- `APP_NAME=Presensi`
- `APP_URL=https://<domain-railway-anda>.up.railway.app`
- Hubungkan service MySQL (jangan pakai `DB_CONNECTION=sqlite`)

## Akun default

| Role | Email | Password |
|------|--------|----------|
| Admin | admin@example.com | password |
| User | user@example.com | password |

## Instalasi lokal

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```

---

© Fakultas Kedokteran Universitas Riau
