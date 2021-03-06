<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('prefix');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('verified_at')->nullable();
            $table->string('password');
            $table->string('country_code');
            $table->string('mobile')->unique();
          //  $table->tinyInteger('gender');
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            //$table->date('birthday');
            $table->string('avatar')->nullable();
            $table->boolean('status')->nullable();
            $table->text('remember_token')->nullable();
            $table->text('device_token')->nullable();
            $table->date('block_date')->nullable()->comment('Block date until');
            $table->boolean('suspend')->default(false)->comment('0 is active - 1 is block');
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
        Schema::dropIfExists('owners');
    }
}
