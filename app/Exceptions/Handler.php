<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

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

    public function render($request, Throwable $e)
    {
        // Logging untuk debugging
        Log::error('Exception Detected!', [
            'exception' => get_class($e),
            'message' => $e->getMessage(),
            'url' => $request->url(),
            'route_name' => Route::currentRouteName(),
        ]);

        // Tangani UnauthorizedException dari Spatie
        if ($e instanceof UnauthorizedException) {
            return response()->view('admin.error.403', [
                'exception' => 'Anda tidak memiliki izin untuk mengakses halaman ini!',
                'current_url' => $request->url(),
                'route_name' => Route::currentRouteName(),
            ], 403);
        }

        // Tangani AuthorizationException (403 Laravel)
        if ($e instanceof AuthorizationException) {
            return response()->view('admin.error.403', [
                'exception' => 'Akses ditolak oleh sistem!',
                'current_url' => $request->url(),
                'route_name' => Route::currentRouteName(),
            ], 403);
        }

        // Tangani NotFoundHttpException (404)
        if ($e instanceof NotFoundHttpException) {
            return response()->view('admin.error.404', [
                'exception' => 'Halaman yang Anda cari tidak ditemukan!',
                'current_url' => $request->url(),
            ], 404);
        }

        return parent::render($request, $e);
    }
}
