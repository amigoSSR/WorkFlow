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
        Schema::create('weekly_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->string('filename');
            $table->string('filepath');
            $table->date('period_start');
            $table->date('period_end');
            $table->timestamps();

            // Prevent duplicate reports for the same user, project, and period
            $table->unique(['user_id', 'project_id', 'period_start', 'period_end'], 'weekly_reports_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weekly_reports');
    }
};
