<?php
/**
 * Created by PhpStorm.
 * User: test
 * Date: 2018/3/8
 * Time: 14:51
 */

//登录
Route::group(['middleware' => ['guest:admin']], function(){
    Route::get('login', 'LoginController@showLogin');
    Route::post('login', 'LoginController@login');
});
//退出登录
Route::post('logout', 'LoginController@logout');

Route::group(['middleware' => ['auth.admin:admin']], function(){
    //后台主面板
    Route::get('/','DashboardController@index');

    Route::group(['namespace' => 'User'], function (){
        //用户管理
        Route::resource('user','AdminUserController');
        //权限管理
        Route::resource('permission','PermissionController');
        //角色管理
        Route::get('role/{id}/getacl','RoleController@getAcl')->name('role.getacl');
        Route::post('role/{id}/setacl','RoleController@setAcl')->name('role.setacl');
        Route::resource('role','RoleController');
        //部门
        Route::resource('department', 'DepartmentController');
    });
});