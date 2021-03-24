<?php

namespace Database\Seeders;

use App\Models\EstadoPost;
use Illuminate\Database\Seeder;

class EstadoPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstadoPost::truncate();

        $datos = [
            ["nombre" => "Activa"],
            ["nombre" => "En proceso"],
            ["nombre" => "Aceptada"],
            ["nombre" => "Rechazada"]
        ];

        EstadoPost::insert($datos);
    }
}
