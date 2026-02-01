<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_media_lists', function (Blueprint $table) {
            $table->integer('extra_progress')->nullable()->after('progress');
        });
    }

    public function down(): void
    {
        Schema::table('user_media_lists', function (Blueprint $table) {
            $table->dropColumn('extra_progress');
        });
    }
};