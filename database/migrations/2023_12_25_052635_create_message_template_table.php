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
        Schema::create('message_template', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('vcard_name')->nullable();
            $table->string('vcard_number')->nullable();
            $table->string('image_attachment_url')->nullable();
            $table->string('video_attachment_url')->nullable();
            $table->string('audio_attachment_url')->nullable();
            $table->boolean('active')->default(1);
            $table->boolean('sentcount')->default(1);
            $table->timestamp('created_at')->default(now());
            $table->timestamp('updated_at')->default(now());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_template');
    }
};
