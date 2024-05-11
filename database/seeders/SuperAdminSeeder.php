<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin User
        $superAdmin =User::create([
            'name' => 'Sleman  Hassn',
            'activate' => 'مفعل',
            'email' => 'sleman.hassn@gmail.com',
            'password' => Hash::make('sleman3102')
        ]);
        $superAdmin->assignRole('Super Admin');

    }
}
