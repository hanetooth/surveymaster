<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class ApiRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            Response::json(
                [
                    'errors' => $validator->errors()
                ],
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            )
        );
    }

// Define your validation rules in the rules() method
}
