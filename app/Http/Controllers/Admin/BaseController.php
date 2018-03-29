<?php
/**
 * 后台公共控制器
 * @author pnpeng
 * @date 2018-03-12
 **/
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\User\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use LogicException;

class BaseController extends Controller
{

    public function __construct()
    {
        if (request()->server('SCRIPT_NAME') == 'artisan') return false;
        $this->initRouteEntity();
        $this->loadPageTitle();
        $this->formValidator();
        $this->setViewShare();
    }

    /**
     * 初始化路由实体信息
     */
    private function initRouteEntity()
    {
        config(['entity' => entity()]);
        //推送主键ID到Request
        $route_entity = str_slug(config('entity'),'_');
        if (request()->route($route_entity)) {
            request()->merge(['id' => request()->route($route_entity)]);
        }
    }

    /**
     * 加载页面标题
     */
    private function loadPageTitle()
    {
        if(request()->method() != 'GET' || (request()->ajax() && !request()->pjax())) return;
        $route_name = request()->route()->getName();
        if(array_last(explode('.', $route_name)) == 'index'){
            $route_name = str_replace('.index', '', $route_name);
        }
        $permission = Permission::where('name', $route_name)->first();
        if(!$permission){
            throw new LogicException('需要添加路由别名【'.$route_name.'】');
        }
        View::share('page_title', $permission->display_name);
    }

    /**
     * 表单验证处理
     */
    private function formValidator()
    {
        if (in_array(request()->method(),['POST','PUT'])) {
            //表单验证
            $validation = Validator::make(request()->all(), rules());
            if ($validation->fails()) {
                throw new LogicException('后端表单验证不通过');
            }
        }
    }

    /**
     * 设置模板共享变量
     */
    private function setViewShare()
    {
        //设置主键ID
        View::share('id', request('id'));
        //设置当前实体名
        View::share('entity', config('entity'));
        //设置当前方法名
        View::share('action_method', request()->route()->getActionMethod());
    }
}
