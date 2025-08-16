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
        Schema::create('feature_pricing_plan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feature_id')->constrained()->onDelete('cascade');
            $table->foreignId('pricing_plan_id')->constrained()->onDelete('cascade');
            $table->string('value'); // The value for this feature in this plan
            $table->string('display_value')->nullable(); // How to display it
            $table->boolean('is_highlighted')->default(false); // Highlight this feature for this plan
            $table->integer('sort_order')->default(0); // Order within the plan
            $table->timestamps();

            $table->unique(['feature_id', 'pricing_plan_id']);
            $table->index(['pricing_plan_id', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feature_pricing_plan');
    }
};
