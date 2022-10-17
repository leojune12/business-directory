<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_city_municipalities', function (Blueprint $table) {
            $table->id();
            $table->string('psgcCode');
            $table->bigInteger('regCode');
            $table->bigInteger('provCode');
            $table->bigInteger('citymunCode');
            $table->string('citymunDesc');
            $table->string('zipCode');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address_city_municipalities');
    }
};
