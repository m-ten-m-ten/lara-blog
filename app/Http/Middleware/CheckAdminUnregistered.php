<?php

namespace App\Http\Middleware;

use App\Admin;
use Closure;

class CheckAdminUnregistered
{
    /**
     * 管理者が登録済みであれば、管理者ログインページへリダイレクトする。
     */
    public function handle($request, Closure $next)
    {
        if (Admin::whereNotNull('email_verified_at')->count() >= 1) {
            return redirect(route('admin.login'))->with('status', '管理者はすでに登録済みです。');
        }

        return $next($request);
    }
}
