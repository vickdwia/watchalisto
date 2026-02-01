<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            ALTER TABLE user_media_lists 
            MODIFY status ENUM('watching', 'reading', 'completed', 'planned') 
            NOT NULL
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("
            ALTER TABLE user_media_lists 
            MODIFY status ENUM('watching', 'completed', 'planned') 
            NOT NULL
        ");
    }
};
