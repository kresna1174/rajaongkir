# Requirements
1. PHP Version 7.4+
2. MYSQL Ver 8.0.30 for Win64 on x86_64 (MySQL Community Server - GPL)
3. Composer
4. Postman
5. PHP server (Laragon Or Xampp)

# INSTALLATION
1. Clone the project
2. Open terminal and type composer update or composer install (if not working type composer install --ignore-platform-reqs)
3. Copy .env.example and paste here, rename .env.example.copy to .env
4. Configure your database connection
5. Run "php artisan key:generate" and "php artisan config:clear"
6. Run "php artisan migrate" and "php artisan db:seed" to generate table and insert default user
7. Run "php artisan serve"

# HOW TO USE
1. To use this api you can read this task1.md && task2.md

# TO Running Unit Test You Can Follow This Command {php artisan test}
