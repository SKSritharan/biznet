<?php

namespace App\Console\Commands;

use App\Services\StripeService;
use App\Models\PricingPlan;
use Illuminate\Console\Command;

class SyncPlansToStripe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plans:sync-stripe {--plan-id= : Sync specific plan by ID}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync pricing plans to Stripe';

    /**
     * Execute the console command.
     */
    public function handle(StripeService $stripeService)
    {
        $this->info('Starting to sync pricing plans to Stripe...');

        $planId = $this->option('plan-id');

        if ($planId) {
            // Sync specific plan
            $plan = PricingPlan::find($planId);

            if (!$plan) {
                $this->error("Plan with ID {$planId} not found.");
                return 1;
            }

            $this->info("Syncing plan: {$plan->name}");

            if (!$plan->stripe_product_id || !$plan->stripe_price_id) {
                $result = $stripeService->createPlanInStripe($plan);
            } else {
                $result = $stripeService->updatePlanInStripe($plan);
            }

            if ($result['success']) {
                $this->info("✅ Plan '{$plan->name}' synced successfully!");
                $this->line("Product ID: {$plan->fresh()->stripe_product_id}");
                $this->line("Price ID: {$plan->fresh()->stripe_price_id}");
            } else {
                $this->error("❌ Failed to sync plan '{$plan->name}': {$result['error']}");
                return 1;
            }
        } else {
            // Sync all plans
            $results = $stripeService->syncAllPlansToStripe();

            $successCount = 0;
            $failureCount = 0;

            foreach ($results as $planId => $result) {
                $plan = PricingPlan::find($planId);

                if ($result['success']) {
                    $this->info("✅ Plan '{$plan->name}' synced successfully!");
                    $successCount++;
                } else {
                    $this->error("❌ Failed to sync plan '{$plan->name}': {$result['error']}");
                    $failureCount++;
                }
            }

            $this->line('');
            $this->info("Sync completed: {$successCount} successful, {$failureCount} failed");
        }

        return 0;
    }
}
