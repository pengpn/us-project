<?php
/**
 * 权限表单验证
 * @author pnpeng
 * @date 2019-03-12
 **/
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
        $rules = [
            'parent_id' => 'int',
            'name' => 'required|unique:admin_permissions,name,'.$id,
            'display_name' => 'required',
            'icon' => 'nullable|string',
            'order_num' => 'nullable|int',
            'is_show' => 'nullable|int',
        ];
        return $rules;
    }
}
