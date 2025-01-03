<?php

namespace Modules\Product\Http\Contracts\Storage;

use Modules\Product\Models\Product;

interface ImageManipulationInterface
{
    public function saveResized(Product $product, string $imageId, int $width, int $height): void;

    public function getResized(Product $product, string $imageId, int $width, int $height): string;
}