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
    public function signup(Request $request)
    {
        $request->validate([
            'userNombre'    => 'required|string',
            'email'         => 'required|string|email',
            'password'      => 'required|string'
        ]);
        #return $request;

        $user = User::create([
            'userNombre'    => $request->userNombre,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'userImagen'    => 'secretaria.png',
            'roleId'        => 2,
        ]);

        return $this->successResponse(['message' => 'Usuario '.$user->userNombre.' creado satisfactoriamente'], 201);
        // return response()->json([
        //     'message' => 'Usuario '.$user->userNombre.' creado satisfactoriamente'
        // ],201);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email'         => 'required|string|email',
            'userNombre'    => 'required_without:email|string',
            'password'      => 'required|string',
            'remember_me'   => 'boolean',
            ]);
        
        if ($request->has('email')) {
            $credenciales = request(['email', 'password']);
        } else {
            $credenciales = request(['userNombre', 'password']);
        }
        # El metrod Auth devuelve true si la autenticacion fue exitosa
        if (!Auth::attempt($credenciales)) {
            # code...
            return $this->errorResponse('No autorizado, verifique sus datos por favor.', 401);
            # return response()->json(['message' => 'No autorizado'],401);
        }
        # return response()->json($credenciales);
        
        # $user = User::find(1);
        # return response()->json($user->createToken('Personal Access Token'));
        $user = $request->user();
        $tokenResult = $user->createToken('Pernsal Access Token');
        $token =  $tokenResult->token;

        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();
        return $this->successResponse([
            'userNombre'    => $user->userNombre,
            'email'         => $user->email,
            'userImagen'    => $user->userImagen,
            'roleId'         => $user->roleId,
            'token'         => $tokenResult->accessToken,
            'token_type'    => 'Bearer',
            'expires_at'    => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
        ], 200);
    }


    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return $this->successResponse(['message'=>'Salió exitosamente'], 200);
    }

      
    public function delete(Request $request)
    {
        return 'bien';
        #eliminar
    }
}
