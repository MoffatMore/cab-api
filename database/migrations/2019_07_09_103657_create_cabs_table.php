<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cabs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('name');
            $table->String('distance');
            $table->String('plate_number')->unique();
            $table->String('rating');
            $table->String('price');
            $table->String('lat');
            $table->String('long');
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
        Schema::dropIfExists('cabs');
    }
}
