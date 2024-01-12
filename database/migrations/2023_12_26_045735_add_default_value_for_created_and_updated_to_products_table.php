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
        if (Schema::hasColumn('products', 'created_at')) {
            Schema::table('products', function (Blueprint $table) {
                $table->timestamp('created_at')->default(now())->change();
            });
        }

        if (Schema::hasColumn('products', 'updated_at')) {
            Schema::table('products', function (Blueprint $table) {
                $table->timestamp('updated_at')->default(now())->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
