<?php

namespace Database\Seeders;

use App\Models\Practicante;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PracticanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Practicante::truncate();
        /*
        for ($i=1; $i<=100; $i++)
        {
            $user = new User();

            $user->name = "Practicante $i";
            $user->run = strval(1200000 + $i) . "-" . strval(random_int(0, 9));
            $user->email = "practicante$i@email.com";
            $user->password = Hash::make("practicante$i");
            $user->estado_usuario_id = random_int(1, 3);
            //$user->rol_id = 1;

            $user->save();

            $practicante = new Practicante();

            $practicante->id = $user->id;
            $practicante->nombre_completo = $user->name;
            $practicante->run = $user->run;
            $practicante->email = $user->email;

            $practicante->carrera_id = random_int(1, 150); 
            $practicante->comuna_id = random_int(1, 150);
            $practicante->institucion_id = random_int(27, 29); 
            $practicante->nivel_educacional_id = random_int(1, 3); 
            $practicante->region_id = random_int(1, 16); 
            $practicante->tipo_practica_id = random_int(1, 5);
            $practicante->user_id = $user->id;      

            $practicante->telefono = "+56 9 0000 0000";
            $practicante->cantidad_horas = random_int(50, 500);
            $practicante->cantidad_meses = random_int(1, 6);
            $practicante->equipo_computacional = random_int(0, 1);
            $practicante->internet_fijo = random_int(0, 1);
            $practicante->hab_blandas = null;
            $practicante->hab_profesionals = null;

            $practicante->save();
        }
        */
        /*$user = User::create([
            'name' => 'kaido',
            'email' => 'kaido@gmail.com',
            'password' => Hash::make('12'),
            'api_token' => Str::random(10),
            'rol_id' => 1,
            'estado_usuario_id' => 2,
            'run' => '2333344-2',
        ])->assignRole('Practicante');

        Practicante::create([
            'user_id' => $user->id,
            'carrera_id' => 1,
            'comuna_id' => 2,
            'institucion_id' => 3,
            'nivel_educacional_id' => 2,
            'region_id' => 2,
            'tipo_practica_id' => 2,
            'run' => '333333333-3',
            'nombre_completo' => 'Kaido-Sama',
            'email' => 'kaido@gmail.com',
            'telefono' => '898989898',
            'cantidad_horas' => 200,
            'cantidad_meses' => 3,
            'equipo_computacional' => 'si',
            'internet_fijo' => 'si',
            'hab_blandas' => null,
            'hab_profesionals' => null,
        ]);*/

        $user = User::create([
            'name' => 'jair',
            'email' => 'jair@gmail.com',
            'password' => Hash::make('12'),
            'api_token' => Str::random(10),
            'rol_id' => 1,
            'estado_usuario_id' => 2,
            'run' => '21344-2',
        ])->assignRole('Practicante');

        Practicante::create([
            'user_id' => $user->id,
            'carrera_id' => 1,
            'comuna_id' => 2,
            'institucion_id' => 3,
            'nivel_educacional_id' => 2,
            'region_id' => 2,
            'tipo_practica_id' => 2,
            'run' => '21344-2',
            'nombre_completo' => 'jair-Sama',
            'email' => 'jair@gmail.com',
            'telefono' => '898989898',
            'cantidad_horas' => 200,
            'cantidad_meses' => 3,
            'equipo_computacional' => 'si',
            'internet_fijo' => 'si',
            'hab_blandas' => null,
            'hab_profesionals' => null,
        ]);
    }
}
