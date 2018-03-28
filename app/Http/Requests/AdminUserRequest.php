<?php
/**
 * 后台用户表单验证
 * @author PNPENG
 * @date 2018-03-26
 **/
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = request('id') ?? 'null';
        $password = request('id') ? 'nullable' : 'required';

        $rules = [
            'username' => 'required|unique:admin_users,username,'.$id,
            'password' => $password.'|min:6',
            'name' => 'required',
            'email' => 'required|email|unique:admin_users,email,'.$id,
            'avatar' => 'nullable|image|max:2048',
            'role_ids' => 'required|array'
        ];
        return $rules;
    }
}
