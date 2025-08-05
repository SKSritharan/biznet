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

    <!-- Privacy Policy Header -->
    <section class="py-20 bg-gradient-to-br from-primary/10 to-secondary/10">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-4xl mx-auto">
                <h1 class="text-5xl font-bold mb-6 text-base-content">Privacy Policy</h1>
                <p class="text-xl text-base-content/80 mb-4">
                    Your privacy and data protection are our top priorities
                </p>
                <p class="text-base-content/70">Last updated: August 4, 2025</p>
            </div>
        </div>
    </section>

    <!-- Privacy Policy Content -->
    <section class="py-20 bg-base-100">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto prose prose-lg">

                <!-- Overview Cards -->
                <div class="grid md:grid-cols-2 gap-8 mb-16">
                    <!-- Data Collection -->
                    <div class="card bg-base-200 shadow-lg">
                        <div class="card-body">
                            <h3 class="card-title text-primary mb-4">Data Collection</h3>
                            <p class="text-base-content/70">We collect only the information necessary to provide our services effectively. This includes account information, usage data, and communication preferences. We never sell your personal data to third parties.</p>
                        </div>
                    </div>

                    <!-- Data Usage -->
                    <div class="card bg-base-200 shadow-lg">
                        <div class="card-body">
                            <h3 class="card-title text-primary mb-4">Data Usage</h3>
                            <p class="text-base-content/70">Your data is used solely to improve your experience with Biznet, provide customer support, and deliver the services you've subscribed to. We use industry-standard practices to protect your information.</p>
                        </div>
                    </div>

                    <!-- Data Security -->
                    <div class="card bg-base-200 shadow-lg">
                        <div class="card-body">
                            <h3 class="card-title text-primary mb-4">Data Security</h3>
                            <p class="text-base-content/70">All data is encrypted in transit and at rest using AES-256 encryption. We employ multi-layered security measures including firewalls, intrusion detection, and regular security assessments.</p>
                        </div>
                    </div>

                    <!-- Your Rights -->
                    <div class="card bg-base-200 shadow-lg">
                        <div class="card-body">
                            <h3 class="card-title text-primary mb-4">Your Rights</h3>
                            <p class="text-base-content/70">You have the right to access, update, or delete your personal data at any time. You can also request data portability or object to certain processing activities. Contact our privacy team for assistance.</p>
                        </div>
                    </div>

                    <!-- Compliance -->
                    <div class="card bg-base-200 shadow-lg">
                        <div class="card-body">
                            <h3 class="card-title text-primary mb-4">Compliance</h3>
                            <p class="text-base-content/70">Biznet is fully compliant with GDPR, CCPA, and other privacy regulations. We regularly update our practices to meet evolving privacy standards and requirements.</p>
                        </div>
                    </div>

                    <!-- Contact -->
                    <div class="card bg-base-200 shadow-lg">
                        <div class="card-body">
                            <h3 class="card-title text-primary mb-4">Contact Us</h3>
                            <p class="text-base-content/70">Questions about our privacy practices? Contact our Data Protection Officer at privacy@biznet.com or through our support portal. We're committed to transparency and prompt responses.</p>
                        </div>
                    </div>
                </div>

                <!-- Detailed Privacy Policy -->
                <div class="bg-base-200 p-8 rounded-xl">
                    <h2 class="text-3xl font-bold mb-8 text-base-content">Detailed Privacy Policy</h2>

                    <!-- Information We Collect -->
                    <div class="mb-8">
                        <h3 class="text-2xl font-semibold mb-4 text-primary">1. Information We Collect</h3>
                        <div class="space-y-4 text-base-content/80">
                            <div>
                                <h4 class="font-semibold text-base-content mb-2">Personal Information</h4>
                                <p>We collect information you provide directly to us, such as when you create an account, subscribe to our services, or contact us for support. This may include your name, email address, phone number, company information, and billing details.</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-base-content mb-2">Usage Information</h4>
                                <p>We automatically collect information about how you use our services, including your IP address, browser type, operating system, referring URLs, access times, and pages viewed.</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-base-content mb-2">Device Information</h4>
                                <p>We may collect information about the devices you use to access our services, including hardware model, operating system version, unique device identifiers, and mobile network information.</p>
                            </div>
                        </div>
                    </div>

                    <!-- How We Use Information -->
                    <div class="mb-8">
                        <h3 class="text-2xl font-semibold mb-4 text-primary">2. How We Use Your Information</h3>
                        <div class="space-y-2 text-base-content/80">
                            <p>• Provide, maintain, and improve our services</p>
                            <p>• Process transactions and send related information</p>
                            <p>• Send technical notices, updates, and support messages</p>
                            <p>• Respond to your comments, questions, and customer service requests</p>
                            <p>• Monitor and analyze trends, usage, and activities</p>
                            <p>• Detect, investigate, and prevent fraudulent activities</p>
                            <p>• Comply with legal obligations and protect our rights</p>
                        </div>
                    </div>

                    <!-- Information Sharing -->
                    <div class="mb-8">
                        <h3 class="text-2xl font-semibold mb-4 text-primary">3. Information Sharing and Disclosure</h3>
                        <div class="space-y-4 text-base-content/80">
                            <p>We do not sell, trade, or rent your personal information to third parties. We may share your information only in the following circumstances:</p>
                            <div class="space-y-2 ml-4">
                                <p>• With your consent or at your direction</p>
                                <p>• With service providers who perform services on our behalf</p>
                                <p>• To comply with legal obligations or protect our rights</p>
                                <p>• In connection with a merger, acquisition, or sale of assets</p>
                                <p>• To prevent harm to the rights, property, or safety of Biznet, our users, or others</p>
                            </div>
                        </div>
                    </div>

                    <!-- Data Security -->
                    <div class="mb-8">
                        <h3 class="text-2xl font-semibold mb-4 text-primary">4. Data Security</h3>
                        <div class="space-y-4 text-base-content/80">
                            <p>We implement appropriate technical and organizational security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. These measures include:</p>
                            <div class="space-y-2 ml-4">
                                <p>• Encryption of data in transit and at rest using AES-256 encryption</p>
                                <p>• Regular security assessments and vulnerability testing</p>
                                <p>• Access controls and authentication mechanisms</p>
                                <p>• Employee training on data protection and privacy practices</p>
                                <p>• Incident response procedures and breach notification protocols</p>
                            </div>
                        </div>
                    </div>

                    <!-- Your Rights -->
                    <div class="mb-8">
                        <h3 class="text-2xl font-semibold mb-4 text-primary">5. Your Rights and Choices</h3>
                        <div class="space-y-4 text-base-content/80">
                            <p>Depending on your location, you may have certain rights regarding your personal information, including:</p>
                            <div class="space-y-2 ml-4">
                                <p>• <strong>Access:</strong> Request access to your personal information</p>
                                <p>• <strong>Correction:</strong> Request correction of inaccurate or incomplete information</p>
                                <p>• <strong>Deletion:</strong> Request deletion of your personal information</p>
                                <p>• <strong>Portability:</strong> Request a copy of your information in a structured format</p>
                                <p>• <strong>Objection:</strong> Object to certain processing activities</p>
                                <p>• <strong>Restriction:</strong> Request restriction of processing in certain circumstances</p>
                            </div>
                            <p class="mt-4">To exercise these rights, please contact us at privacy@biznet.com.</p>
                        </div>
                    </div>

                    <!-- Data Retention -->
                    <div class="mb-8">
                        <h3 class="text-2xl font-semibold mb-4 text-primary">6. Data Retention</h3>
                        <p class="text-base-content/80">We retain your personal information for as long as necessary to provide our services, comply with legal obligations, resolve disputes, and enforce our agreements. When we no longer need your information, we will securely delete or anonymize it.</p>
                    </div>

                    <!-- International Transfers -->
                    <div class="mb-8">
                        <h3 class="text-2xl font-semibold mb-4 text-primary">7. International Data Transfers</h3>
                        <p class="text-base-content/80">Your information may be transferred to and processed in countries other than your own. We ensure that such transfers are conducted in accordance with applicable data protection laws and implement appropriate safeguards to protect your information.</p>
                    </div>

                    <!-- Cookies and Tracking -->
                    <div class="mb-8">
                        <h3 class="text-2xl font-semibold mb-4 text-primary">8. Cookies and Tracking Technologies</h3>
                        <div class="space-y-4 text-base-content/80">
                            <p>We use cookies and similar tracking technologies to collect and track information about your use of our services. You can control cookies through your browser settings, but disabling cookies may affect the functionality of our services.</p>
                            <div class="space-y-2 ml-4">
                                <p>• <strong>Essential Cookies:</strong> Required for basic functionality</p>
                                <p>• <strong>Analytics Cookies:</strong> Help us understand how you use our services</p>
                                <p>• <strong>Preference Cookies:</strong> Remember your settings and preferences</p>
                            </div>
                        </div>
                    </div>

                    <!-- Changes to Privacy Policy -->
                    <div class="mb-8">
                        <h3 class="text-2xl font-semibold mb-4 text-primary">9. Changes to This Privacy Policy</h3>
                        <p class="text-base-content/80">We may update this Privacy Policy from time to time. We will notify you of any material changes by posting the new Privacy Policy on this page and updating the "Last updated" date. We encourage you to review this Privacy Policy periodically.</p>
                    </div>

                    <!-- Contact Information -->
                    <div class="mb-8">
                        <h3 class="text-2xl font-semibold mb-4 text-primary">10. Contact Us</h3>
                        <div class="space-y-2 text-base-content/80">
                            <p>If you have any questions about this Privacy Policy or our privacy practices, please contact us:</p>
                            <div class="ml-4 space-y-1">
                                <p><strong>Email:</strong> privacy@biznet.com</p>
                                <p><strong>Address:</strong> Biznet Privacy Team, 123 Business Avenue, Tech City, TC 12345</p>
                                <p><strong>Phone:</strong> +1 (555) 123-4567</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Call to Action -->
                <div class="text-center mt-12">
                    <div class="bg-primary/10 p-8 rounded-xl">
                        <h3 class="text-2xl font-bold mb-4 text-base-content">Questions About Your Privacy?</h3>
                        <p class="text-base-content/70 mb-6">Our privacy team is here to help with any questions or concerns you may have.</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="mailto:privacy@biznet.com" class="btn btn-primary text-white">
                                Contact Privacy Team
                            </a>
                            <a href="/" class="btn btn-outline btn-primary">
                                Back to Home
                            </a>
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
    // Back to top button functionality
    document.addEventListener('DOMContentLoaded', function() {
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
