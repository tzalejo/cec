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
        # dd($request->user());
        # $request->user()->autorizaRoles([ 'Director', 'Secretaria' ]);
        # baje las cantidades de consulta..de 30 a 26
        # $comisiones = Comision::all();
        $comisiones = Comision::with('matriculas') 
                            ->with('curso')
                            ->get();
        # envio a mi api 
        return response()->json($comisiones, 200);  # return view('home')->with('comisiones', $comisiones);
        
        # return view('home')
        #     ->with('comisiones', Comision::all())
        #     ->with('titulo','valore que va en la variable titulo');
        # return view('home', compact('comisiones')); seria equivalente al de arriba
        
    }

    
}
