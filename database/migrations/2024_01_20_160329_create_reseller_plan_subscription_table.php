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
        Schema::create('reseller_plan_subscription', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reseller_plan_id')->nullable();
            $table->unsignedBigInteger('reseller_id')->nullable();
            $table->timestamp('next_due_date');
            $table->string('subscription_duration');
            $table->boolean('active_status')->nullable()->default(1);
            $table->timestamp('created_at')->default(now());
            $table->timestamp('updated_at')->default(now())->useCurrent();

            $table->foreign('reseller_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reseller_plan_id')->references('id')->on('reseller_plan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reseller_plan_subscription');
    }
};
