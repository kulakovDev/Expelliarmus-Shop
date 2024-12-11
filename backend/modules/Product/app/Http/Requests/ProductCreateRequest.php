<?php

namespace Modules\Product\Http\Requests;

use App\Services\Validators\JsonApiRelationsValidation;
use Illuminate\Validation\Rule;

class ProductCreateRequest extends JsonApiRelationsValidation
{
    public function authorize(): bool
    {
        return true;
    }

    public function jsonApiAttributeRules(): array
    {
        return [
            'title' => ['required', 'string', 'max:150'],
            'title_description' => ['required', 'string', 'max:350'],
            'main_description' => ['required', 'string'],
            'price' => ['required', 'regex:/^\d{1,6}(\.\d{1,2})?$/'],
            'total_quantity' => ['required', 'integer'],
        ];
    }

    public function jsonApiRelationshipsRules(): array
    {
        return [
            'product_variations.*' => [
                'sku' => ['required', 'string', Rule::unique('product_variations', 'sku')],
                'quantity' => ['required', 'integer'],
                'price_in_cents' => ['regex:/^\d{1,6}(\.\d{1,2})?$/'],
                'attributes.*.id' => ['required', 'integer', Rule::exists('product_attributes', 'id')],
                'attributes.*.value' => ['required', 'string']
            ],
            'category' => [
                'id' => ['required', 'integer', Rule::exists('categories', 'id')]
            ],
            'brands' => [
                'id' => ['string', Rule::exists('brands', 'id')]
            ],
            'product_specs.*' => [
                'id' => ['required', 'integer', Rule::exists('product_specs_attributes', 'id')],
                'value' => ['required', 'array']
            ]
        ];
    }

    public function jsonApiRelationshipsCustomAttributes(): array
    {
        return [
            'product_variations.*' => [
                'price_in_cents' => 'price',
                'sku' => 'SKU',
                'quantity' => 'quantity',
                'attributes.*.id' => 'product attribute',
                'attributes.*.value' => 'product attribute value'
            ],
            'brands' => [
                'slug' => 'brand name'
            ],
            'product_specs.*' => [
                'id' => 'id',
                'value' => 'value'
            ]
        ];
    }

    public function jsonApiRelationshipsCustomErrorsMessages(): array
    {
        return [
            'product_variations.*' => [
                'sku.unique' => 'The SKU must be unique.',
            ]
        ];
    }

    public function jsonApiCustomAttributes(): array
    {
        return [
            'title_description' => 'short description',
            'main_description' => 'main description',
            'total_quantity' => 'total quantity',
            'price' => 'price',
            'title' => 'title'
        ];
    }
}
