# MovieBox v2

MovieBox v2 is a Laravel-based movie management application that provides a complete authentication system, personalized watchlist and favorites, movie search, ratings, reviews, and theme customization.

## Features

### Authentication

- **Sign Up** — Create a new user account.
- **Log In** — Securely authenticate users.
- **Change Password** — Change the account password from the user profile.
- **Forgot Password** — Request a password reset.
- **Password Reset Email** — Receive a password reset email.
- **Log Out** — Securely log out from the application.
- **Welcome Email** — Receive a welcome email after creating an account.

### Movie Management

- **Movie Search** — Search for movies.
- **Watchlist** — Add and remove movies from your personal watchlist.
- **Favorites** — Add and remove movies from your favorites.
- **Change Watching Status** — Change a movie's status, including marking it as **Watched**.
- **Movie Rating** — Rate watched movies.
- **Add to Watchlist from Home** — Add movies directly to your watchlist from the home page.

### User Profile

- **Profile Page** — View user account information.
- **Watchlist** — Manage movies saved for watching.
- **Favorites** — Manage favorite movies.

### UI & Theme

- **Dark Mode** — Switch the application to a dark theme.
- **Light Mode** — Switch the application to a light theme.

### Reviews & Email

- **Movie Reviews** — Users can submit reviews for movies.
- **Review Email Notification** — Receive an email related to submitted reviews.

## Built With

- **Laravel**
- **PHP**
- **MySQL**
- **Blade**
- **HTML / CSS / JavaScript**

## Project Development

MovieBox v2 was developed as a Laravel project with a focus on authentication, movie management, user personalization, and watchlist functionality.

The **backend and application logic were developed by me using Laravel**, including the database structure, models, controllers, routes, validation, authentication, CRUD operations, watchlist, favorites, movie ratings, and email functionality.

The **frontend/UI was developed with the assistance of AI tools**.

## Installation & Setup

### 1. Clone the repository

bash
git clone https://github.com/Hassanzz23/MovieBox-v2.git


Navigate to the project directory:

bash
cd MovieBox-v2


### 2. Install PHP dependencies

Make sure you have PHP and Composer installed, then run:

bash
composer install


### 3. Create the environment file

Copy `.env.example` and create a `.env` file.

On Windows, you can simply copy `.env.example` and rename the copy to `.env`.

### 4. Generate the application key

bash
php artisan key:generate


### 5. Configure the database

Open the `.env` file and configure your MySQL database:

env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password


Create the database in MySQL before running the migrations.

### 6. Run migrations

bash
php artisan migrate


If the project contains seeders and you want to populate the database with sample data:

bash
php artisan db:seed


### 7. Configure email

MovieBox v2 uses email functionality for features such as password reset and welcome emails.

Configure your mail settings in `.env`:

env
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email
MAIL_FROM_NAME="${APP_NAME}"


> Never commit your `.env` file or real email credentials to GitHub.

### 8. Run the application

Start the Laravel development server:

bash
php artisan serve


Then open:

text
http://127.0.0.1:8000


## Usage

After starting the application, users can:

1. Create an account or log in.
2. Search for movies.
3. Add movies to their watchlist.
4. Remove movies from their watchlist.
5. Add or remove movies from favorites.
6. Change the watching status of movies.
7. Mark movies as **Watched**.
8. Rate movies.
9. Add movies to the watchlist directly from the home page.
10. View and manage their profile.
11. Submit movie reviews.
12. Switch between **Dark Mode** and **Light Mode**.
13. Reset their password through the password reset email.

## Project Structure

The project follows the standard Laravel application structure:

text
MovieBox-v2/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
├── .env.example
├── artisan
├── composer.json
├── composer.lock
├── package.json
└── README.md


## Author

**Hassanzz23**

GitHub: https://github.com/Hassanzz23

## License

This project was created as a learning and portfolio project.