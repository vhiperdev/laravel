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
        Schema::table('role_user', function (Blueprint $table) {
            // Assuming 'user_id' is the foreign key column
            $table->dropForeign(['user_id']);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('customers', function (Blueprint $table) {
            // Add the 'created_by' field   
            $table->dropForeign(['created_by']);

            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('plans', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });


        Schema::table('subsription_payment_history', function (Blueprint $table) {
            $table->dropForeign(['subscription_id']);
            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
