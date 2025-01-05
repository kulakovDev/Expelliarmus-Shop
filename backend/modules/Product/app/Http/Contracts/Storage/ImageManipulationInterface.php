<?php

namespace Modules\Product\Http\Contracts\Storage;

use Modules\Product\Models\Product;
use Modules\Product\Storages\ProductImages\Size;

interface ImageManipulationInterface
{
    public function saveResized(Product $product, string $imageId, Size $size): void;

    public function getResized(Product $product, string $imageId, Size $size): string;
}