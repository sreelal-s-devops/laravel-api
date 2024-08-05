# Task Management API

This project is a simple Task Management API built with Laravel 11 and Laravel Sanctum for authentication. The API allows users to register, log in, and manage their tasks.

## Features

- User registration
- User login to obtain an API token
- User logout
- Create, read, update, and delete tasks for authenticated users

## Installation

### Prerequisites

- PHP >= 8.1
- Composer
- MySQL or any other supported database

### Steps

1. Clone the repository.
2. Run `composer install` to install dependencies.
3. Copy `.env.example` to `.env` and configure your environment variables.
4. Run `php artisan key:generate` to generate an application key.
5. Configure your database settings in the `.env` file.
6. Run `php artisan migrate` to apply database migrations.
7. Run `composer require laravel/sanctum` to install Laravel Sanctum.
8. Run `php artisan db:seed` to seed the database with initial data.
9. Run `php artisan serve` to start the development server.

## API Endpoints

### Register

**POST** `/api/register`

**Request Body:**
```json
{
    "name": "<user name>",
    "email": "<email>",
    "password": "<password>"
}
