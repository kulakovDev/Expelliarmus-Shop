<?php

declare(strict_types=1);

namespace Modules\Product\Http\Service;

use Illuminate\Http\UploadedFile;
use Modules\Product\Http\Contracts\Storage\ProductImagesStorageInterface;
use Modules\Product\Models\Product;
use Modules\Product\Storages\ProductImages\Size;

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
        $images = $this->imagesStorage->uploadMany($files, $product, new Size(300, 300));

        $product->images = $images;

        $product->save();
    }

    public function getResizedImage(Product $product, Size $size): string
    {
        return $this->imagesStorage->getResized($product, $product->images[0], $size);
    }
}