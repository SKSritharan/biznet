<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PricingPlan extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'billing_period',
        'stripe_price_id',
        'stripe_product_id',
        'sort_order',
        'is_active',
        'is_featured',
        'metadata',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'metadata' => 'array',
    ];

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class)
            ->withPivot(['value', 'display_value', 'is_highlighted', 'sort_order'])
            ->withTimestamps()
            ->orderByPivot('sort_order');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function getFormattedPriceAttribute(): string
    {
        if ($this->price == 0) {
            return 'Free';
        }

        return '$' . number_format($this->price, 2);
    }

    public function getBillingDisplayAttribute(): string
    {
        return ucfirst($this->billing_period);
    }
}
