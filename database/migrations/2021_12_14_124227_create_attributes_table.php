<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('ar_name');
            $table->string('en_name');
            $table->timestamps();
        });
        DB::table('attributes')->insert([
            'ar_name' => 'مصعد',
            'en_name' => 'elvater',
            'created_at' => now(),
            'updated_at' => now(),
        ]); 
        DB::table('attributes')->insert([
            'ar_name' => 'wc',
            'en_name' => 'wc',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attributes');
    }
}
