<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('drama_details', function (Blueprint $table) {
        $table->id();

        $table->foreignId('media_id')
            ->constrained('media')
            ->onDelete('cascade');

        $table->unsignedInteger('total_episode')->nullable();
        $table->unsignedInteger('total_season')->nullable();

        $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drama_details');
    }
};
