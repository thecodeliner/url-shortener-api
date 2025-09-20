<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 🔗 Laravel URL Shortener API

A simple **URL Shortener API** built with Laravel.  
This API allows users to shorten long URLs, redirect them using the short version, and track click counts. Each shortened URL is associated with an authenticated user.

---
# Postman Documentation
https://documenter.getpostman.com/view/48401009/2sB3HtEbfW


## 🚀 Features
- ✅ Shorten any valid URL  
- ✅ Generate unique 5-character short codes  
- ✅ Redirect to the original URL  
- ✅ Track number of clicks for each short link  
- ✅ User-specific URL management (requires authentication)  

---

## 📦 Installation
1. **Clone the repository**  
   Clone the project and navigate to the project directory:
   ```bash
   git clone https://github.com/your-username/laravel-url-shortener.git
   cd laravel-url-shortener
   ```

2. **Install dependencies**  
   Install the required PHP dependencies using Composer:
   ```bash
   composer install
   ```

3. **Set up environment variables**  
   Copy the `.env.example` file to `.env` and configure your environment variables:
   ```bash
   cp .env.example .env
   ```

4. **Generate application key**  
   Generate a unique application key for your Laravel project:
   ```bash
   php artisan key:generate
   ```

5. **Run migrations**  
   Set up the database by running the migrations:
   ```bash
   php artisan migrate
   ```

6. **Start the local development server**  
   Launch the Laravel development server:
   ```bash
   php artisan serve
   ```
# API Documentation

## 🔑 Authentication
All routes require an authenticated user (e.g., via Laravel Sanctum or Passport).  
Ensure authentication is configured before using the API.

## 📡 API Endpoints

### 1. Create a Short URL
**POST** `/api/urls`

**Request Body:**
```json
{
  "original_url": "https://example.com/very/long/link"
}
```

**Response:**
```json
{
  "original_url": "https://example.com/very/long/link",
  "short_url": "http://your-app.test/abc12"
}
```

### 2. Redirect to Original URL
**GET** `/{short_url}`

Redirects the user to the original URL and increments the clicks counter.

**Example:**  
`http://your-app.test/abc12` → redirects to `https://example.com/very/long/link`

### 3. List User’s Short URLs
**GET** `/api/urls`

**Response:**
```json
{
  "status": true,
  "urls": [
    {
      "original_url": "https://example.com/very/long/link",
      "short_url": "abc12",
      "clicks": 5
    }
  ]
}
```

## 🗄 Database Structure

| Column        | Type     | Description                          |
|---------------|----------|--------------------------------------|
| id            | bigint   | Primary key                          |
| user_id       | bigint   | ID of the owner (FK to users)        |
| original_url  | text     | Original long URL                    |
| short_url     | varchar  | Unique 5-character short code        |
| clicks        | int      | Number of times link was visited     |
| created_at    | datetime | Timestamp                            |
| updated_at    | datetime | Timestamp                            |

## 🛠 Tech Stack
- **Laravel**: PHP Framework
- **MySQL / PostgreSQL**: Database
- **Authentication**: Laravel Sanctum or Passport

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
