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
        Schema::create('education_materials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content')->nullable(); // untuk artikel
            $table->string('url')->nullable(); // untuk video
            $table->string('thumbnail')->nullable(); // path ke gambar
            $table->boolean('is_featured')->default(false); // materi penting
            $table->enum('type', ['article', 'video']); // jenis materi
            $table->timestamps();
            $table->softDeletes(); // soft delete support
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_materials');
    }
};