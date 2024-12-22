<?php

namespace Modules\Product\Http\Requests;

use AllowDynamicProperties;
use App\Services\Validators\JsonApiRelationsValidation;
use Illuminate\Validation\Rule;
use Modules\Warehouse\Enums\ProductAttributeTypeEnum;

#[AllowDynamicProperties] class ProductCreateRequest extends JsonApiRelationsValidation
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
            'price' => [
                'nullable',
                'required_if:data.attributes.is_combined_attributes,null',
                'regex:/^\d{1,6}(\.\d{1,2})?$/',
                'max:10000000',
                'min:1'
            ],
            'total_quantity' => ['required', 'integer'],
            'product_article' => ['required', 'string', Rule::unique('warehouses', 'product_article')],
            'is_combined_attributes' => ['present', 'nullable', 'boolean']
        ];
    }

    public function jsonApiRelationshipsRules(): array
    {
        return [
            'product_variations_combinations' => [
                'nullable',
                'present_if:data.attributes.is_combined_attributes,true',
                'exclude_if:data.attributes.is_combined_attributes,false',
                'exclude_if:data.attributes.is_combined_attributes,null',
                'array'
            ],
            'product_variations_combinations.*' => [
                'sku' => [
                    'required',
                    'string',
                    'distinct',
                    Rule::unique('product_variations', 'sku')
                ],
                'price' => [
                    'required_if:data.attributes.price,null',
                    'regex:/^\d{1,6}(\.\d{1,2})?$/',
                    'max:10000000',
                    'min:1'
                ],
                'quantity' => [
                    'required',
                    'integer'
                ],
                'attributes' => [
                    'required',
                    'array'
                ],
                'attributes.*.id' => [
                    'integer',
                    Rule::exists('product_attributes', 'id')
                ],
                'attributes.*.value' => [
                    'required',
                    'string'
                ],
                'attributes.*.name' => [
                    'required_without:data.relationships.product_variations_combinations.data.*.attributes.*.id',
                    'string'
                ],
                'attributes.*.type' => [
                    'required_with:data.relationships.product_variations_combinations.data.*.attributes.*.name',
                    Rule::enum(ProductAttributeTypeEnum::class)
                ],
            ],

            'product_variation' => [
                'nullable',
                'present_if:data.attributes.is_combined_attributes,false',
                'exclude_if:data.attributes.is_combined_attributes,true',
                'exclude_if:data.attributes.is_combined_attributes,null',
                'array'
            ],
            'product_variation.*' => [
                'attribute_id' => [
                    'nullable',
                    'integer',
                    Rule::exists('product_attributes', 'id')
                ],
                'attribute_name' => [
                    'required_without:product_variation.*.attribute_id',
                    'string'
                ],
                'attribute_type' => [
                    'required_with:data.relationships.product_variation.*.attribute_name',
                    Rule::enum(ProductAttributeTypeEnum::class)
                ],
                'attributes' => [
                    'required',
                    'array'
                ],
                'attributes.*.quantity' => [
                    'required',
                    'integer'
                ],
                'attributes.*.value' => [
                    'required',
                    'string'
                ],
                'attributes.*.price' => [
                    'required_if:data.attributes.price,null',
                    'regex:/^\d{1,6}(\.\d{1,2})?$/',
                    'max:10000000',
                    'min:1'
                ],
            ],

            'brands' => [
                'id' => ['string', Rule::exists('brands', 'id')]
            ],
            'product_specs' => ['required', 'array'],
            'product_specs.*' => [
                'id' => ['required', 'integer', Rule::exists('product_specs_attributes', 'id')],
                'value' => ['required', 'array']
            ]
        ];
    }

    public function jsonApiRelationshipsCustomAttributes(): array
    {
        return [
            'product_variations_combinations.*' => [
                'price_in_cents' => 'price',
                'sku' => 'SKU',
                'quantity' => 'quantity',
                'attributes.*.id' => 'product attribute',
                'attributes.*.value' => 'product attribute value',
                'attributes.*.price' => 'product price for attribute',
                'attributes.*.name' => 'attribute name',
                'attributes.*.type' => 'attribute type'
            ],
            'brands' => [
                'slug' => 'brand name'
            ],
            'product_specs.*' => [
                'id' => 'id',
                'value' => 'value'
            ],
            'product_variation.*' => [
                'attribute_id' => 'attribute id',
                'attribute_name' => 'attribute name',
                'attribute_type' => 'attribute type',
                'attributes.*.quantity' => 'products quantity for attribute',
                'attributes.*.value' => 'product attribute value',
                'attributes.*.price' => 'product price for attribute'
            ]
        ];
    }

    public function jsonApiRelationshipsCustomErrorsMessages(): array
    {
        return [
            'product_variations_combinations.*' => [
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
            'price' => 'default price',
            'title' => 'title',
            'product_article' => 'product article'
        ];
    }
}
