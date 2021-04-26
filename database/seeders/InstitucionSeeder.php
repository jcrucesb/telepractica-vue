<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Carrera;
use App\Models\Institucion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InstitucionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Institucion::truncate();

        for ($i=1; $i<=10; $i++)
        {
            $user = new User();

            $user->name = "Institución $i";
            $user->run = strval(1100000 + $i) . "-" . strval(random_int(0, 9));
            $user->email = "institucion$i@email.com";
            $user->password = Hash::make("institucion$i");
            $user->api_token = Str::random(10);
            $user->rol_id = 3;
            $user->estado_usuario_id = random_int(1, 3);
            //$user->rol_id = 3; 
            $user->save();

            $institucion = new Institucion();

            $institucion->id = $user->id;

            $institucion->user_id = $user->id;

            $institucion->nombre = $user->name;
            $institucion->run = $user->run;
            $institucion->email = $user->email;
            $institucion->sigla = "INST. $i";
            $institucion->web = "www.institucion$i.com";
            $institucion->telefono = "+56 9 0000 0000";

            $institucion->save();
        }

        /*
        $user = User::create([
            'name' => 'inst',
            'email' => 'institucion@gmail.com',
            'password' => Hash::make('12345678'),
            'estado_usuario_id' => 2,
            'run' => '2553344-9',
        ])->assignRole('Institucion');

        institucions::create([
            'user_id' => $user->id,
            'run' => '2553344-9',
            'nombre' => 'Duoc UC',
            'sigla' => 'INST 35',
            'web' => 'www.duocuc.cl',
            'email' => 'institucion@gmail.com',
            'telefono' => '898989898',
        ]);
        */
    }
}
