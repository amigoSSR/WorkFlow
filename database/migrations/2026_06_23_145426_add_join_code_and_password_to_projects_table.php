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
            // Unique join code (e.g. "ABCD1234") generated at creation
            $table->string('join_code', 8)->nullable()->unique()->after('project_id');
            // Optional password to protect join (hashed)
            $table->string('join_password')->nullable()->after('join_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['join_code', 'join_password']);
        });
    }
};
