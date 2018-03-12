<?php

namespace App\Providers;

use App\Models\Admin\User\Permission;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $this->listenLeftMenu($events);
    }

    /**
     * 监听左侧菜单栏
     * @param $events
     */
    private function listenLeftMenu($events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $permissions = Permission::orderBy('order_num')->get()->keyBy('id');
            $tree_nodes = Permission::generateLeftMenuTree($permissions->toArray());
            foreach($tree_nodes as $node){
                $event->menu->add($node);
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
