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
5.Configure your database settings in the .env file.
6.Run'php artisan migrate'.
7.Run 'composer require laravel/sanctum'.
8.Run 'php artisan db:seed'.
9.Run'php artisan serve'.

###API Endpoints

Register:POST /api/register.
{
    "name": "<user name>",
    "email": "<email>",
    "password": "<password>",

}

Login:POST /api/login.
{
    "email": "<email>",
    "password": "<password>"
}

Logut:POST /api/logout.
Headers:Authorization: Bearer your-generated-token

Get all tasks:GET /api/tasks.

Create a new task:POST /api/tasks

Request body:{
    "title": "New Task",
    "description": "Task description"
}

Update a task:PUT /api/tasks/{task}.

Request body:{
    "title": "Updated Task",
    "description": "Updated description"
}

Delete a task:DELETE /api/tasks/{task}.


This `README.md` provides clear instructions on setting up and using the Task Management API, making it easy for others to understand and work with your project.
