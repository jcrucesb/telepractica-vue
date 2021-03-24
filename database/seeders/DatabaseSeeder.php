<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Oferta;
use App\Models\Carrera;
use App\Models\Empresa;
use App\Models\Institucion;
use App\Models\EstadoOferta;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        
        $this->call([
            //
            AreaSeeder::class,
            DepartamentoSeeder::class,
            EscuelaSeeder::class,
            EstadoOfertaSeeder::class,
            EstadoPostSeeder::class,
            EstadoUsuarioSeeder::class,
            NivelEducacionalSeeder::class,
            RegionSeeder::class,
            RolSeeder::class,
            TipoPracticaSeeder::class,

            //
            ComunaSeeder::class,

            //
            EmpresaSeeder::class,
            InstitucionSeeder::class,

            //MencionSeeder::class,
            SupervisorSeeder::class,

            //
            CarreraSeeder::class,

            //
            PracticanteSeeder::class,

            // Cursos
            // Experiencias

            //
            OfertaSeeder::class,
            
            // Postulacion
            PostulacionSeeder::class,

            // Entrevistas

            UserSeeder::class
        ]);

        ////////////////////
        // MANY RELATIONS //
        ////////////////////

        // Oferta -(proviene)-> empresa && estado && supervisor
        /* foreach (Oferta::all() as $oferta) {
            $empresa = Empresa::where('id', $oferta->empresa_id)->pluck('id');
            
            $oferta->empresa()->attach($empresa);
        } */

        // Postulacion -(proviene)-> estado $$ oferta && practicante
        /* foreach (Oferta::all() as $oferta) {
            $practicantes = Practicante::inRandomOrder()->take(rand(1, 15))->pluck('id');
            foreach ($practicantes as $practicante) {
                $oferta->practicantes()->attach($practicante);
            }
        } */
    }
}
