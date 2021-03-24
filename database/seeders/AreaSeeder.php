<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Area::truncate();

        for ($i=1; $i<=5; $i++)
        {
            $area = new Area();

            $area->nombre = "Área $i";

            $area->save();
        }
    }
}
