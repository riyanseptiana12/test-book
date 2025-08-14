Install dependencies PHP : composer install
Install dependencies JavaScript : npm install
Copy file .env : cp .env.example .env (di terminal)
php artisan key:generate (jalankan di terminal)

Buka file .env, ubah bagian ini sesuai database lokal:
DB_DATABASE=nama_database
DB_USERNAME=root 
DB_PASSWORD=

ganti menggunakan ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=book_store (nama database)
DB_USERNAME=root
DB_PASSWORD=

Migrasi & Seed Database
php artisan migrate --seed

php artisan serve

Akses di browser: http://127.0.0.1:8000

