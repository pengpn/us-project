<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Admin\User\AdminUser;


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
        
    }
}
