<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(): View
    {
        $customers = Customer::query()->orderBy('customer_code')->get();

        return view('customers.index', compact('customers'));
    }

    public function create(): View
    {
        return view('customers.form', ['customer' => new Customer]);
    }

    public function store(CustomerRequest $request): RedirectResponse
    {
        Customer::create($request->validated() + [
            'customer_code' => 'C-'.strtoupper(bin2hex(random_bytes(8))),
        ]);

        return redirect()->route('customers.index')->with('success', 'Customer account created successfully.');
    }

    public function edit(Customer $customer): View
    {
        return view('customers.form', compact('customer'));
    }

    public function update(CustomerRequest $request, Customer $customer): RedirectResponse
    {
        $customer->update($request->validated());

        return redirect()->route('customers.index')->with('success', 'Customer account updated successfully.');
    }
}
