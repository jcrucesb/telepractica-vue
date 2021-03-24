<?php

namespace Database\Seeders;

use App\Models\Empresa;
use App\Models\Supervisor;
use Illuminate\Database\Seeder;

class SupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supervisor::truncate();
        // Supervisor -(proviene)-> empresa
        foreach (Empresa::all() as $empresa) {
            $i = random_int(1, 5);
            
            for ($x=1; $x <= $i; $x++) {
                $supervisor = new Supervisor();
    
                $supervisor->empresa_id = $empresa->id;
    
                $supervisor->save();

                $supervisor->run = strval(1000000 + $supervisor->id . "-" . strval(random_int(0, 9)));
                $supervisor->nombre_completo = "Supervisor $supervisor->id";
                $supervisor->email = "supervisor$supervisor->id@email.com";
                $supervisor->telefono = "+56 9 0000 0000";
    
                $supervisor->save();
            }
        }

        // Empresa -(tiene)-> supervisores
        foreach (Empresa::all() as $empresa) {
            $supervisors = Supervisor::where('empresa_id', $empresa->id)->get();
            $empresa->supervisors()->saveMany($supervisors);
        }
    }
}
