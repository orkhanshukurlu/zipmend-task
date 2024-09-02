<?php

use App\Exceptions\UnauthorizedException;
use App\Http\Middleware\BasicAuthMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'basic.auth' => BasicAuthMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (UnauthorizedException $exception) {
            return response()->json(['message' => $exception->getMessage()], Response::HTTP_UNAUTHORIZED);
        });

        $exceptions->render(function (NotFoundHttpException $exception) {
            return response()->json(['message' => $exception->getMessage()], Response::HTTP_NOT_FOUND);
        });

        $exceptions->render(function (MethodNotAllowedHttpException $exception) {
            return response()->json(['message' => $exception->getMessage()], Response::HTTP_METHOD_NOT_ALLOWED);
        });

        $exceptions->render(function (ValidationException $exception) {
            return response()->json(
                ['message' => $exception->getMessage(), 'errors' => $exception->errors()],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        });

        $exceptions->render(function (Exception|Error $exception) {
            return response()->json(['message' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        });
    })
    ->create();
