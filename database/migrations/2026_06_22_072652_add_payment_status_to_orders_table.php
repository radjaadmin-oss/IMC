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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_status')->default('pending')->after('status'); // pending, paid, expired
            $table->timestamp('payment_expired_at')->nullable()->after('payment_status');
            $table->timestamp('paid_at')->nullable()->after('payment_expired_at');
            $table->string('payment_method')->nullable()->after('paid_at'); // bank_transfer, e-wallet, credit_card
            $table->text('payment_proof')->nullable()->after('payment_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['payment_status', 'payment_expired_at', 'paid_at', 'payment_method', 'payment_proof']);
        });
    }
};
