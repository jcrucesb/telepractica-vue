<?php

namespace Database\Seeders;

use App\Models\NivelEducacional;
use Illuminate\Database\Seeder;

class NivelEducacionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NivelEducacional::truncate();

        $datos = [
            ["nombre" => "Técnico profesional"],
            ["nombre" => "Pregrado"],
            ["nombre" => "Postgrado"]
        ];

        NivelEducacional::insert($datos);
    }
}
