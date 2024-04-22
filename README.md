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
```

```bash
$ php artisan key:generate
```

```bash
$ php artisan migrate:fresh
```