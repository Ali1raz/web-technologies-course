<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<a href="#problem-statement">Problem Statement</a>
<a href="#installation">Installation</a>

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

# Installation:

1. Prerequisites

-   `Git`: Download and install from `git-scm.com`.
-   `PHP`: Download and install from php.net.
-   `Composer`: Download and install from getcomposer.org.
-   A web server: (e.g., `XAMPP` or `WAMP`), since this is a `PHP` project.
-   `Node.js` & npm (if you need to run frontend tasks): nodejs.org.

2. Clone the Repository
Open Command Prompt and run:

```sh
git clone https://github.com/Ali1raz/student_admin_course.git
cd student_admin_course
```

3. Install Dependencies
PHP Dependencies

```sh
composer install
```

Node Dependencies (if required)
Check if there's a package.json file. If yes:

```sh
npm install
```

4. Configure Environment
Copy the example environment file:

```sh
copy .env.example .env
```

Open .env in a text editor and set up your environment variables (database, app key, etc.).

5. Set Up Database
Create a new database in your preferred database (e.g., MySQL).
Update your .env file with the database credentials.
Run migrations:
```sh
php artisan migrate
```

6. Start the Development Server
```sh
php artisan serve
```

Visit `http://localhost:8000` in your browser.
