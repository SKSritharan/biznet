<?php

namespace App\Services;

use App\Models\PricingPlan;
use Stripe\Stripe;
use Stripe\Product;
use Stripe\Price;
use Exception;

class StripeService
{
    public function __construct()
    {
        Stripe::setApiKey(config('cashier.secret'));
    }

    /**
     * Create a Stripe product and price for a pricing plan
     */
    public function createPlanInStripe(PricingPlan $plan): array
    {
        try {
            // Create Product in Stripe
            $product = Product::create([
                'name' => $plan->name,
                'description' => $plan->description,
                'metadata' => [
                    'plan_id' => $plan->id,
                    'slug' => $plan->slug,
                ],
            ]);

            // Create Price in Stripe
            $priceData = [
                'unit_amount' => (int) ($plan->price * 100), // Convert to cents
                'currency' => 'usd',
                'product' => $product->id,
                'metadata' => [
                    'plan_id' => $plan->id,
                ],
            ];

            // Set recurring if not one-time
            if ($plan->billing_period !== 'one-time') {
                $priceData['recurring'] = [
                    'interval' => $plan->billing_period === 'yearly' ? 'year' : 'month',
                ];
            }

            $price = Price::create($priceData);

            // Update the plan with Stripe IDs
            $plan->update([
                'stripe_product_id' => $product->id,
                'stripe_price_id' => $price->id,
            ]);

            return [
                'success' => true,
                'product' => $product,
                'price' => $price,
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Update a Stripe product and price for a pricing plan
     */
    public function updatePlanInStripe(PricingPlan $plan): array
    {
        try {
            $result = ['success' => true];

            // Update Product if it exists
            if ($plan->stripe_product_id) {
                Product::update($plan->stripe_product_id, [
                    'name' => $plan->name,
                    'description' => $plan->description,
                    'metadata' => [
                        'plan_id' => $plan->id,
                        'slug' => $plan->slug,
                    ],
                ]);
                $result['product_updated'] = true;
            }

            // For price changes, we need to create a new price (Stripe doesn't allow price updates)
            if ($plan->stripe_price_id && $plan->isDirty('price')) {
                // Archive the old price
                Price::update($plan->stripe_price_id, ['active' => false]);

                // Create new price
                $priceData = [
                    'unit_amount' => (int) ($plan->price * 100),
                    'currency' => 'usd',
                    'product' => $plan->stripe_product_id,
                    'metadata' => [
                        'plan_id' => $plan->id,
                    ],
                ];

                if ($plan->billing_period !== 'one-time') {
                    $priceData['recurring'] = [
                        'interval' => $plan->billing_period === 'yearly' ? 'year' : 'month',
                    ];
                }

                $newPrice = Price::create($priceData);

                $plan->update(['stripe_price_id' => $newPrice->id]);
                $result['new_price_created'] = true;
            }

            return $result;
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Archive a plan in Stripe (doesn't delete, just deactivates)
     */
    public function archivePlanInStripe(PricingPlan $plan): array
    {
        try {
            // Archive the product
            if ($plan->stripe_product_id) {
                Product::update($plan->stripe_product_id, ['active' => false]);
            }

            // Archive the price
            if ($plan->stripe_price_id) {
                Price::update($plan->stripe_price_id, ['active' => false]);
            }

            return ['success' => true];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Sync all active plans to Stripe
     */
    public function syncAllPlansToStripe(): array
    {
        $results = [];
        $plans = PricingPlan::where('is_active', true)->get();

        foreach ($plans as $plan) {
            if (!$plan->stripe_product_id || !$plan->stripe_price_id) {
                $results[$plan->id] = $this->createPlanInStripe($plan);
            } else {
                $results[$plan->id] = $this->updatePlanInStripe($plan);
            }
        }

        return $results;
    }
}
