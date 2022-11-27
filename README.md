# About People Seedtech

## Front-end

We will use Bootstrap installed using [laravel/ui](https://github.com/laravel/ui).
This has been installed according to the README in this package.

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
create database people_seedtech_development;
create database people_seedtech_test;
```

## Seed data

1. Seeding data
  1. Reset database with `php artisan migrate:fresh`
  2. Seed data with `php artisan db:seed`
2. Login user
  1. Login with email: "test@example.com", password: "password"
