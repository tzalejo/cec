<?php

namespace App\Http\Controllers;

use App\User;
use App\Notifications\SignupActivate;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponser;
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

        return $this->successResponse( ['message' => 'Usuario '.$user->userNombre.' creado satisfactoriamente'],201);
        // return response()->json([
        //     'message' => 'Usuario '.$user->userNombre.' creado satisfactoriamente'
        // ],201);

    }
    public function login(Request $request){
        
        $request->validate([
            'email'         => 'required|string|email',
            'userNombre'    => 'required_without:email|string',
            'password'      => 'required|string',
            'remember_me'   => 'boolean',
            ]);
        if($request->has('userNombre')){
            $credenciales = request(['userNombre', 'password']);
        }else{
            $credenciales = request(['email', 'password']);
        }
        # El metrod Auth devuelve true si la autenticacion fue exitosa
        if (!Auth::attempt($credenciales)) {
            # code...
            return $this->errorResponse('No autorizado',401);
            # return response()->json(['message' => 'No autorizado'],401);
        }
        // return response()->json($credenciales);
        
        # $user = User::find(1); 
        # return response()->json($user->createToken('Personal Access Token'));
        $user = $request->user();
        $tokenResult = $user->createToken('Pernsal Access Token');
        $token =  $tokenResult->token;

        if($request->remember_me){
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();
        return $this->successResponse([
            'access_token'  => $tokenResult->accessToken,
            'token_type'    => 'Bearer',
            'expires_at'    => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
        ], 200);

    }


    public function logout(Request $request){
        $request->user()->token()->revoke();
        return $this->successResponse(['message'=>'Salió exitosamente'], 200);
    }

    // public function user(Request $request){
    //     return $this->showAll($request->user());
        
    // }

}
