<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    use AuthenticatesUsers{
        AuthenticatesUsers::login as parentLogin;
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    public function username()
    {
        return 'username';  // 使用username进行登录（laravel默认使用email）
    }

    /**
     * 重写登录视图页面
     * @author pnpeng
     * @date   2018-03-08
     * @return [type]                   [description]
     */
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        return $this->parentLogin($request)->with(['message' => '登录成功']);
    }

    public function logout(Request $request)
    {

        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect('admin');
    }

    /**
     * 自定义认证驱动
     * @author pnpeng
     * @date   2018-03-08
     * @return [type]                   [description]
     */
    protected function guard()
    {
        return auth()->guard('admin');
    }

}
