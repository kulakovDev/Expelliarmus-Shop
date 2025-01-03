<?php

declare(strict_types=1);

namespace Modules\Product\Storages\ProductImages;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Modules\Product\Http\Contracts\Storage\LocalProductImagesStorageInterface;
use Modules\Product\Http\Exceptions\FailedToCreateProductException;
use Modules\Product\Models\Product;
use RuntimeException;
use Throwable;

class LocalProductImagesStorage implements LocalProductImagesStorageInterface
{

    private string $disk = 'public_products_images';

    public function upload(UploadedFile $file, int $productId): string
    {
        $path = "product-id-$productId-images";

        Storage::disk($this->disk)->makeDirectory($path);

        $filePath = Storage::disk($this->disk)->putFile($path, $file);

        if ($filePath === false) {
            throw new RuntimeException('Failed to upload the file');
        }

        return $filePath;
    }

    /**
     * @throws FailedToCreateProductException
     */
    public function uploadMany(array $files, int $productId): array
    {
        try {
            $images = [];

            foreach ($files as $file) {
                $this->upload($file, $productId);

                $images[] = $file->hashName();
            }
        } catch (Throwable $e) {
            throw new FailedToCreateProductException('Failed to upload images', $e);
        }

        return $images;
    }

    public function get(Product $product): string|false
    {
        // TODO: Implement get() method.
    }

    public function saveResized(Product $product, string $imageId, int $width, int $height): void
    {
        $resizedImageId = $width."_".$height."_".$imageId;

        if ($imageId === 'product_preview.png') {
            $image = ImageManager::imagick()->read(
                storage_path("app/public/product_preview.png")
            );

            Storage::disk($this->disk)->makeDirectory("product-id-$product->id-images");
        } else {
            $image = ImageManager::imagick()->read(
                storage_path("app/public/products/product-id-$product->id-images/$imageId")
            );
        }

        $image->resize($width, $height);

        $image->save(
            storage_path("app/public/products/".$this->getImageFullPath($product, $resizedImageId))
        );
    }

    public function getResized(Product $product, string $imageId, int $width, int $height): string
    {
        $resizedImageId = $width."_".$height."_".$imageId;

        if (Storage::disk($this->disk)->exists($this->getImageFullPath($product, $resizedImageId))) {
            return Storage::disk($this->disk)->url($this->getImageFullPath($product, $resizedImageId));
        }

        $this->saveResized($product, $imageId, $width, $height);

        return Storage::disk($this->disk)->url($this->getImageFullPath($product, $resizedImageId));
    }

    public function delete(string $fileId): bool
    {
        // TODO: Implement delete() method.
    }

    public function isExists(string $fileId): bool
    {
        // TODO: Implement isExists() method.
    }

    private function getImageFullPath(Product $product, string $imageId): string
    {
        return "product-id-$product->id-images/$imageId";
    }
}