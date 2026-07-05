<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('house_rules', function (Blueprint $table) {
        $table->id();
        $table->string('judul_rule');
        $table->longText('deskripsi_rule');
        $table->string('kategori');
        $table->foreignId('dibuat_oleh')->constrained('users')->onDelete('cascade');
        $table->timestamps();

        // Additional fields for ordering and status
        $table->integer('order_column')->default(0);
        $table->boolean('is_active')->default(true);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('house_rules');
    }
};
