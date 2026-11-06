# The Daily Fit TFA7

This IT0049 Laravel POS activity continues TFA6 in the same repository. It adds
validated create and edit forms for customers and staff, plus prepared user-avatar
uploads. The home/about pages, original six accounts per table, and bundled photos
are retained.

## Requirements

PHP 8.2+, Composer, PDO SQLite, Fileinfo, Mbstring, Exif, and GD.
Intervention Image 3 prepares 300 × 300 JPEG thumbnails using GD. The package
is the image library demonstrated in Module 7; confirm any instructor-specific
package approval if required. No Apache, MySQL, npm build, or htdocs is needed.

## Existing project on Angel's Windows computer

The migrations and storage link have already been applied locally. To open the app:

```powershell
cd "C:\Users\ANGEL\Documents\ChatGPT\IT0049 WEB SYS TECH\daily-fit-laravel-tfa5"
powershell.exe -NoProfile -ExecutionPolicy Bypass -File .\run-local.ps1
```

Visit http://127.0.0.1:8000. Keep the terminal open; Ctrl+C stops it.
The folder name remains unchanged, but its contents now implement TFA7.
If port 8000 is busy, add `-Port 8001` to the command.

The launcher enables GD only for this PHP process if XAMPP's php.ini disables it;
it does not modify global XAMPP settings. It launches PHP's local server directly
so that the server receives the GD option. If GD is enabled in php.ini,
`php artisan serve` also works. Restart any older running server before testing uploads.

## Fresh clone setup

Enable `extension=gd` in your PHP configuration (and restart PHP) before Composer
installation or image processing. On Angel's machine the PHP binary is
`C:\xampp\php\php.exe`; use that path in place of `php` if PHP is not on PATH.

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Do not replace an existing .env. SQLite uses `database/database.sqlite`.
For an existing clone, run `php artisan migrate`, not a database reset.
Seeders are for sample data: rerunning them updates matching sample accounts,
including their original photos. Never use `migrate:fresh` on data you need.

## Using the activity

- Customers → Create customer: enter full name, valid email, and optional phone.
- Customers → Edit: existing values are pre-filled; save to update the record.
- Users → Create user: enter a unique username and full name.
- Users → Edit account: change the name/username or select a profile photo.
- Leave the photo field blank to preserve the current picture.
- Validation feedback appears beside each invalid field. Text is restored with
  old() after an invalid submission; browsers require reselecting file inputs.
- Successful saves return to the directory with a confirmation message.

Emails must be unique because TFA6's customers schema already has that constraint.
Usernames allow letters, digits, periods, underscores, and hyphens (up to 50).
Account codes are generated on creation, not accepted from untrusted form fields.
Original staff roles/statuses are retained. This is a local classroom directory,
not an authenticated production POS: do not expose it publicly or use real data.

## Upload handling

JPG/JPEG, PNG and WebP only; actual image content is validated, up to 2048 KB
and 6000 × 6000 pixels. SVG and non-image uploads are rejected.
Intervention Image crops/resizes to a 300 × 300 JPEG. Storage::disk('public')
writes a generated UUID filename under avatars/; only that relative path is saved.
The listing uses /storage/ for uploads and a placeholder when no image exists.
The original TFA6 bundled photos remain supported.

The new file is saved first, then the database is updated. Only after successful
replacement is the previous managed upload deleted. Failed database saves clean up
the new upload, and bundled photos are never deleted. Files are served using the
standard storage:link public-storage link.

The avatar column was already introduced via the TFA6 staff-fields migration;
TFA7 reuses it instead of adding a duplicate column. A new migration makes the
starter email/password columns nullable so the required directory-only form does
not need to invent login credentials. That migration intentionally leaves these
columns nullable on rollback to preserve directory-only records.

## Code map

- routes/web.php: home/about and customer/user index, create, store, edit, update routes.
- app/Http/Requests: reusable customer/user validation rules.
- app/Http/Controllers: Eloquent reads and validated writes.
- app/Services/AvatarService.php: image preparation, public storage, safe cleanup.
- app/Models/User.php: upload/bundled-photo/placeholder URL selection.
- resources/views: shared layout, listings, and create/edit forms.
- database/migrations and database/seeders: reproducible database setup.
- tests/Feature/AccountFormsTest.php: form and upload verification.

## Verification

With GD enabled in php.ini:

```powershell
php artisan test
php artisan migrate:status
php artisan route:list
```

Without changing XAMPP's php.ini:

```powershell
C:\xampp\php\php.exe -d extension=gd vendor/bin/phpunit
```

Tests use an isolated in-memory SQLite database and fake upload storage, not the
local accounts or uploaded photos.

## Submission

Use the existing repository: https://github.com/angelc-byte/The-Daily-Fit
Submit the source with migrations and seeders. Hosting is not required for this
submission, as clarified by the student. Legacy Vercel files are not a verified
TFA7 deployment and are not needed to run locally.
Do not commit .env, vendor, the local database, or uploaded personal photos.

Suggested screenshot evidence: create forms, validation feedback with retained
input, pre-filled edit forms, a user listing after avatar upload, and passing tests.
