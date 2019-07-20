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
            $table->String('user_id')->unique();
            $table->String('distance')->nullable();;
            $table->String('plate_number')->unique();
            $table->String('rating')->nullable();
            $table->String('price')->nullable();;
            $table->boolean('status')->default(1);
            $table->String('lat')->nullable();;
            $table->String('long')->nullable();;
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
