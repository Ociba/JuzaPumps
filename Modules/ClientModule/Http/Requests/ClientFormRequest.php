<?php

namespace Modules\ClientModule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id'               => '',
            'id_number'             => 'max:255',
            'number_plate'          => 'max:255',
            'telephone'             => 'max:255',
            'pin'                   => 'max:255',
            'first_name'            => 'max:20',
            'other_names'           => 'max:10',
            'town_id'               => 'max:400',
            'region_id'             => 'max:255',
            'date_of_birth'         => 'max:255',
            'stage_name'            => 'max:225',
            'stage_leader'          => 'max:225',
            'stage_leader_contact'  => 'max:225',
            'days'                  => 'max:225',
            'amount_paid'           => 'max:225',
            'date_paid'             => 'max:225',
            'leader'                  => 'max:225',
            'profile_photo_path'    => '',
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
