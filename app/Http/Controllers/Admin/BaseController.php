<?php
/**
 * 后台公共控制器
 * @author pnpeng
 * @date 2018-03-12
 **/
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    private $entity;

    public function __construct()
    {
        if (request()->server('SCRIPT_NAME') == 'artisan') return false;
        $this->initRouteEntity();
        $this->setViewShare();
    }

    private function initRouteEntity()
    {
        $this->entity = array_first(explode('.' , request()->route()->getName()));
        //推送主键ID到Request
        $route_entity = str_replace('-','_', $this->entity);
        if (request()->route($route_entity)) {
            request()->merge(['id' => request()->route($route_entity)]);
        }
    }

    private function setViewShare()
    {
        //设置主键ID
        View::share('id', request('id'));
        //设置当前实体名
        View::share('entity', $this->entity);
        //设置当前方法名
        View::share('action_method', request()->route()->getActionMethod());
    }
}
