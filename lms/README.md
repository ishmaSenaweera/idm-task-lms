# Laravel 11 Project Setup Guide

This guide will help you clone and set up the project on your local machine using XAMPP. It also includes instructions to seed the admin user data.

## Prerequisites

-   XAMPP installed on your machine
-   Composer installed globally

## Clone the Repository

1. Clone the repository.
2. Navigate to the LMS directory.

## Set Up Environment Variables

1. Copy the `.env.example` file and rename it to `.env`:
2. Configure your `.env` file with your database credentials.

## Database Setup

1. Open XAMPP and start Apache and MySQL services.
2. Update your `.env` file with your database credentials.

## Run Migrations and Seeders

1. Run the following command to migrate the database tables: `php artisan migrate`
2. Seed users' data: `php artisan db:seed --class=UsersSeeder`
3. Seed user roles and permissions: `artisan db:seed --class=RolesAndPermissionSeeder` and
   `php artisan db:seed --class=UserRoleSeeder`
4. After creating few courses, edit and use StudentAndCourseSeeder accordingly to seed students to courses using:
   `php artisan db:seed --class=StudentAndCourseSeeder`

## Start the Development Server

1. Run the following command to start the Laravel development server: `php artisan serve`
2. Open your web browser and navigate to `http://localhost:8000` to see your Laravel application running.

## Admin Login

-   Username: admin@gmail.com
-   Password: 123@admin
