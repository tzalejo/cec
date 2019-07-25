<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        $this->truncateTables([
            'estudiantes' , 'users', 'roles'
        ]);
        
        // La creación de datos de roles debe ejecutarse primero
        $this->call(RoleTablaSeeder::class);
        // Los usuarios necesitarán los roles previamente generados
        $this->call(UserTablaSeeder::class);
        
        // Estudiantes
        $this->call(EstudianteSeeder::class);
        
    }
    /**
     * Creo una fc para desactivar y activar la revision de foreign key,
     * es muy util porque a veces las tablas tienen restricciones q no
     * dejan correr al seed.
     * 
     * 
     */
    protected function truncateTables(array $tables){
        
        // para desactivar la revision de llave foranea en la bd
        Schema::disableForeignKeyConstraints();
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
        // para activar la revision.
        Schema::enableForeignKeyConstraints();
    }
}
