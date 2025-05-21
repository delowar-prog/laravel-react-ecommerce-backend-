# Clone the repository
git clone [https://github.com/your-username/your-project.git](https://github.com/delowar-prog/laravel-react-ecommerce-backend-.git)
cd your-project/backend

# Install dependencies
composer install

# Copy environment file and generate app key
cp .env.example .env
php artisan key:generate

# Configure your .env (DB, Sanctum, etc.)
# Then run migrations
php artisan migrate

# (Optional) Seed database
php artisan db:seed

# Start Laravel server
php artisan serve
