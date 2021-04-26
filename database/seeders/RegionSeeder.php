<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::truncate();
        $region = array('Arica y Parinacota', 'Tarapacá','Antofagasta','Atacama','Coquimbo', 'Valparaíso'
                        ,'Región del Libertador Gral. Bernardo O’Higgins','Región del Maule', 'Región del Biobío',
                        'Región de la Araucanía', 'Región de Los Ríos','Región de Los Lagos',
                        'Región Aisén del Gral. Carlos Ibáñez del Campo','Región de Magallanes y de la Antártica Chilena',
                        'Región Metropolitana de Santiago');
        foreach ($region as $key) {
            Region::create([
                /*Acá insertamos correctamente el id de la empresa en la tabla Oferta.*/
                /*Funcionando correctamente.*/
                'nombre' => $key,
            ]);
        }

    }
}
