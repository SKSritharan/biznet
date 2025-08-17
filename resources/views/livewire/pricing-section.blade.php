<section id="pricing" class="py-20 bg-base-200">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4 text-base-content">Simple, Transparent Pricing</h2>
            <p class="text-xl text-base-content/70">Choose the plan that's right for your business</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">

            @foreach($pricingPlans as $plan)
                <div class="card bg-base-100 shadow-xl hover:border-2 hover:border-primary hover:relative
                    @if($plan->is_featured)
                        border-2 border-primary relative
                    @endif
                    @if($plan->is_featured)
                        shadow-2xl
                    @endif
                    transition-all duration-300 ease-in-out transform hover:scale-105
                "
                >
                    @if($plan->is_featured)
                        <div class="absolute top-0 right-0 bg-primary text-white px-3 py-1 rounded-bl-lg">
                            Featured
                        </div>
                    @endif
                    <div class="card-body text-center">
                        <h3 class="card-title justify-center text-2xl mb-4">{{$plan->name}}</h3>
                        <p class="text-base-content/70 mb-6">{{$plan->description}}</p>
                        <div class="mb-6">
                            <span class="text-4xl font-bold text-primary">${{$plan->price}}</span>
                            <span class="text-base-content/70">/{{$plan->billing_period}}</span>
                        </div>
                        <ul class="text-left space-y-3 mb-8">
                            @foreach($plan->features as $feature)
                                <li class="flex items-center justify-between">
                                    <span>{{ $feature->name }}</span>
                                    <span class="font-medium text-primary">{{ $feature->pivot->display_value ?? $feature->getDisplayValueForPlan($plan->id) }}</span>
                                </li>
                            @endforeach

                        </ul>
                        <a href="#"
                            wire:navigate
                            class="btn btn-outline btn-primary w-full">Get Started</a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
