<?php

namespace Modules\Warehouse\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $variation_id
 * @property int $attribute_id
 * @property string $value
 */
class VariationAttributeValues extends Model
{
    use HasFactory;

    protected $table = 'variation_attribute_values';

    public $timestamps = false;

    protected $fillable = [
        'variation_id',
        'attribute_id',
        'value'
    ];
}
