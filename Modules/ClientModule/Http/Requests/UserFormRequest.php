<?php

namespace Modules\ClientModule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Hash;

class UserFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'     =>'max:255',
            'email'    =>'max:255',
            'telephone'=>'max:255',
            'password' =>Hash::make(request()->password),
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
