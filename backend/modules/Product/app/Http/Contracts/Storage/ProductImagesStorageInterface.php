<?php

namespace Modules\Product\Http\Contracts\Storage;

use Illuminate\Http\UploadedFile;
use Modules\Product\Models\Product;
use Modules\Product\Storages\ProductImages\Size;

interface ProductImagesStorageInterface
{
    public function upload(UploadedFile $file, int $productId): string;

    /**@var array<int, UploadedFile> $files */
    public function uploadMany(array $files, Product $product, Size $size): array;

    public function getOne(Product $product, string $imageId): string;

    public function getAll(Product $product): array;

    public function delete(string $fileId): bool;

    public function isExists(Product $product, string $imageId): bool;
}