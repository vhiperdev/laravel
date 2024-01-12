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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('default_payment_message')->nullable();
            $table->foreign('default_payment_message')->references('id')->on('message_template')->onDelete('set null'); // Assuming there's a payment_methods table
            $table->unsignedBigInteger('currency')->nullable();
            $table->foreign('currency')->references('id')->on('currencies')->onDelete('set null');
            $table->timestamp('created_at')->default(now());
            $table->timestamp('updated_at')->default(now());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
