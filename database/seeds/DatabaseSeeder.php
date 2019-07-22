<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        
        // La creación de datos de roles debe ejecutarse primero
        $this->call(RoleTablaSeeder::class);
        // Los usuarios necesitarán los roles previamente generados
        $this->call(UserTablaSeeder::class);

    }
}
