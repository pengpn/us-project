<?php
/**
 * 部门模型
 * @author pnpeng
 * @date 2018/03/09
 **/
namespace App\Models\Admin\User;

use App\Models\Admin\BaseModel;
use App\Traits\FormTrait;

/**
 * App\Models\Admin\User\Department
 *
 * @mixin \Eloquent
 */
class Department extends BaseModel
{
    use FormTrait;

    protected $table = 'departments';

    protected $fillable = ['id', 'department_name','department_address'];

    public function users()
    {
        return $this->hasMany(AdminUser::class,'department_id');
    }

    /**
     * 获取当前部门下的用户
     * @param $id
     * @return mixed
     */
    public static function getDepartmentUsers($id)
    {
        return Department::find($id)->users()->select('id')->get();
    }

    /**
     * 同步用户部门
     * @param $id
     */
    public static function syncUserDepartment($id)
    {
        $current_user_ids = AdminUser::where(['department_id' => $id])->pluck('id');
        $new_ids = collect(request('department_user_ids'))->diff($current_user_ids)->all();
        $reset_ids = $current_user_ids->diff(request('department_user_ids'))->all();
        if ($new_ids) {
            AdminUser::whereIn('id', $new_ids)->update(['department_id' => $id]);
        }
        if ($reset_ids) {
            AdminUser::whereIn('id', $reset_ids)->update(['department_id' => null]);
        }
    }
}
