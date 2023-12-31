<?php

namespace App\Http\Requests\Admin;

use Dotenv\Validator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class MaintenanceRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'datetime1'=>'required|date',
            'datetime2'=>'required|date',
            'datetime3'=>'required|required',

        ];
    }
    public function failedValidation(ValidationValidator $validator){
        throw new HttpResponseException(failure($validator->errors(),422));
    }

}
