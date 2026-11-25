# Kedai Kopi REST API (PHP Lumen)

Project REST API tema **Kedai Kopi** menggunakan **PHP Lumen** dengan relasi tabel `outlets` (Main Table) -> `menus` (Secondary Table).

## Cara Menjalankan Project

1. **Extract file ZIP** ini ke folder kerja kamu.
2. Buka terminal di dalam folder `kedai-kopi-lumen-api`, lalu install dependency Lumen:
   ```bash
   composer install
   ```
3. Buat database baru di MySQL / HeidiSQL dengan nama:
   ```sql
   CREATE DATABASE db_kedai_kopi;
   ```
   *(Sesuaikan `DB_USERNAME` dan `DB_PASSWORD` di file `.env` jika MySQL kamu pakai password).*
4. Jalankan migrasi tabel dan seeder (data contoh):
   ```bash
   php artisan migrate --seed
   ```
5. Jalankan server lokal Lumen:
   ```bash
   php -S localhost:8000 -t public
   ```

## Testing di Postman

1. Buka Postman -> klik **Import** -> pilih file `Kedai_Kopi_API.postman_collection.json` yang sudah ada di dalam folder ini.
2. Semua 10 endpoint + contoh filter `outlet_id` + contoh response XML sudah siap pakai.
3. **Kredensial Basic Auth** (untuk `POST`, `PUT`, `DELETE`):
   - **Username:** `admin`
   - **Password:** `kopi123`
4. **Dynamic Response (JSON / XML):**
   - Ganti Header `Accept` menjadi `application/json` untuk JSON.
   - Ganti Header `Accept` menjadi `application/xml` untuk XML.
