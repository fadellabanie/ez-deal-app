<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealestatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realestates', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('owner_id')->default(0)->index();
            $table->unsignedBigInteger('realestate_type_id')->index();
            $table->unsignedBigInteger('city_id')->index();
            $table->unsignedBigInteger('country_id')->default(1);
            $table->string('name');
            $table->float('space');
            $table->tinyInteger('room');
            $table->tinyInteger('wc');
            $table->tinyInteger('guests');
            $table->tinyInteger('bed');
            $table->decimal('lat', 10, 8)->nullable();
            $table->decimal('lng', 11, 8)->nullable();
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->longText('note')->nullable();
            $table->integer('number_of_views')->default(0);
            $table->float('rate')->default(0);
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('realestates');
    }
}
