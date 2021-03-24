<?php

namespace Database\Seeders;

use App\Models\Oferta;
use App\Models\Carrera;
use App\Models\EstadoPost;
use App\Models\Postulacion;
use App\Models\Practicante;
use Illuminate\Database\Seeder;

class PostulacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Postulacion::truncate();

        // Creacion: Postulacion -(proviene)-> oferta && estado && supervisor && carreras
        foreach (Oferta::all() as $oferta) {
            $i = random_int(0, 6);

            if ($i > 0) {
                for ($x = 1; $x < $i; $x++) {

                    $estado_post_id = EstadoPost::inRandomOrder()->take(1)->pluck('id');
            
                    $carreras = array();
                    foreach ($oferta->carreras as $carrera) {
                        array_push($carreras, $carrera["id"]);
                    }
        
                    $oferta->carrera_ids = $carreras;

                    $practicante_id = Practicante::inRandomOrder()->take(1)->pluck('id');

                    if($practicante_id != null){
                        // FKs
                        $postulacion = new Postulacion();
    
                        $postulacion->oferta_id = $oferta->id;
                        $postulacion->estado_post_id = $estado_post_id[0];
                        $postulacion->practicante_id = $practicante_id[0];
    
                        $postulacion->save();
    
                        // Attributes
                        Postulacion::where('id', $postulacion->id)->update(['nombre' => "Postulacion $postulacion->id"]);
                        Postulacion::where('id', $postulacion->id)->update(['fecha' => "2021-01-01"]);
                        Postulacion::where('id', $postulacion->id)->update(['hora' => "00:00"]);
                    }
                }
            }
        }
    }
}
