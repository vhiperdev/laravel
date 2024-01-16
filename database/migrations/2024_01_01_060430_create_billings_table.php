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
        //days of the week that charges will be sent

        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->boolean('automatic_sending')->default(0);
            $table->boolean('automatic_billing')->default(0);
            $table->boolean('sunday_billing')->default(0);
            $table->boolean('daily_billing')->default(0);
            $table->boolean('monday_billing')->default(0);
            $table->boolean('tuesday_billing')->default(0);
            $table->boolean('wednesday_billing')->default(0);
            $table->boolean('thursday_billing')->default(0);
            $table->boolean('friday_billing')->default(0);
            $table->boolean('saturday_billing')->default(0);
            $table->time('shipping_time')->default('00:00');

            $table->unsignedBigInteger('default_message')->nullable();
            $table->foreign('default_message')->references('id')->on('message_template')->onDelete('set null');

            $table->unsignedBigInteger('server')->nullable();
            $table->foreign('server')->references('id')->on('servers')->onDelete('set null');

            $table->unsignedBigInteger('application_id')->nullable();
            $table->foreign('application_id')->references('id')->on('application')->onDelete('set null');

            $table->unsignedBigInteger('device_id')->nullable();
            $table->foreign('device_id')->references('id')->on('device')->onDelete('set null');

            $table->unsignedBigInteger('customer_referal_id')->nullable();
            $table->foreign('customer_referal_id')->references('id')->on('customer_referal')->onDelete('set null');


            $table->string('customer_subscription_status')->default('active');
            $table->string('days_to_expire')->default(0);
            $table->integer('shipping_interval')->default(0);

            $table->timestamp('last_shipment')->default(now());
            $table->integer('customer_count')->default(0);
            $table->integer('customer_received_count')->default(0);

            $table->timestamp('created_at')->default(now());
            $table->timestamp('updated_at')->default(now());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billings');
    }
};
