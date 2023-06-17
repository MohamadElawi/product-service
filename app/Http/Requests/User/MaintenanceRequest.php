<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\Validator;
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
                'description'=>'required|string',
                 'location'=>'required|string',
                 'street'=>'required|string',
                 'area'=>'required|string'
             ];
    }
    public function failedValidation(Validator $validator){
        throw new HttpResponseException(failure($validator->errors(),422));
    }
}
