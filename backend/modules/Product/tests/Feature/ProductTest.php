<?php

namespace Modules\Product\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Mockery;
use Modules\Product\Database\Seeders\ProductDatabaseSeeder;
use Modules\Product\Http\Actions\Product\Create\CreateProduct;
use Modules\Product\Http\Actions\Product\Create\CreateProductFactoryAction;
use Modules\Product\Http\Requests\ProductCreateRequest;
use Modules\Product\Http\Service\ProductImagesService;
use Modules\Product\Models\Brand;
use Modules\Product\Models\Category;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductSpecAttributes;
use Modules\Product\Storages\ProductImages\LocalProductImagesStorage;
use Modules\Warehouse\Database\Seeders\WarehouseDatabaseSeeder;
use Modules\Warehouse\Enums\ProductAttributeTypeEnum;
use Modules\Warehouse\Http\Actions\CreateProductInWarehouse;
use Modules\Warehouse\Models\ProductVariation;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed([
            ProductDatabaseSeeder::class,
            WarehouseDatabaseSeeder::class,
        ]);
    }

    public function test_product_created_with_single_attributes(): void
    {
        $request = $this->createRequest('Title 2', false);

        (new CreateProductFactoryAction())->createAction($request)
            ->handle(
                new CreateProduct(),
                new CreateProductInWarehouse()
            );

        $product = Product::query()->where('slug', 'title-2')->first();

        $this->assertDatabaseHas('products', ['slug' => 'title-2']);

        $this->assertDatabaseHas('warehouses', ['product_id' => $product->id]);

        $this->assertDatabaseHas('product_attribute_values', ['product_id' => $product->id]);
    }

    public function test_product_created_with_combined_attributes(): void
    {
        $request = $this->createRequest('Title 1', true);

        (new CreateProductFactoryAction())->createAction($request)
            ->handle(
                new CreateProduct(),
                new CreateProductInWarehouse()
            );

        $product = Product::query()->where('slug', 'title-1')->first();

        $variation = ProductVariation::query()->where('product_id', $product->id)->first();

        $this->assertDatabaseHas('products', ['slug' => 'title-1']);

        $this->assertDatabaseHas('warehouses', ['product_id' => $product->id]);

        $this->assertDatabaseHas('product_variations', ['product_id' => $product->id]);

        $this->assertDatabaseHas('variation_attribute_values', ['variation_id' => $variation->id, 'value' => 'test']);
    }

    public function test_product_created_without_attributes(): void
    {
        $request = $this->createRequest('Title 3', null);

        (new CreateProductFactoryAction())->createAction($request)
            ->handle(
                new CreateProduct(),
                new CreateProductInWarehouse()
            );

        $this->assertDatabaseHas('products', ['slug' => 'title-3']);

        $product = Product::query()->where('slug', 'title-3')->first(['id']);

        $this->assertDatabaseHas('warehouses', ['product_id' => $product->id]);
    }

    public function test_can_upload_product_images_locally(): void
    {
        $product = Product::query()->create([
            'title' => 'Abra cadabra',
            'title_description' => 'example',
            'main_description_markdown' => 'example',
            'category_id' => Category::query()->first(['id'])->id,
            'brand_id' => Brand::query()->first(['id'])->id
        ]);

        Storage::fake('public_products_images');

        $images = [
            UploadedFile::fake()->image('product_image1.png'),
            UploadedFile::fake()->image('product_image2.png'),
        ];

        (new ProductImagesService(new LocalProductImagesStorage()))->upload($images, $product);

        $storedFilesNames = [];

        foreach ($images as $image) {
            $storedFilesNames[] = $image->hashName();

            Storage::disk('public_products_images')
                ->assertExists("product-id-$product->id-images/".$image->hashName());
        }

        $this->assertEquals($storedFilesNames, $product->refresh()->images);
    }


    private function createRequest(string $title, ?bool $isCombinedAttributes)
    {
        $combinedVariations = [
            [
                'sku' => 'ADADAD',
                'quantity' => 20,
                'price' => 50.5,
                'attributes' => [
                    [
                        'name' => 'Color',
                        'type' => ProductAttributeTypeEnum::COLOR->value,
                        'value' => 'test'
                    ]
                ]
            ],
            [
                'sku' => 'ADAD',
                'quantity' => 20,
                'price' => 50.5,
                'attributes' => [
                    [
                        'name' => 'Color',
                        'type' => ProductAttributeTypeEnum::COLOR->value,
                        'value' => 'test'
                    ]
                ]
            ],
        ];

        $singleVariation = [
            [
                'attribute_name' => 'Size',
                'attribute_type' => 0,
                'attributes' => [
                    [
                        'quantity' => 50,
                        'price' => 100,
                        'value' => 'M'
                    ],
                    [
                        'quantity' => 50,
                        'price' => 200,
                        'value' => 'L'
                    ]
                ],
            ]
        ];

        $request = Mockery::mock(ProductCreateRequest::class);

        $request->shouldReceive('relation')
            ->with('product_variations_combinations')
            ->andReturn(collect($combinedVariations));

        $request->shouldReceive('relation')
            ->with('product_variation')
            ->andReturn(collect($singleVariation));

        $request->shouldReceive('relation')
            ->with('category')
            ->andReturn(['id' => Category::query()->first(['id'])->id]);

        $request->shouldReceive('relation')
            ->with('brand')
            ->andReturn(['id' => Brand::query()->first(['id'])->id]);

        $request->shouldReceive('relation')
            ->with('product_specs')
            ->andReturn(
                collect([
                    [
                        'id' => ProductSpecAttributes::query()->create(['spec_name' => 'example'])->id,
                        'value' => ['value']
                    ]
                ])
            );

        $request->is_combined_attributes = $isCombinedAttributes;
        $request->title = $title;
        $request->title_description = 'bla bla';
        $request->main_description = '# bla bla';
        $request->total_quantity = 100;
        $request->price = 200.1;
        $request->product_article = 'ADADAD';

        return $request;
    }
}
