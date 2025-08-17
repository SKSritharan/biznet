<?php

namespace App\Livewire;

use App\Models\PricingPlan;
use Livewire\Component;

class PricingSection extends Component
{
    public $pricingPlans;

    public function mount(): void
    {
        $this->pricingPlans = PricingPlan::with(['features' => function($query) {
                $query->orderByPivot('sort_order');
            }])
            ->active()
            ->ordered()
            ->take(3)
            ->get();
    }

    public function render()
    {
        return view('livewire.pricing-section');
    }
}
