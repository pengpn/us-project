<?php
/**
 * 权限模型
 * @author pnpeng
 * @date 2018-03-09
 **/
namespace App\Models\Admin\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;

class Permission extends Model
{
    protected $table = 'admin_permissions';
    protected $fillable = ['parent_id', 'name', 'display_name', 'icon', 'order_num', 'is_show'];

    public function roles()
    {
        return $this->belongsToMany(Role::class,'admin_permission_role','permission_id','role_id');
    }

    /**
     * 生成左侧菜单栏树（无限分类非递归版）
     * @param array $nodes
     * @return array
     */
    public static function generateLeftMenuTree(array $nodes)
    {
        $tree = [];
        foreach ($nodes as $node) {
            if ($node['is_show'] == 0) continue;
            if (Gate::denies($node['name'])) continue;
            $nodes[$node['id']] = array_merge($nodes[$node['id']], self::getLeftMenuAttribute($node));
            if (isset($nodes[$node['parent_id']])) {
                $nodes[$node['parent_id']]['submenu'][] = &$nodes[$node['id']];
            } else {
                $tree[] = &$nodes[$node['id']];
            }
        }
        return $tree;
    }

    /**
     * 获取左侧菜单栏的属性
     * @param $level
     * @return array
     */
    private static function getLeftMenuAttribute($level)
    {
        return [
            'text' => $level['display_name'],
            'url' => 'admin/'.str_replace('.', '/', $level['name']),
            'icon' => $level['icon'],
        ];
    }

}
