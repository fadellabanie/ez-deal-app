<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_settings', function (Blueprint $table) {
            $table->id();
            $table->string('facebook');
            $table->string('twitter');
            $table->string('instagram');
            $table->string('snapchat');
            $table->string('whats_app');
            $table->string('email');
            $table->string('mobile');
            $table->timestamps();
        });
        DB::table('app_settings')->insert([
   
            'facebook' => 'facebook.png',
            'twitter' => 'twitter.png',
            'instagram' => 'instagram',
            'snapchat' => 'snapchat',
            'email' => 'email',
            'whats_app' => '234234234',
            'mobile' => '234234234',
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
        Schema::dropIfExists('app_settings');
    }
}
