<?php

declare(strict_types=1);

namespace Modules\Product\Storages\ProductImages;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;
use Modules\Product\Http\Contracts\Storage\ImageManipulationInterface;
use Modules\Product\Http\Contracts\Storage\ProductImagesStorageInterface;
use Modules\Product\Models\Product;

abstract class BaseProductImagesStorage implements ProductImagesStorageInterface, ImageManipulationInterface
{
    public function saveResized(Product $product, string $imageId, int $width, int $height): void
    {
        $resizedImageId = $width."_".$height."_".$imageId;

        $image = $this->getInterventionImage($product, $imageId)->resize($width, $height);

        $encodedImage = (string)$image->encode();

        Storage::disk($this->disk())->makeDirectory("product-id-$product->id-images");

        Storage::disk($this->disk())->put($this->getImageFullPath($product, $resizedImageId), $encodedImage);
    }

    public function getResized(Product $product, string $imageId, int $width, int $height): string
    {
        $resizedImageId = $width."_".$height."_".$imageId;

        if ($this->isExists($product, $resizedImageId)) {
            return Storage::disk($this->disk())->url($this->getImageFullPath($product, $resizedImageId));
        }

        $this->saveResized($product, $imageId, $width, $height);

        return $this->getOne($product, $resizedImageId);
    }

    public function isExists(Product $product, string $imageId): bool
    {
        return Storage::disk($this->disk())->exists($this->getImageFullPath($product, $imageId));
    }

    protected function defaultImageId(): string
    {
        return 'product_preview.png';
    }

    abstract protected function getInterventionImage(Product $product, string $imageId): Image;

    abstract protected function getImageFullPath(Product $product, string $resizedImageId): string;

    abstract protected function disk(): string;
}