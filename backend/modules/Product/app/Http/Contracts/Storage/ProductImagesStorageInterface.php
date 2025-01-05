<?php

namespace Modules\Product\Http\Contracts\Storage;

use Illuminate\Http\UploadedFile;
use Modules\Product\Models\Product;

interface ProductImagesStorageInterface
{
    public function upload(UploadedFile $file, int $productId): string;

    /**@var array<int, UploadedFile> $files */
    public function uploadMany(array $files, int $productId): array;

    public function getOne(Product $product, string $imageId): string;

    public function getAll(Product $product): array;

    public function delete(string $fileId): bool;

    public function isExists(Product $product, string $imageId): bool;
}