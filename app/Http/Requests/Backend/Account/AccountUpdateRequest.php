<?php

namespace App\Http\Requests\Backend\Account;

use Illuminate\Foundation\Http\FormRequest;

class AccountUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|unique:accounts,name,'.$this->id,
            'app_url'=>'required',
            'app_token'=>'required',
            'app_id'=>'required'
        ];
    }
}
