<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pricing_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Plan name (e.g., Basic, Pro, Enterprise)
            $table->string('slug')->unique(); // URL-friendly version of the name
            $table->text('description')->nullable(); // Plan description
            $table->decimal('price', 10, 2); // Plan price (monthly or as specified)
            $table->string('billing_period')->default('monthly'); // monthly, yearly, etc.
            $table->string('stripe_price_id')->nullable(); // Stripe price ID
            $table->string('stripe_product_id')->nullable(); // Stripe product ID
            $table->integer('sort_order')->default(0); // For ordering plans
            $table->boolean('is_active')->default(true); // Whether the plan is available
            $table->boolean('is_featured')->default(false); // Highlight this plan
            $table->json('metadata')->nullable(); // Additional plan data
            $table->timestamps();

            $table->index(['is_active', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_plans');
    }
};
