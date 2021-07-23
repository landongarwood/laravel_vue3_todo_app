# ToDo App with Laravel 8 and Vue 3 Composition API

> A simple ToDo application using Laravel 8 and Vue 3 Composition API.

## Project setup

```
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
```

## Run project

```
php artisan serve
```

### Run PHP UnitTest

```
cp .env.example .env.testing
php artisan key:generate --env=testing
php artisan test
```
