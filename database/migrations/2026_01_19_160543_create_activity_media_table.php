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
        Schema::create('activity_media', function (Blueprint $table) {
            $table->id('activity_media_id');
            $table->foreignId('activity_id')->constrained('activities', 'activity_id')->cascadeOnDelete();
            $table->string('activity_media_url');
            $table->boolean('activity_media_is_thumbnail')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_media');
    }
};
