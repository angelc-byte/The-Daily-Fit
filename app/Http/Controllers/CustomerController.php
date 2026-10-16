<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(): View
    {
        $customers = [
            ['id' => 'C-1001', 'name' => 'Mika Santos', 'email' => 'mika.santos@example.com', 'phone' => '0917 245 1180', 'joined' => 'Oct 02, 2026', 'avatar' => 'images/customers/mika-santos.jpg'],
            ['id' => 'C-1002', 'name' => 'Andrea Cruz', 'email' => 'andrea.cruz@example.com', 'phone' => '0918 634 2201', 'joined' => 'Oct 03, 2026', 'avatar' => 'images/customers/andrea-cruz.jpg'],
            ['id' => 'C-1003', 'name' => 'Paolo Reyes', 'email' => 'paolo.reyes@example.com', 'phone' => '0920 811 7345', 'joined' => 'Oct 04, 2026', 'avatar' => 'images/customers/paolo-reyes.jpg'],
            ['id' => 'C-1004', 'name' => 'Nicole Garcia', 'email' => 'nicole.garcia@example.com', 'phone' => '0916 402 9817', 'joined' => 'Oct 05, 2026', 'avatar' => 'images/customers/nicole-garcia.jpg'],
            ['id' => 'C-1005', 'name' => 'Joshua Lim', 'email' => 'joshua.lim@example.com', 'phone' => '0922 719 5664', 'joined' => 'Oct 06, 2026', 'avatar' => 'images/customers/joshua-lim.jpg'],
            ['id' => 'C-1006', 'name' => 'Bianca Flores', 'email' => 'bianca.flores@example.com', 'phone' => '0915 328 4409', 'joined' => 'Oct 07, 2026', 'avatar' => 'images/customers/bianca-flores.jpg'],
        ];

        return view('customers.index', compact('customers'));
    }
}
