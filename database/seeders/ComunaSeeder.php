<?php

namespace Database\Seeders;

use App\Models\Comuna;
use Illuminate\Database\Seeder;

class ComunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comuna::truncate();

        for ($i=1; $i<=150; $i++)
        {
            $comuna = new Comuna();

            $comuna->region_id = random_int(1, 16);
            $comuna->nombre = "Comuna $i";

            $comuna->save();
        }
    }
}
