<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('user_media_lists', function (Blueprint $table) {
            $table->date('started_date')->nullable()->after('status');
            $table->date('finished_date')->nullable()->after('started_date');
            $table->text('notes')->nullable()->after('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_media_lists', function (Blueprint $table) {
            $table->dropColumn([
                'started_date',
                'finished_date',
                'notes',
            ]);
        });
    }
};
