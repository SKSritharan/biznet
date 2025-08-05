<nav class="navbar bg-base-100 shadow-lg sticky top-0 z-50 border-b border-base-200">
    <div class="navbar-start">
        <!-- Brand Logo -->
        <a href="/" class="btn btn-ghost text-xl font-bold text-primary">
            <svg class="w-8 h-8 mr-2" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
            </svg>
            Biznet
        </a>
    </div>

    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1 space-x-2">
            <!-- Home -->
            <li>
                <a href="/" class="btn btn-ghost hover:bg-base-200 nav-link" data-section="home">
                    Home
                </a>
            </li>

            <!-- Features -->
            <li>
                <a href="/#features" class="btn btn-ghost hover:bg-base-200 nav-link" data-section="features">
                    Features
                </a>
            </li>

            <!-- Pricing -->
            <li>
                <a href="/#pricing" class="btn btn-ghost hover:bg-base-200 nav-link" data-section="pricing">Pricing</a>
            </li>

            <!-- FAQ -->
            <li>
                <a href="/#faq" class="btn btn-ghost hover:bg-base-200 nav-link" data-section="faq">FAQ</a>
            </li>

            <!-- Privacy Policy -->
            <li>
                <a href="/privacy-policy" class="btn btn-ghost hover:bg-base-200 nav-link" data-section="privacy-policy">Privacy Policy</a>
            </li>
        </ul>
    </div>

    <div class="navbar-end">
        <!-- Desktop Actions -->
        <div class="hidden lg:flex items-center space-x-3">
            <a href="/#pricing" class="btn btn-primary text-white hover:btn-primary-focus">
                Get Started
            </a>
        </div>

        <!-- Mobile Menu -->
        <div class="dropdown dropdown-end lg:hidden">
            <div tabindex="0" role="button" class="btn btn-ghost">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow-lg border border-base-200">
                <li><a href="/" class="mobile-nav-link" data-section="home">Home</a></li>
                <li><a href="/#features" class="mobile-nav-link" data-section="features">Features</a></li>
                <li><a href="/#pricing" class="mobile-nav-link" data-section="pricing">Pricing</a></li>
                <li><a href="/#faq" class="mobile-nav-link" data-section="faq">FAQ</a></li>
                <li><a href="/privacy-policy" class="mobile-nav-link" data-section="privacy-policy">Privacy Policy</a></li>
                <li>
                    <a href="/#pricing" class="btn btn-primary btn-sm text-white">Get Started</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    /* Active navigation styles */
    .nav-link.active {
        background-color: hsl(var(--p) / 0.2) !important;
        color: hsl(var(--p)) !important;
        font-weight: 600;
        border: 1px solid hsl(var(--p) / 0.3);
    }

    .mobile-nav-link.active {
        background-color: hsl(var(--p) / 0.2);
        color: hsl(var(--p));
        font-weight: 600;
    }

    /* Section highlighting for smooth scroll */
    .section-highlight {
        border-left: 4px solid hsl(var(--p));
        background-color: hsl(var(--p) / 0.05);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to update active navigation
        function updateActiveNav() {
            const currentPath = window.location.pathname;
            const currentHash = window.location.hash;

            // Remove active class from all nav links
            document.querySelectorAll('.nav-link, .mobile-nav-link').forEach(link => {
                link.classList.remove('active');
            });

            // Determine which section should be active
            let activeSection = '';

            if (currentPath === '/privacy-policy') {
                activeSection = 'privacy-policy';
            } else if (currentPath === '/' || currentPath === '') {
                if (currentHash) {
                    // If there's a hash, use it (remove the # symbol)
                    activeSection = currentHash.substring(1);
                } else {
                    // Default to home if no hash
                    activeSection = 'home';
                }
            }

            // Add active class to the appropriate nav link
            document.querySelectorAll(`[data-section="${activeSection}"]`).forEach(link => {
                link.classList.add('active');
            });
        }

        // Function to handle intersection observer for scroll-based highlighting
        function setupScrollHighlighting() {
            if (window.location.pathname === '/' || window.location.pathname === '') {
                const sections = document.querySelectorAll('section[id]');
                const navLinks = document.querySelectorAll('.nav-link, .mobile-nav-link');

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            // Remove active class from all nav links
                            navLinks.forEach(link => link.classList.remove('active'));

                            // Add active class to corresponding nav link
                            const sectionId = entry.target.id;
                            document.querySelectorAll(`[data-section="${sectionId}"]`).forEach(link => {
                                link.classList.add('active');
                            });

                            // Update URL hash without triggering scroll
                            if (sectionId !== 'hero') {
                                history.replaceState(null, null, `#${sectionId}`);
                            } else {
                                history.replaceState(null, null, '/');
                            }
                        }
                    });
                }, {
                    threshold: 0.3,
                    rootMargin: '-100px 0px -60% 0px'
                });

                sections.forEach(section => observer.observe(section));
            }
        }

        // Handle smooth scrolling when on the same page
        if (window.location.pathname === '/' || window.location.pathname === '') {
            document.querySelectorAll('a[href^="/#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href').substring(2); // Remove "/#"
                    const target = document.getElementById(targetId);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });

                // Set up scroll-based highlighting
                setupScrollHighlighting();
            });
        }

        // Initial active nav update
        updateActiveNav();

        // Update active nav when hash changes
        window.addEventListener('hashchange', updateActiveNav);

        // Update active nav when page loads (for back/forward navigation)
        window.addEventListener('load', updateActiveNav);
    });
</script>
