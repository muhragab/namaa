<?php

namespace App\Http\Requests;

use App\Custom\CustomValidate;
use App\Models\User;

class CreateSubscriberRequest extends CustomValidate
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
        return User::$rules;
    }
}
