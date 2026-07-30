<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('status')->default('pending')->after('total');
            $table->text('address')->nullable()->after('status');
            $table->string('phone')->nullable()->after('address');
            $table->string('payment_method')->default('COD')->after('phone');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['status', 'address', 'phone', 'payment_method']);
        });
    }
};
