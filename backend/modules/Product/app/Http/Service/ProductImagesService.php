<?php

declare(strict_types=1);

namespace Modules\Product\Http\Service;

use Illuminate\Http\UploadedFile;
use Modules\Product\Http\Contracts\Storage\ProductImagesStorageInterface;
use Modules\Product\Models\Product;

class ProductImagesService
{
    public function __construct(
        private ProductImagesStorageInterface $imagesStorage
    ) {
    }

    /**
     * @param  array<int, UploadedFile>  $files
     */
    public function upload(array $files, Product $product): void
    {
        $images = $this->imagesStorage->uploadMany($files, $product->id);

        $product->images = $images;

        $product->save();
    }
}