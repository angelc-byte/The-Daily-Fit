# The Daily Fit — TFA6: From Arrays to Eloquent

This IT0049 project continues TFA5 with database-backed customer and user directories.
The four pages and existing product/profile images are retained. CustomerController and
UserController now query Eloquent models; Blade renders those records with `@foreach`.

## Requirements and setup

PHP 8.2+, Composer, and the PDO SQLite extension are required. SQLite is the local default.
No Apache, MySQL, npm build, or htdocs folder is needed.

For a fresh clone (do not overwrite an existing .env):

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Open http://127.0.0.1:8000. Keep the terminal open; Ctrl+C stops the server.
On Angel's computer, use `C:\xampp\php\php.exe` instead of `php` if PHP is not on PATH.
The SQLite file is `database/database.sqlite` and is excluded from Git.

For the existing configured project, only `php artisan serve` is needed.
After pulling new migrations, run `php artisan migrate --seed` first.
Seeders can be rerun without duplicating the six sample accounts per table.
Do not use `migrate:fresh` on a database containing records you need: it deletes tables.

## Pages and implementation

- `/`: home and featured products (presentation data remains static).
- `/about`: store information.
- `/customers`: CustomerController → Customer model → customers table → customers/index.blade.php.
- `/users`: UserController → User model → users table → users/index.blade.php.
- `database/migrations`: table creation, staff fields, and full_name alignment.
- `database/seeders`: CustomerSeeder and UserSeeder, invoked by DatabaseSeeder.
- `public/images`: locally stored product and profile photos.

The TFA2 core fields are preserved: customers have full_name, email, phone;
users have username (unique) and full_name. Both tables have numeric primary IDs
and timestamps. Additional presentation fields preserve the TFA5 account codes,
photos, staff roles, and statuses. Laravel's starter users table retains its
password/email fields; this activity does not implement login or authentication.
Seeded credentials are demonstration-only, not production accounts.

## Verification

```powershell
php artisan test
php artisan migrate:status
php artisan route:list
```

Feature tests use an isolated in-memory SQLite database, not the local database.
They cover all four routes, database-driven changes, seeded records, repeatable
seeding, unique usernames, escaped output, and empty directories.

## Submission and hosting

Submit this repository's source, including migrations and seeders; the activity
allows these instead of a database export. Do not commit .env, vendor, or private data.
Hosting is not required for this submission, as confirmed by the student.
Run the application locally using the setup instructions above.

The legacy Vercel configuration is retained from TFA5 but is not a verified TFA6
deployment. A serverless temporary SQLite file is not persistent storage. Hosting
needs a persistent database, configured DB_* environment variables, an APP_KEY,
APP_DEBUG=false, and migrations/seeding run against the hosted database. Use a
persistent PHP host with SQLite storage or a managed MySQL/PostgreSQL database.
Never use real customer data in this classroom sample.
