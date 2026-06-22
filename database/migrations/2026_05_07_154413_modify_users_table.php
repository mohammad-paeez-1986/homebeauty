<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop email columns if not already done
            $table->dropColumn(['email', 'email_verified_at']);
            
            // Add mobile column with exact 11 digits constraint
            $table->string('mobile', 11)->unique()-> after('name');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->dropColumn('mobile');
        });
    }
};