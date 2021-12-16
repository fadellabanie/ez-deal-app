<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('days', function (Blueprint $table) {
            $table->id();
            $table->string('ar_day');
            $table->string('en_day');
        });

        DB::table('days')->insert([
            'ar_day' => 'Saturday',
            'en_day' => 'Saturday',
        ]);
        DB::table('days')->insert([
            'ar_day' => 'Sunday',
            'en_day' => 'Sunday',
        ]);
        DB::table('days')->insert([
            'ar_day' => 'Monday',
            'en_day' => 'Monday',
        ]);
        DB::table('days')->insert([
            'ar_day' => 'Tuesday',
            'en_day' => 'Tuesday',
        ]);
        DB::table('days')->insert([
            'ar_day' => 'Wednesday',
            'en_day' => 'Wednesday',
        ]);
        DB::table('days')->insert([
            'ar_day' => 'Thursday',
            'en_day' => 'Thursday',
        ]);
        DB::table('days')->insert([
            'ar_day' => 'Friday',
            'en_day' => 'Friday',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('days');
    }
}
