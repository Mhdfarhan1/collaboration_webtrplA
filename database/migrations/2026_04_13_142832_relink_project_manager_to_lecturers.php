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
        Schema::table('projects', function (Blueprint $table) {
            // Drop old foreign key if exists
            $table->dropForeign(['project_manager_id']);
            $table->dropColumn('project_manager_id');
        });

        Schema::table('projects', function (Blueprint $table) {
            // Add new foreign key pointing to lecturers
            $table->foreignId('project_manager_id')->nullable()->constrained('lecturers', 'lecturer_id')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['project_manager_id']);
            $table->dropColumn('project_manager_id');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('project_manager_id')->nullable()->constrained('members', 'member_id')->nullOnDelete();
        });
    }
};
