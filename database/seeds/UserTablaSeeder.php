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
        // traigo el rol de admin(director)
        $role_dire=Role::where('roleDescripcion','director')->first();
        
        // creo el usuario director.
        $user= new User();
        $user->userNombre = 'Alejandro';
        $user->email = 'director@email.com';
        $user->password = bcrypt('secret');
        $user->roleId = $role_dire->roleId;
        $user->save();
        
        // creo un usuario secretaria
        $role_secre=Role::where('roleDescripcion','secretaria')->first();
        $user= new User();
        $user->userNombre = 'Amelie';
        $user->email = 'secre@email.com';
        $user->password = bcrypt('secret1');
        $user->roleId = $role_secre->roleId;
        $user->save();
        

    }
}
