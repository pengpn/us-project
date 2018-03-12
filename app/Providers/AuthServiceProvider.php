<?php
/**
 * 验证服务提供者
 * @author pnpeng
 * @date 2018-03-12
 **/
namespace App\Providers;

use App\Models\Admin\User\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    protected $except = [
        'admin',
        'admin.error',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->defineHasPermissionForLeftMenu();
        //
    }

    /**
     * 定义是否拥有左侧菜单栏权限
     */
    private function defineHasPermissionForLeftMenu()
    {
        //中止权限检查
        //如果是管理员或超级用户拥有所有权限
        Gate::before(function ($user, $ability){
            if ($user->id === 1 || in_array($ability, $this->except)) {
                return true;
            }
        });

        $permissions = Permission::with('roles')->get();
        foreach ($permissions as $permission) {
            Gate::define($permission->name, function ($user) use ($permission){
                return $user->hasPermission($permission);
            });
        }
    }
}
