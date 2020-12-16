# clear and configure necessary caches
php artisan optimize

# migrate necessary tables for both the working database and test database
php artisan migrate --database=mysql --path=database/migrations/mysql & php artisan migrate --database=mysql_2 --path=database/migrations/mysql_2

# seed both databases with the necessary data
php artisan news:fetch