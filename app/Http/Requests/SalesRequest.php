<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalesRequest extends FormRequest
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
     */
    public function rules(): array
    {
        // ✨ ISININGIT NATIN ANG MGA RIGOROUS CONSTRAINTS DITO BRO:
        return [
            'product_id'    => 'required|exists:products,id',      // Piliting umiiral ang Product ID sa database
            'quantity'      => 'required|integer|min:1',           // Bawal magbenta ng 0 o negatibong piraso
            'selling_price' => 'required|numeric|min:0',           // Bawal ang negatibong presyo ng benta
            'sales_date'    => 'required|date|before_or_equal:today', // Bawal mag-advance ng petsa sa hinaharap
        ];
    }

    /**
     * Get the custom messages for validator errors.
     */
    public function messages(): array
    {
        
        return [
            'product_id.required'    => 'Product is required.',
            'quantity.required'      => 'Quantity is required.',
            'selling_price.required' => 'Selling Price is required.',
            'sales_date.required'    => 'Sales Date is required.',
        ];
    }
}
