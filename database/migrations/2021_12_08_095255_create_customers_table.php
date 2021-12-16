<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
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
            $table->string('gender');
            $table->date('birthday');
            $table->string('avatar')->nullable();
            $table->string('status')->nullable();
            $table->boolean('is_dark')->default(false);
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
        Schema::dropIfExists('customers');
    }
}
