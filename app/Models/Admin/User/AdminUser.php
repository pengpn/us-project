<?php

namespace App\Models\Admin\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class AdminUser extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['username', 'password', 'name', 'email', 'avatar'];
    protected $hidden = ['password', 'remember_token'];
}
