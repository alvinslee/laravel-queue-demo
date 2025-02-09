# Inventory Report Generator

A Laravel application that demonstrates background job processing, PDF generation, and email delivery. The application allows users to generate inventory reports based on various criteria and receive them via email.

## Features

- Generate inventory reports with multiple category filters
- Set minimum quantity thresholds for low-stock alerts
- Background job processing using Redis
- PDF report generation using DomPDF
- Email delivery using Mailtrap
- PostgreSQL database for data storage
- Clean and responsive UI using Tailwind CSS

## Prerequisites

- PHP 8.2 or higher
- Composer
- PostgreSQL
- Redis
- Node.js and npm (for development)

## Installation

1. Clone the repository:
```bash
git clone <repository-url>
cd <repository-name>
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install Node.js dependencies:
```bash
npm install
```

4. Copy the environment file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Configure your environment variables in `.env`:
- Set up your PostgreSQL database credentials
- Configure your Mailtrap credentials for email testing
- Ensure Redis connection details are correct

## Database Setup

1. Create a PostgreSQL database:
```bash
createdb laravel_db
```

2. Run database migrations:
```bash
php artisan migrate
```

3. Seed the database with sample inventory items:
```bash
php artisan db:seed
```

## Running the Application

1. Start the Laravel development server:
```bash
php artisan serve
```

2. Start the Redis queue worker in a separate terminal:
```bash
php artisan queue:work
```
Note: This command uses Redis as the queue driver, as configured in your `.env` file with `QUEUE_CONNECTION=redis`

3. Build frontend assets (for development):
```bash
npm run dev
```

The application will be available at `http://localhost:8000`

## Usage

1. Visit the application in your browser
2. Click "Generate New Report"
3. Fill in the report details:
   - Report Name
   - Email Address
   - Select one or more categories
   - Optionally set a minimum quantity threshold
4. Submit the form
5. The report will be generated in the background
6. You'll receive an email with the PDF report when it's ready

## Development

- The application uses Laravel's queue system with Redis for background processing
- PDF reports are generated using the DomPDF package
- Email delivery is configured to use Mailtrap for testing
- The database is seeded with 100 random inventory items across 10 categories

## License

This project is open-sourced software licensed under the MIT license.
