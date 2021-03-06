<?php
/**
 * 角色模型
 * @author pnpeng
 * @date 2018-03-09
 **/
namespace App\Models\Admin\User;

use App\Traits\FormTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\User\Role
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin\User\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin\User\AdminUser[] $users
 * @mixin \Eloquent
 */
class Role extends Model
{
    use FormTrait;
    protected $table = 'admin_roles';
    protected $fillable = ['name', 'description'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'admin_permission_role','role_id','permission_id');
    }

    public function users()
    {
        return $this->belongsToMany(AdminUser::class,'admin_role_user','role_id','user_id');
    }

    /**
     * 获取该角色拥有的权限
     * @param $id
     * @return mixed
     */
    public static function getOwnPermissions($id)
    {
        return Role::find($id)->permissions()->get()->map(function ($name){
            return $name->pivot;
        })->pluck('permission_id');
    }

    /**
     * 获取角色复选框中已选择的值
     * @param $id
     * @return mixed
     */
    public static function getRoleSelected($id)
    {
        //找出user id = $id的user的角色
        return Role::whereHas('users', function ($query) use ($id) {
            $query->where('id',$id);
        })->get()->pluck('id');

    }
}
