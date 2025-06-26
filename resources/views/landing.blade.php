<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Primary Meta Tags -->
    <title>Touch Estate - Smart Real Estate Analytics & Data Collection Platform</title>
    <meta name="title" content="Touch Estate - Smart Real Estate Analytics & Data Collection Platform">
    <meta name="description" content="Transform your real estate business with Touch Estate's NFC/QR tag system. Track visitor data, analyze property performance, and streamline your operations with our innovative platform.">
    <meta name="keywords" content="real estate analytics, property tracking, NFC tags, QR codes, visitor data, real estate technology, property management, real estate marketing">
    <meta name="author" content="Touch Estate">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Touch Estate - Smart Real Estate Analytics & Data Collection Platform">
    <meta property="og:description" content="Transform your real estate business with Touch Estate's NFC/QR tag system. Track visitor data, analyze property performance, and streamline your operations.">
    <meta property="og:image" content="{{ asset('images/landing/hero.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="Touch Estate - Smart Real Estate Analytics & Data Collection Platform">
    <meta property="twitter:description" content="Transform your real estate business with Touch Estate's NFC/QR tag system. Track visitor data, analyze property performance, and streamline your operations.">
    <meta property="twitter:image" content="{{ asset('images/landing/hero.png') }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favico-2.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favico-2.png') }}">

    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Touch Estate",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('images/logo.png') }}",
        "description": "Smart Real Estate Analytics & Data Collection Platform",
        "sameAs": [
            "https://twitter.com/touchestate",
            "https://linkedin.com/company/touchestate"
        ]
    }
    </script>

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Product",
        "name": "Touch Estate Analytics Platform",
        "description": "Real estate analytics and visitor tracking system using NFC/QR technology",
        "brand": {
            "@type": "Brand",
            "name": "Touch Estate"
        },
        "offers": {
            "@type": "Offer",
            "price": "249",
            "priceCurrency": "CAD",
            "availability": "https://schema.org/InStock"
        }
    }
    </script>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Add Toastify CSS and JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <style>
        html {
            scroll-behavior: smooth;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            position: relative;
            overflow: hidden;
        }
        .gradient-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .feature-card {
            transition: transform 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-5px);
        }
        .hero-image {
            position: relative;
            border-radius: 1rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            transform: perspective(1000px) rotateY(-5deg) rotateX(5deg);
            transition: transform 0.3s ease;
        }
        .hero-image:hover {
            transform: perspective(1000px) rotateY(-2deg) rotateX(2deg);
        }
        .hero-image::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #3b82f6, #60a5fa);
            z-index: -1;
            border-radius: 1.1rem;
        }
        .hero-badge {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Animation Classes */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .slide-in-left {
            opacity: 0;
            transform: translateX(-50px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .slide-in-left.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .slide-in-right {
            opacity: 0;
            transform: translateX(50px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .slide-in-right.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .scale-in {
            opacity: 0;
            transform: scale(0.9);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .scale-in.visible {
            opacity: 1;
            transform: scale(1);
        }

        .stagger-delay-1 { transition-delay: 0.1s; }
        .stagger-delay-2 { transition-delay: 0.2s; }
        .stagger-delay-3 { transition-delay: 0.3s; }
        .stagger-delay-4 { transition-delay: 0.4s; }

        /* Hover Animations */
        .hover-lift {
            transition: transform 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
        }

        .hover-scale {
            transition: transform 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }

        /* Pulse Animation */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .animate-pulse {
            animation: pulse 2s infinite;
        }

        /* Gradient Animation */
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .gradient-animate {
            background-size: 200% 200%;
            animation: gradient 15s ease infinite;
        }
    </style>

    <script>
        // Intersection Observer for scroll animations
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            // Observe all animated elements
            document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right, .scale-in').forEach((el) => {
                observer.observe(el);
            });

            // Smooth scroll for anchor links
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

            // Add hover effects to cards
            document.querySelectorAll('.feature-card, .pricing-card').forEach(card => {
                card.classList.add('hover-lift');
            });

            // Add hover effects to buttons
            document.querySelectorAll('button, .btn').forEach(button => {
                button.classList.add('hover-scale');
            });
        });
    </script>
</head>
<body class="bg-gray-50">
    <!-- Hero Section -->
    <header class="gradient-bg text-white min-h-screen flex items-center relative">
        <div class="container mx-auto px-6 py-24 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="lg:w-1/2 space-y-8">
                    <div class="inline-block fade-in stagger-delay-1">
                        <span class="hero-badge px-4 py-2 rounded-full text-sm font-semibold mb-6 inline-block">
                            🚀 Turn Property Visit Into a Digital Lead
                        </span>
                    </div>
                    <h1 class="text-5xl lg:text-6xl font-bold leading-tight fade-in stagger-delay-2">
                        Transform Your <br><span class="text-blue-300">Real Estate</span> Business with Smart Analytics
                    </h1>
                    <p class="text-xl text-blue-100 leading-relaxed fade-in stagger-delay-3">
                        Touch Estate empowers real estate professionals with cutting-edge tools for visitor data collection,
                        performance analytics, and streamlined operations.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 pt-4 fade-in stagger-delay-4">
                        <a href="#pricing" class="bg-white text-blue-900 px-8 py-4 rounded-xl font-semibold hover:bg-blue-50 transition duration-300 text-center shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            Get Started Now
                        </a>
                        <a href="#key-features" class="bg-blue-800 bg-opacity-50 text-white px-8 py-4 rounded-xl font-semibold hover:bg-opacity-70 transition duration-300 text-center border border-blue-400">
                            View Features
                        </a>
                    </div>
                    <div class="grid grid-cols-3 gap-6 pt-8 border-t border-blue-400 border-opacity-30">
                        <div>
                            <h4 class="text-3xl font-bold">500+</h4>
                            <p class="text-blue-200">Active Properties</p>
                        </div>
                        <div>
                            <h4 class="text-3xl font-bold">98%</h4>
                            <p class="text-blue-200">Client Satisfaction</p>
                        </div>
                        <div>
                            <h4 class="text-3xl font-bold">24/7</h4>
                            <p class="text-blue-200">Support</p>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/2 relative slide-in-right">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl blur-2xl opacity-20 animate-pulse"></div>
                    <div class="relative">
                        <div class="hero-image bg-white rounded-xl overflow-hidden">
                            <img src="{{ asset('images/landing/hero.png') }}"
                                 alt="Touch Estate Dashboard"
                                 class="w-full h-auto rounded-xl shadow-2xl"
                                 loading="eager">
                        </div>
                        <div class="absolute -bottom-6 -right-6 bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg p-4 shadow-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                                <span class="text-sm font-medium">Get more faster</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-gray-50 to-transparent"></div>
    </header>

    <!-- NFC/QR Tag Section -->
    <section class="py-24 bg-white relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-64 h-64 bg-blue-100 rounded-full filter blur-3xl opacity-20 transform -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-64 h-64 bg-blue-100 rounded-full filter blur-3xl opacity-20 transform translate-x-1/2 translate-y-1/2"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in">
                <span class="inline-block px-4 py-2 rounded-full bg-blue-100 text-blue-800 text-sm font-semibold mb-4">
                    Smart Technology
                </span>
                <h2 class="text-4xl font-bold mb-6">What is an NFC/QR Tag?</h2>
                <p class="text-xl text-gray-600">
                    Our custom-designed tags combine physical durability with digital intelligence.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-12 items-center">
                <!-- Image -->
                <div class="relative slide-in-left">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-8 shadow-lg">
                        <img src="{{ asset('images/landing/nfc-qr.jpeg') }}"
                             alt="NFC/QR Tag"
                             class="w-full h-auto rounded-xl shadow-xl transform hover:scale-105 transition-transform duration-300">
                    </div>
                </div>

                <!-- Features -->
                <div class="space-y-8 slide-in-right">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold mb-2">Custom Crafted</h3>
                            <p class="text-gray-600">Each tag is carefully designed and manufactured by our team, ensuring the highest quality and durability for your real estate needs.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold mb-2">Document Holder</h3>
                            <p class="text-gray-600">The tag includes a sturdy stand that securely holds your property documents, making it easy for visitors to access important information.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold mb-2">Smart Scanning</h3>
                            <p class="text-gray-600">Equipped with both NFC and QR technology, visitors can easily scan the tag using their smartphones to access property information instantly.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold mb-2">Unique Identification</h3>
                            <p class="text-gray-600">Every tag has a unique identifier that our application uses to track its location and usage, providing you with precise analytics for each property.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="key-features" class="py-24 bg-white relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-64 h-64 bg-blue-100 rounded-full filter blur-3xl opacity-20 transform -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-64 h-64 bg-blue-100 rounded-full filter blur-3xl opacity-20 transform translate-x-1/2 translate-y-1/2"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in">
                <span class="inline-block px-4 py-2 rounded-full bg-blue-100 text-blue-800 text-sm font-semibold mb-4">
                    Powerful Features
                </span>
                <h2 class="text-4xl font-bold mb-6">Everything You Need to Succeed</h2>
                <p class="text-xl text-gray-600">
                    Our comprehensive suite of tools helps you collect, analyze, <br>and act on visitor data with ease.
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature Card 1 -->
                <div class="feature-card group bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 fade-in stagger-delay-1">
                    <div class="relative mb-6">
                        <div class="absolute inset-0 bg-blue-100 rounded-xl opacity-20 transform group-hover:scale-110 transition-transform duration-300"></div>
                        <div class="w-16 h-16 mx-auto relative z-10 flex items-center justify-center">
                            <svg class="w-8 h-8 text-blue-600 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold mb-4 text-center group-hover:text-blue-600 transition-colors duration-300">Easy Configuration</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        Set up your properties in minutes with our intuitive interface. No technical expertise required.
                    </p>
                    <div class="mt-6 text-center">
                        <span class="inline-block px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-sm transform group-hover:scale-105 transition-transform duration-300">
                            Quick Setup
                        </span>
                    </div>
                </div>

                <!-- Feature Card 2 -->
                <div class="feature-card group bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 fade-in stagger-delay-2">
                    <div class="relative mb-6">
                        <div class="absolute inset-0 bg-blue-100 rounded-xl opacity-20 transform group-hover:scale-110 transition-transform duration-300"></div>
                        <div class="w-16 h-16 mx-auto relative z-10 flex items-center justify-center">
                            <svg class="w-8 h-8 text-blue-600 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold mb-4 text-center group-hover:text-blue-600 transition-colors duration-300">Easy Visitor Connection</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        Visitors can connect instantly through QR codes or NFC tags, making data collection seamless.
                    </p>
                    <div class="mt-6 text-center">
                        <span class="inline-block px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-sm transform group-hover:scale-105 transition-transform duration-300">
                            Instant Access
                        </span>
                    </div>
                </div>

                <!-- Feature Card 3 -->
                <div class="feature-card group bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 fade-in stagger-delay-3">
                    <div class="relative mb-6">
                        <div class="absolute inset-0 bg-blue-100 rounded-xl opacity-20 transform group-hover:scale-110 transition-transform duration-300"></div>
                        <div class="w-16 h-16 mx-auto relative z-10 flex items-center justify-center">
                            <svg class="w-8 h-8 text-blue-600 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold mb-4 text-center group-hover:text-blue-600 transition-colors duration-300">Powerful Analytics</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        Gain deep insights into visitor behavior, property performance, and market trends.
                    </p>
                    <div class="mt-6 text-center">
                        <span class="inline-block px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-sm transform group-hover:scale-105 transition-transform duration-300">
                            Smart Insights
                        </span>
                    </div>
                </div>
            </div>

            <!-- Feature Highlights -->
            <div class="mt-16 grid md:grid-cols-2 gap-8">
                <div class="bg-blue-50 rounded-2xl p-8 fade-in stagger-delay-4 hover:bg-blue-100 transition-colors duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center transform hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-semibold">Real-time Data Collection</h4>
                    </div>
                    <p class="text-gray-600">Capture visitor information instantly and securely, with automatic data validation and storage.</p>
                </div>
                <div class="bg-blue-50 rounded-2xl p-8 fade-in stagger-delay-5 hover:bg-blue-100 transition-colors duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center transform hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-semibold">Lightning Fast Performance</h4>
                    </div>
                    <p class="text-gray-600">Experience blazing-fast data processing and real-time analytics with our optimized platform.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Analytics Section -->
    <section class="py-24 bg-gray-50 relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-64 h-64 bg-blue-100 rounded-full filter blur-3xl opacity-20 transform -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-64 h-64 bg-blue-100 rounded-full filter blur-3xl opacity-20 transform translate-x-1/2 translate-y-1/2"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in">
                <span class="inline-block px-4 py-2 rounded-full bg-blue-100 text-blue-800 text-sm font-semibold mb-4">
                    Real-time Analytics
                </span>
                <h2 class="text-4xl font-bold mb-6">Data-Driven Insights</h2>
                <p class="text-xl text-gray-600">
                    Track visitor behavior and property performance with our powerful analytics dashboard.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Visitors Chart -->
                <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">Weekly Visitors</h3>
                            <p class="text-sm text-gray-500">Last 7 days</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                            <span class="text-sm font-medium text-gray-600">Total Visitors</span>
                        </div>
                    </div>
                    <div class="w-full relative" style="min-height: 200px; max-height: 300px;">
                        <canvas id="visitorsChart"></canvas>
                    </div>
                </div>

                <!-- Favorites Chart -->
                <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">Favorites Activity</h3>
                            <p class="text-sm text-gray-500">Last 7 days</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            <span class="text-sm font-medium text-gray-600">Favorites Added</span>
                        </div>
                    </div>
                    <div class="w-full relative" style="min-height: 200px; max-height: 300px;">
                        <canvas id="favoritesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- User Journey Section -->
    <section class="py-24 bg-white relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-64 h-64 bg-blue-100 rounded-full filter blur-3xl opacity-20 transform -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-64 h-64 bg-blue-100 rounded-full filter blur-3xl opacity-20 transform translate-x-1/2 translate-y-1/2"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in">
                <span class="inline-block px-4 py-2 rounded-full bg-blue-100 text-blue-800 text-sm font-semibold mb-4">
                    Seamless Experience
                </span>
                <h2 class="text-4xl font-bold mb-6">Simple Steps to Property Access</h2>
                <p class="text-xl text-gray-600">
                    Our streamlined process makes property visits effortless for both visitors and agents.
                </p>
            </div>

            <!-- Journey Timeline -->
            <div class="max-w-4xl mx-auto relative">
                <!-- Timeline Line -->
                <div class="absolute left-1/2 top-0 bottom-0 w-1 bg-gradient-to-b from-blue-500 via-blue-400 to-blue-300 transform -translate-x-1/2 hidden md:block animate-pulse" style="height: calc(100% - 160px);"></div>

                <!-- Step 1 -->
                <div class="relative mb-8 md:mb-16 group fade-in stagger-delay-1">
                    <div class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-blue-500 rounded-full border-4 border-white shadow-lg group-hover:scale-125 transition-transform duration-300 hidden md:block animate-bounce"></div>
                    <div class="flex items-center">
                        <div class="w-full md:w-1/2 md:pr-12 md:text-right">
                            <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 group-hover:border-blue-200 transform group-hover:-translate-y-1">
                                <div class="w-16 h-16 bg-blue-50 rounded-xl flex items-center justify-center group-hover:bg-blue-100 transition-colors duration-300 transform group-hover:scale-110 mx-auto md:float-right md:ml-6 mb-6">
                                    <svg class="w-8 h-8 text-blue-600 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                    </svg>
                                </div>
                                <div class="text-center md:text-right">
                                    <h3 class="text-lg font-semibold mb-2 group-hover:text-blue-600 transition-colors duration-300">Scan Tag</h3>
                                    <p class="text-sm text-gray-600">Quick scan of QR/NFC tag at the property</p>
                                </div>
                            </div>
                        </div>
                        <div class="hidden md:block md:w-1/2 md:pl-12">
                            <!-- Empty space for alignment -->
                        </div>
                    </div>
                    <!-- Down Arrow for Mobile -->
                    <div class="flex justify-center my-4 md:hidden">
                        <svg class="w-6 h-6 text-blue-500 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="relative mb-8 md:mb-16 group fade-in stagger-delay-2">
                    <div class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-blue-500 rounded-full border-4 border-white shadow-lg group-hover:scale-125 transition-transform duration-300 hidden md:block animate-bounce"></div>
                    <div class="flex items-center">
                        <div class="hidden md:block md:w-1/2 md:pr-12">
                            <!-- Empty space for alignment -->
                        </div>
                        <div class="w-full md:w-1/2 md:pl-12 md:text-left">
                            <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 group-hover:border-blue-200 transform group-hover:-translate-y-1">
                                <div class="w-16 h-16 bg-blue-50 rounded-xl flex items-center justify-center group-hover:bg-blue-100 transition-colors duration-300 transform group-hover:scale-110 mx-auto md:float-left md:mr-6 mb-6">
                                    <svg class="w-8 h-8 text-blue-600 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div class="text-center md:text-left">
                                    <h3 class="text-lg font-semibold mb-2 group-hover:text-blue-600 transition-colors duration-300">Quick Auth</h3>
                                    <p class="text-sm text-gray-600">Easy email or phone verification</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Down Arrow for Mobile -->
                    <div class="flex justify-center my-4 md:hidden">
                        <svg class="w-6 h-6 text-blue-500 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="relative mb-8 md:mb-16 group fade-in stagger-delay-3">
                    <div class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-blue-500 rounded-full border-4 border-white shadow-lg group-hover:scale-125 transition-transform duration-300 hidden md:block animate-bounce"></div>
                    <div class="flex items-center">
                        <div class="w-full md:w-1/2 md:pr-12 md:text-right">
                            <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 group-hover:border-blue-200 transform group-hover:-translate-y-1">
                                <div class="w-16 h-16 bg-blue-50 rounded-xl flex items-center justify-center group-hover:bg-blue-100 transition-colors duration-300 transform group-hover:scale-110 mx-auto md:float-right md:ml-6 mb-6">
                                    <svg class="w-8 h-8 text-blue-600 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div class="text-center md:text-right">
                                    <h3 class="text-lg font-semibold mb-2 group-hover:text-blue-600 transition-colors duration-300">Provide Info</h3>
                                    <p class="text-sm text-gray-600">Share basic details like name and DOB</p>
                                </div>
                            </div>
                        </div>
                        <div class="hidden md:block md:w-1/2 md:pl-12">
                            <!-- Empty space for alignment -->
                        </div>
                    </div>
                    <!-- Down Arrow for Mobile -->
                    <div class="flex justify-center my-4 md:hidden">
                        <svg class="w-6 h-6 text-blue-500 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="relative mb-8 md:mb-16 group fade-in stagger-delay-4">
                    <div class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-blue-500 rounded-full border-4 border-white shadow-lg group-hover:scale-125 transition-transform duration-300 hidden md:block animate-bounce"></div>
                    <div class="flex items-center">
                        <div class="hidden md:block md:w-1/2 md:pr-12">
                            <!-- Empty space for alignment -->
                        </div>
                        <div class="w-full md:w-1/2 md:pl-12 md:text-left">
                            <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 group-hover:border-blue-200 transform group-hover:-translate-y-1">
                                <div class="w-16 h-16 bg-blue-50 rounded-xl flex items-center justify-center group-hover:bg-blue-100 transition-colors duration-300 transform group-hover:scale-110 mx-auto md:float-left md:mr-6 mb-6">
                                    <svg class="w-8 h-8 text-blue-600 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                </div>
                                <div class="text-center md:text-left">
                                    <h3 class="text-lg font-semibold mb-2 group-hover:text-blue-600 transition-colors duration-300">Access Property</h3>
                                    <p class="text-sm text-gray-600">Get instant access to property details</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Follow-up Section -->
                <div class="mt-32 relative z-10 bg-gradient-to-r from-blue-50 to-blue-100 rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 fade-in stagger-delay-5 transform hover:-translate-y-1">
                    <div class="flex flex-col items-center sm:flex-row sm:items-start gap-6">
                        <div class="w-16 h-16 px-4 bg-blue-100 rounded-xl flex items-center justify-center group-hover:bg-blue-200 transition-colors duration-300 transform group-hover:scale-110">
                            <svg class="w-8 h-8 text-blue-600 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                            </svg>
                        </div>
                        <div class="text-center sm:text-left">
                            <h3 class="text-xl font-semibold mb-2 text-blue-800">Stay Connected</h3>
                            <p class="text-gray-600">
                                After the visit, we automatically send personalized follow-ups and reminders,
                                keeping your properties top of mind for potential buyers. Our engagement system
                                ensures visitors never forget about your listings.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Integrations Section -->
    <section class="py-24 bg-white relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-64 h-64 bg-blue-100 rounded-full filter blur-3xl opacity-20 transform -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-64 h-64 bg-blue-100 rounded-full filter blur-3xl opacity-20 transform translate-x-1/2 translate-y-1/2"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in">
                <span class="inline-block px-4 py-2 rounded-full bg-blue-100 text-blue-800 text-sm font-semibold mb-4">
                    Seamless Integrations
                </span>
                <h2 class="text-4xl font-bold mb-6">Connect with Your Favorite Tools</h2>
                <p class="text-xl text-gray-600">
                    Integrate with popular platforms and services to streamline your workflow.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Mortgage Brokers -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
                    <div class="w-16 h-16 mx-auto mb-6 bg-blue-50 rounded-xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-4">Mortgage Brokers</h3>
                    <p class="text-gray-600 text-center">
                        Connect with mortgage professionals to streamline the buying process.
                    </p>
                </div>

                <!-- CRM Systems -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
                    <div class="w-16 h-16 mx-auto mb-6 bg-blue-50 rounded-xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-4">CRM Systems</h3>
                    <p class="text-gray-600 text-center">
                        Sync your data with popular CRM platforms for better lead management.
                    </p>
                </div>

                <!-- API Access -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
                    <div class="w-16 h-16 mx-auto mb-6 bg-blue-50 rounded-xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-4">API Access</h3>
                    <p class="text-gray-600 text-center">
                        Custom integrations through our powerful API.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-24 bg-gray-50 relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-64 h-64 bg-blue-100 rounded-full filter blur-3xl opacity-20 transform -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-64 h-64 bg-blue-100 rounded-full filter blur-3xl opacity-20 transform translate-x-1/2 translate-y-1/2"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in">
                <span class="inline-block px-4 py-2 rounded-full bg-blue-100 text-blue-800 text-sm font-semibold mb-4">
                    Simple Pricing
                </span>
                <h2 class="text-4xl font-bold mb-6">Flat Plan Pricing</h2>
                <p class="text-xl text-gray-600">
                    Start with our Pro Package and scale as you grow.
                </p>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-all duration-300">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                        <div class="text-center w-full md:w-auto">
                            <h3 class="text-2xl font-bold mb-2">Flat rate</h3>
                            <div class="flex items-baseline justify-center gap-2">
                                <span class="text-4xl font-bold">$249</span>
                                <span class="text-gray-500">/month</span>
                            </div>
                        </div>
                        <div class="flex-1 flex justify-center">
                            <ul class="space-y-3 text-gray-600">
                                <li class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>12 Smart QR/NFC Property Tags</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Branded digital property pages (no app required)</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Real-time visitor analytics & engagement tracking</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Visitor subscription capture + lead export</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Integrated mortgage broker/referral section</span>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <a href="#contact" class="bg-blue-600 text-white px-8 py-3 rounded-xl font-semibold hover:bg-blue-700 transition duration-300 inline-block">
                                Get Started
                            </a>
                        </div>
                    </div>
                </div>
                <div class="mt-8 text-center text-gray-600">
                    <p>Need more tags? Every next additional 12 tags for just $199/month</p>
                    <p>You can select between free printable property title page with a QR code</p>
                    <p>Or order the NFC/QR tags with your branding from us for $25/tag. Conditions apply</p>
                    <p class="text-sm mt-2">* All prices are in CAD</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-24 bg-gray-50 relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-64 h-64 bg-blue-100 rounded-full filter blur-3xl opacity-20 transform -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-64 h-64 bg-blue-100 rounded-full filter blur-3xl opacity-20 transform translate-x-1/2 translate-y-1/2"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in">
                <span class="inline-block px-4 py-2 rounded-full bg-blue-100 text-blue-800 text-sm font-semibold mb-4">
                    🙋‍♂️ FAQ
                </span>
                <h2 class="text-4xl font-bold mb-6">Frequently Asked Questions</h2>
                <p class="text-xl text-gray-600">
                    Quick answers to common questions about our service.
                </p>
            </div>

            <div class="max-w-3xl mx-auto">
                <div class="space-y-6">
                    <!-- Question 1 -->
                    <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 fade-in stagger-delay-1">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold mb-2">Do visitors need an app?</h3>
                                <p class="text-gray-600">No, it's all web-based. Visitors can access property information directly through their mobile browser.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Question 2 -->
                    <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 fade-in stagger-delay-2">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold mb-2">What if I need more than 24 tags?</h3>
                                <p class="text-gray-600">Extra packs are available. You can easily add additional sets of 12 tags to your subscription as your portfolio grows.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Question 3 -->
                    <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 fade-in stagger-delay-3">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold mb-2">What information do I see?</h3>
                                <p class="text-gray-600">You get comprehensive insights including emails, phone numbers, names, date & time, and more through custom forms builder. Our detailed analytics help you understand visitor behavior and property performance.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-24 bg-white relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-64 h-64 bg-blue-100 rounded-full filter blur-3xl opacity-20 transform -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-64 h-64 bg-blue-100 rounded-full filter blur-3xl opacity-20 transform translate-x-1/2 translate-y-1/2"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in">
                <span class="inline-block px-4 py-2 rounded-full bg-blue-100 text-blue-800 text-sm font-semibold mb-4">
                    Get in Touch
                </span>
                <h2 class="text-4xl font-bold mb-6">Start Your Journey Today</h2>
                <p class="text-xl text-gray-600">
                    Fill out the form below and we'll get back to you within 24 hours.
                </p>

                <p class="text-xl text-gray-600">
                    <b>Get a demo access today after 15 minutes call with us!</b>
                </p>
            </div>

            <div class="max-w-2xl mx-auto">
                <form id="contactForm" class="bg-white rounded-2xl shadow-lg p-8">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                            <input type="text" id="name" name="name" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" name="email" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                    </div>
                    <div class="mt-6">
                        <label for="company" class="block text-sm font-medium text-gray-700 mb-2">Company (Optional)</label>
                        <input type="text" id="company" name="company" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="mt-6">
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                        <textarea id="message" name="message" rows="4" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required></textarea>
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="w-full bg-blue-600 text-white px-8 py-4 rounded-xl font-semibold hover:bg-blue-700 transition duration-300">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h2 class="text-2xl font-bold">Touch Estate</h2>
                    <p class="text-gray-400">Smart Real Estate Analytics & Data Collection</p>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('privacy-policy') }}" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-white">Privacy Policy</a>
                    <a href="{{ route('terms-of-service') }}" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-white">Terms of Service</a>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-800 text-center text-gray-400 text-sm">
                <p>&copy; {{ date('Y') }} Touch Estate. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Chart configuration
        const chartConfig = {
            responsive: true,
            maintainAspectRatio: true,
            aspectRatio: window.innerWidth < 640 ? 1.2 : 2,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        maxTicksLimit: 6
                    }
                },
                x: {
                    ticks: {
                        maxRotation: 0,
                        minRotation: 0
                    }
                }
            }
        };

        // Visitors Chart
        const visitorsCtx = document.getElementById('visitorsChart').getContext('2d');
        new Chart(visitorsCtx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Visitors',
                    data: [45, 60, 55, 70, 65, 80, 75],
                    borderColor: '#3B82F6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: chartConfig
        });

        // Favorites Chart
        const favoritesCtx = document.getElementById('favoritesChart').getContext('2d');
        new Chart(favoritesCtx, {
            type: 'bar',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Favorites',
                    data: [12, 15, 10, 18, 14, 20, 16],
                    backgroundColor: '#10B981',
                    borderRadius: 4
                }]
            },
            options: chartConfig
        });

        // Update chart sizes on window resize
        window.addEventListener('resize', () => {
            chartConfig.aspectRatio = window.innerWidth < 640 ? 1.2 : 2;
        });

        document.getElementById('contactForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                company: document.getElementById('company').value,
                message: document.getElementById('message').value
            };

            try {
                const response = await fetch('/contact-us', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(formData)
                });

                const data = await response.json();

                if (data.success) {
                    // Show success toast
                    Toastify({
                        text: data.message,
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        style: {
                            background: "#4CAF50",
                        }
                    }).showToast();

                    // Clear the form
                    this.reset();
                } else {
                    // Show error toast
                    Toastify({
                        text: data.message || 'Something went wrong. Please try again.',
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        style: {
                            background: "#F44336",
                        }
                    }).showToast();
                }
            } catch (error) {
                // Show error toast
                Toastify({
                    text: "An error occurred. Please try again later.",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    style: {
                        background: "#F44336",
                    }
                }).showToast();
            }
        });
    </script>
</body>
</html>
