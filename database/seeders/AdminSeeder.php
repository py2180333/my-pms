<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'QuantumTech',
            // 'email' => 'rajputdigvijay.qt@gmail.com',
            'email' => 'test@gmail.com',
            'password' => Hash::make('Admin@1992'), // Ensure password is hashed
            'phoneNumber' => '1234567890', // Optional field, change if needed
            'username' => 'quatech', // Optional, change if needed
        ]);
    }
}

