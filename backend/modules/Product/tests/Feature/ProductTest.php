<?php

namespace Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Modules\Product\Database\Seeders\ProductDatabaseSeeder;
use Modules\Product\Http\Actions\Product\Create\AddCombinedProductAttributesAction;
use Modules\Product\Http\Actions\Product\Create\CreateProductAction;
use Modules\Product\Http\Actions\Product\Create\CreateProductInWarehouse;
use Modules\Product\Http\DTO\AttributesForCombinedValueDto;
use Modules\Product\Http\DTO\CreateProductDto;
use Modules\Product\Http\DTO\ProductAttributeCombinedVariationsDto;
use Modules\Product\Http\DTO\ProductSpecsDto;
use Modules\Product\Models\Product;
use Modules\Warehouse\Database\Seeders\WarehouseDatabaseSeeder;
use Modules\Warehouse\DTO\CreateWarehouseDto;
use Modules\Warehouse\Models\ProductVariation;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed([ProductDatabaseSeeder::class, WarehouseDatabaseSeeder::class]);
    }

    public function test_product_successfully_created(): void
    {
        $productDto = CreateProductDto::from([
            'title' => 'Title 1',
            'titleDesc' => 'bla bla',
            'mainDesc' => 'bla bla',
            'categoryId' => 1,
            'brandId' => 1,
            'productSpecs' => collect(ProductSpecsDto::collect([
                [
                    'id' => 1,
                    'value' => ['value']
                ]
            ]))
        ]);

        $variations = collect(ProductAttributeCombinedVariationsDto::collect([
            [
                'skuName' => 'SKU-a-a',
                'quantity' => 100,
                'attributes' => collect(AttributesForCombinedValueDto::collect([
                    [
                        'id' => 1,
                        'value' => 'test'
                    ]
                ]))
            ]
        ]));

        $warehouse = CreateWarehouseDto::from([
            'productArticle' => 'ABS123',
            'totalQuantity' => 1000,
            'price' => 90.1
        ]);

        (new CreateProductAction(
            new AddCombinedProductAttributesAction(),
            new CreateProductInWarehouse()
        ))->handle($productDto, $variations, $warehouse);

        $product = Product::query()->where('slug', 'title-1')->first();
        $variation = ProductVariation::query()->where('product_id', $product->id)->first();

        $this->assertDatabaseHas('products', ['slug' => 'title-1']);

        $this->assertDatabaseHas('warehouses', ['product_id' => $product->id]);

        $this->assertDatabaseHas('product_variations', ['product_id' => $product->id]);


        $this->assertDatabaseHas('variation_attribute_values', ['variation_id' => $variation->id, 'value' => 'test']);
    }
}
