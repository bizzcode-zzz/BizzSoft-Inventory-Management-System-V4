<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
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
      
        return [
            'supplier_id'   => 'required|exists:suppliers,id',    
            'product_id'    => 'required|exists:products,id',     
            'quantity'      => 'required|integer|min:1',         
            'cost_price'    => 'required|numeric|min:0',        
            'purchase_date' => 'required|date|before_or_equal:today',  
        ];
    }

    /**
     * Get the custom messages for validator errors.
     */
    public function messages(): array
    {
     
        return [
            'supplier_id.required'   => 'Supplier is required.',
            'product_id.required'    => 'Product is required.',
            'quantity.required'      => 'Quantity is required.',
            'cost_price.required'    => 'Cost Price is required.',
            'purchase_date.required' => 'Purchase Date is required.',
        ];
    }
}
