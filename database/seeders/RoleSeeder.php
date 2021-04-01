<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
/**Importamos el modelo de Laravel permission.*/
use Spatie\Permission\Models\Role;
/**Otorgar permisos a los diferentes tipos de USUARIOS.*/
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Ahora llamamos al MODELO ROLES y agregamos los tipos de usuarios.
        $practicante = Role::create(['name' => 'Practicante']);
        $empresa = Role::create(['name' => 'Empresa']);
        $institucion = Role::create(['name' => 'Institucion']);
        $empresa_premium = Role::create(['name' => 'Empresa_premium']);
        $admin = Role::create(['name' => 'Superusuario']);

        /*Un permiso a un role
        $permission->assignRole($role);*/
        /*Llamamos al modelo PERMISSION.*/
        /*Después de agregar syncRoles([$admin]), debemos ejecutar nuevamente los seeder.*/
        Permission::create(['name' => 'admin.home'])->syncRoles([$admin]);
        //Empresa.
        Permission::create(['name' => 'empresas.index'])->syncRoles([$empresa]);
        $empresa->givePermissionTo('empresas.index');

        Permission::create(['name' => 'practicante.index'])->syncRoles([$practicante]);
        $practicante->givePermissionTo('practicante.index');
    }
}
