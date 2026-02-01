<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('drama_details', function (Blueprint $table) {
            if (Schema::hasColumn('drama_details', 'episode_duration')) {
                $table->dropColumn('episode_duration');
            }
        });
    }

    public function down(): void
    {
        Schema::table('drama_details', function (Blueprint $table) {
            $table->integer('episode_duration')->nullable();
        });
    }
};
