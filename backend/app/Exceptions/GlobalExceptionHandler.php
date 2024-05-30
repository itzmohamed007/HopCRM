<?php

namespace App\Exceptions;

use App\Exceptions\Customs\ModularException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class GlobalExceptionHandler extends ExceptionHandler
{
    /**
     * Report or log an exception.
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModularException) {
            return $this->renderCustomMessage($exception->getMessage(), $exception->getCode());
        }

        return $this->renderExceptionMessage($exception->getMessage(), 500, $exception->getLine());
    }

    /**
     * Render a custom message response.
     */
    public function renderCustomMessage($message, $code)
    {
        return response()->json([
            'message' => $message,
            'code' => $code
        ], $code);
    }

    /**
     * Render an exception message response.
     */
    public function renderExceptionMessage($exceptionMessage, $code, $line)
    {
        return response()->json([
            'message' => $exceptionMessage,
            'code' => $code,
            'line' => $line
        ], $code);
    }
}
