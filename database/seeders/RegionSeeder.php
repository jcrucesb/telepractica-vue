<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::truncate();

        for ($i=1; $i<=16; $i++)
        {
            $region = new Region();

            $region->nombre = "Región $i";

            $region->save();
        }
    }
}
