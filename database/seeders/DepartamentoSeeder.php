<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departamento::truncate();

        for ($i=1; $i<=10; $i++)
        {
            $departamento = new Departamento();

            $departamento->nombre = "Departamento $i";

            $departamento->save();
        }
    }
}
