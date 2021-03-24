<?php

namespace Database\Seeders;

use App\Models\Carrera;
use App\Models\Institucion;
use Illuminate\Database\Seeder;

class CarreraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Carrera::truncate();

        for ($i = 1; $i <= 150; $i++) {
            $carrera = new Carrera();

            $carrera->escuela_id = random_int(1, 20);
            $carrera->mencion_id = null;
            $carrera->nombre = "Carrera $i";

            $carrera->save();
        }
    
        // ManyToMany: Institucion -(ManytoMany)-> Carrera
        foreach (Institucion::all() as $institucion) {
            $carreras = Carrera::inRandomOrder()->take(rand(1, 10))->pluck('id');
            foreach ($carreras as $carrera) {
                $institucion->carreras()->attach($carrera);
            }
        }
    }
}
