<?php

use Livewire\Volt\Component;
use Mary\Traits\Toast;

new class extends Component {
    use Toast;

    public function mount()
    {
        // Initialize any data if needed
    }
};
?>

<div>

    <!-- Hero Section -->
    <section id="hero" class="hero min-h-screen bg-gradient-to-br from-primary/10 to-secondary/10">
        <div class="hero-content text-center">
            <div class="max-w-4xl">
                <h1 class="text-5xl font-bold mb-6 text-base-content">
                    Scale Your Business with <span class="text-primary">Biznet</span>
                </h1>
                <p class="text-xl mb-8 text-base-content/80">
                    The all-in-one platform that helps businesses automate processes, gain insights, and accelerate growth through intelligent solutions.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#pricing" class="btn btn-primary btn-lg text-white smooth-scroll">
                        Get Started
                    </a>
                    <a href="#features" class="btn btn-outline btn-lg smooth-scroll">
                        Explore Features
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-base-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 text-base-content">Powerful Features</h2>
                <p class="text-xl text-base-content/70">Everything you need to run your business efficiently</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Analytics Dashboard -->
                <div class="card bg-base-200 shadow-xl hover:shadow-2xl transition-all duration-300">
                    <div class="card-body">
                        <div class="text-primary mb-4">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="card-title text-base-content">Analytics Dashboard</h3>
                        <p class="text-base-content/70">Real-time insights and comprehensive analytics to make data-driven decisions for your business growth.</p>
                    </div>
                </div>

                <!-- Business Automation -->
                <div class="card bg-base-200 shadow-xl hover:shadow-2xl transition-all duration-300">
                    <div class="card-body">
                        <div class="text-primary mb-4">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h3 class="card-title text-base-content">Business Automation</h3>
                        <p class="text-base-content/70">Streamline workflows and automate repetitive tasks to increase efficiency and reduce operational costs.</p>
                    </div>
                </div>

                <!-- Third-party Integrations -->
                <div class="card bg-base-200 shadow-xl hover:shadow-2xl transition-all duration-300">
                    <div class="card-body">
                        <div class="text-primary mb-4">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="card-title text-base-content">Third-party Integrations</h3>
                        <p class="text-base-content/70">Connect with 100+ popular tools and services to create a unified business ecosystem.</p>
                    </div>
                </div>

                <!-- Advanced Reporting -->
                <div class="card bg-base-200 shadow-xl hover:shadow-2xl transition-all duration-300">
                    <div class="card-body">
                        <div class="text-primary mb-4">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="card-title text-base-content">Advanced Reporting</h3>
                        <p class="text-base-content/70">Generate comprehensive reports with customizable templates and automated scheduling.</p>
                    </div>
                </div>

                <!-- Enterprise Security -->
                <div class="card bg-base-200 shadow-xl hover:shadow-2xl transition-all duration-300">
                    <div class="card-body">
                        <div class="text-primary mb-4">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <h3 class="card-title text-base-content">Enterprise Security</h3>
                        <p class="text-base-content/70">Bank-level security with end-to-end encryption, multi-factor authentication, and compliance standards.</p>
                    </div>
                </div>

                <!-- Cloud Infrastructure -->
                <div class="card bg-base-200 shadow-xl hover:shadow-2xl transition-all duration-300">
                    <div class="card-body">
                        <div class="text-primary mb-4">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                            </svg>
                        </div>
                        <h3 class="card-title text-base-content">Cloud Infrastructure</h3>
                        <p class="text-base-content/70">Scalable cloud infrastructure with 99.9% uptime guarantee and global content delivery network.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-20 bg-base-200">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 text-base-content">Simple, Transparent Pricing</h2>
                <p class="text-xl text-base-content/70">Choose the plan that's right for your business</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Starter Plan -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body text-center">
                        <h3 class="card-title justify-center text-2xl mb-4">Starter</h3>
                        <div class="mb-6">
                            <span class="text-4xl font-bold text-primary">$29</span>
                            <span class="text-base-content/70">/month</span>
                        </div>
                        <ul class="text-left space-y-3 mb-8">
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-success mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Up to 5 users
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-success mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Basic analytics
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-success mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                5 integrations
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-success mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Email support
                            </li>
                        </ul>
                        <button class="btn btn-outline btn-primary w-full">Get Started</button>
                    </div>
                </div>

                <!-- Professional Plan -->
                <div class="card bg-base-100 shadow-xl border-2 border-primary relative">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                        <span class="badge badge-primary text-white px-3 py-2">Most Popular</span>
                    </div>
                    <div class="card-body text-center">
                        <h3 class="card-title justify-center text-2xl mb-4">Professional</h3>
                        <div class="mb-6">
                            <span class="text-4xl font-bold text-primary">$99</span>
                            <span class="text-base-content/70">/month</span>
                        </div>
                        <ul class="text-left space-y-3 mb-8">
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-success mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Up to 25 users
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-success mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Advanced analytics
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-success mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Unlimited integrations
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-success mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Priority support
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-success mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Advanced automation
                            </li>
                        </ul>
                        <button class="btn btn-primary w-full text-white">Get Started</button>
                    </div>
                </div>

                <!-- Enterprise Plan -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body text-center">
                        <h3 class="card-title justify-center text-2xl mb-4">Enterprise</h3>
                        <div class="mb-6">
                            <span class="text-4xl font-bold text-primary">$299</span>
                            <span class="text-base-content/70">/month</span>
                        </div>
                        <ul class="text-left space-y-3 mb-8">
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-success mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Unlimited users
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-success mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Custom analytics
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-success mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Custom integrations
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-success mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                24/7 dedicated support
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-success mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                On-premise deployment
                            </li>
                        </ul>
                        <button class="btn btn-outline btn-primary w-full">Contact Sales</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-20 bg-base-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 text-base-content">Frequently Asked Questions</h2>
                <p class="text-xl text-base-content/70">Find answers to common questions about Biznet</p>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="join join-vertical w-full">
                    <!-- FAQ Item 1 -->
                    <div class="collapse collapse-arrow join-item border border-base-300">
                        <input type="radio" name="faq-accordion" checked="checked" />
                        <div class="collapse-title text-xl font-medium">
                            What is Biznet and how can it help my business?
                        </div>
                        <div class="collapse-content">
                            <p class="text-base-content/70">Biznet is a comprehensive business management platform that helps companies automate processes, gain valuable insights through analytics, and scale efficiently. Our platform integrates with your existing tools to create a unified business ecosystem that saves time and reduces operational costs.</p>
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="collapse collapse-arrow join-item border border-base-300">
                        <input type="radio" name="faq-accordion" />
                        <div class="collapse-title text-xl font-medium">
                            How long does it take to set up Biznet?
                        </div>
                        <div class="collapse-content">
                            <p class="text-base-content/70">Most businesses can get up and running with Biznet in less than 24 hours. Our onboarding process includes guided setup, data migration assistance, and dedicated support to ensure a smooth transition. For enterprise customers, our implementation team provides white-glove service.</p>
                        </div>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div class="collapse collapse-arrow join-item border border-base-300">
                        <input type="radio" name="faq-accordion" />
                        <div class="collapse-title text-xl font-medium">
                            Can I integrate Biznet with my existing tools?
                        </div>
                        <div class="collapse-content">
                            <p class="text-base-content/70">Yes! Biznet integrates with over 100 popular business tools including CRMs, accounting software, project management tools, and communication platforms. Our API also allows for custom integrations to meet specific business needs.</p>
                        </div>
                    </div>

                    <!-- FAQ Item 4 -->
                    <div class="collapse collapse-arrow join-item border border-base-300">
                        <input type="radio" name="faq-accordion" />
                        <div class="collapse-title text-xl font-medium">
                            Is my data secure with Biznet?
                        </div>
                        <div class="collapse-content">
                            <p class="text-base-content/70">Absolutely. We use bank-level security with end-to-end encryption, multi-factor authentication, and regular security audits. Biznet is SOC 2 Type II certified and complies with GDPR, HIPAA, and other industry standards. Your data is backed up across multiple secure data centers.</p>
                        </div>
                    </div>

                    <!-- FAQ Item 5 -->
                    <div class="collapse collapse-arrow join-item border border-base-300">
                        <input type="radio" name="faq-accordion" />
                        <div class="collapse-title text-xl font-medium">
                            What kind of support do you offer?
                        </div>
                        <div class="collapse-content">
                            <p class="text-base-content/70">We offer multiple support channels including email, live chat, and phone support. Professional and Enterprise plans include priority support with faster response times. Enterprise customers also get access to a dedicated customer success manager and 24/7 technical support.</p>
                        </div>
                    </div>

                    <!-- FAQ Item 6 -->
                    <div class="collapse collapse-arrow join-item border border-base-300">
                        <input type="radio" name="faq-accordion" />
                        <div class="collapse-title text-xl font-medium">
                            Can I cancel my subscription anytime?
                        </div>
                        <div class="collapse-content">
                            <p class="text-base-content/70">Yes, you can cancel your subscription at any time with no cancellation fees. You'll continue to have access to your account until the end of your current billing period. We also offer data export tools to help you migrate your information if needed.</p>
                        </div>
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

    <!-- Back to Top Button -->
    <button id="backToTop" class="btn btn-circle btn-primary fixed bottom-8 right-8 shadow-lg opacity-0 transition-all duration-300 z-50" onclick="scrollToTop()">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </button>
</div>

<script>
    // Smooth scroll functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Add smooth scroll behavior to all anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Back to top button functionality
        const backToTopButton = document.getElementById('backToTop');

        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopButton.style.opacity = '1';
                backToTopButton.style.transform = 'translateY(0)';
            } else {
                backToTopButton.style.opacity = '0';
                backToTopButton.style.transform = 'translateY(20px)';
            }
        });
    });

    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
</script>
