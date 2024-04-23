# Konsep Aplikasi

## Deskripsi Blogmaster:

**Blogmaster** adalah sebuah platform blogging yang dirancang khusus untuk memfasilitasi Admin Website UMKM dalam membuat, mengelola, dan mempublikasikan konten blog. Aplikasi ini bertujuan untuk memberikan pengalaman yang optimal bagi author (penulis) dalam mengelola konten blog, serta memberikan informasi dan inspirasi kepada pengunjung terkait dengan UMKM (Usaha Mikro, Kecil, dan Menengah).

## Konsep Blogmaster:

### Tujuan Aplikasi:

Aplikasi ini bertujuan untuk memberikan pengalaman yang optimal bagi author (penulis) dalam mengelola konten blog, serta memberikan informasi dan inspirasi kepada pengunjung terkait dengan UMKM (Usaha Mikro, Kecil, dan Menengah).

### Fitur Utama:

1. **Autentikasi**:
   Menjamin keamanan dengan memerlukan login bagi pengguna (admin dan author) sebelum mengakses fitur-fitur admin panel dan halaman dashboard author.

2. **Admin Panel**:
   - Mengelola Author: Menambah, mengedit, dan menghapus author yang berkontribusi dalam menulis blog.
   - Mengelola Blog: Menambah, mengedit, dan menghapus postingan blog.
   - Mengelola Kategori: Menambah, mengedit, dan menghapus kategori untuk mengatur konten blog agar terorganisir dengan baik.

3. **Dashboard Author**:
   - Melihat Postingan: Melihat daftar postingan yang telah ditulis.
   - Membuat Postingan Baru: Membuat postingan baru untuk dipublikasikan.
   - Mengedit Postingan: Mengedit postingan yang telah dibuat sebelumnya.
   - Menghapus Postingan: Menghapus postingan yang tidak diperlukan lagi.

4. **Pengelolaan Konten Blog**:
   Admin dan author memiliki kemampuan untuk membuat, mengedit, dan menghapus postingan blog, memastikan kelancaran dan relevansi konten yang disajikan kepada pengunjung.

5. **Tampilan Publik**:
   Menampilkan konten blog kepada pengunjung melalui halaman publik, termasuk daftar blog, detail blog, dan kategori blog untuk memudahkan navigasi dan pencarian.



# Installation

Clone repository
```bash
$ git clone https://github.com/gtkrshnaaa/blogmaster.git
```
Masuk ke direktori blogmaster
```bash
$ cd blogmaster
```
Kemudian ikuti command command dibawah ini
```bash
$ composer install
```

```bash
$ cp .env.example .env
```

Sesuaikan isi file .env
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=


FILESYSTEM_DISK=public
```

```bash
$ php artisan key:generate
```

```bash
$ php artisan migrate:fresh
```

```bash
$ php artisan storage:link
```


Jalankan aplikasi dengan command ini
```bash
$ php artisan serve
```


# Url Penting

Halaman Home

```bash
http://127.0.0.1:8000
```

Halaman login admin 
```bash
http://127.0.0.1:8000/admin/login

email       : admin@example.com
password    : password
```

Halaman login author
```bash
http://127.0.0.1:8000/author/login

account author bisa dibuat oleh admin, jadi buat dulu akunya sebelum login
```
