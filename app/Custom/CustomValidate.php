<?php

namespace App\Custom;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use InfyOm\Generator\Utils\ResponseUtil;
use Response;

class CustomValidate extends FormRequest
{

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->sendError($validator->errors()->first(),422));
    }

    public function sendError($error, $code = 404)
    {
        return Response::json(ResponseUtil::makeError($error), $code);
    }
}
