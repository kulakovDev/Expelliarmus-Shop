<?php

declare(strict_types=1);

namespace Modules\Product\Storages\ProductImages;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Modules\Product\Http\Contracts\Storage\S3ProductImagesStorageInterface;
use Modules\Product\Http\Exceptions\FailedToUploadImagesException;
use RuntimeException;
use Throwable;

class S3ProductImagesStorage implements S3ProductImagesStorageInterface
{

    private string $disk = 's3';

    public function upload(UploadedFile $file, int $productId): string
    {
        $path = "product/product-id-$productId-images";

        Storage::disk($this->disk)->makeDirectory($path);

        $filePath = Storage::disk($this->disk)->putFile($path, $file);

        if ($filePath === false) {
            throw new RuntimeException('Failed to upload the file');
        }

        return $filePath;
    }

    /**
     * @throws FailedToUploadImagesException
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
            throw new FailedToUploadImagesException('Failed to upload images', $e);
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