<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('manhwa_details', function (Blueprint $table) {
            if (Schema::hasColumn('manhwa_details', 'avg_read_time')) {
                $table->dropColumn('avg_read_time');
            }
        });
    }

    public function down(): void
    {
        Schema::table('manhwa_details', function (Blueprint $table) {
            $table->integer('avg_read_time')->nullable();
        });
    }
};