<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
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
     */
    public function report(Exception $exception): void
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    /**
     * Create a Symfony response for the given exception.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function convertExceptionToResponse(Exception $e)
    {
        if (config('app.debug')) {
            return $this->renderExceptionWithWhoops($e);
        }

        return parent::convertExceptionToResponse($e);
    }

    /**
     * Render an exception using Whoops.
     *
     * @return \Illuminate\Http\Response
     */
    protected function renderExceptionWithWhoops(Exception $e)
    {
        $whoops = new \Whoops\Run();
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());

        return response()->make(
            $whoops->handleException($e),
            \method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500,
            \method_exists($e, 'getHeaders') ? $e->getHeaders() : []
        );
    }

    /**
     * ゲストな人が要認証ページにアクセスしようとしたら、各認証ページのloginページを表示する。
     *
     * @param Request $request [description]
     * @param AuthenticationException $exception [description]
     *
     * @return Response 各認証ページのloginページへリダイレクト
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        // if ($request->expectsJson()) {
        //     return response()->json(['message' => $exception->getMessage()], 401);
        // }

        $url = route(($guard = $exception->guards()[0]) ? $guard . '.login' : 'login');

        return redirect($url);
    }
}
