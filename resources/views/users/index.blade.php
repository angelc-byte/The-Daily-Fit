@extends('layouts.app')

@section('title', 'User Accounts | The Daily Fit')

@section('content')
    <section class="page-hero compact-hero">
        <p class="eyebrow">Store team</p>
        <h1>User Accounts</h1>
        <p>Staff information supplied by a static PHP array in the UserController.</p>
    </section>

    <section class="section directory-section">
        <div class="directory-summary">
            <div><span>Team members</span><strong>{{ count($users) }}</strong></div>
            <p>Showing all sample user records</p>
        </div>

        <div class="team-grid">
            @foreach ($users as $user)
                <article class="team-card">
                    <div class="team-card-top">
                        <span class="avatar avatar-large">{{ collect(explode(' ', $user['name']))->map(fn ($part) => substr($part, 0, 1))->take(2)->join('') }}</span>
                        <span class="status"><i></i>{{ $user['status'] }}</span>
                    </div>
                    <h2>{{ $user['name'] }}</h2>
                    <p>{{ $user['role'] }}</p>
                    <dl>
                        <div><dt>User ID</dt><dd>{{ $user['id'] }}</dd></div>
                        <div><dt>Username</dt><dd>{{ '@'.$user['username'] }}</dd></div>
                    </dl>
                </article>
            @endforeach
        </div>
    </section>
@endsection
