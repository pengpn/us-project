<?php
/**
 * 后台权限检查
 * @autho pnpeng
 * @date 2018-03-29
 **/
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class PermissionAdmin
{
    protected $except = [
        'admin'
    ];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 组装权限别名，使其和路由别名一致
        if (isset($request->route()->getAction()['as'])) {
            $route_action = explode('.', $request->route()->getAction()['as']);
            if (array_last($route_action) == 'index') {
                $permits = array_first($route_action);
            } elseif (array_last($route_action) == 'store') {
                $permits = array_first($route_action).'create';
            } elseif (array_last($route_action) =='update') {
                $permits = array_first($route_action).'.edit';
            } else{
                $permits = $request->route()->getAction()['as'];
            }
        } else {
            $permits = str_replace('/','.',str_after($request->getPathInfo(),'/'));
        }
        //检查是否拥有权限(admin帐号拥有全部权限)
        if (Gate::allows($permits) || in_array($permits,$this->except)) {
            return $next($request);
        }

        //Ajax的get请求,忽略权限控制
        if(request()->method() == 'GET' && request()->ajax() && !request()->pjax()) {
            return $next($request);
        }

        // 返回权限提示
        $err_msg = '您没有该操作权限！【'.$permits.'】';
        if($request->ajax()){
            throw new AccessDeniedHttpException($err_msg);
        }else{
            return redirect('admin')->with([
                'alert_type' => 'error',
                'message' => $err_msg
            ]);
        }
    }
}
