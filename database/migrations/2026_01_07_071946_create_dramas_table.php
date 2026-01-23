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
        Schema::create('dramas', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // judul drama
        $table->text('synopsis')->nullable(); // sinopsis
        $table->string('poster')->nullable(); // nama file poster
        $table->string('genre')->nullable();
        $table->integer('episodes')->nullable();
        $table->integer('release_year')->nullable();
        $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dramas');
    }
};
