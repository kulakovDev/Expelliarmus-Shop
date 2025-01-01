<?php

namespace Modules\Product\Http\Contracts\Storage;

use Illuminate\Http\UploadedFile;

interface ProductImagesStorageInterface
{
    public function upload(UploadedFile $file, int $productId): string;

    /**@var array<int, UploadedFile> $files */
    public function uploadMany(array $files, int $productId): array;

    public function get(string $fileId): string|false;

    public function delete(string $fileId): bool;

    public function isExists(string $fileId): bool;
}