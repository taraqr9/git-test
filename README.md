# Laravel 12 API with JWT Authentication

This is a modern RESTful API starter project built with **Laravel 12** and **PHP 8.4**, featuring **JWT-based authentication** using `tymon/jwt-auth`. It provides basic user registration, login, and logout functionality, and is ready for PostgreSQL or MySQL database integration.

## 🚀 Installation Guide

Follow the steps below to get the project up and running on your local environment.

---

### 1. Clone the Repository

```bash
git clone <your-repository-url>
cd <project-directory>
```

### 2. Install PHP Dependencies
```
composer install
```

### 3. Generate JWT Secret Key
   This will generate the secret key required for token signing.
```
php artisan jwt:secret
```

### 4. Copy the Example Environment File
```
cp .env.example .env
```

### 5. Configure Your Database
   Update the .env file with your database credentials (PostgreSQL or MySQL).

### 6. Run Migrations
```
php artisan migrate
```

### 7. Serve the Application
```
php artisan serve
```
