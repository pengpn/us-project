<?php
/**
 * 部门
 * @author pnpneg
 * @date 2018/03/28
 **/
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
        $rules = [
            'department_name' => 'required',
            'department_address' => 'nullable',
        ];
        return $rules;
    }
}
