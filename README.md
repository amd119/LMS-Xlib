# Laravel 11: Library Management System With Laravel Breeze

## Installation

### Composer and NPM Packages
```
composer install
npm install
```

### Update Packages
```
composer update
npm update
```

## Configuration

### Create `.env` file from `.env.example`
```
cp .env.example .env
```

### Generate Laravel App Key
```
php artisan key:generate
```

### Create a Symbolic Link
```
php artisan storage:link
```

### Database Integration
1. Open `.env` file
2. Create a database and connect it with Laravel with filling the DB name in `DB_DATABASE` key
3. Adjust the `DB_USERNAME`
4. Adjust the `DB_PASSWORD`

### Migrate the Database Migration and Run the Seeder
```
php artisan migrate
```
```
php artisan db:seed
```

## Run App

Run local web server
```
php artisan serve
```

Open new console and run the app with Vite
```
npm run dev
```