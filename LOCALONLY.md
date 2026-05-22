!!JANGAN DI PUSH KE GITHUB!!

PANDUAN UNTUK MEMULAI PENGERJAAN BACKEND + TESTING DI POSTMAN

1.Buka Laravel Herd: Pastikan aplikasi Herd sudah berjalan di system tray.

2. Buka MySQL di XAMPP - Klik Start hanya pada MySQL.

3. Cek Koneksi Database
   - Buka file .env di VS Code.
   - DB_CONNECTION=mysql
   - DB_HOST=127.0.0.1
   - DB_PORT=3306
   - DB_DATABASE=db_majadigi
     TESTING: Ketik php artisan migrate. Jika muncul pesan Nothing to migrate atau daftar tabel, berarti koneksi aman.

4. Implementasi Logika Backend
   - Update Model User: Pastikan app/Models/User.php sudah menggunakan HasApiTokens agar fungsi createToken() tidak error.
   - Daftarkan Route: Pastikan route login sudah ada di routes/api.php dan berada di luar group middleware auth:sanctum.

5. Pengujian dengan Postman (Desktop Agent)
   A. Ambil Token (Login):
   - Method: POST.
   - URL: [http://majadigi.test/api/v1/login](http://majadigi.test/api/v1/login).
   - Headers: Tambahkan Accept: application/json.

   - Body (raw JSON):
   - JSON
     {
     "email": "test@example.com",
     "password": "password"
     }
   - Klik Send: Ambil nilai access_token yang muncul.
