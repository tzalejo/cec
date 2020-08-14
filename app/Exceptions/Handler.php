<?php

namespace App\Exceptions;

use Exception;
use App\Traits\ApiResponser;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Validation\ValidationException;
use RuntimeException;

class Handler extends ExceptionHandler
{
    use ApiResponser;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        # cuando genera algun otro error llamo al metodo ApiException
        if ($request->expectsJson()) {
            return $this->ApiException($request, $exception);
        }
        return parent::render($request, $exception);
    }

    protected function ApiException($request, Exception $exception)
    {

        // if ($exception instanceof CustomException) {
        //     return $this->errorResponse('Error Servidor', 500);
        // }

        if ($exception instanceof ModelNotFoundException) {
            $modelo =strtolower(class_basename($exception->getModel()));
            return $this->errorResponse("No exite ninguna instancia de {$modelo} con el id expecificado", 404);
        }

        if ($exception instanceof NotFoundHttpException) {
            return $this->errorResponse('No se encontro la url expecificada ', 404);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->errorResponse('El metodo expecificado en la peticion no es valido ', 405);
        }
        if ($exception instanceof QueryException) {
            $codigo=$exception->errorInfo[1];
            if ($codigo==1451) {
                return $this->errorResponse('No se puede eliminar de forma permanente el recurso porque esta relacionado con algun otro.', 409);
            }
        }

        // if($exception instanceof ThrottleRequestsException){
        //     return $this->errorResponse('Limite de peticiones rebasado ',409);
        // }

        // if($exception instanceof RequestException){
        //     return $this->errorResponse('Fallo en la llamada.',500);
        // }

        # si estamos en modo depuracion..
        if (config('app.debug')) {
            return parent::render($request, $exception);
        }

        return $this->errorResponse('Falla inesperada. intente luego.', 500);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson()
                    ? $this->errorResponse(['message' => "Usuario no autoriazado"], 401)
                    : redirect()->guest($exception->redirectTo() ?? route('login'));
    }

    # para cuando los valores para el login son incorrecto..
    protected function invalidJson($request, ValidationException $exception)
    {
        return $this->errorResponse([
            'message' => 'Los datos dados no eran válidos.',
            'errors' => $exception->errors(),
        ], $exception->status);
    }
}
