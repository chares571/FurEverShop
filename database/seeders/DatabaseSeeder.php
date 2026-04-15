<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::query()->updateOrCreate(
            ['email' => 'admin@furever.local'],
            [
                'name' => 'FurEver Admin',
                'role' => User::ROLE_ADMIN,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ]
        );

        $shopper = User::query()->updateOrCreate(
            ['email' => 'user@furever.local'],
            [
                'name' => 'FurEver Shopper',
                'role' => User::ROLE_USER,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ]
        );

        User::factory(4)->create();
    }
}
