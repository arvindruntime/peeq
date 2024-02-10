<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
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
        if ($exception instanceof TokenMismatchException) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'CSRF Token Mismatch',
                ], 419);
            }

            return response()->view('errors.419', [], 419);
        }
        if ($request->expectsJson()){

            if ($exception instanceof ModelNotFoundException){
                return response([
                    'status' => 404,
                    'statusState'=> 'error',
                    'message' => 'Object Not Found',
                ], 404);
            }

            if ($exception instanceof NotFoundHttpException){
                return response([
                    'status' => 404,
                    'statusState'=> 'error',
                    'message'=> 'Route Not Found'
                ], 404);
            }
          
        }
        return parent::render($request, $exception);
        
    }
}
