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
        // User::factory(10)->create();

        \App\Models\Role::firstOrCreate(['name' => 'administrateur'], ['description' => 'Admin full access']);
        \App\Models\Role::firstOrCreate(['name' => 'formateur'], ['description' => 'Formation instructor']);
        \App\Models\Role::firstOrCreate(['name' => 'apprenant'], ['description' => 'Student/learner']);

        $adminRole = \App\Models\Role::where('name', 'administrateur')->first();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'administrateur',
            'role_id' => $adminRole->id,
            'email_verified_at' => now(),
        ]);
    }
}
