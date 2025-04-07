<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Tentang Laravel

Laravel adalah framework aplikasi web dengan sintaks yang ekspresif dan elegan. Kami percaya bahwa pengembangan harus menjadi pengalaman yang menyenangkan dan kreatif agar benar-benar memuaskan. Laravel menghilangkan rasa sakit dari pengembangan dengan mempermudah tugas umum yang digunakan dalam banyak proyek web, seperti:

-   [Mesin routing sederhana dan cepat](https://laravel.com/docs/routing).
-   [Wadah injeksi ketergantungan yang kuat](https://laravel.com/docs/container).
-   Beberapa back-end untuk penyimpanan [sesi](https://laravel.com/docs/session) dan [cache](https://laravel.com/docs/cache).
-   [ORM database](https://laravel.com/docs/eloquent) yang ekspresif dan intuitif.
-   [Migrasi skema](https://laravel.com/docs/migrations) database agnostik.
-   [Pemrosesan pekerjaan latar belakang yang kuat](https://laravel.com/docs/queues).
-   [Siaran acara waktu nyata](https://laravel.com/docs/broadcasting).

Laravel dapat diakses, kuat, dan menyediakan alat yang diperlukan untuk aplikasi besar dan tangguh.

## Mempelajari Laravel

Laravel memiliki [dokumentasi](https://laravel.com/docs) dan perpustakaan tutorial video yang paling luas dan menyeluruh dari semua framework aplikasi web modern, sehingga mudah untuk memulai dengan framework ini.

Anda juga dapat mencoba [Laravel Bootcamp](https://bootcamp.laravel.com), di mana Anda akan dipandu dalam membangun aplikasi Laravel modern dari awal.

Jika Anda tidak ingin membaca, [Laracasts](https://laracasts.com) dapat membantu. Laracasts berisi ribuan tutorial video tentang berbagai topik termasuk Laravel, PHP modern, pengujian unit, dan JavaScript. Tingkatkan keterampilan Anda dengan menggali perpustakaan video komprehensif kami.

## Sponsor Laravel

Kami ingin mengucapkan terima kasih kepada sponsor berikut karena telah mendanai pengembangan Laravel. Jika Anda tertarik untuk menjadi sponsor, silakan kunjungi [program Mitra Laravel](https://partners.laravel.com).

### Mitra Premium

-   **[Vehikl](https://vehikl.com/)**
-   **[Tighten Co.](https://tighten.co)**
-   **[WebReinvent](https://webreinvent.com/)**
-   **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
-   **[64 Robots](https://64robots.com)**
-   **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
-   **[Cyber-Duck](https://cyber-duck.co.uk)**
-   **[DevSquad](https://devsquad.com/hire-laravel-developers)**
-   **[Jump24](https://jump24.co.uk)**
-   **[Redberry](https://redberry.international/laravel/)**
-   **[Active Logic](https://activelogic.com)**
-   **[byte5](https://byte5.de)**
-   **[OP.GG](https://op.gg)**

## Tutorial Instalasi Laravel dari Kloning GitHub

Berikut adalah langkah-langkah untuk menginstal Laravel dari kloning repositori GitHub:

1.  **Persyaratan:**
    * Pastikan Anda memiliki PHP (versi 8.1 atau lebih tinggi) dan Composer terinstal di sistem Anda.
    * Anda juga memerlukan Node.js dan npm jika Anda berencana menggunakan Laravel Mix untuk kompilasi aset frontend.
    * Git sudah terinstal di komputer anda.

2.  **Kloning Repositori:**
    * Buka terminal atau command prompt Anda dan jalankan perintah berikut, ganti `[URL_REPOSITORI]` dengan URL repositori GitHub Laravel Anda:
        ```bash
        git clone [URL_REPOSITORI]
        ```

3.  **Navigasi ke Direktori Proyek:**
    * Pindah ke direktori proyek yang baru dikloning:
        ```bash
        cd [NAMA_PROYEK]
        ```

4.  **Instal Dependensi Composer:**
    * Jalankan perintah berikut untuk menginstal dependensi PHP:
        ```bash
        composer install
        ```

5.  **Salin File `.env.example`:**
    * Salin file `.env.example` ke `.env`:
        ```bash
        cp .env.example .env
        ```
    * Buka file `.env` dan konfigurasi pengaturan database dan lainnya sesuai kebutuhan Anda.

6.  **Hasilkan Kunci Aplikasi:**
    * Jalankan perintah berikut untuk menghasilkan kunci aplikasi:
        ```bash
        php artisan key:generate
        ```

7.  **Jalankan Migrasi Database (Jika Diperlukan):**
    * Jika proyek Anda menggunakan migrasi database, jalankan perintah berikut:
        ```bash
        php artisan migrate
        ```

8.  **Jalankan Server Pengembangan:**
    * Jalankan server pengembangan Laravel:
        ```bash
        php artisan serve
        ```
    * Buka browser web Anda dan kunjungi `http://127.0.0.1:8000` untuk melihat aplikasi Laravel Anda.

## Kontribusi

Terima kasih telah mempertimbangkan untuk berkontribusi pada framework Laravel! Panduan kontribusi dapat ditemukan di [dokumentasi Laravel](https://laravel.com/docs/contributions).

## Kode Etik

Untuk memastikan bahwa komunitas Laravel ramah terhadap semua orang, harap tinjau dan patuhi [Kode Etik](https://laravel.com/docs/contributions#code-of-conduct).

## Kerentanan Keamanan

Jika Anda menemukan kerentanan keamanan dalam Laravel, kirimkan email ke Taylor Otwell melalui [taylor@laravel.com](mailto:taylor@laravel.com). Semua kerentanan keamanan akan segera ditangani.

## Lisensi

Framework Laravel adalah perangkat lunak sumber terbuka yang dilisensikan di bawah [lisensi MIT](https://opensource.org/licenses/MIT).
