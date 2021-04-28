<?php

namespace Database\Seeders;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Empresa::truncate();
        /*Probaremos
        for ($i=1; $i<=20; $i++)
        {
            $user = new User();

            $user->name = "Empresa $i";
            $user->run = strval(1000000 + $i) . "-" . strval(random_int(0, 9));
            $user->email = "empresa$i@email.com";
            $user->password = Hash::make("empresa$i");
            $user->estado_usuario_id = random_int(1, 3);
            if(intval($i) < 11){
                $user->rol_id = 2;
            }
            else{
                $user->rol_id = 4;
            }

            $user->save();

            $empresa = new Empresa();

            $empresa->id = $user->id;

            $empresa->area_id = random_int(1, 5);
            $empresa->user_id = $user->id;

            $empresa->nombre_ficticio = $user->name;
            $empresa->run = $user->run;
            $empresa->email = $user->email;
            $empresa->razon_social = "EMP. $i";
            $empresa->giro = "Giro-EMP. $i";
            $empresa->web = "www.empresa$i.com";
            $empresa->telefono = "+56 9 0000 0000";
            $empresa->direccion = "Dirección EMP. $i";
            $empresa->fecha_inicio_actividades = "01/01/2021";

            $empresa->save();
        }
        */
        $emp = User::create([
            'name' => 'empresa',
            'email' => 'empresa@gmail.com',
            'password' => Hash::make('1234567'),
            'rol_id' => 2,
            'api_token' => Str::random(10),
            'estado_usuario_id' => 2,
            'run' => '11111111-1',
        ])->assignRole('Empresa');

        Empresa::create([
            'user_id' => $emp->id,
            'area_id' => 1,
            'nombre_ficticio' => 'Eme Bus',
            'run' => '11111111-1',
            'email' => 'empresa@gmail.com',
            'razon_social' => 'Giro-EMP',
            'giro' => 'eme bus',
            'web' => 'www.emebus.cl',
            'telefono' => '+56 9 0000 0000',
            'direccion' => 'Talca',
            'fecha_inicio_actividades' => '01/01/2021',
        ]);

        $emp = User::create([
            'name' => 'la',
            'email' => 'la@gmail.com',
            'password' => Hash::make('123'),
            'rol_id' => 2,
            'api_token' => Str::random(10),
            'estado_usuario_id' => 2,
            'run' => '222222-2',
        ])->assignRole('Empresa');

        Empresa::create([
            'user_id' => $emp->id,
            'area_id' => 1,
            'nombre_ficticio' => 'la',
            'run' => '222222-2',
            'email' => 'la@gmail.com',
            'razon_social' => 'Giro-EMP1',
            'giro' => 'la',
            'web' => 'www.la.cl',
            'telefono' => '+56 9 0000 0000',
            'direccion' => 'Talca',
            'fecha_inicio_actividades' => '01/01/2021',
        ]);
    }
}
