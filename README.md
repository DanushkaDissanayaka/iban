
## Project Build With

- PHP Version PHP 8.2
- NodeJs Version 22.9.0
- Laravel Version 10.10
- Vite + Vue 3

# Developer Setup Guide for Laravel Application with Vite + Vue.js 3

Project Overview : The application enables users to validate IBAN numbers while ensuring secure user management for both regular users and administrators.

---

## Prerequisites

Before you begin, ensure you have the following tools installed on your development machine:

### Backend (Laravel)
- PHP >= 8.1
- Composer
- MySQL or any other supported database
- Laravel CLI

#### This project required bcmath extension for php

Use command to add extension for ubuntu
```
add-apt-repository ppa:ondrej/php
apt update
apt install php8.2-bcmath
```

### Frontend (Vite + Vue 3)
- Node.js >= 20.x
- npm or yarn

---

## Step 1: Clone the Repository

1. Clone the project repository to your local machine:
   ```bash
   git clone https://github.com/DanushkaDissanayaka/iban
   ```
2. Navigate into the project directory:
   ```bash
   cd iban
   ```

---

## Step 2: Set Up the Backend (Laravel)

1. Navigate to the Laravel backend directory:
   ```bash
   cd iban_backend
   ```
2. Install PHP dependencies using Composer:
   ```bash
   composer install
   ```
3. Copy the environment configuration file:
   ```bash
   cp .env.example .env
   ```
4. Generate the application key:
   ```bash
   php artisan key:generate
   ```
5. Update the `.env` file with your local database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=<your-database-name>
   DB_USERNAME=<your-database-username>
   DB_PASSWORD=<your-database-password>
   JWT_SECRET=<jwt-secret>
   ```
6. Run migrations to set up the database schema:
   ```bash
   php artisan migrate
   ```
7.  Seed the database with test data:
    ```bash
    php artisan db:seed
    ```
   
8. There are two example users with permission 'admin' and 'user'

   ```bash
   'Admin'
   username:admin@example.com
   password:password

   'User'
   email:user@example.com
   password: password
   ```
---

## Step 3: Set Up the Frontend (Vue.js 3 with Vite)

1. Navigate to the Vue.js frontend directory:
   ```bash
   cd iban_frontend
   ```
2. Install Node.js dependencies:
   ```bash
   npm install
   ```
   or if you use Yarn:
   ```bash
   yarn install
   ```
---

## Step 4: Run the Application

1. Start the Laravel backend server:
   ```bash
   cd iban_backend
   php artisan serve
   ```
2. Start the Vite development server for the frontend:
   ```bash
   cd iban_frontend
   npm run dev
   ```
   or using Yarn:
   ```bash
   yarn dev
   ```

## Step 5: Debugging and Logs

1. Laravel logs are located in the `iban_backend/storage/logs` directory.
2. Use the browser developer tools for debugging frontend issues.
3. Run the following commands to identify and fix common issues:
   - Clear application cache:
     ```bash
     php artisan cache:clear
     ```
   - Clear configuration cache:
     ```bash
     php artisan config:clear
     ```
   - Clear route cache:
     ```bash
     php artisan route:clear
     ```
