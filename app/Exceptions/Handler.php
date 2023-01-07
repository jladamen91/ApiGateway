<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Response;
use Illuminate\Session\TokenMismatchException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponser;
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        /* valida excepciones de tipo HttpException*/
        if ($exception instanceof HttpException) {
            $code = $exception->getStatusCode();
            $message = Response::$statusTexts[$code];
            return $this->errorResponse($message, $code);
        }

        /* valida excepciones de tipo cuando no encuentra el registro*/
        if ($exception instanceof ModelNotFoundException) {
            $model = strtolower(class_basename($exception->getModel()));
            return $this->errorResponse("No existe el registro, favor de verificar {$model}", Response::HTTP_NOT_FOUND);
        }
        /* valida excepciones de tipo no autorizado*/
        if ($exception instanceof AuthorizationException) {
            return $this->errorResponse("NO AUTORIZADO {$exception->getMessage()}", Response::HTTP_FORBIDDEN);
        }
        /* valida excepciones de tipo no autenticado*/
        if ($exception instanceof AuthenticationException) {
            return $this->errorResponse("NO AUTORIZADO {$exception->getMessage()}", Response::HTTP_UNAUTHORIZED);
        }

        /* valida excepciones de tipo Validacion*/
        if ($exception instanceof ValidationException) {
            $errors =   $exception->validator->errors()->getMessages();
            return $this->errorResponse($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        /*
            *Validacion si el cliente se equivoca al enviar la petecion al apigateway
            */

        if ($exception instanceof ClientException) {

            $message = $exception->getResponse()->getBody();
            $code = $exception->getCode();


            return $this->errorMessage($message, $code);
        }

        /**
         * error de base de datos
         */

        if ($exception instanceof QueryException) {
            $codigo = $exception->errorInfo[1];

            if ($codigo == 1451) {
                return $this->errorResponse('No se puede elimnar este registro ya que cuenta con relacion a otro', 409);
            }
    
        }

        /**
         * error cuando el usuario quiere iniciar sesion y no puede
         */

        if ($exception instanceof TokenMismatchException)
        {
            return redirect()->back()->withInput($request->input());
        }


        /**
         * TODAS LAS VALIDACIONES DEBEN DE IR ARRIBA DE AQUI -----------------------------------------------
         */

        /*Si requiero que la aplicacion este en modo debug osea que se esta contruyendo entramos aqui*/
        if (env('APP_DEBUG', false)) {
            return parent::render($request, $exception);
        }


        /*error inesperado */
        return $this->errorResponse("ERROR INESPERADO ", Response::HTTP_INTERNAL_SERVER_ERROR);
    }


}
