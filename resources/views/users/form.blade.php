@extends('layouts.app')

@section('title', ($user->exists ? 'Edit' : 'Create').' User | The Daily Fit')

@section('content')
    <section class="page-hero compact-hero">
        <p class="eyebrow">Account management</p>
        <h1>{{ $user->exists ? 'Edit' : 'Create' }} User</h1>
        <p>Keep staff details up to date and give each account a profile photo.</p>
    </section>

    <section class="section form-section">
        <a class="back-link" href="{{ route('users.index') }}">&larr; Back to user accounts</a>
        @if ($errors->any())
            <div class="form-errors" role="alert">
                <strong>Please correct the highlighted fields.</strong>
                <p>Your text input has been kept. If you selected a photo, please select it again.</p>
            </div>
        @endif
        <form class="account-form" method="POST" action="{{ $user->exists ? route('users.update', $user) : route('users.store') }}" enctype="multipart/form-data">
            @csrf
            @if ($user->exists)
                @method('PATCH')
            @endif
            <p class="form-note">Fields marked * are required.</p>
            <div class="form-field">
                <label for="username">Username *</label>
                <input id="username" name="username" type="text" maxlength="50" value="{{ old('username', $user->username) }}" required @error('username') aria-invalid="true" aria-describedby="username-error" @enderror>
                @error('username')<p class="field-error" id="username-error">{{ $message }}</p>@enderror
            </div>
            <div class="form-field">
                <label for="full_name">Full name *</label>
                <input id="full_name" name="full_name" type="text" maxlength="100" value="{{ old('full_name', $user->full_name) }}" required @error('full_name') aria-invalid="true" aria-describedby="full_name-error" @enderror>
                @error('full_name')<p class="field-error" id="full_name-error">{{ $message }}</p>@enderror
            </div>
            @if ($user->exists)
                <div class="form-field avatar-editor">
                    <img class="avatar avatar-large" src="{{ $user->avatar_url }}" alt="Current profile photo of {{ $user->full_name }}">
                    <label for="avatar">Profile picture (optional)</label>
                    <input id="avatar" name="avatar" type="file" accept="image/jpeg,image/png,image/webp" aria-describedby="avatar-help @error('avatar') avatar-error @enderror" @error('avatar') aria-invalid="true" @enderror>
                    <p class="form-note" id="avatar-help">JPG, PNG or WebP, up to 2 MB and 6000 × 6000 pixels. Saved as a square 300 × 300 thumbnail. Leave blank to keep the current photo.</p>
                    @error('avatar')<p class="field-error" id="avatar-error">{{ $message }}</p>@enderror
                </div>
            @else
                <p class="form-note">Create the account first, then choose Edit account to upload a profile photo.</p>
            @endif
            <div class="form-actions">
                <button class="button button-dark" type="submit">{{ $user->exists ? 'Save changes' : 'Create user' }}</button>
                <a class="button button-light" href="{{ route('users.index') }}">Cancel</a>
            </div>
        </form>
    </section>
@endsection
