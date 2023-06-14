<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CategoryRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name_en'=>'required|max:50',
            'description_en' => 'required|string' ,
            'image' => 'required_without:_method|image|max:4096|mimes:png,jpg,jpeg,svg'
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json($validator->errors(),422));
    }

    public function messages()
    {
        return [
            'name_en.required'=>'The name field is required.',
            'description_en.required'=>'The description field is required.'
        ];
    }

}
