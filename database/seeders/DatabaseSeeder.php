<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\City;
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
            'code' => 'GUEST',
            'name' => 'Guest',
        ]);

        City::create([
            'nama' => 'Luwuk',
            'type' => 'Asal',
        ]);
        City::create([
            'nama' => 'Palu',
            'type' => 'Asal'
        ]);

        City::create([
            'nama' => 'Makasar',
            'type' => 'Asal'
        ]);

        City::create([
            'nama' => 'Toili',
            'type' => 'Tujuan'
        ]);

        City::create([
            'nama' => 'Toili Barat',
            'type' => 'Tujuan'
        ]);

        City::create([
            'nama' => 'Panduuke',
            'type' => 'Tujuan'
        ]);

        City::create([
            'nama' => 'Baturube',
            'type' => 'Tujuan'
        ]);
        City::create([
            'nama' => 'Bungku',
            'type' => 'Tujuan'
        ]);
        City::create([
            'nama' => 'Balantak',
            'type' => 'Tujuan'
        ]);
        City::create([
            'nama' => 'Bualemo',
            'type' => 'Tujuan'
        ]);
        City::create([
            'nama' => 'Pagimana',
            'type' => 'Tujuan'
        ]);
    }
}
