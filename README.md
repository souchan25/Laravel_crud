# Laravel Issue/Bug Tracker

A simple and efficient Issue and Bug Tracking system built with Laravel. This application allows users to create, manage, and assign tickets for various tasks, bugs, or feature requests.

## Features

-   **User Authentication:** Secure login and registration powered by Laravel Breeze.
-   **Ticket Management:** Create, view, update, and delete tickets (CRUD functionality).
-   **Ticket Attributes:**
    -   **Status:** Open, In Progress, Resolved.
    -   **Priority:** Low, Medium, High, Urgent.
    -   **Type:** Bug, Feature, Task, Inquiry.
-   **Assignment:** Tickets can be assigned to specific team members.
-   **Commenting System:** Users can add comments to tickets for better collaboration.
-   **Dashboard:** A visual overview of ticket statistics (Open, In Progress, Resolved).
-   **Team Page:** A dedicated "About Us" page that displays team members and roles, configurable via `config/team.php`.
-   **Profile Management:** Users can manage their profile settings and account information.

## Tech Stack

-   **Backend:** [Laravel 9](https://laravel.com/) (PHP 8.1+)
-   **Authentication:** [Laravel Breeze](https://laravel.com/docs/9.x/starter-kits#laravel-breeze)
-   **Frontend:** Tailwind CSS, Vite
-   **Database:** MySQL / SQLite / PostgreSQL (configured via `.env`)
-   **Icons/UI:** Blade Components

## Installation

Follow these steps to set up the project locally:

1.  **Clone the repository:**
    ```bash
    git clone <repository-url>
    cd <project-directory>
    ```

2.  **Install PHP dependencies:**
    ```bash
    composer install
    ```

3.  **Install NPM dependencies:**
    ```bash
    npm install && npm run build
    ```

4.  **Set up environment variables:**
    Copy the `.env.example` file to `.env` and update your database credentials:
    ```bash
    cp .env.example .env
    ```

5.  **Generate application key:**
    ```bash
    php artisan key:generate
    ```

6.  **Run migrations and seeders:**
    ```bash
    php artisan migrate --seed
    ```

7.  **Start the development server:**
    ```bash
    php artisan serve
    ```

## Configuration

### Team Members
To update the list of team members displayed on the "About Us" page, modify the `members` array in:
`config/team.php`

### Environment
Ensure your `.env` file is correctly configured for your local environment, especially the `DB_*` variables for database connectivity.

## Core Models

-   **User:** Represents a team member or reporter.
-   **Ticket:** Represents an issue, bug, or task.
-   **Comment:** Represents a discussion entry on a specific ticket.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
