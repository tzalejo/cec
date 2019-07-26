<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comision;
class AlumnosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inscripcion(){
        $now = date('Y-m-d');
        $comisionesAbiertas = Comision::where('comisionFF', '>', $now)->get();
        return view('inscripcion')->with('comisionesAbiertas',$comisionesAbiertas);
    }
    
}
