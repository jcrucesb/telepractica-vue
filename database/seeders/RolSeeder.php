<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rol::truncate();

        $datos = [
            ["nombre" => "Practicante"],
            ["nombre" => "Empresa"],
            ["nombre" => "Institución"],
            ["nombre" => "Empresa premium"],
            ["nombre" => "Superusuario"]
        ];

        Rol::insert($datos);
    }
}
