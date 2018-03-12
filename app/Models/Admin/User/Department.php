<?php
/**
 * 组别模型
 * @author pnpeng
 * @date 2018/03/09
 **/
namespace App\Models\Admin\User;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    protected $fillable = ['id', 'department_name','department_address'];
}
