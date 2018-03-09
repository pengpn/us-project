<?php
/**
 * 主面板控制器
 * @author pnpeng
 * @date 2018-03-09
 **/
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index()
    {
        return view('admin.dashboard');
    }
}
