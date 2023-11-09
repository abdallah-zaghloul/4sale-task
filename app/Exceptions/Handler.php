<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Modules\User\Exceptions\UserExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }


    /**
     * @param $request
     * @param Throwable $e
     * @return mixed
     * @throws Throwable
     */
    public function render($request, Throwable $e)
    {
        if ($userExceptionHandler = @app(UserExceptionHandler::class))
            return $userExceptionHandler->render($request, $e);
        return parent::render($request, $e);
    }
}
