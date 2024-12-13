<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(['name' => 'Admin User', 'email' => 'admin@admin.com', 'password' => bcrypt('password'), 'role' => 'admin']);
        User::create(['name' => 'Manager User', 'email' => 'manager@manager.com', 'password' => bcrypt('password'), 'role' => 'manager']);
        User::create(['name' => 'Employee User', 'email' => 'employee@employee.com', 'password' => bcrypt('password'), 'role' => 'employee']);
    }
}
