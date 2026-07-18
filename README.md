# EchoWild 🌿

EchoWild is an aesthetic and private digital journal built with **Laravel** and **Tailwind CSS**. It provides a beautifully designed, distraction-free environment for you to record your daily reflections, track your moods, and visualize your inner journey.

## Features

- **Beautiful UI/UX**: Designed with modern glassmorphism effects, a calming emerald & sage green color palette, and subtle ambient animations.
- **Journal Management**: Full CRUD (Create, Read, Update, Delete) functionality for your daily journal entries.
- **Mood Tracking**: Log your mood manually using an intuitive emoji-based selector (from 😩 to 😁) when writing journals.
- **Secure Authentication**: Powered by Laravel Breeze for secure login, registration, and user session management.
- **Responsive Design**: Fully responsive layout that looks great on desktop, tablet, and mobile devices.

## Tech Stack

- **Backend**: Laravel 11.x (PHP 8.x)
- **Frontend**: Blade Templates, Tailwind CSS, Alpine.js
- **Database**: MySQL / SQLite (configurable via `.env`)

## Installation

1. **Clone the repository** (if applicable) or copy the files to your local environment.
2. **Install PHP dependencies**:
   ```bash
   composer install
   ```
3. **Install NPM dependencies** and build assets:
   ```bash
   npm install
   npm run build
   ```
4. **Environment Setup**:
   Copy the example `.env` file and generate an application key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Make sure to configure your database credentials in the `.env` file.*
5. **Run Migrations**:
   ```bash
   php artisan migrate
   ```
6. **Serve the Application**:
   ```bash
   php artisan serve
   ```
   *Note: If you are using Laragon, XAMPP, or Laravel Valet, you can access the app directly via your local development URL (e.g., `http://echowild.test`).*

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
