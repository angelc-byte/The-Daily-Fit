<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['staff_code' => 'U-001', 'full_name' => 'Angel Tolentino', 'username' => 'admin', 'email' => 'angel.tolentino@example.com', 'role' => 'Administrator', 'avatar' => 'images/users/angel-tolentino.jpg'],
            ['staff_code' => 'U-002', 'full_name' => 'Sofia Mendoza', 'username' => 'sofia.m', 'email' => 'sofia.mendoza@example.com', 'role' => 'Store Manager', 'avatar' => 'images/users/sofia-mendoza.jpg'],
            ['staff_code' => 'U-003', 'full_name' => 'Carlo Villanueva', 'username' => 'carlo.v', 'email' => 'carlo.villanueva@example.com', 'role' => 'Sales Associate', 'avatar' => 'images/users/carlo-villanueva.jpg'],
            ['staff_code' => 'U-004', 'full_name' => 'Trisha Navarro', 'username' => 'trisha.n', 'email' => 'trisha.navarro@example.com', 'role' => 'Inventory Staff', 'avatar' => 'images/users/trisha-navarro.jpg'],
            ['staff_code' => 'U-005', 'full_name' => 'Miguel Ramos', 'username' => 'miguel.r', 'email' => 'miguel.ramos@example.com', 'role' => 'Sales Associate', 'avatar' => 'images/users/miguel-ramos.jpg'],
            ['staff_code' => 'U-006', 'full_name' => 'Ella Bautista', 'username' => 'ella.b', 'email' => 'ella.bautista@example.com', 'role' => 'Cashier', 'avatar' => 'images/users/ella-bautista.jpg'],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['staff_code' => $user['staff_code']],
                $user + [
                    'status' => 'Active',
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ],
            );
        }
    }
}
