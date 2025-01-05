<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductImageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'images' => ['required', 'array', 'max:4'],
            'images.*' => ['image', 'max:10240']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
