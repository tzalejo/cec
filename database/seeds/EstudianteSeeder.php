<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Estudiante;

class EstudianteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // para eliminar todo en la db
        // DB::table('estudiantes')->truncate();

        // crear usuario usando Eloquent
        Estudiante::create([
            'estudianteDNI'=>12345678,
            'estudianteApellido'=>'Valenzuela',
            'estudianteNombre'=>'Alejandro',
            'estudianteDomicilio'=>'Av. Juan Carlos Nro 1873',
            'estudianteTelefono'=>'134-1543623',
            'estudianteLocalidad'=>'Tartagal',
            'estudianteEmail'=>'tzalejo@mail.com',
            'estudianteNacimiento'=>'1982-09-17',
            'estudianteFoto'=>'null'
        ]);

        //creo 20 estudiantes aleatorios..
        factory(Estudiante::class)->times(80)->create();


        // creamos un usuario, usuando el constructor de consulta
        // DB::table('estudiantes')->insert([
        //     'estudianteDNI'=>12345678,
        //     'estudianteApellido'=>'Vale',
        //     'estudianteNombre'=>'ale',
        //     'estudianteDomicilio'=>'domi 1',
        //     'estudianteTelefono'=>'123-123',
        //     'estudianteLocalidad'=>'mi localidad',
        //     'estudianteNacimiento'=>'1982-09-17',
        //     'estudianteFoto'=>'null'
        // ]);


        // otra forma de inserta usando sql(manualmente): 
        // DB:insert('INSERT INTO estudiantes (estudianteDNI, ...) VALUES (:campos)',[
        //     'estudianteDNI'=>12345678,
        //     'estudianteApellido'=>'Gonza',
        //     'estudianteNombre'=>'pep',
        //     'estudianteDomicilio'=>'domi d',
        //     'estudianteTelefono'=>'253-373',
        //     'estudianteLocalidad'=>'mi localidad',
        //     'estudianteNacimiento'=>'1990-09-27',
        //     'estudianteFoto'=>'null',
        //     ]);

        // creando usuario usuando directamente consulta sql
        // dd(DB::select('SELECT "estudianteId" FROM estudiantes WHERE "estudianteApellido" = ?',['Gonza'])); // devuelve un array con el valor 1
        // dd($estudiante);

        // $estudiante = DB::table('estudiantes')->select('estudianteId')->take(1)->get(); // devuelve un objeto de array..
        // dd($estudiante->first()->estudianteId); // es similar y mas elegante q $estudiantes[0];
        
        // $estudiante = DB::table('estudiantes')->select('estudianteId')->first(); // devuelve un objeto de array..
        // dd($estudiante); // devuelve un objeto
        
        // con la clausula where, devuelve los dos campos(id,dni)
        // $estudiante = DB::table('estudiantes')
        //     ->select('estudianteId','estudianteDNI')
        //     ->where('estudianteApellido','=','Gonza')
        //     ->first(); 
        
        // devuelve el valor de id
        // $estudiante = DB::table('estudiantes')
        //     ->where('estudianteApellido','=','Gonza')
        //     ->value('estudianteId'); 
        // dd($estudiante);



        }
}
