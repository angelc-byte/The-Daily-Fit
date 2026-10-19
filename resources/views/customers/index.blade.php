@extends('layouts.app')

@section('title', 'Customer Accounts | The Daily Fit')

@section('content')
    <section class="page-hero compact-hero">
        <p class="eyebrow">Account directory</p>
        <h1>Customer Accounts</h1>
        <p>Customer information retrieved from the database using Eloquent.</p>
    </section>

    <section class="section directory-section">
        <div class="directory-summary">
            <div><span>Total customers</span><strong>{{ count($customers) }}</strong></div>
            <p>Showing all sample customer records</p>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Customer ID</th>
                        <th>Contact</th>
                        <th>Joined</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <td>
                                <div class="person-cell">
                                    <img class="avatar" src="{{ asset($customer->avatar) }}" alt="Profile photo of {{ $customer->full_name }}">
                                    <div><strong>{{ $customer->full_name }}</strong><span>{{ $customer->email }}</span></div>
                                </div>
                            </td>
                            <td><span class="id-badge">{{ $customer->customer_code }}</span></td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->created_at->format('M d, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
