# Laravel-Start
Laravel 5.8 with Laravel Passport

1. Clone this repo
2. Create Database to MySql
3. Go to Project directory run (composer install)
4. Copy .env.example to .env (cp .env.example .env)
5. Run (php artisan key:generate)
6. open .env file then add your database name and database credentials then save
7. Run (php artisan config:cache)
8. Run (php artisan migrate)
9. then run (php artisan passport:install) then copy the second client secret
10. copy this line of code below then paste it to the bottom of  the .env file then add your ENDPOINT and CLIENT_SECRET
      PASSPORT_LOGIN_ENDPOINT="http://example.test/oauth/token"
      
      PASSPORT_CLIENT_ID=2
      
      PASSPORT_CLIENT_SECRET="example laravel passport client"

11. Save .env file
12. Then run (php artisan config:cache)

This Project has a default migrations, controller and Model with one to many relationship for

-User

-Category

-Brand

-Produc
