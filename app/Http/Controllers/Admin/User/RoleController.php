<?php
/**
 * 角色控制器
 * @author pnpeng
 * @date 2018-03-19
 **/
namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Admin\User\Permission;
use App\Models\Admin\User\Role;
use Illuminate\Http\Request;

class RoleController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $role = Role::when(request('id'), function($query){
            $query->where('id', request('id'));
        })->when(request('name'), function($query){
            $query->where('name', 'like', '%'.request('name').'%');
        })->latest()->paginate(request('per_page'));
        return view('admin.user.role-index', compact('role'));
    }

    public function create()
    {
        return view('admin.user.role-edit');
    }

    public function edit($id)
    {
        $role = Role::find($id);
        return view('admin.user.role-edit', compact('role'));
    }

    public function store()
    {
        Role::create(request()->all());
        return redirect(request('previous_url'))->with(['message' => '插入成功']);
    }

    public function update($id)
    {
        Role::find($id)->update(request()->all());
        return redirect(request('previous_url'))->with(['message' => '更新成功']);
    }

    public function destroy($id)
    {
        Role::destroy($id);
        return redirect()->back()->with(['message' => '删除成功']);
    }

    public function getAcl($id)
    {
        $permissions = Permission::orderBy('order_num')->get()->keyBy('id');
        $permission_tree = Permission::generatePermissionTree($permissions->toArray());
        $own_permissions = Role::getOwnPermissions($id);
        return view('admin.user.role-acl', compact('permission_tree','own_permissions'));

    }

    public function setAcl($id)
    {
        Role::find($id)->permissions()->sync(request('permission_ids'));
        return redirect()->route('role.getacl', $id);
    }

    
}
