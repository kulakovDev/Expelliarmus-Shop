<?php

declare(strict_types=1);

namespace Modules\Product\Http\Actions\Product\Create;

use Illuminate\Support\Collection;
use Modules\Product\Http\DTO\ProductAttributeSingleVariationDto;

class AddAttributesToProduct
{
    public function handle(Collection $attributes, int $productId)
    {
        if ($attributes->isEmpty()) {
            return;
        }

        if ($attributes instanceof ProductAttributeSingleVariationDto) {
            (new AddSingleProductAttributeAction())->handle($productId, $attributes);
        }

        (new AddCombinedProductAttributesAction())->handle($productId, $attributes);
    }
}