@extends('layouts.app')

@section('title', ($customer->exists ? 'Edit' : 'Create').' Customer | The Daily Fit')

@section('content')
    <section class="page-hero compact-hero">
        <p class="eyebrow">Account management</p>
        <h1>{{ $customer->exists ? 'Edit' : 'Create' }} Customer</h1>
        <p>Add or update customer contact information.</p>
    </section>

    <section class="section form-section">
        <a class="back-link" href="{{ route('customers.index') }}">&larr; Back to customer accounts</a>
        @if ($errors->any())
            <div class="form-errors" role="alert">
                <strong>Please correct the highlighted fields.</strong>
                <p>Your text input has been kept.</p>
            </div>
        @endif
        <form class="account-form" method="POST" action="{{ $customer->exists ? route('customers.update', $customer) : route('customers.store') }}">
            @csrf
            @if ($customer->exists)
                @method('PATCH')
            @endif
            <p class="form-note">Fields marked * are required.</p>
            <div class="form-field">
                <label for="full_name">Full name *</label>
                <input id="full_name" name="full_name" type="text" maxlength="100" value="{{ old('full_name', $customer->full_name) }}" required @error('full_name') aria-invalid="true" aria-describedby="full_name-error" @enderror>
                @error('full_name')<p class="field-error" id="full_name-error">{{ $message }}</p>@enderror
            </div>
            <div class="form-field">
                <label for="email">Email address *</label>
                <input id="email" name="email" type="email" maxlength="150" value="{{ old('email', $customer->email) }}" required @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
                @error('email')<p class="field-error" id="email-error">{{ $message }}</p>@enderror
            </div>
            <div class="form-field">
                <label for="phone">Phone number (optional)</label>
                <input id="phone" name="phone" type="tel" maxlength="20" value="{{ old('phone', $customer->phone) }}" @error('phone') aria-invalid="true" aria-describedby="phone-error" @enderror>
                @error('phone')<p class="field-error" id="phone-error">{{ $message }}</p>@enderror
            </div>

            <div class="form-actions">
                <button class="button button-dark" type="submit">{{ $customer->exists ? 'Save changes' : 'Create customer' }}</button>
                <a class="button button-light" href="{{ route('customers.index') }}">Cancel</a>
            </div>
        </form>
    </section>
@endsection
