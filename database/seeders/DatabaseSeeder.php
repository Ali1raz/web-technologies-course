<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make('12345678');

        DB::statement("
            INSERT INTO users (name, email, password, role, created_at, updated_at) 
            VALUES (
                'Admin User',
                'admin@example.com',
                '$password',
                'admin',
                NOW(),
                NOW()
            )
        ");

        DB::statement("
            INSERT INTO users (name, email, password, role, created_at, updated_at) 
            VALUES (
                'Customer User',
                'customer@example.com',
                '$password',
                'customer',
                NOW(),
                NOW()
            )
        ");
    }
}
