<?php

namespace App\Http\Controllers;

use App\User;
use App\Notifications\SignupActivate;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signup(Request $request){
        $request->validate([
            'userNombre'    => 'required|string',
            'email'         => 'required|string|email|unique:users',
            'password'      => 'required|string|confirmed',
            'roleId'        => 'required|numeric',
        ]);

        $user = User::create([
            'userNombre'    => $request->userNombre,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'roleId'        => $request->roleId,
        ]);

        return response()->json([
            'message' => 'Usuario '.$user->userNombre.' creado satisfactoriamente'
        ],201);
    }
    public function login(Request $request){
        $request->validate([
            'email'         => 'required|string|email',
            'password'      => 'required|string',
            'remember_me'   => 'boolean',
            ]);
        $credenciales = $request->only('email','password');
        # El metrod Auth devuelve true si la autenticacion fue exitosa
        if (!Auth::attempt($credenciales)) {
            # code...
            return response()->json(['message' => 'No autorizado'],401);
        }
        
        # $user = User::find(1); 
        # return response()->json($user->createToken('Personal Access Token'));
        $user = $request->user();
        $tokenResult = $user->createToken('Pernsal Access Token');
        $token =  $tokenResult->token;

        if($request->remember_me){
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();
        return response()->json([
            'access_token'  => $tokenResult->accessToken,
            'token_type'    => 'Bearer',
            'expires_at'    => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
        ], 200);

    }

    public function logout(Request $request){

        $request->user()->token()->revoke();
        return response()->json(['message'=>'Salió exitosamente'], 200);
    }

    public function user(Request $request){
        return response()->json($request->user());
        
    }

}
