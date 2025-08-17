<?php

use Livewire\Volt\Component;
use Mary\Traits\Toast;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

new class extends Component {
    use Toast;

    public string $name = '';
    public string $domain = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $selected_plan = 'starter';
    public bool $terms_accepted = false;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'domain' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*\.?[a-zA-Z]{2,}$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'selected_plan' => ['required', 'in:starter,professional,enterprise'],
            'terms_accepted' => ['accepted']
        ];
    }

    public function register()
    {
        $this->validate();

        try {

            $this->success('Registration successful! Welcome to Biznet!', position: 'toast-top');

        } catch (\Exception $e) {
            $this->error('Registration failed. Please try again.', position: 'toast-top');
        }
    }

    public function selectPlan($planSlug)
    {
        $this->selected_plan = \App\Models\PricingPlan::where('slug', $planSlug)->first()->slug ?? 'starter';
    }
};
?>

<div>

    <!-- Registration Header -->
    <section class="py-16 bg-gradient-to-br from-primary/10 to-secondary/10">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-2xl mx-auto">
                <h1 class="text-4xl font-bold mb-4 text-base-content">Join Biznet Today</h1>
                <p class="text-xl text-base-content/80">Start your journey to business automation and growth</p>
            </div>
        </div>
    </section>

    <!-- Registration Form -->
    <section class="py-16 bg-base-100">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-12">

                    <!-- Plan Selection -->
                    <div class="order-2 lg:order-1">
                        <h2 class="text-2xl font-bold mb-6 text-base-content">Choose Your Plan</h2>

                        <div class="space-y-4">

                        </div>

                        <!-- Plan Summary -->
                        <div class="mt-6 p-4 bg-base-200 rounded-lg">
                            <div class="flex justify-between items-center">
                                <span class="text-base-content/80">New Plan</span>
                                <span class="text-lg font-bold text-primary">$12.99/month</span>
                            </div>
                            <p class="text-sm text-base-content/70 mt-2">You can change or cancel your plan anytime</p>
                        </div>
                    </div>

                    <!-- Registration Form -->
                    <div class="order-1 lg:order-2">
                        <div class="card bg-base-200 shadow-xl">
                            <div class="card-body">
                                <h2 class="card-title text-2xl mb-6 text-base-content">Create Your Account</h2>

                                <form wire:submit="register" class="space-y-6">
                                    <!-- Name -->
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="label-text font-medium">Full Name</span>
                                        </label>
                                        <input type="text"
                                               wire:model="name"
                                               placeholder="Enter your full name"
                                               class="input input-bordered w-full @error('name') input-error @enderror">
                                        @error('name')
                                            <label class="label">
                                                <span class="label-text-alt text-error">{{ $message }}</span>
                                            </label>
                                        @enderror
                                    </div>

                                    <!-- Domain -->
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="label-text font-medium">Company Domain</span>
                                        </label>
                                        <input type="text"
                                               wire:model="domain"
                                               placeholder="yourcompany.com"
                                               class="input input-bordered w-full @error('domain') input-error @enderror">
                                        @error('domain')
                                            <label class="label">
                                                <span class="label-text-alt text-error">{{ $message }}</span>
                                            </label>
                                        @enderror
                                        <label class="label">
                                            <span class="label-text-alt">This will be used for your Biznet workspace</span>
                                        </label>
                                    </div>

                                    <!-- Email -->
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="label-text font-medium">Email Address</span>
                                        </label>
                                        <input type="email"
                                               wire:model="email"
                                               placeholder="Enter your email"
                                               class="input input-bordered w-full @error('email') input-error @enderror">
                                        @error('email')
                                            <label class="label">
                                                <span class="label-text-alt text-error">{{ $message }}</span>
                                            </label>
                                        @enderror
                                    </div>

                                    <!-- Password -->
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="label-text font-medium">Password</span>
                                        </label>
                                        <input type="password"
                                               wire:model="password"
                                               placeholder="Create a strong password"
                                               class="input input-bordered w-full @error('password') input-error @enderror">
                                        @error('password')
                                            <label class="label">
                                                <span class="label-text-alt text-error">{{ $message }}</span>
                                            </label>
                                        @enderror
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="label-text font-medium">Confirm Password</span>
                                        </label>
                                        <input type="password"
                                               wire:model="password_confirmation"
                                               placeholder="Confirm your password"
                                               class="input input-bordered w-full @error('password_confirmation') input-error @enderror">
                                        @error('password_confirmation')
                                            <label class="label">
                                                <span class="label-text-alt text-error">{{ $message }}</span>
                                            </label>
                                        @enderror
                                    </div>

                                    <!-- Terms and Conditions -->
                                    <div class="form-control">
                                        <label class="label cursor-pointer justify-start space-x-3">
                                            <input type="checkbox"
                                                   wire:model="terms_accepted"
                                                   class="checkbox checkbox-primary @error('terms_accepted') checkbox-error @enderror">
                                            <span class="label-text">
                                                I agree to the
                                                <a href="/terms" class="link link-primary">Terms of Service</a>
                                                and
                                                <a href="/privacy-policy" class="link link-primary">Privacy Policy</a>
                                            </span>
                                        </label>
                                        @error('terms_accepted')
                                            <label class="label">
                                                <span class="label-text-alt text-error">{{ $message }}</span>
                                            </label>
                                        @enderror
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="form-control pt-4">
                                        <button type="submit"
                                                class="btn btn-primary btn-lg w-full text-white"
                                                wire:loading.attr="disabled">
                                            <span wire:loading.remove>Create Account & Start Basic Plan</span>
                                            <span wire:loading class="loading loading-spinner loading-sm"></span>
                                            <span wire:loading>Creating Account...</span>
                                        </button>
                                    </div>

                                    <!-- Login Link -->
                                    <div class="text-center pt-4">
                                        <p class="text-base-content/70">
                                            Already have an account?
                                            <a href="/login" class="link link-primary font-medium">Sign in here</a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Preview -->
    <section class="py-16 bg-base-200">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl font-bold mb-8 text-base-content">What You'll Get</h2>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-primary/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2 text-base-content">Instant Setup</h3>
                        <p class="text-base-content/70">Get started in minutes with our guided onboarding process</p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-primary/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2 text-base-content">14-Day Free Trial</h3>
                        <p class="text-base-content/70">Try all features risk-free before your first payment</p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-primary/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 12h0"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2 text-base-content">24/7 Support</h3>
                        <p class="text-base-content/70">Get help whenever you need it from our expert team</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer footer-center bg-base-300 text-base-content p-10">
        <aside>
            <div class="flex items-center mb-4">
                <svg class="w-10 h-10 mr-2 text-primary" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
                <span class="text-2xl font-bold text-primary">Biznet</span>
            </div>
            <p class="text-base-content/70">Empowering businesses with intelligent solutions since 2025.</p>
            <p class="text-base-content/70">Copyright © 2025 - All rights reserved</p>
        </aside>
    </footer>
</div>
