<?php

namespace Database\Seeders;

use App\Models\EstadoUsuario;
use Illuminate\Database\Seeder;

class EstadoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstadoUsuario::truncate();

        $datos = [
            ["nombre" => "Registrado"],
            ["nombre" => "Validado"],
            ["nombre" => "Inactivo"]
        ];

        EstadoUsuario::insert($datos);
    }
}
