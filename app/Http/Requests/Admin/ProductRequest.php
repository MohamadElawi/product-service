<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name_en'=>'required|string',
            'details_en'=>'required|string',
            'description_en'=>'required|string',
            'is_special'=>'in:0,1',
            'quantity'=>'required|numeric',
            'category_id'=>'required|exists:categories,id',
            'price'=>'required|numeric',
            'main_image'=>'required|file|mimes:png,jpg,jpeg|max:4096',
            'images' => 'array|required|max:3',
            'images.*'=>'required|image|mimes:png,jpg,jpeg',
            'quantity_special_product' => 'required_with:_method|lte:quantity|numeric' ,
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(failure($validator->errors(),422));
    }
}
