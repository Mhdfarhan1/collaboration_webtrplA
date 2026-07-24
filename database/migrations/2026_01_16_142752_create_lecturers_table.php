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
        Schema::create('lecturers', function (Blueprint $table) {
            $table->id('lecturer_id');
            $table->string('lecturer_name');
            $table->string('lecturer_nip')->nullable();
            $table->string('lecturer_image')->nullable();
            $table->string('lecturer_expertise')->nullable();
            $table->string('lecturer_title')->nullable();
            $table->string('lecturer_position')->nullable();
            $table->string('lecturer_email')->nullable();
            $table->string('last_education')->nullable();
            $table->text('education_history')->nullable();
            $table->enum('lecturer_type', ['dosen', 'manpro'])->default('dosen');
            $table->string('is_advisor')->default(false);
            
            // Social Links
            $table->string('scholar_url')->nullable();
            $table->string('scopus_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecturers');
    }
};
