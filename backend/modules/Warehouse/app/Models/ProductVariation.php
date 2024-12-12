<?php

namespace Modules\Warehouse\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $product_id
 * @property int $quantity
 * @property float $price_in_cents,
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class ProductVariation extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'price_in_cents',
        'sku'
    ];

    public function variationAttributeValue(): HasMany
    {
        return $this->hasMany(VariationAttributeValues::class, 'variation_id');
    }
}
