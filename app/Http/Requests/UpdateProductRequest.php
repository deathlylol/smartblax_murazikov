<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'name' => ['sometimes', 'required', 'string', 'min:2'],
            'price' => ['sometimes', 'required', 'numeric', 'min:0'],
            'barcode' => [
                'sometimes',
                'required',
                'string',
                'regex:/^\d{13}$/',
                Rule::unique('products', 'barcode')->ignore($this->route('id'))
            ],
            'category_id' => ['sometimes', 'nullable', 'exists:categories,id']
        ];
    }
}
