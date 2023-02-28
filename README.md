# About People Seedtech

## Front-end

We will use Bootstrap installed using [laravel/ui](https://github.com/laravel/ui).
This has been installed according to the README in this package.

We stripped out all Tailwind CSS stuff since we use Bootstrap in this project.

### Commands

#### Development

Run Laravel server
```
php artisan serve
```

Run vite
```
npm run dev
```

## Create database

We are currently using MySQL.

From within the mysql console.
```
create database people_development;
create database people_test;
```

## Seed data

1. Seeding data
  1. Reset database with `php artisan migrate:fresh`
  2. Seed data with `php artisan db:seed`
2. Login user
  1. Login with email: "test@example.com", password: "password"

## Static analysis

```
./vendor/bin/phpstan analyse --memory-limit=2G
```

## Linting

Pint is installed by default in new Laravel apps.

```
./vendor/bin/pint
```
