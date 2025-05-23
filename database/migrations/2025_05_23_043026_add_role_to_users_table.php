<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     
    public function up()
    {
        DB::statement("
            ALTER TABLE users 
            ADD COLUMN role ENUM('admin', 'customer') NOT NULL DEFAULT 'customer'
        ");
    }

    public function down()
    {
        DB::statement("
            ALTER TABLE users 
            DROP COLUMN role
        ");
    }
};
