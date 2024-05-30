# Installing dependencies
php -f composer.phar install
sleep 10
# Migrate db
php artisan migrate:fresh --seed

# Run App
php artisan serve --host=0.0.0.0