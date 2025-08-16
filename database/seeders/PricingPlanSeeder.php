<?php

namespace Database\Seeders;

use App\Models\PricingPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PricingPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Free Plan
        PricingPlan::create([
            'name' => 'Free',
            'slug' => 'free',
            'description' => 'Get started with our basic features',
            'price' => 0.00,
            'billing_period' => 'monthly',
            'sort_order' => 0,
            'is_active' => true,
            'is_featured' => false,
        ]);

        // Create Basic Plan
        PricingPlan::create([
            'name' => 'Basic',
            'slug' => 'basic',
            'description' => 'Perfect for small businesses getting started',
            'price' => 29.99,
            'billing_period' => 'monthly',
            'sort_order' => 1,
            'is_active' => true,
            'is_featured' => false,
        ]);

        // Create Pro Plan
        PricingPlan::create([
            'name' => 'Pro',
            'slug' => 'pro',
            'description' => 'Most popular choice for growing businesses',
            'price' => 59.99,
            'billing_period' => 'monthly',
            'sort_order' => 2,
            'is_active' => true,
            'is_featured' => true,
        ]);

        // Create Enterprise Plan
        PricingPlan::create([
            'name' => 'Enterprise',
            'slug' => 'enterprise',
            'description' => 'Advanced features for large organizations',
            'price' => 199.99,
            'billing_period' => 'monthly',
            'sort_order' => 3,
            'is_active' => true,
            'is_featured' => false,
        ]);
    }
}
