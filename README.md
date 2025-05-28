# 🕌 PrayTimeNow

**PrayTimeNow** adalah aplikasi web ringan berbasis Laravel yang memungkinkan pengguna untuk mengecek **jadwal sholat** berdasarkan **lokasi** dan **tanggal** tanpa perlu login, instalasi, atau akses GPS.

---

## Fitur Utama

-   Input nama kota dan tanggal secara manual
-   Ambil data real-time dari API eksternal:
    -   [Aladhan API](https://aladhan.com/prayer-times-api) untuk jadwal sholat
    -   [Nominatim (OpenStreetMap)](https://nominatim.org/) untuk konversi kota → koordinat
-   Tampilkan 5 waktu sholat wajib (Subuh, Dzuhur, Ashar, Maghrib, Isya)
-   Desain web responsif
-   Tanpa database & login
-   Mendukung CI/CD deployment via Azure

---

## Motivasi Proyek

Proyek ini dikembangkan sebagai bagian dari Tugas Kelompok_8 DevOps oleh mahasiswa ITS, dengan tujuan:

-   Memudahkan umat muslim mengakses jadwal sholat yang akurat dan cepat
-   Menerapkan praktik DevOps (CI/CD) pada proyek sederhana berbasis Laravel
-   Membuat aplikasi yang ringan, ramah pengguna, dan tidak memerlukan login

## Teknologi yang Digunakan

| Komponen          | Tools / Library                                   |
| ----------------- | ------------------------------------------------- |
| Backend           | Laravel 12                                        |
| Frontend Styling  | Bootstrap 5, Bootstrap Icons                      |
| API Jadwal Sholat | [Aladhan API](https://aladhan.com)                |
| API Lokasi        | [Nominatim OpenStreetMap](https://nominatim.org/) |
| CI/CD             | GitHub Actions                                    |
| Containerization  | Docker + Azure Container Registry                 |
| Hosting           | Azure Web App for Containers                      |
| Monitoring (Ops)  | Azure Application Insights (opsional)             |
