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
    public function saveResized(Product $product, string $imageId, Size $size): void
    {
        $image = $this->getInterventionImage($product, $imageId)->resize($size->width, $size->height);

        $encodedImage = (string)$image->encode();

        Storage::disk($this->disk())->put(
            $this->getImageFullPath($product, $this->getResizedImageId($imageId, $size->width, $size->height)),
            $encodedImage
        );
    }

    public function getResized(Product $product, string $imageId, Size $size): string
    {
        return $this->getOne($product, $this->getResizedImageId($imageId, $size->width, $size->height));
    }

    public function isExists(Product $product, string $imageId): bool
    {
        return Storage::disk($this->disk())->exists($this->getImageFullPath($product, $imageId));
    }

    protected function defaultImageId(): string
    {
        return 'product_preview.png';
    }

    private function getResizedImageId(string $imageId, int $width, int $height): string
    {
        return $width."_".$height."_".$imageId;
    }

    abstract protected function getInterventionImage(Product $product, string $imageId): Image;

    abstract protected function getImageFullPath(Product $product, string $resizedImageId): string;

    abstract protected function disk(): string;
}