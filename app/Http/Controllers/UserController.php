<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = [
            ['id' => 'U-001', 'name' => 'Angel Tolentino', 'username' => 'admin', 'role' => 'Administrator', 'status' => 'Active'],
            ['id' => 'U-002', 'name' => 'Sofia Mendoza', 'username' => 'sofia.m', 'role' => 'Store Manager', 'status' => 'Active'],
            ['id' => 'U-003', 'name' => 'Carlo Villanueva', 'username' => 'carlo.v', 'role' => 'Sales Associate', 'status' => 'Active'],
            ['id' => 'U-004', 'name' => 'Trisha Navarro', 'username' => 'trisha.n', 'role' => 'Inventory Staff', 'status' => 'Active'],
            ['id' => 'U-005', 'name' => 'Miguel Ramos', 'username' => 'miguel.r', 'role' => 'Sales Associate', 'status' => 'Active'],
            ['id' => 'U-006', 'name' => 'Ella Bautista', 'username' => 'ella.b', 'role' => 'Cashier', 'status' => 'Active'],
        ];

        return view('users.index', compact('users'));
    }
}
