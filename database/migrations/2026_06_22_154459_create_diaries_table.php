<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('project_id')->nullable()->constrained()->onDelete('set null');
            $table->string('title');
            $table->text('progress');
            $table->text('challenges')->nullable();
            $table->string('category')->default('progress'); // progress, meeting, review, deployment
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diaries');
    }
};
