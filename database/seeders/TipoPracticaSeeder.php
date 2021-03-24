<?php

namespace Database\Seeders;

use App\Models\TipoPractica;
use Illuminate\Database\Seeder;

class TipoPracticaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoPractica::truncate();

        $datos = [
            ["nombre" => "Industrial"],
            ["nombre" => "Laboral"],
            ["nombre" => "Pasantía"],
            ["nombre" => "Profesional"],
            ["nombre" => "Otro"]
        ];

        TipoPractica::insert($datos);
    }
}
