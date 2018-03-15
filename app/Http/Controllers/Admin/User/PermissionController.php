<?php
/**
 * 权限控制器
 * @author pnpeng
 * @date 2018-03-09
 **/
namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Admin\User\Permission;



class PermissionController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $permissions = Permission::orderBy('order_num')->get()->keyBy('id');
        $permission_tree = Permission::generatePermissionTree($permissions->toArray());
        return view('admin.permission-index', compact('permission_tree'));
    }

    public function edit($id)
    {
        if(request()->ajax()){
            $permission = Permission::where('id', $id)->first();
            return response()->json($permission);
        }
        return view('admin.permission-index');

    }

    public function store()
    {
        Permission::create(request()->all());
        return redirect()->back()->with(['message' => '插入成功']);
    }

    public function update($id)
    {
        Permission::find($id)->update(request()->all());
        return redirect()->back()->with(['message' => '更新成功']);
    }

    public function destroy($id)
    {
        Permission::destroy($id);
        return redirect()->back()->with(['message' => '删除成功']);
    }
}
