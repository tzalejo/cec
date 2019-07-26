<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comision;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        
        // $comisiones = Comision::all();
        $request->user()->autorizaRoles(['secretaria', 'director']);
        // return view('home')
        //     ->with('comisiones', Comision::all())
        //     ->with('titulo','valore que va en la variable titulo');
        // return view('home', compact('comisiones')); seria equivalente al de arriba
        
        return view('home')->with('comisiones', Comision::all());
    }

    
}
