<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create(
            [
                'name' => 'admin',
                'username' => 'admin',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'status' => true,
                'type' => 'admin',
            ]
        );
    }
}
