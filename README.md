# The Daily Fit Laravel POS Foundations

This project is the Technical Formative Assessment 5 submission for IT0049 Web System Technologies. It rebuilds the earlier Point-of-Sale interface in Laravel and focuses on routes, controllers, Blade views, and static PHP arrays.

## Required pages

- `/` - landing page
- `/about` - store information
- `/customers` - customer accounts generated with `@foreach`
- `/users` - user accounts generated with `@foreach`

## Project structure

- `routes/web.php` defines the four routes.
- `app/Http/Controllers/PageController.php` handles the landing and about pages.
- `app/Http/Controllers/CustomerController.php` supplies a static customer array.
- `app/Http/Controllers/UserController.php` supplies a static user array.
- `resources/views` contains the shared layout and four Blade pages.
- `public/css/app.css` contains the responsive The Daily Fit styling.

## Local setup

Requirements: PHP 8.2 or newer and Composer.

```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan serve
```

Open `http://127.0.0.1:8000` in a browser.

## Verification

```bash
php artisan route:list
php artisan test
```

The activity intentionally uses static arrays as temporary data sources, so no database setup is required for these four pages.

## Deployment

The repository includes `api/index.php` and `vercel.json` for deployment through Vercel's PHP runtime. Configure these environment variables in the hosting project:

```text
APP_NAME="The Daily Fit"
APP_ENV=production
APP_KEY=<generate with php artisan key:generate --show>
APP_DEBUG=false
APP_URL=<your hosted URL>
LOG_CHANNEL=stderr
SESSION_DRIVER=array
CACHE_STORE=array
QUEUE_CONNECTION=sync
```

The project also retains Laravel's standard `database/migrations` and `database/seeders` directories for repository completeness. They are not used by the required customer and user listing pages.

## Submission checklist

- Confirm all four routes work locally.
- Push the raw project files to GitHub.
- Do not commit `.env` or `vendor`.
- Deploy the same GitHub revision and verify all four hosted routes.
- Submit the GitHub repository link and hosted application link.
