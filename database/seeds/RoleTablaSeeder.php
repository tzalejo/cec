<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleTablaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // creamos el rol de director(admin)
        $role = new Role(
            // [
            // 'roleId'=>1,
            // 'roleDescripcion' => 'director'
            // ]
        );
        // $role->roleId = 1;
        $role->roleDescripcion = 'director';
        $role->save();
        
        // creamos el rol de secretaria
        $role = new Role(
            // [
            // 'roleId'=>2,
            // 'roleDescripcion' => 'secretaria'
            // ]
        );
        // $role->roleId = 2;
        $role->roleDescripcion = 'secretaria';
        $role->save();


    }
}
