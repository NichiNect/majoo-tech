<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        // if($this->isMethod('put')) {
        //     $name = '';
        // } else {
        //     $name = 'required|string|unique:products';
        // }

        return [
            'product_name' => 'required|string|unique:products,product_name,' . optional(request())->id,
            'price' => ['required', 'numeric'],
            'description' => ['required'],
            'status' => ['required']
        ];
    }
}
