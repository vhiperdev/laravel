<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCountryTable extends Migration
{
    public function up()
    {
        Schema::create('country', function (Blueprint $table) {
            $table->id();
            $table->string('Country Name', 32)->nullable();
            $table->string('ISO2', 2)->nullable();
            $table->string('ISO3', 3)->nullable();
            $table->string('Top Level Domain', 2)->nullable();
            $table->string('FIPS', 2)->nullable();
            $table->unsignedSmallInteger('ISO Numeric')->nullable();
            $table->string('GeoNameID', 7)->nullable();
            $table->unsignedSmallInteger('E164')->nullable();
            $table->string('Phone Code', 19)->nullable();
            $table->string('Continent', 13)->nullable();
            $table->string('Capital', 20)->nullable();
            $table->string('Time Zone in Capital', 30)->nullable();
            $table->string('Currency', 13)->nullable();
            $table->string('Language Codes', 89)->nullable();
            $table->string('Languages', 489)->nullable();
            $table->unsignedInteger('Area KM2')->nullable();
            $table->string('Internet Hosts', 9)->nullable();
            $table->string('Internet Users', 9)->nullable();
            $table->string('Phones (Mobile)', 10)->nullable();
            $table->string('Phones (Landline)', 9)->nullable();
            $table->string('GDP', 14)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('country');
    }
}
