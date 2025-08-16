<?php

namespace App\Filament\Resources\PricingPlanResource\Widgets;

use App\Models\Feature;
use App\Models\PricingPlan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PricingPlanStats extends BaseWidget
{
    protected function getStats(): array
    {
        // Get pricing plan statistics
        $totalPlans = PricingPlan::count();
        $activePlans = PricingPlan::where('is_active', true)->count();
        $featuredPlans = PricingPlan::where('is_featured', true)->count();

        // Get feature statistics
        $totalFeatures = Feature::count();
        $activeFeatures = Feature::where('is_active', true)->count();

        return [
            Stat::make('Total Active Plans', $totalPlans)
                ->description($activePlans . ' active plans')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Featured Plans', $featuredPlans)
                ->description('Plans marked as featured')
                ->descriptionIcon('heroicon-m-star')
                ->color('warning'),

            Stat::make('Available Features', $totalFeatures)
                ->description($activeFeatures . ' active features')
                ->descriptionIcon('heroicon-m-cog-6-tooth')
                ->color('info'),
        ];
    }
}
