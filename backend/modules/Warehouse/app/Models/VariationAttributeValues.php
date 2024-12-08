<?php

namespace Modules\Warehouse\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
