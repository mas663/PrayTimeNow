# PrayTimeNow

Aplikasi web ringan untuk menampilkan jadwal sholat harian berdasarkan lokasi dan tanggal input, tanpa login, instalasi, atau GPS. Dibangun dengan Laravel dan Bootstrap, serta didukung CI/CD pipeline menggunakan GitHub Actions dan Docker, serta di-deploy secara otomatis ke [Render](https://praytimenow.onrender.com/).

---

## 🔧 Tools & Teknologi

-   **Laravel 10+** (backend framework)
-   **Bootstrap 5** (frontend UI)
-   **Docker** (containerization)
-   **GitHub Actions** (CI/CD automation)
-   **Render.com** (deployment hosting)
-   **PHPUnit** (unit testing)
-   **API:**
    -   [Aladhan API](https://aladhan.com/prayer-times-api) – untuk jadwal sholat
    -   [Nominatim API](https://nominatim.org/) – untuk geocoding lokasi input

---

## 🚀 Alur CI/CD Pipeline

CI/CD pipeline dikelola menggunakan **GitHub Actions** dan berjalan otomatis pada setiap push ke branch `main`.

### 1️⃣ Continuous Integration (CI)

#### ✅ Step: Install & Validate

-   Menjalankan `composer install`
-   Menjalankan perintah Laravel seperti:
    -   `php artisan config:clear`
    -   `php artisan test`
-   Mengecek struktur file, dependensi, dan kelengkapan konfigurasi (`.env`, `phpunit.xml`, `Dockerfile`)

#### ✅ Step: Unit Testing

-   Pengujian fitur yang penting seperti:
    -   Endpoint utama (`/`)
    -   Pencarian lokasi & jadwal (`/praytime`)
    -   Validasi output API dan status HTTP
-   Dilakukan melalui Laravel Feature Test

#### ✅ Step: Build Docker Image

-   Dockerfile akan membangun image dari Laravel app
-   Build otomatis saat ada perubahan kode

---

### 2️⃣ Continuous Deployment (CD)

#### ✅ Step: Push Docker Image

-   Image dikirim ke registry internal Render setelah build berhasil

#### ✅ Step: Deploy ke Render

-   Otomatis setelah image ter-push
-   Menggunakan konfigurasi Laravel + Apache di dalam Docker
-   Environment `APP_KEY`, `APP_ENV`, dan path `APP_URL` sudah ditentukan
-   Folder permission (`storage/`, `bootstrap/cache/`) disesuaikan di Dockerfile

---

## 📂 Struktur Penting Repository

-   .github/workflows/ci-cd.yml # CI/CD pipeline GitHub Actions
-   Dockerfile # Build image Laravel
-   .env # Environment Laravel
-   phpunit.xml # Config untuk unit test
-   tests/Feature/ # Berisi Laravel Feature Tests
-   public/ # Entry point web
-   app/Http/Controllers/ # PrayTimeController utama\

---

## 🧪 Contoh Feature Test

```php
public function test_main_page_accessible(): void
{
    $response = $this->get('/');
    $response->assertStatus(200);
    $response->assertSee('PrayTimeNow');
}
```
