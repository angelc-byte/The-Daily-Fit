@extends('layouts.app')

@section('title', 'User Accounts | The Daily Fit')

@section('content')
    <section class="page-hero compact-hero">
        <p class="eyebrow">Store team</p>
        <h1>User Accounts</h1>
        <p>Staff information retrieved from the database using Eloquent.</p>
    </section>

    <section class="section directory-section">
        <div class="directory-summary">
            <div><span>Team members</span><strong>{{ count($users) }}</strong></div>
            <a class="button button-dark" href="{{ route('users.create') }}">Create user</a>
        </div>

        <div class="team-grid">
            @foreach ($users as $user)
                <article class="team-card">
                    <div class="team-card-top">
                        <img class="avatar avatar-large" src="{{ $user->avatar_url }}" alt="Profile photo of {{ $user->full_name }}">
                        <span class="status"><i></i>{{ $user->status }}</span>
                    </div>
                    <h2>{{ $user->full_name }}</h2>
                    <p>{{ $user->role }}</p>
                    <dl>
                        <div><dt>User ID</dt><dd>{{ $user->staff_code }}</dd></div>
                        <div><dt>Username</dt><dd>{{ '@'.$user->username }}</dd></div>
                    </dl>
                    <a class="edit-link" href="{{ route('users.edit', $user) }}" aria-label="Edit {{ $user->full_name }}">Edit account &rarr;</a>
                </article>
            @endforeach
        </div>
    </section>
@endsection
