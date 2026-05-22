==================================================
PANDUAN SETUP PROJECT MARKET HANDPHONE DARI CLONE
==================================================

Halo tim! Setelah kalian berhasil meng-clone project ini ke laptop masing-masing, pastikan kalian sudah menginstall:
1. XAMPP / Laragon (Pastikan Apache & MySQL menyala)
2. Composer
3. Node.js

Jika sudah, ikuti langkah-langkah di bawah ini secara berurutan di dalam terminal VS Code kalian:

---
LANGKAH 1: Install Dependencies (Library PHP & Frontend)
---
Jalankan dua perintah ini untuk mengunduh semua package yang dibutuhkan project:
1. Ketik: composer install
   (Tunggu sampai selesai)
2. Ketik: npm install
   (Tunggu sampai selesai)

---
LANGKAH 2: Konfigurasi File .env
---
Jalankan perintah ini di terminal untuk menduplikasi file konfigurasi bawaan:
> cp .env.example .env     (atau pakai perintah `copy .env.example .env` jika memakai CMD Windows)

Setelah itu, buka file `.env` yang baru saja dibuat di sebelah kiri (File Explorer VS Code), lalu cari bagian konfigurasi database dan pastikan nama databasenya diubah menjadi "handphone" seperti ini:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=handphone
DB_USERNAME=root
DB_PASSWORD=

---
LANGKAH 3: Generate Application Key
---
Jalankan perintah ini agar Laravel membuat kunci keamanan unik untuk laptop kalian:
> php artisan key:generate

---
LANGKAH 4: Setup Database & Isi Data Otomatis
---
Jalankan perintah di bawah ini untuk mereset/membuat struktur tabel dari nol beserta data dummy (seeder) yang sudah diatur:
> php artisan migrate:fresh --seed

⚠️ PENTING: Karena database belum dibuat, terminal akan memunculkan pesan peringatan seperti ini:
"Database 'handphone' does not exist on the mysql connection. Would you like to create it? (yes/no) [no]"
Ketik "yes" lalu tekan Enter. Laravel akan otomatis membuatkan databasenya untuk kalian.

---
LANGKAH 5: Hubungkan Folder Penyimpanan (Storage Link)
---
Karena project ini punya fitur upload gambar, kita harus mengaktifkan link storage-nya. Jalankan di terminal:
> php artisan storage:link

---
LANGKAH 6: Jalankan Project (Butuh 2 Terminal)
---
Karena kita memakai Vite, kita harus menyalakan server PHP dan server Frontend secara bersamaan.
Buka 2 tab terminal di VS Code:

Di Terminal 1, jalankan:
> php artisan serve

Di Terminal 2, jalankan:
> npm run dev

Selesai! Sekarang kalian bisa buka projectnya di browser melalui link: http://127.0.0.1:8000