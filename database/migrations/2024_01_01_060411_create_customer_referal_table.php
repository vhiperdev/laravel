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
        Schema::create('customer_referal', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('facebook');
            $table->integer('customer_count')->default(0);
            $table->integer('cost_per_customer')->default(0);
            $table->integer('amount_earned')->default(0);
            $table->timestamp('created_at')->default(now());
            $table->timestamp('updated_at')->default(now());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_referal');
    }
};
