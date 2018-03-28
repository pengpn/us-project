<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Admin\User\AdminUser;
use App\Models\Admin\User\Department;
use App\Models\Admin\User\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AdminUserController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $users = AdminUser::when(request('id'), function ($query){
            $query->where('id', request('id'));
        })->when(request('username'), function ($query) {
            $query->where('username','like','%'.request('username').'%');
        })->when(request('email'), function($query){
            $query->where('email','like','%'.request('email').'%');
        })->when(request('name'), function($query){
            $query->where('name','like','%'.request('name').'%');
        })->with('roles')->latest()->paginate(request('per_page'));
        return view('admin.user.user-index',compact('users'));
    }

    public function create()
    {
        $role_options = Role::getSelectOptions();
        $department_options = Department::getSelectOptions();
        return view('admin.user.user-edit',compact('role_options','department_options'));
    }

    public function edit($id)
    {
        $user = AdminUser::find($id);
        $role_options = Role::getSelectOptions();
        $role_selected = Role::getRoleSelected($id);
        $department_options = Department::getSelectOptions();
        return view('admin.user.user-edit', compact('user', 'role_options', 'role_selected', 'department_options'));

    }

    public function store(Request $request)
    {
        //对密码进行加密
        $hash_password = Hash::make(request('password'));
        $request->merge(['password' => $hash_password]);
        $admin_user = AdminUser::create(request()->all());
        $admin_user->roles()->sync(request('role_ids'));
        $admin_user->uploadFile();
        return redirect(request('previous_url'));
    }

    public function update($id,Request $request)
    {
        $admin_user = AdminUser::find($id);
        //对密码进行加密
        $hash_password = Hash::make(request('password'));
        $request->merge(['password' => $hash_password]);
        $admin_user->update(request()->all());
        $admin_user->roles()->sync(request('role_ids'));
        $admin_user->uploadFile();
        return redirect(request('previous_url'));
    }

    public function destroy($ids)
    {
        AdminUser::destroy(explode(',', $ids));
        return redirect()->back();
    }
}
