<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        DB::statement("
            INSERT INTO users (name, email, password, role, created_at, updated_at) 
            VALUES (
                'Admin User',
                'admin@example.com',
                '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
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
                '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'customer',
                NOW(),
                NOW()
            )
        ");
    }
}
