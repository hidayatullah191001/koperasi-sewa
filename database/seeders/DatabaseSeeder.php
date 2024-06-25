<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Role::create([
            'code' => 'SUADM',
            'name' => 'Super Admin',
        ]);
        
        Role::create([
            'code' => 'ADM',
            'name' => 'Admin',
        ]);

        Role::create([
            'code' => 'USR',
            'name' => 'User',
        ]);

        Role::create([
            'code' => 'GUEST',
            'name' => 'Guest',
        ]);
    }
}
