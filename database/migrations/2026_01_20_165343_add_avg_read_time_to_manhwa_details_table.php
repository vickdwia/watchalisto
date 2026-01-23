<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('manhwa_details', function (Blueprint $table) {
            $table->unsignedTinyInteger('avg_read_time')
                ->default(8)
                ->comment('Estimated reading time per chapter in minutes');
        });
    }

    public function down(): void
    {
        Schema::table('manhwa_details', function (Blueprint $table) {
            $table->dropColumn('avg_read_time');
        });
    }
};