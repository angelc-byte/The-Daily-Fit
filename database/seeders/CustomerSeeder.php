<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            ['customer_code' => 'C-1001', 'full_name' => 'Mika Santos', 'email' => 'mika.santos@example.com', 'phone' => '0917 245 1180', 'avatar' => 'images/customers/mika-santos.jpg', 'created_at' => '2026-10-02 09:00:00'],
            ['customer_code' => 'C-1002', 'full_name' => 'Andrea Cruz', 'email' => 'andrea.cruz@example.com', 'phone' => '0918 634 2201', 'avatar' => 'images/customers/andrea-cruz.jpg', 'created_at' => '2026-10-03 09:00:00'],
            ['customer_code' => 'C-1003', 'full_name' => 'Paolo Reyes', 'email' => 'paolo.reyes@example.com', 'phone' => '0920 811 7345', 'avatar' => 'images/customers/paolo-reyes.jpg', 'created_at' => '2026-10-04 09:00:00'],
            ['customer_code' => 'C-1004', 'full_name' => 'Nicole Garcia', 'email' => 'nicole.garcia@example.com', 'phone' => '0916 402 9817', 'avatar' => 'images/customers/nicole-garcia.jpg', 'created_at' => '2026-10-05 09:00:00'],
            ['customer_code' => 'C-1005', 'full_name' => 'Joshua Lim', 'email' => 'joshua.lim@example.com', 'phone' => '0922 719 5664', 'avatar' => 'images/customers/joshua-lim.jpg', 'created_at' => '2026-10-06 09:00:00'],
            ['customer_code' => 'C-1006', 'full_name' => 'Bianca Flores', 'email' => 'bianca.flores@example.com', 'phone' => '0915 328 4409', 'avatar' => 'images/customers/bianca-flores.jpg', 'created_at' => '2026-10-07 09:00:00'],
        ];

        foreach ($customers as $customer) {
            Customer::updateOrCreate(
                ['customer_code' => $customer['customer_code']],
                $customer + ['is_active' => true, 'updated_at' => $customer['created_at']],
            );
        }
    }
}
