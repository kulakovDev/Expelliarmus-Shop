<?php

namespace Modules\Product\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Order\Models\OrderLine;
use Modules\Product\Traits\Slugger;
use Modules\Warehouse\Models\ProductAttributeValue;
use Modules\Warehouse\Models\ProductVariation;
use Modules\Warehouse\Models\Warehouse;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $category_id
 * @property int $brand_id
 * @property string $title_description
 * @property string $main_description_markdown
 * @property string $main_description_html
 * @property array $images
 * @property Carbon $created_at
 */
class Product extends Model
{
    use HasFactory;
    use Slugger;

    protected $fillable = [
        'title',
        'category_id',
        'brand_id',
        'title_description',
        'main_description_markdown',
        'main_description_html',
        'images',
    ];

    public function orderLines(): HasMany
    {
        return $this->hasMany(OrderLine::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function productSpecs(): HasMany
    {
        return $this->hasMany(ProductSpec::class);
    }

    public function singleAttributes(): HasMany
    {
        return $this->hasMany(ProductAttributeValue::class);
    }

    public function combinedAttributes(): HasMany
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function getDescriptionMarkdown(): string
    {
        return $this->main_description_markdown;
    }

    public function getDescriptionHtml(): string
    {
        return $this->main_description_html;
    }

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'images' => 'array'
        ];
    }

    protected function slugColumn(): string
    {
        return 'slug';
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Product $product) {
            if ($product->created_at === null) {
                $product->created_at = Carbon::now();
            }

            $product->slug = $product->createSlug($product->title);
        });

        static::saving(function (Product $product) {
            $product->fill([
                'main_description_html' => str($product->main_description_markdown)->markdown([
                    'html_input' => 'strip',
                    'allow_unsafe_links' => false,
                    'max_nesting_level' => 5
                ])
            ]);
        });
    }
}
