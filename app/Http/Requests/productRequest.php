<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class productRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_title' => 'required',
            'product_description' => 'required',
            'product_price' => 'required',
            'product_quantity' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required'
        ];
    }
}
