<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        $action_method = request()->route()->getActionMethod();
        if ($action_method == 'setAcl') {
            $rules = [
                'permission_ids' => 'nullable|array',
            ];
        } else {
            $rules = [
                'name' => 'required',
                'description' => 'required'
            ];
        }

        return $rules;
    }
}
