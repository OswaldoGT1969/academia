<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('stripe_session_id')->nullable()->after('proof_of_payment_path');
            // We use raw SQL because modifying enums in SQLite/MySQL can be tricky with Blueprint
            // but for this project we'll assume a standard Laravel approach.
            // If using SQLite (often for tests), change column might fail without doctrine/dbal.
        });

        // Add 'stripe' and 'bank_transfer' to the enum (PostgreSQL/MySQL approach)
        if (config('database.default') !== 'sqlite') {
            DB::statement("ALTER TABLE orders MODIFY COLUMN payment_method ENUM('paypal', 'deposit', 'stripe', 'bank_transfer') NOT NULL");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('stripe_session_id');
        });

        if (config('database.default') !== 'sqlite') {
            DB::statement("ALTER TABLE orders MODIFY COLUMN payment_method ENUM('paypal', 'deposit') NOT NULL");
        }
    }
};
