<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE TABLE products (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                price DECIMAL(10,2) NOT NULL,
                stock INT NOT NULL DEFAULT 0,
                description TEXT,
                created_at TIMESTAMP NULL,
                updated_at TIMESTAMP NULL
            )
        ");
    }

    public function down()
    {
        DB::statement("DROP TABLE IF EXISTS products");
    }
};
