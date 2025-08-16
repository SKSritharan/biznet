<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'type',
        'options',
        'unit',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'options' => 'array',
        'is_active' => 'boolean',
    ];

    public function pricingPlans(): BelongsToMany
    {
        return $this->belongsToMany(PricingPlan::class)
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

    /**
     * Get formatted display value for a specific plan
     */
    public function getDisplayValueForPlan($planId, $value = null): string
    {
        $pivotData = $this->pricingPlans()->where('pricing_plan_id', $planId)->first()?->pivot;

        if ($pivotData && $pivotData->display_value) {
            return $pivotData->display_value;
        }

        $actualValue = $value ?? $pivotData?->value;

        return match ($this->type) {
            'boolean' => $actualValue === 'true' || $actualValue === '1' ? '✓' : '✗',
            'numeric' => $actualValue === '-1' ? 'Unlimited' : ($actualValue . ($this->unit ? ' ' . $this->unit : '')),
            'select' => $actualValue,
            default => $actualValue ?? '',
        };
    }
}
