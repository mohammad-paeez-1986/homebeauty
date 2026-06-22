<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sms_codes', function (Blueprint $table) {
            $table->id();
            $table->string('mobile', 11)->unique();
            $table->string('code', 4);
            $table->timestamp('expires_at');
            $table->boolean('is_used')->default(false);
            $table->timestamp('used_at')->nullable();
            $table->integer('attempts')->default(0);
            $table->timestamp('created_at');
            
            // Indexes
            $table->index('code');
            $table->index('expires_at');
            $table->index('mobile');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sms_codes');
    }
};