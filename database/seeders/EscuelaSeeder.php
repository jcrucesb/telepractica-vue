<?php

namespace Database\Seeders;

use App\Models\Escuela;
use Illuminate\Database\Seeder;

class EscuelaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Escuela::truncate();

        for ($i=1; $i<=20; $i++)
        {
            $escuela = new Escuela();

            $escuela->departamento_id = random_int(1, 10);
            $escuela->nombre = "Escuela $i";

            $escuela->save();
        }
    }
}
