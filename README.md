<h1 align="center">Halo, selamat datang di Repositori ini</h1>

------------

### Tentang Repo Ini?
Repositori ini adalah Web App E-commerce sederhana dengan Laravel 8. Project ini adalah online tes dari PT Majoo Teknologi Indonesia.**

### Fitur Apa Saja Yang Tersedia di Web App Ini?
- Autentikasi Admin, User
- Terdapat 2 User Level
- User Management
- Pengelolaan Product
- Pengelolaan Transaksi
- Dan lain-lain.

------------

## 💻 Install

1. **Clone Repository**
```bash
git clone https://github.com/NichiNect/majoo-dev.git
cd majoo-dev
composer install
npm install
npm run dev
copy .env.example .env
```

2. **Buka ```.env``` lalu ubah baris berikut sesuai dengan konfigurasi database**
```
DB_PORT=3306
DB_DATABASE=laravel_tes_majoo
DB_USERNAME=root
DB_PASSWORD=
```

3. **Instalasi website**
```bash
php artisan key:generate
php artisan migrate
// php artisan db:seed
php artisan storage:link
```
Mohon maaf saya tidak menyediakan seeder untuk ini. Tetapi aya menyediakan data dummy simple untuk database nya jika terjadi error pada migration atau seeding. silahkan import file ```/database/laravel_tes_majoo.sql``` pada database Anda.

4. **Run the website**
```bash
php artisan serve
```

------------

### 👤 Default Account for testing
	
**Admin Default Account**
- Username: yoniwidhi
- Password: thispassword

**User Default Account**
- Username : user1
- Password : thispassword

------------

## 🧑 Author

👤 <a href="https://www.facebook.com/yoniwidhi"> **Yoni Widhi**</a>
- Facebook : <a href="https://www.facebook.com/yoniwidhi"> Yoni Widhi</a>
- Telegram : <a href="https://t.me/yoniwidhi"> Yoni Widhi</a>

------------