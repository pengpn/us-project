<?php
/**
 * 后台登录状态验证（已登录时处理）
 * @author pnpeng
 * @date 2018-03-08
 **/
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        if (Auth::guard($guard)->check()) {
            // 根据不同 guard 跳转到不同的页面
            $url = $guard ? '/admin' : '/';
            return redirect($url);
        }

        return $next($request);
    }
}
