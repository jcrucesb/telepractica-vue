<?php

namespace Database\Seeders;

use App\Models\Oferta;
use App\Models\Carrera;
use App\Models\Empresa;
use App\Models\Supervisor;
use App\Models\EstadoOferta;
use Illuminate\Database\Seeder;

class OfertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        Oferta::truncate();

        // Creacion: Oferta -(proviene)-> empresa && estado && supervisor && carreras
        foreach (Empresa:: all() as $empresa) {
            $i = random_int(0, 10);

            if($i > 0) {
                for ($x=1; $x < $i; $x++) {
                    $estado_oferta_id = EstadoOferta::inRandomOrder()->take(1)->pluck('id');
                    $supervisor_id = Supervisor::where('empresa_id', $empresa->id)->inRandomOrder()->take(1)->pluck('id');

                    if($supervisor_id != null) {
                        // FKs
                        $oferta = new Oferta();
    
                        $oferta->empresa_id = $empresa->id;
                        $oferta->estado_oferta_id = $estado_oferta_id[0];
                        $oferta->supervisor_id = $supervisor_id[0];
            
                        $oferta->save();
    
                        // Attributes
                        Oferta::where('id', $oferta->id)->update(['nombre_oferta' => "Oferta $oferta->id"]);
                        Oferta::where('id', $oferta->id)->update(['descripcion' => "Descripción $oferta->id"]);
                        Oferta::where('id', $oferta->id)->update(['remunerada' => random_int(0, 1)]);
                        Oferta::where('id', $oferta->id)->update(['fecha_inicio' => "2021-01-01"]);
                        Oferta::where('id', $oferta->id)->update(['fecha_termino' => "2021-01-01"]);
                        Oferta::where('id', $oferta->id)->update(['requisitos_min' => "Requisitos mínimos $oferta->id"]);
                        Oferta::where('id', $oferta->id)->update(['cupos_totales' => random_int(1, 999)]);
                        Oferta::where('id', $oferta->id)->update(['postulaciones_recibidas' => 0]);
                    }
                }
            }
        }
    
        // ManyToMany: Oferta -(ManytoMany)-> Carrera
        foreach (Oferta::all() as $oferta) {
            $carreras = Carrera::inRandomOrder()->take(random_int(1, 5))->pluck('id');
            foreach ($carreras as $carrera) {
                $oferta->carreras()->attach($carrera);
            }
        }*/
    }
}
