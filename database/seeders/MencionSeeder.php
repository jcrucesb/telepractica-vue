<?php

namespace Database\Seeders;

use App\Models\Mencion;
use Illuminate\Database\Seeder;

class MencionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mencion::truncate();

        for ($i=1; $i<=2; $i++)
        {
            $mencion = new Mencion();

            $mencion->nombre = "Mención $i";

            $mencion->save();
        }
    }
}
