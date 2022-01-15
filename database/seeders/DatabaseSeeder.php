<?php

namespace Database\Seeders;

use App\Models\Day;
use App\Models\Owner;
use App\Models\Video;
use App\Models\Attribute;
use App\Models\Entertainment;
use App\Models\RealEstate;
use App\Models\RealestateMedia;
use App\Models\RealestatePrice;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\RealestateAttribute;
use Database\Factories\RealestateMediaFactory;
use Database\Factories\RealestatePriceFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Video::factory(20)->create();
        Entertainment::factory(50)->create();

        Owner::factory()->count(20)->create()->each(function ($data) {
            RealEstate::factory($data)->count(10)->create([
                'owner_id' => $data->id,
            ])->each(function ($data) {
                RealestateMedia::factory($data)->count(5)->create([
                    'realestate_id' => $data->id,
                ]);
                RealestateAttribute::factory($data)->count(5)->create([
                    'realestate_id' => $data->id,
                ]);
                RealestatePrice::factory($data)->count(5)->create([
                    'realestate_id' => $data->id,
                ]);
            });
        });
    }
}
