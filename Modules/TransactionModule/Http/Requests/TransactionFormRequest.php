<?php

namespace Modules\TransactionModule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\TransactionModule\Entities\Payment;

class TransactionFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id'   =>'',
            'client_id' =>'',
            'amount_paid' =>'required | max:255',
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
