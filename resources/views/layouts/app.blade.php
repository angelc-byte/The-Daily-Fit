<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="The Daily Fit Laravel POS foundations project">
    <title>@yield('title', 'The Daily Fit')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header class="site-header">
        <a class="brand" href="{{ route('home') }}" aria-label="The Daily Fit home">
            <span class="brand-mark">DF</span>
            <span>
                <strong>The Daily Fit</strong>
                <small>Online Store</small>
            </span>
        </a>

        <nav class="site-nav" aria-label="Main navigation">
            <a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
            <a class="{{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
            <a class="{{ request()->routeIs('customers.*') ? 'active' : '' }}" href="{{ route('customers.index') }}">Customers</a>
            <a class="{{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">Users</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div>
            <strong>The Daily Fit</strong>
            <p>Everyday style, thoughtfully selected.</p>
        </div>
        <div class="footer-links">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('customers.index') }}">Customers</a>
            <a href="{{ route('users.index') }}">Users</a>
        </div>
        <p class="copyright">&copy; {{ date('Y') }} The Daily Fit. IT0049 TFA5.</p>
    </footer>
</body>
</html>
