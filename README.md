docker-compose up -d

cp .env.example .env

docker-compose exec laravel.test bash

php artisan key:generate

php artisan migrate

php artisan serve

SWAGGER URL:{{URL}}swagger-ui/index.html
