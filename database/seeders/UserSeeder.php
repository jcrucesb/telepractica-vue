<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i<=10; $i++)
        {
            $user = new User();

            $user->name = "Superusuario $i";
            $user->run = strval(1300000 + $i) . "-" . strval(random_int(0, 9));
            $user->email = "superusuario$i@email.com";
            $user->password = Hash::make("superusuario$i");
            $user->estado_usuario_id = random_int(1, 3);
            $user->rol_id = 5;

            $user->save();
        }
    }
}
