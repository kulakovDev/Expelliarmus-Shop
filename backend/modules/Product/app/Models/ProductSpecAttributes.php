<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $spec_name
 * @property string $group
 */
class ProductSpecAttributes extends Model
{
    use HasFactory;

    protected $table = 'product_specs_attributes';

    public $timestamps = false;

    protected $fillable = [
        'spec_name',
        'group_name'
    ];

    public function productSpec(): HasMany
    {
        return $this->hasMany(ProductSpec::class);
    }

    public function specName(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => ucfirst($value),
            set: fn(string $value) => strtolower($value)
        );
    }

    public function groupName(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => ucfirst($value),
            set: fn(string $value) => strtolower($value)
        );
    }
}
