
## 🚀 Project Setup

### ⚙️ Requirements

- PHP 8.2+
- Composer
- Laravel 11
- MySQL
- Laravel Sanctum
- Vite

---

### 📦 Backend - Laravel 11

```bash
# Clone the repository
git clone [https://github.com/your-username/your-project.git](https://github.com/delowar-prog/laravel-react-ecommerce-backend-.git)
cd your-project/backend

# Install PHP dependencies
composer install

# Copy environment file and generate app key
cp .env.example .env
php artisan key:generate

# Set up database configuration in .env
php artisan migrate

# (Optional) Seed the database
php artisan db:seed

# Serve the application
php artisan serve
