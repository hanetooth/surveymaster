<?php

namespace App\Http\Requests\Api\Form;

use App\Http\Requests\ApiRequest;

class UpateRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        return [
//            'title' => 'required|string',
//            'description' => 'nullable|string',
//            'questions' => 'required|array',
//            'questions.*.text' => 'required|string',
//            'questions.*.hint' => 'nullable|string',
//            'questions.*.is_required' => 'required|boolean',
//            'questions.*.component_id' => 'required|exists:components,id',
        ];
    }
}
