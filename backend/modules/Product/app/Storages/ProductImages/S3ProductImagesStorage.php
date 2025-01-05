<?php

declare(strict_types=1);

namespace Modules\Product\Storages\ProductImages;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Modules\Product\Http\Contracts\Storage\S3ProductImagesStorageInterface;
use Modules\Product\Http\Exceptions\FailedToUploadImagesException;
use Modules\Product\Models\Product;
use Throwable;

class S3ProductImagesStorage extends BaseProductImagesStorage implements S3ProductImagesStorageInterface
{
    public function upload(UploadedFile $file, int $productId): string
    {
        $path = "products/product-id-$productId-images";

        Storage::disk($this->disk())->makeDirectory($path);

        return Storage::disk($this->disk())->putFile($path, $file);
    }

    /**
     * @throws FailedToUploadImagesException
     */
    public function uploadMany(array $files, Product $product, Size $size): array
    {
        try {
            $images = [];

            foreach ($files as $file) {
                $this->upload($file, $product->id);

                $this->saveResized($product, $file->hashName(), $size);

                $images[] = $file->hashName();
            }
        } catch (Throwable $e) {
            throw new FailedToUploadImagesException($e->getMessage(), $e);
            // TODO: delete all images on error
        }

        return $images;
    }

    public function getOne(Product $product, string $imageId): string
    {
        if ($this->isExists($product, $imageId)) {
            return Storage::disk($this->disk())->url($this->getImageFullPath($product, $imageId));
        }

        return Storage::disk($this->disk())->url('products/'.$this->defaultImageId());
    }

    public function getAll(Product $product): array
    {
        if (count($product->images) === 1 && $product->images[0] === $this->defaultImageId()) {
            return [$this->getOne($product, $this->defaultImageId())];
        }

        return collect($product->images)->each(function (string $imageId) use ($product) {
            return $this->getOne($product, $imageId);
        })->toArray();
    }

    public function delete(string $fileId): bool
    {
        // TODO: Implement delete() method.
    }

    protected function getInterventionImage(Product $product, string $imageId): Image
    {
        if ($imageId === $this->defaultImageId()) {
            $imageContent = Storage::disk($this->disk())->get('products/'.$this->defaultImageId());
        } else {
            $imageContent = Storage::disk($this->disk())->get($this->getImageFullPath($product, $imageId));
        }

        return ImageManager::imagick()->read($imageContent);
    }

    protected function getImageFullPath(Product $product, string $resizedImageId): string
    {
        return "products/product-id-$product->id-images/$resizedImageId";
    }

    protected function disk(): string
    {
        return 's3';
    }
}