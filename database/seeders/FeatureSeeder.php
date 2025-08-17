<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\PricingPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create features
        $features = [
            [
                'name' => 'User Count',
                'slug' => 'user_count',
                'description' => 'Number of users allowed in the account',
                'type' => 'numeric',
                'unit' => 'users',
                'sort_order' => 1,
            ],
            [
                'name' => 'Database Backup',
                'slug' => 'database_backup',
                'description' => 'Automated database backup functionality',
                'type' => 'boolean',
                'sort_order' => 2,
            ],
            [
                'name' => 'Analytics',
                'slug' => 'analytics',
                'description' => 'Analytics and reporting features',
                'type' => 'select',
                'options' => ['None', 'Basic', 'Advanced'],
                'sort_order' => 3,
            ],
            [
                'name' => 'Custom Domain',
                'slug' => 'custom_domain',
                'description' => 'Ability to use custom domain',
                'type' => 'boolean',
                'sort_order' => 4,
            ],
            [
                'name' => 'Help & Support',
                'slug' => 'help_support',
                'description' => 'Access to help and support resources',
                'type' => 'boolean',
                'sort_order' => 5,
            ],
            [
                'name' => 'Email Support',
                'slug' => 'email_support',
                'description' => 'Email-based customer support',
                'type' => 'boolean',
                'sort_order' => 6,
            ],
        ];

        foreach ($features as $featureData) {
            Feature::create($featureData);
        }

        // Get features and plans
        $userCount = Feature::where('slug', 'user_count')->first();
        $databaseBackup = Feature::where('slug', 'database_backup')->first();
        $analytics = Feature::where('slug', 'analytics')->first();
        $customDomain = Feature::where('slug', 'custom_domain')->first();
        $helpSupport = Feature::where('slug', 'help_support')->first();
        $emailSupport = Feature::where('slug', 'email_support')->first();

        $basicPlan = PricingPlan::where('slug', 'basic')->first();
        $proPlan = PricingPlan::where('slug', 'pro')->first();
        $enterprisePlan = PricingPlan::where('slug', 'enterprise')->first();

        // Attach features to Basic Plan
        if ($basicPlan) {
            $basicPlan->features()->attach([
                $userCount->id => ['value' => '5', 'display_value' => 'Up to 5 users', 'sort_order' => 1, 'is_highlighted' => false],
                $databaseBackup->id => ['value' => 'true', 'display_value' => '✓', 'sort_order' => 2, 'is_highlighted' => true],
                $analytics->id => ['value' => 'Basic', 'display_value' => 'Basic Analytics', 'sort_order' => 3, 'is_highlighted' => false],
                $customDomain->id => ['value' => 'false', 'display_value' => '✗', 'sort_order' => 4, 'is_highlighted' => false],
                $helpSupport->id => ['value' => 'true', 'display_value' => '✓', 'sort_order' => 5, 'is_highlighted' => false],
                $emailSupport->id => ['value' => 'true', 'display_value' => '✓', 'sort_order' => 6, 'is_highlighted' => false],
            ]);
        }

        // Attach features to Pro Plan
        if ($proPlan) {
            $proPlan->features()->attach([
                $userCount->id => ['value' => '25', 'display_value' => 'Up to 25 users', 'sort_order' => 1, 'is_highlighted' => false],
                $databaseBackup->id => ['value' => 'true', 'display_value' => '✓', 'sort_order' => 2, 'is_highlighted' => false],
                $analytics->id => ['value' => 'Advanced', 'display_value' => 'Advanced Analytics', 'sort_order' => 3, 'is_highlighted' => true],
                $customDomain->id => ['value' => 'true', 'display_value' => '✗', 'sort_order' => 4, 'is_highlighted' => true],
                $helpSupport->id => ['value' => 'true', 'display_value' => '✓', 'sort_order' => 5, 'is_highlighted' => false],
                $emailSupport->id => ['value' => 'true', 'display_value' => '✓', 'sort_order' => 6, 'is_highlighted' => false],
            ]);
        }

        // Attach features to Enterprise Plan
        if ($enterprisePlan) {
            $enterprisePlan->features()->attach([
                $userCount->id => ['value' => '-1', 'display_value' => 'Unlimited users', 'sort_order' => 1, 'is_highlighted' => true],
                $databaseBackup->id => ['value' => 'true', 'display_value' => '✓', 'sort_order' => 2, 'is_highlighted' => false],
                $analytics->id => ['value' => 'Advanced', 'display_value' => 'Advanced Analytics', 'sort_order' => 3, 'is_highlighted' => false],
                $customDomain->id => ['value' => 'true', 'display_value' => '✓', 'sort_order' => 4, 'is_highlighted' => false],
                $helpSupport->id => ['value' => 'true', 'display_value' => '✓', 'sort_order' => 5, 'is_highlighted' => true],
                $emailSupport->id => ['value' => 'true', 'display_value' => '✓', 'sort_order' => 6, 'is_highlighted' => false],
            ]);
        }
    }
}
