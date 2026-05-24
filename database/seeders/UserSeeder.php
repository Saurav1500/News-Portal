<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $superAdminRole = Role::where('slug', 'super-admin')->first();
        $adminRole = Role::where('slug', 'admin')->first();
        $editorRole = Role::where('slug', 'editor')->first();
        $authorRole = Role::where('slug', 'author')->first();
        $userRole = Role::where('slug', 'user')->first();

        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'सुपर प्रशासक',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role_id' => $superAdminRole?->id,
            ]
        );

        User::firstOrCreate(
            ['email' => 'editor@newsai.com'],
            [
                'name' => 'सम्पादक',
                'email' => 'editor@newsai.com',
                'password' => Hash::make('password'),
                'role_id' => $editorRole?->id,
            ]
        );

        User::firstOrCreate(
            ['email' => 'author@newsai.com'],
            [
                'name' => 'लेखक',
                'email' => 'author@newsai.com',
                'password' => Hash::make('password'),
                'role_id' => $authorRole?->id,
            ]
        );

        User::firstOrCreate(
            ['email' => 'user@newsai.com'],
            [
                'name' => 'प्रयोगकर्ता',
                'email' => 'user@newsai.com',
                'password' => Hash::make('password'),
                'role_id' => $userRole?->id,
            ]
        );
    }
}
