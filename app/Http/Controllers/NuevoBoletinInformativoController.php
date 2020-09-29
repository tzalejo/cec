<?php

namespace App\Http\Controllers;

use App\Console\Commands\EnviarCorreoVerificacionComando;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class NuevoBoletinInformativoController extends Controller
{
    public function enviar(){
        Artisan::call(EnviarCorreoVerificacionComando::class);
        return response()->json(['data'=> 'Mensaje de Verificacion enviado']);
    }
}
