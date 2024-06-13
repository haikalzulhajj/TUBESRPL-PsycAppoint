# PsycAppoint

## Requirement

- php 8.2
- composer
- node.js
- mysql

## Cara Installasi

1. Pastikan kalian sudah install semua, komponen yang digunakan.
2. Copy `.env.example`, lalu rename menjadi `.env`.
3. Hilangkan comment pada `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.
4. Untuk `DB_CONNECTION` ganti menjadi `mysql`.
5. Untuk `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` atur sesuai yang kalian inginkan.
6. Buka terminal, lalu jalankan perintah `composer install`.
7. Migrate table dengan menjalankan perintah `php artisan migrate --seed` (jika pada table yang kalian gunakan tidak kosong, kalian bisa menggunakan perintah `php artisan migrate:fresh --seed`).
8. Jalankan perintah `npm install`, lalu `npm run build` untuk melakukan building assets.
9. Untuk menjalankan website, jalankan perintah `php artisan serve`, lalu buka [http://localhost:8000](http://localhost:8000).
