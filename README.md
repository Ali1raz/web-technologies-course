<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects.

# Problem Statement:

COMSATS University wants to create a basic web application to manage and display a list of academic courses, particularly for the Web Technologies subject. The application should allow students to:

-   View available web technology courses.
-   Search for specific courses by title.
-   Allow admins (faculty) to add new courses to the list.
-   The goal is to implement this as a Laravel-based web application.

# Task Details:

## Course List Display:

-   Create a Laravel application with routes and controllers to show a list of courses (e.g., HTML, CSS, JavaScript, Laravel, Bootstrap).
-   Store course data in a PHP array (title, instructor, credit hours, semester).

## Search Functionality:

-   Allow students to search for courses by title.
-   Use conditional statements and loops in PHP to filter matching courses.

## Add New Courses (Admin):

-   Provide a separate route for faculty to access a form to add new courses.
-   Use Laravel controllers to handle the form and update the array with new course data.

## Routing & Views:

-   Define user and admin routes using Laravel routing.
-   Use Blade templates to create clean and responsive views for course listings and the add course form.

## Passing Data to Views:

-   Use Laravel controllers to pass the courses array to the views and display it dynamically.
