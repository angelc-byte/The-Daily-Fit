@extends('layouts.app')

@section('title', 'Customer Accounts | The Daily Fit')

@section('content')
    <section class="page-hero compact-hero">
        <p class="eyebrow">Account directory</p>
        <h1>Customer Accounts</h1>
        <p>Customer information supplied by a static PHP array in the CustomerController.</p>
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
                                    <span class="avatar">{{ collect(explode(' ', $customer['name']))->map(fn ($part) => substr($part, 0, 1))->take(2)->join('') }}</span>
                                    <div><strong>{{ $customer['name'] }}</strong><span>{{ $customer['email'] }}</span></div>
                                </div>
                            </td>
                            <td><span class="id-badge">{{ $customer['id'] }}</span></td>
                            <td>{{ $customer['phone'] }}</td>
                            <td>{{ $customer['joined'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
