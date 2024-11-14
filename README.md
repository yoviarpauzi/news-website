# News Website Installation Guide

This guide outlines the steps to install and run the News Website application.

## Installation Steps

### 1. Create the `.env` File

Copy the contents of the `.env.example` file to create a new `.env` file:

```bash
cp .env.example .env
```

### 2. Generate the Application Key

Generate a unique application key for the application:

```bash
php artisan key:generate
```

### 3. Configure the URL in `.env`

In the `.env` file, change the `APP_URL` to:

```env
APP_URL=http://127.0.0.1
```

### 4. Configure the Database

Open the `.env` file and set up your database configuration:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 5. Install Dependencies

Run the following commands to install project dependencies:

```bash
composer install
npm install
```

### 6. Run Database Migrations

Run database migrations to create the necessary tables:

```bash
php artisan db:migrate
```

### 7. Create a User for the Admin Panel

Run the following command to create a user for the admin panel:

```bash
php artisan make:filament-user
```

### 8. Link Storage

Create a symbolic link for the storage directory:

```bash
php artisan storage:link
```

### 9. Seed Categories

Run the category seeder to populate the categories table:

```bash
php artisan db:seed --class=CategorySeeder
```

### 10. Seed Posts

Run the post seeder to populate the posts table. **Note**: If images are not generated during this step, you may need to run this command again.

```bash
php artisan db:seed --class=PostSeeder
```

### 11. Run the Program

Start the development server with the following commands:

```bash
php artisan serve
```

```bash
npm run dev
```

**Note**: To access the admin panel, navigate to [http://127.0.0.1:8000/admin](http://127.0.0.1:8000/admin).
