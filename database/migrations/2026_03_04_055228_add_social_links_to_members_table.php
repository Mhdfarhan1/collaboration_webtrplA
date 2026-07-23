<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    

    public function up(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->string('instagram_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('github_url')->nullable();
        });
    }

    
    
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn(['instagram_url', 'linkedin_url', 'github_url']);
        });
    }
};
