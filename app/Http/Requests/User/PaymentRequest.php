<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PaymentRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'order'=>'required|array' ,
            'order.*.product_id'=>'required|exists:products,id',
            'order.*.quantity' =>'required|numeric|gt:0',
            'total_price' =>'required|numeric' ,
            // 'stripe_token' => 'required' 
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(failure($validator->errors(),422));
    }
}
