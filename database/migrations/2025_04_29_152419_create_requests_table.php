<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pickup_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('alamat');
            $table->text('jenis_sampah');
            $table->decimal('berat', 8, 2)->nullable();
            $table->string('transaction_id')->unique();
            $table->enum('status', ['Pending', 'Assigned', 'Completed', 'Cancelled'])->default('Pending'); // Tambahkan 'Cancelled'
            $table->date('pickup_date')->nullable();
            $table->foreignId('collector_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pickup_requests');
    }
};