<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Warehouse\Models\Warehouse;

class ProductAttributesCombo extends Model
{
    use HasFactory;

    protected $table = 'product_attributes_combo';

    public $timestamps = false;

    protected $fillable = [
        'attribute_1_id',
        'attribute_2_id',
        'attribute_3_id',
        'warehouse_id',
        'quantity',
        'price_in_cents'
    ];

    public function attribute1(): BelongsTo
    {
        return $this->belongsTo(ProductAttribute::class, 'attribute_1_id');
    }

    public function attribute2(): BelongsTo
    {
        return $this->belongsTo(ProductAttribute::class, 'attribute_2_id');
    }

    public function attribute3(): BelongsTo
    {
        return $this->belongsTo(ProductAttribute::class, 'attribute_3_id');
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }
}
