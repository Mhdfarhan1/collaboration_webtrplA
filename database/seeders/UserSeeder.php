<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Super Admin (Pemilik Utama / Dev)
        User::updateOrCreate(
            ['email' => 'farhankudap06@gmail.com'],
            [
                'name' => 'Farhan (Super Admin)',
                'role' => 'super_admin',
                'password' => Hash::make('superadmin123'),
            ]
        );

        // 2. Admin Pengurus (Akun Tambahan)
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Pengurus Kelas',
                'role' => 'admin',
                'password' => Hash::make('Admin123'),
            ]
        );
    }
}
