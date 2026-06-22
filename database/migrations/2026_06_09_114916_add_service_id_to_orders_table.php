<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('service_id')->nullable();
            $table->foreign('service_id')->references('id')->on('services')->nullOnDelete();
        });

        DB::statement("UPDATE orders SET service_id = 3 WHERE service_type = 'man'");
        DB::statement("UPDATE orders SET service_id = 1 WHERE service_type = 'woman'");
        DB::statement("UPDATE orders SET service_id = 2 WHERE service_type = 'bearish'");

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('service_type');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('service_type', ['man', 'woman', 'bearish'])->nullable()->after('service_id');
        });

        DB::statement("UPDATE orders SET service_type = 'man' WHERE service_id = 3");
        DB::statement("UPDATE orders SET service_type = 'woman' WHERE service_id = 1");
        DB::statement("UPDATE orders SET service_type = 'bearish' WHERE service_id = 2");

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
            $table->dropColumn('service_id');
        });
    }
};
