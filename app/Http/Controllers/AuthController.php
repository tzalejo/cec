<?php

namespace App\Http\Controllers;

use App\User;
use App\Notifications\SignupActivate;
use App\Traits\ApiResponser;
use App\Http\Requests\SignupUserRequest;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    use ApiResponser;
    public function signup(SignupUserRequest $request)
    {
        $user = User::create([
            'userNombre' => $request->userNombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'userImagen' => 'secretaria.png',
            'roleId' => 2,
        ]);

        return $this->successResponse(
            [
                'message' =>
                    'Usuario ' .
                    $user->userNombre .
                    ' creado satisfactoriamente',
            ],
            Response::HTTP_CREATED
        );
    }
    public function login(LoginUserRequest $request)
    {
        $credenciales = request(['email', 'password']);

        # El metrod Auth devuelve true si la autenticacion fue exitosa
        if (!Auth::attempt($credenciales)) {
            return $this->errorResponse(
                'No autorizado, verifique sus datos por favor.',
                Response::HTTP_UNAUTHORIZED
            );
        }
        # return response()->json($credenciales);
        # $user = User::find(1);
        # return response()->json($user->createToken('Personal Access Token'));
        $user = $request->user();
        $tokenResult = $user->createToken('Pernsal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();
        return $this->successResponse(
            [
                'userNombre' => $user->userNombre,
                'email' => $user->email,
                'userImagen' => $user->userImagen,
                'roleId' => $user->roleId,
                'roleNombre' => $user->role->roleDescripcion,
                'token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString(),
            ],
            Response::HTTP_OK
        );
    }

    public function logout(Request $request)
    {
        $request
            ->user()
            ->token()
            ->revoke();
        return $this->successResponse(
            ['message' => 'Salió exitosamente'],
            Response::HTTP_OK
        );
    }

    public function delete(Request $request)
    {
        return 'bien';
        #eliminar
    }
}
