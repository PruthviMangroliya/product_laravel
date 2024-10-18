<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class customer_register_Request extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "customer_firstname"=>"required",
            "customer_lastname"=>"required",
            "customer_email"=>"required|email",
            "customer_telephone"=>"required|numeric|max_digits:10|min_digits:10",
            "customer_password"=>"required||required_with:customer_con_password|same:customer_con_password",
            "customer_con_password"=>"required",
            "customer_address"=>"required",
            "customer_city"=>"required",
            "customer_country"=>"required",
            "customer_state"=>"required",
            "customer_pincode"=>"required|numeric"
        ];
    }
}
