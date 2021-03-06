<?php
/**
 * 后台用户模型
 * @author pnpeng
 * @date 2018-03-09
 **/
namespace App\Models\Admin\User;

use App\Traits\FormTrait;
use App\Traits\UploadTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


/**
 * App\Models\Admin\User\AdminUser
 *
 * @property-read \App\Models\Admin\User\Department $department
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin\User\Role[] $roles
 * @mixin \Eloquent
 */
class AdminUser extends Authenticatable
{
    use Notifiable,FormTrait,UploadTrait;

    protected $fillable = ['username', 'password', 'name', 'email', 'avatar','department_id'];
    protected $hidden = ['password', 'remember_token'];

    public function department()
    {
        return $this->belongsTo(Department::class,'department_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class,'admin_role_user','user_id','role_id');
    }

    public function superiors()
    {
        return $this->belongsToMany(AdminUser::class,'admin_superior_user','user_id','superior_user_id');
    }

    public function hasPermission($permission)
    {
        if (is_string($permission)) {
            $permission = Permission::where('name', $permission)->first();
            if (!$permission) return false;
        }
        return $this->hasRole($permission->roles);
    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }
        // intersect 移除任何指定 数组 或集合内所没有的数值。最终集合保存着原集合的键：
        return !!$role->intersect($this->roles)->count();
    }

    /**
     * 获取用户上级用户复选框已选择的值
     * @param $id
     * @return mixed
     */
    public static function getSuperiorSelected($id)
    {
        return AdminUser::find($id)->superiors->pluck('id');
    }
}
