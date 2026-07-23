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
        Schema::table('lecturers', function (Blueprint $table) {
            $table->string('lecturer_title')->nullable()->after('lecturer_name');
            $table->string('lecturer_position')->nullable()->after('lecturer_title');
            $table->string('lecturer_email')->nullable()->after('lecturer_position');
            $table->string('last_education')->nullable()->after('lecturer_email');
            $table->text('education_history')->nullable()->after('last_education');
            $table->enum('lecturer_type', ['dosen', 'manpro'])->default('dosen')->after('education_history');
            
            // Social Links
            $table->string('scholar_url')->nullable();
            $table->string('scopus_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lecturers', function (Blueprint $table) {
            $table->dropColumn([
                'lecturer_title', 'lecturer_position', 'lecturer_email', 
                'last_education', 'education_history', 'lecturer_type',
                'scholar_url', 'scopus_url', 'linkedin_url', 
                'twitter_url', 'facebook_url', 'instagram_url'
            ]);
        });
    }
};
