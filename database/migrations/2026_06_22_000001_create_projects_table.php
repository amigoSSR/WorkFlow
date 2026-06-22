<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_id')->unique(); // e.g., PRJ-20260622-001
            $table->string('name');
            $table->text('description');
            $table->string('category');
            $table->string('status')->default('Draft');
            $table->date('deadline')->nullable();
            $table->string('document_path')->nullable();
            $table->string('reference_links')->nullable();
            $table->integer('max_members')->default(10);
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
