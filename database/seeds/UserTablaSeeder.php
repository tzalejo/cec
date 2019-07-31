<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
class UserTablaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Creamo el usuario director (admin)
     * 
     * @return void
     */
    public function run()
    {
        // para vaciar las bd
        // DB::table('users')->truncate();

        // traigo el rol de admin(director)
        $role_dire=Role::where('roleDescripcion','Director')->first();
        
        // creo el usuario director.
        $user= new User();
        $user->userNombre = 'Alejandro';
        $user->email = 'director@email.com';
        $user->password = bcrypt('secret');
        $user->userImagen = 'http://www.empleosperu.gob.pe:8080/CertiJovenPortal/images/usuario.jpg';
        $user->roleId = $role_dire->roleId;
        $user->save();
        
        // creo un usuario secretaria
        $role_secre=Role::where('roleDescripcion','Secretaria')->first();
        $user= new User();
        $user->userNombre = 'Amelie';
        $user->email = 'secre@email.com';
        $user->password = bcrypt('secret1');
        $user->userImagen = 'http://www.empleosperu.gob.pe:8080/CertiJovenPortal/images/usuario.jpg';
        $user->roleId = $role_secre->roleId;
        $user->save();
        
        //creo usuario usando factory.. 
        factory(User::class)->times(20)->create();

    }
   
}
