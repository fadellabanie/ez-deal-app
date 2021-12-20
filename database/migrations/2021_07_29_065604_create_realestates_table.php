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
            $table->string('ar_name');
            $table->string('en_name');
            $table->float('space');
            $table->unsignedBigInteger('guest_type')->default(1);
            $table->integer('guest_count');
            $table->boolean('is_sleep');
            $table->tinyInteger('wc_count');
            $table->boolean('wc_prepared');
            $table->tinyInteger('living_room');
            $table->tinyInteger('bed_room')->nullable();
            $table->tinyInteger('smail_bed_count')->nullable();
            $table->tinyInteger('large_bed_count')->nullable();
            $table->tinyInteger('kitchen_count')->nullable();
            $table->boolean('kitchen_prepared')->nullable();
            $table->float('price');
            $table->decimal('lat', 10, 8)->nullable();
            $table->decimal('lng', 11, 8)->nullable();
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->longText('note')->nullable();
            $table->boolean('is_overnight');
            $table->integer('number_of_views')->default(0);
            $table->float('rate')->default(0);
            $table->time('enter_time')->nullable();
            $table->time('leave_time')->nullable();
            $table->boolean('is_reserved')->default(0);
            $table->boolean('status')->default(0);
            $table->boolean('is_active')->default(0);
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
