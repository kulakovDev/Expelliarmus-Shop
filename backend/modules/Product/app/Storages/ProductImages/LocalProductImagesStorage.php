<?php

declare(strict_types=1);

namespace Modules\Product\Storages\ProductImages;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Modules\Product\Http\Contracts\Storage\LocalProductImagesStorageInterface;
use Modules\Product\Http\Exceptions\FailedToUploadImagesException;
use Modules\Product\Models\Product;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Throwable;

class LocalProductImagesStorage extends BaseProductImagesStorage implements LocalProductImagesStorageInterface
{
    public function upload(UploadedFile $file, int $productId): string
    {
        try {
            $path = "product-id-$productId-images";

            Storage::disk($this->disk())->makeDirectory($path);

            return Storage::disk($this->disk())->putFile($path, $file);
        } catch (Throwable $e) {
            throw new FileException($e->getMessage());
        }
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

    protected function getImageFullPath(Product $product, string $resizedImageId): string
    {
        return "product-id-$product->id-images/$resizedImageId";
    }

    protected function disk(): string
    {
        return 'public_products_images';
    }

    protected function getInterventionImage(Product $product, string $imageId): Image
    {
        try {
            if ($imageId === $this->defaultImageId()) {
                $imageContent = ImageManager::imagick()->read(storage_path("app/public/".$this->defaultImageId()));
            } else {
                $imageContent = ImageManager::imagick()->read(
                    storage_path("app/public/products/product-id-$product->id-images/$imageId")
                );
            }
        } catch (Throwable $e) {
            throw new FailedToUploadImagesException($e->getMessage(), $e);
        }

        return $imageContent;
    }
}