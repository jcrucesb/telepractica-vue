<?php

namespace Database\Seeders;

use App\Models\EstadoOferta;
use Illuminate\Database\Seeder;

class EstadoOfertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstadoOferta::truncate();

        $datos = [
            ["nombre" => "Activa"],
            ["nombre" => "Pausada"],
            ["nombre" => "Finalizada"]
        ];

        EstadoOferta::insert($datos);
    }
}
