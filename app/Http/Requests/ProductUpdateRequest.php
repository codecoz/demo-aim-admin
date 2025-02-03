<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Adjust based on your authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', Rule::exists('products', 'id')],
            'name' => [
                'sometimes',
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('products', 'name')->ignore($this->id)
            ],
            'description' => [
                'sometimes',
                'nullable',
                'string',
                'min:10',
                'max:1000'
            ],
            'price' => [
                'sometimes',
                'required',
                'numeric',
                'min:0.01',
                'max:999999.99',
                'regex:/^\d+(\.\d{1,2})?$/' // Ensures 2 decimal places max
            ],
            'stock' => [
                'sometimes',
                'required',
                'integer',
                'min:0',
                'max:999999'
            ]
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Product name is required',
            'name.min' => 'Product name must be at least 3 characters',
            'name.unique' => 'This product name already exists',
            'description.min' => 'Description must be at least 10 characters',
            'price.required' => 'Product price is required',
            'price.min' => 'Price must be at least 0.01',
            'price.regex' => 'Price must have maximum 2 decimal places',
            'stock.required' => 'Stock quantity is required',
            'stock.integer' => 'Stock must be a whole number',
            'stock.min' => 'Stock cannot be negative'
        ];
    }
}
