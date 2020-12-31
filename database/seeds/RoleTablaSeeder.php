<?php

use Illuminate\Database\Seeder;
use App\Role;
use Illuminate\Support\Facades\Config; // Agrego constantes

class RoleTablaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // para vaciar las bd
        // DB::table('roles')->truncate();

        // creamos el rol de director(admin)
        $role = new Role();
        $role->roleDescripcion = Config::get('constants.ADMIN');
        $role->save();

        // creamos el rol de secretaria
        $role = new Role();
        $role->roleDescripcion = Config::get('constants.USER');
        $role->save();
    }
}
