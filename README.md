# Booking App

This is a simple Laravel-based Book Management System that allows staff and readers to interact with the system. 

## Features

- Staff (Admin,Editor,Viewer) and Reader roles
- Dashboard for Staff and Readers
- Registration for both Staff Roles and Readers
- User status management for Staff users
- Book Create , Update and Delete 

## Requirements

- PHP >= 8.1
- Composer
- Laravel >= 10.x
- MySQL >= 5.7
- NodeJS & NPM for front-end assets

## Installation

1. Clone the repository

    ```bash
    git clone https://github.com/book_management.git
    ```

2. Navigate to the project directory

    ```bash
    cd book_management
    ```

3. Install PHP dependencies

    ```bash
    composer install
    ```

4. Install JavaScript dependencies

    ```bash
    npm install
    ```

5. Build front-end assets

    ```bash
    npm run dev
    ```

6. Copy `.env.example` to `.env`

    ```bash
    cp .env.example .env
    ```

7. Generate application key

    ```bash
    php artisan key:generate
    ```

8. Update `.env` file with your database credentials

9. Run database migrations and seeders

    ```bash
    php artisan migrate --seed
    ```

10. Start the development server

    ```bash
    php artisan serve
    ```

## Usage

Visit `http://localhost:8000` to access the application.

- Admin can log in and view the dashboard, as well as manage user statuses.
- Readers can register and interact with the booking functionalities (still under development).

## Contributing

For any bugs or feature requests, please open an issue.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.
