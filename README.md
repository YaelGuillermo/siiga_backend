# siiga_backend
Backend of Academic Management of a Primary School

Academic Enrollment Management System
This is a project for managing academic enrollments, built with Laravel, MySQL, and Laragon.

Installation
Clone the repository to your local machine.

bash
Copy code
git clone <repository-url>
Install PHP dependencies using Composer.

bash
Copy code
composer install
Copy the .env.example file to .env and configure your environment variables, such as database connection details.

Generate application key.

bash
Copy code
php artisan key:generate
Run database migrations and seeders to set up the database.

bash
Copy code
php artisan migrate --seed
Serve the application.

bash
Copy code
php artisan serve
Access the application in your web browser at http://localhost:8000.

Features
User authentication: Register, login, logout.
Enrollment management: Add, edit, delete enrollments.
Student management: Add, edit, delete students.
Course management: Add, edit, delete courses.
Reports: Generate reports on enrollments, students, courses, etc.
Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

License
MIT
