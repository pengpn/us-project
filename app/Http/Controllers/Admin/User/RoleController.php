<?php
/**
 * 角色控制器
 * @author pnpeng
 * @date 2018-03-19
 **/
namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Admin\BaseController;
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
        $role = Role::when(request('id'), function ($query){
            $query->where('id', request('id'));
        })->when(request('name'), function ($query){
            $query->where('name','like','%'.request('name').'%');
        })->latest()->paginate(request('per_page'));

        return view('admin.user.role-index', compact('role'));
    }
    
}
