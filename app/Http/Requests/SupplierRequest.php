<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; // ⚠️ Naka-import para sa unique fields ignore rules mo bro

class SupplierRequest extends FormRequest
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
        // 🏛️ PINALITAN ANG $id PATUNGONG $supplier PARA MAS CONSISTENT SA CATEGORY
        $supplier = $this->route('supplier'); 

        return [
            
            'supplier_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('suppliers', 'supplier_name')->ignore($supplier),
            ],
            'contact_person' => [
                'required',
                'string',
                'max:255'
            ],
            'phone_number'   => [
                'required',
                'string',
                'max:20'
            ],
            'email' => [
                'required',
                'string',
                'email', // 📧 Piliting maging saktong valid email format rules
                'max:255',
                Rule::unique('suppliers', 'email')->ignore($supplier),
            ],
            'address' => [
                'required',
                'string'
            ],
        ];
    }

    /**
     * Get the custom messages for validator errors.
     */
    public function messages(): array
    {
   
        return [
            'supplier_name.required'  => 'Supplier Name is required.',
            'supplier_name.unique'    => 'This Supplier Name already exists.',
            'contact_person.required' => 'Contact Person is required.',
            'phone_number.required'   => 'Phone Number is required.',
            'email.required'          => 'Email Address is required.',
            'email.unique'            => 'This Email Address already exists.',
            'address.required'        => 'Address is required.',
        ];
    }
}
