# Product Requirements Document (PRD) - EchoWild

## 1. Project Overview
* **Nama aplikasi:** EchoWild
* **Latar belakang masalah:** Kebutuhan pengguna akan ruang digital yang estetis, privat, dan menenangkan (distraction-free) untuk mencatat refleksi harian, melacak suasana hati, dan memvisualisasikan perjalanan emosional mereka tanpa gangguan.
* **Target pengguna:** Individu yang ingin mencatat jurnal harian, melakukan refleksi diri, dan melacak mood mereka secara rutin.

## 2. User Personas & User Flow
* **Daftar aktor:**
  * **User:** Pengguna reguler yang dapat mendaftar, login, membuat jurnal, melacak mood, dan mengelola entri jurnal mereka sendiri secara privat.

* **Langkah alur penggunaan aplikasi:**
  1. Pengguna membuka aplikasi dan melakukan registrasi atau login (menggunakan sistem autentikasi Laravel Breeze).
  2. Pengguna diarahkan ke dashboard utama.
  3. Pengguna dapat membuat entri jurnal baru dengan menulis konten, memilih mood (skala 1-5 / emoji), dan menambahkan judul opsional.
  4. Pengguna dapat melihat daftar entri jurnal yang telah ditulis sebelumnya.
  5. Pengguna dapat mengubah (edit) atau menghapus (delete) entri jurnal miliknya.
  6. Pengguna dapat logout dari sistem.

## 3. Functional Requirements
| ID Fitur | Nama Fitur | Deskripsi Perilaku | Status Wajib/Opsional |
| :--- | :--- | :--- | :--- |
| F-01 | Autentikasi Pengguna | Pengguna dapat mendaftar, login, dan logout dengan aman (Breeze). | Wajib |
| F-02 | Manajemen Jurnal | Pengguna dapat membuat, membaca, mengubah, dan menghapus (CRUD) entri jurnal mereka. | Wajib |
| F-03 | Pelacakan Mood (Mood Tracking) | Pengguna dapat melacak suasana hatinya (skala 1-5) saat membuat/mengubah jurnal. | Wajib |
| F-04 | Judul Opsional | Pengguna dapat memberikan judul pada entri jurnalnya, namun tidak diwajibkan. | Opsional |

## 4. Non-Functional Requirements
* **Teknologi yang digunakan (stack):**
  * Backend: Laravel 11.x (PHP 8.x)
  * Frontend: Blade Templates, Tailwind CSS, Alpine.js
  * Database: MySQL / SQLite
* **Ketentuan keamanan:**
  * **Enkripsi:** Password pengguna dienkripsi menggunakan standar hashing bcrypt dari Laravel.
  * **Validasi input:** Form request divalidasi dengan ketat baik di sisi klien maupun server sebelum disimpan ke database.
  * **Otorisasi Data:** Entri jurnal terikat dengan `user_id` sehingga setiap pengguna hanya dapat mengakses dan memodifikasi datanya sendiri.

## 5. Database Schema
### Tabel `users`
* `id` (Primary Key, BigInt)
* `name` (String)
* `email` (String, Unique)
* `email_verified_at` (Timestamp, Nullable)
* `password` (String)
* `remember_token` (String, Nullable)
* `timestamps` (created_at, updated_at)

### Tabel `journals`
* `id` (Primary Key, BigInt)
* `user_id` (Foreign Key ke `users.id`, Cascade on Delete)
* `title` (String, Nullable)
* `content` (Text)
* `mood_score` (Integer, Default 3)
* `timestamps` (created_at, updated_at)
