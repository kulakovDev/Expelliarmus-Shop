<?php

namespace Modules\Product\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Order\Models\OrderLine;
use Modules\Warehouse\Models\Warehouse;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $category_id
 * @property int $brand_id
 * @property string $title_description
 * @property string $main_description
 * @property array $images
 * @property Carbon $created_at
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'brand_id',
        'title_description',
        'main_description',
        'images',
    ];

    public function orderLines(): HasMany
    {
        return $this->hasMany(OrderLine::class);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function productSpecs(): HasMany
    {
        return $this->hasMany(ProductSpec::class);
    }

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime'
        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Product $product) {
            if ($product->created_at === null) {
                $product->created_at = Carbon::now();
            }
            //slug
        });
    }
}
