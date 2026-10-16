<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = [
            ['id' => 'U-001', 'name' => 'Angel Tolentino', 'username' => 'admin', 'role' => 'Administrator', 'status' => 'Active', 'avatar' => 'images/users/angel-tolentino.jpg'],
            ['id' => 'U-002', 'name' => 'Sofia Mendoza', 'username' => 'sofia.m', 'role' => 'Store Manager', 'status' => 'Active', 'avatar' => 'images/users/sofia-mendoza.jpg'],
            ['id' => 'U-003', 'name' => 'Carlo Villanueva', 'username' => 'carlo.v', 'role' => 'Sales Associate', 'status' => 'Active', 'avatar' => 'images/users/carlo-villanueva.jpg'],
            ['id' => 'U-004', 'name' => 'Trisha Navarro', 'username' => 'trisha.n', 'role' => 'Inventory Staff', 'status' => 'Active', 'avatar' => 'images/users/trisha-navarro.jpg'],
            ['id' => 'U-005', 'name' => 'Miguel Ramos', 'username' => 'miguel.r', 'role' => 'Sales Associate', 'status' => 'Active', 'avatar' => 'images/users/miguel-ramos.jpg'],
            ['id' => 'U-006', 'name' => 'Ella Bautista', 'username' => 'ella.b', 'role' => 'Cashier', 'status' => 'Active', 'avatar' => 'images/users/ella-bautista.jpg'],
        ];

        return view('users.index', compact('users'));
    }
}
