<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     * 認証状態時にログイン画面にアクセスしたら各認証区分のtopページへリダイレクトする。
     * 認証区分がない際には、'/'へリダイレクト。
     *
     * @param \Illuminate\Http\Request $request
     * @param null|mixed $guard
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $url = ($guard) ? route($guard . '.index') : '/';

            return redirect($url);
        }

        return $next($request);
    }
}
