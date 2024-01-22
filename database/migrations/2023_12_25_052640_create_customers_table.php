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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username');
            $table->string('whatsapp');
            $table->string('screen');

            $table->unsignedBigInteger('server')->nullable();
            $table->foreign('server')->references('id')->on('servers')->onDelete('set null');


            $table->timestamp('expiry_date'); // Adjusted to timestamp data type

            $table->unsignedBigInteger('application_id')->nullable();
            $table->foreign('application_id')->references('id')->on('application')->onDelete('set null');

            $table->unsignedBigInteger('device_id')->nullable();
            $table->foreign('device_id')->references('id')->on('device')->onDelete('set null');

            $table->string('mac');
            $table->string('key');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
