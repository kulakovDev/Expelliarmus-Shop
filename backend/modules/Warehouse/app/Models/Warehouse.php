<?php

namespace Modules\Warehouse\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;
use Modules\Product\Models\Product;

/**
 * @property int $id
 * @property int $product_id
 * @property int $total_quantity
 * @property float $price_per_unit_in_cents
 * @property Carbon $arrived_at
 * @property Carbon $published_at
 * @property string $product_article
 */
class Warehouse extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'total_quantity',
        'price_per_unit_in_cents'
    ];

    public function product(): HasOne
    {
        return $this->hasOne(Product::class);
    }

    public function productAttributesCombo(): HasMany
    {
        return $this->hasMany(VariationAttributeValues::class);
    }

    public function pricePerUnit(): float
    {
        return $this->price_per_unit_in_cents;
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Warehouse $warehouse) {
            $warehouse->product_article .= '-'.Str::random(6);
        });
    }
}
