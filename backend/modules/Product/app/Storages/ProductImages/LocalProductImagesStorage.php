<?php

declare(strict_types=1);

namespace Modules\Product\Storages\ProductImages;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Modules\Product\Http\Contracts\Storage\LocalProductImagesStorageInterface;
use Modules\Product\Http\Exceptions\FailedToCreateProductException;
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

    public function get(string $fileId): string|false
    {
        // TODO: Implement get() method.
    }

    public function delete(string $fileId): bool
    {
        // TODO: Implement delete() method.
    }

    public function isExists(string $fileId): bool
    {
        // TODO: Implement isExists() method.
    }
}