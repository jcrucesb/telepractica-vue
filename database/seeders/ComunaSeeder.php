<?php

namespace Database\Seeders;

use App\Models\Comuna;
use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comuna::truncate();

        /*for ($i=1; $i<=3; $i++)
        {
            $comuna = new Comuna();

            $comuna->region_id = random_int(1, 16);
            $comuna->nombre = "Comuna $i";

            $comuna->save();
        }*/
        $region = DB::table('regions')
        ->select('id', 'nombre')
        ->get();
        //echo $region;
        //$correr = 2;
        $arica = array("Arica", "Camarones", "Putre", "General Lagos");
        $tarapaca = array("Iquique", "Alto Hospicio", "Pozo Almonte", "Camiña", "Colchane", "Huara", "Pica");
        $antofagasta = array("Antofagasta", "Mejillones", "Sierra Gorda", "Taltal", "Calama", "Ollagüe", "San Pedro de Atacama", "Tocopilla", "María Elena");
        $atacama = array("Copiapó", "Caldera", "Tierra Amarilla", "Chañaral", "Diego de Almagro", "Vallenar", "Alto del Carmen", "Freirina", "Huasco");
        $coquimbo = array("La Serena", "Coquimbo", "Andacollo", "La Higuera", "Paiguano", "Vicuña", "Illapel", "Canela", "Los Vilos", "Salamanca", "Ovalle", "Combarbalá", "Monte Patria", "Punitaqui", "Río Hurtado");
        $valpo = array("Valparaíso", "Casablanca", "Concón", "Juan Fernández", "Puchuncaví", "Quintero", "Viña del Mar", "Isla de Pascua", "Los Andes", "Calle Larga", "Rinconada", "San Esteban", "La Ligua", "Cabildo", "Papudo", "Petorca", "Zapallar", "Quillota", "Calera", "Hijuelas", "La Cruz", "Nogales", "San Antonio", "Algarrobo", "Cartagena", "El Quisco", "El Tabo", "Santo Domingo", "San Felipe", "Catemu", "Llaillay", "Panquehue", "Putaendo", "Santa María", "Quilpué", "Limache", "Olmué", "Villa Alemana");
        $libertador = array("Rancagua", "Codegua", "Coinco", "Coltauco", "Doñihue", "Graneros", "Las Cabras", "Machalí", "Malloa", "Mostazal", "Olivar", "Peumo", "Pichidegua", "Quinta de Tilcoco", "Rengo", "Requínoa", "San Vicente", "Pichilemu", "La Estrella", "Litueche", "Marchihue", "Navidad", "Paredones", "San Fernando", "Chépica", "Chimbarongo", "Lolol", "Nancagua", "Palmilla", "Peralillo", "Placilla", "Pumanque", "Santa Cruz");
        $maule = array("Talca", "Constitución", "Curepto", "Empedrado", "Maule", "Pelarco", "Pencahue", "Río Claro", "San Clemente", "San Rafael", "Cauquenes", "Chanco", "Pelluhue", "Curicó", "Hualañé", "Licantén", "Molina", "Rauco", "Romeral", "Sagrada Familia", "Teno", "Vichuquén", "Linares", "Colbún", "Longaví", "Parral", "Retiro", "San Javier", "Villa Alegre", "Yerbas Buenas");
        $biobio = array("Concepción", "Coronel", "Chiguayante", "Florida", "Hualqui", "Lota", "Penco", "San Pedro de la Paz", "Santa Juana", "Talcahuano", "Tomé", "Hualpén", "Lebu", "Arauco", "Cañete", "Contulmo", "Curanilahue", "Los Álamos", "Tirúa", "Los Ángeles", "Antuco", "Cabrero", "Laja", "Mulchén", "Nacimiento", "Negrete", "Quilaco", "Quilleco", "San Rosendo", "Santa Bárbara", "Tucapel", "Yumbel", "Alto Biobío", "Chillán", "Bulnes", "Cobquecura", "Coelemu", "Coihueco", "Chillán Viejo", "El Carmen", "Ninhue", "Ñiquén", "Pemuco", "Pinto", "Portezuelo", "Quillón", "Quirihue", "Ránquil", "San Carlos", "San Fabián", "San Ignacio", "San Nicolás", "Treguaco", "Yungay");
        $araucania = array("Temuco", "Carahue", "Cunco", "Curarrehue", "Freire", "Galvarino", "Gorbea", "Lautaro", "Loncoche", "Melipeuco", "Nueva Imperial", "Padre las Casas", "Perquenco", "Pitrufquén", "Pucón", "Saavedra", "Teodoro Schmidt", "Toltén", "Vilcún", "Villarrica", "Cholchol", "Angol", "Collipulli", "Curacautín", "Ercilla", "Lonquimay", "Los Sauces", "Lumaco", "Purén", "Renaico", "Traiguén", "Victoria");
        $losrios = array("Valdivia", "Corral", "Lanco", "Los Lagos", "Máfil", "Mariquina", "Paillaco", "Panguipulli", "La Unión", "Futrono", "Lago Ranco", "Río Bueno");
        $lagos = array("Puerto Montt", "Calbuco", "Cochamó", "Fresia", "Frutillar", "Los Muermos", "Llanquihue", "Maullín", "Puerto Varas", "Castro", "Ancud", "Chonchi", "Curaco de Vélez", "Dalcahue", "Puqueldón", "Queilén", "Quellón", "Quemchi", "Quinchao", "Osorno", "Puerto Octay", "Purranque", "Puyehue", "Río Negro", "San Juan de la Costa", "San Pablo", "Chaitén", "Futaleufú", "Hualaihué", "Palena");
        $aysen = array("Coihaique", "Lago Verde", "Aisén", "Cisnes", "Guaitecas", "Cochrane", "O’Higgins", "Tortel", "Chile Chico", "Río Ibáñez");
        $magallanes = array("Punta Arenas", "Laguna Blanca", "Río Verde", "San Gregorio", "Cabo de Hornos (Ex Navarino)", "Antártica", "Porvenir", "Primavera", "Timaukel", "Natales", "Torres del Paine");
        $metropolitana = array("Cerrillos", "Cerro Navia", "Conchalí", "El Bosque", "Estación Central", "Huechuraba", "Independencia", "La Cisterna", "La Florida", "La Granja", "La Pintana", "La Reina", "Las Condes", "Lo Barnechea", "Lo Espejo", "Lo Prado", "Macul", "Maipú", "Ñuñoa", "Pedro Aguirre Cerda", "Peñalolén", "Providencia", "Pudahuel", "Quilicura", "Quinta Normal", "Recoleta", "Renca", "San Joaquín", "San Miguel", "San Ramón", "Vitacura", "Puente Alto", "Pirque", "San José de Maipo", "Colina", "Lampa", "Tiltil", "San Bernardo", "Buin", "Calera de Tango", "Paine", "Melipilla", "Alhué", "Curacaví", "María Pinto", "San Pedro", "Talagante", "El Monte", "Isla de Maipo", "Padre Hurtado", "Peñaflor");
        
        foreach ($region as $key) {
           $id = $key->id;
           if ($id == 1) {
                echo 'si';
                foreach ($arica as $key) {
                    Comuna::create([
                        /*Acá insertamos correctamente el id de la empresa en la tabla Oferta.*/
                        /*Funcionando correctamente.*/
                        'region_id' => $id,
                        'nombre' => $key,
                    ]);
                }
            }else if ($id == 2){
                echo 'no';
                foreach ($tarapaca as $key) {
                    Comuna::create([
                        /*Acá insertamos correctamente el id de la empresa en la tabla Oferta.*/
                        /*Funcionando correctamente.*/
                        'region_id' => $id,
                        'nombre' => $key,
                    ]);
                }
            }else if ($id == 3){
            echo 'no';
                foreach ($antofagasta as $key) {
                    Comuna::create([
                        /*Acá insertamos correctamente el id de la empresa en la tabla Oferta.*/
                        /*Funcionando correctamente.*/
                        'region_id' => $id,
                        'nombre' => $key,
                    ]);
                }
            }else if ($id == 4){
                foreach ($atacama as $key) {
                    Comuna::create([
                        /*Acá insertamos correctamente el id de la empresa en la tabla Oferta.*/
                        /*Funcionando correctamente.*/
                        'region_id' => $id,
                        'nombre' => $key,
                    ]);
                }
            }else if ($id == 5){
                foreach ($coquimbo as $key) {
                    Comuna::create([
                        /*Acá insertamos correctamente el id de la empresa en la tabla Oferta.*/
                        /*Funcionando correctamente.*/
                        'region_id' => $id,
                        'nombre' => $key,
                    ]);
                }
            }else if ($id == 6){
                foreach ($valpo as $key) {
                    Comuna::create([
                        /*Acá insertamos correctamente el id de la empresa en la tabla Oferta.*/
                        /*Funcionando correctamente.*/
                        'region_id' => $id,
                        'nombre' => $key,
                    ]);
                }
            }else if ($id == 7){
                foreach ($libertador as $key) {
                    Comuna::create([
                        /*Acá insertamos correctamente el id de la empresa en la tabla Oferta.*/
                        /*Funcionando correctamente.*/
                        'region_id' => $id,
                        'nombre' => $key,
                    ]);
                }
            }else if ($id == 8){
                foreach ($maule as $key) {
                    Comuna::create([
                        /*Acá insertamos correctamente el id de la empresa en la tabla Oferta.*/
                        /*Funcionando correctamente.*/
                        'region_id' => $id,
                        'nombre' => $key,
                    ]);
                }
            }else if ($id == 9){
                foreach ($biobio as $key) {
                    Comuna::create([
                        /*Acá insertamos correctamente el id de la empresa en la tabla Oferta.*/
                        /*Funcionando correctamente.*/
                        'region_id' => $id,
                        'nombre' => $key,
                    ]);
                }
            }else if ($id == 10){
                foreach ($araucania as $key) {
                    Comuna::create([
                        /*Acá insertamos correctamente el id de la empresa en la tabla Oferta.*/
                        /*Funcionando correctamente.*/
                        'region_id' => $id,
                        'nombre' => $key,
                    ]);
                }
            }else if ($id == 11){
                foreach ($losrios as $key) {
                    Comuna::create([
                        /*Acá insertamos correctamente el id de la empresa en la tabla Oferta.*/
                        /*Funcionando correctamente.*/
                        'region_id' => $id,
                        'nombre' => $key,
                    ]);
                }
            }else if ($id == 12){
                foreach ($lagos as $key) {
                    Comuna::create([
                        /*Acá insertamos correctamente el id de la empresa en la tabla Oferta.*/
                        /*Funcionando correctamente.*/
                        'region_id' => $id,
                        'nombre' => $key,
                    ]);
                }
            }else if ($id == 13){
                foreach ($aysen as $key) {
                    Comuna::create([
                        /*Acá insertamos correctamente el id de la empresa en la tabla Oferta.*/
                        /*Funcionando correctamente.*/
                        'region_id' => $id,
                        'nombre' => $key,
                    ]);
                }
            }else if ($id == 14){
                foreach ($magallanes as $key) {
                    Comuna::create([
                        /*Acá insertamos correctamente el id de la empresa en la tabla Oferta.*/
                        /*Funcionando correctamente.*/
                        'region_id' => $id,
                        'nombre' => $key,
                    ]);
                }
            }else if ($id == 15){
                foreach ($metropolitana as $key) {
                    Comuna::create([
                        /*Acá insertamos correctamente el id de la empresa en la tabla Oferta.*/
                        /*Funcionando correctamente.*/
                        'region_id' => $id,
                        'nombre' => $key,
                    ]);
                }
            }
        }
        
    }
}
