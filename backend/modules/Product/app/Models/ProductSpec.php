<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $product_id
 * @property int $attribute_id
 * @property string $value
 */
class ProductSpec extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'product_id',
        'attribute_id',
        'value'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function attributes(): BelongsTo
    {
        return $this->belongsTo(ProductSpecAttributes::class);
    }

    protected function casts(): array
    {
        return [
            'value' => 'array'
        ];
    }
}
