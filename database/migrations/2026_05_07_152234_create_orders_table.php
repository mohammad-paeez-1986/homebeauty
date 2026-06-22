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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // Day and time fields
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->text('address');
            $table->date('day');
            $table->time('time');
            $table->enum('service_type', ['man', 'woman', 'bearish']);
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'done', 'canceled'])->default('pending');
            $table->timestamps();

            $table->index('day');
            $table->index('user_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
