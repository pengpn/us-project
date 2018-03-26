<?php
/**
 * 部门模型
 * @author pnpeng
 * @date 2018/03/19
 **/
namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Admin\User\AdminUser;
use App\Models\Admin\User\Department;
use Illuminate\Http\Request;


class DepartmentController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $department = Department::when(request('id'), function ($query){
            $query->where('id',request('id'));
        })->when(request('department_name'), function($query){
            $query->where('department_name', 'like', '%'.request('department_name').'%');
        })->with('users')->latest()->paginate(request('per_page'));
        return view('admin.user.department-index',compact('department'));
    }

    public function create()
    {
        $admin_user_options = AdminUser::getSelectOptions();
        return view('admin.user.department-edit',compact('admin_user_options'));
    }

    public function edit($id)
    {
        $department = Department::find($id);
        $admin_user_options = AdminUser::getSelectOptions();
        $department_user_selected = Department::getDepartmentUsers($id);
        return view('admin.user.department-edit', compact('id', 'department', 'admin_user_options', 'department_user_selected'));
    }

    public function update($id)
    {
        Department::find($id)->update(request()->all());
        Department::syncUserDepartment($id);
        return redirect(request('previous_url'));
    }

    public function destroy($ids)
    {
        Department::destroy(explode(',', $ids));
        return redirect()->back();
    }
}
