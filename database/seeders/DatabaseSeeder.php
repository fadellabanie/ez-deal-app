<?php

namespace Database\Seeders;

use App\Models\Video;
use App\Models\Attribute;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Attribute::factory(10)->create();
        Video::factory(20)->create();
    }
}
