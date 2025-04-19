<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Touch Estate - Smart Real Estate Analytics & Data Collection</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    </style>
</head>
<body class="bg-gray-50">
    <!-- Hero Section -->
    <header class="gradient-bg text-white min-h-screen flex items-center relative">
        <div class="container mx-auto px-6 py-24 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="lg:w-1/2 space-y-8">
                    <div class="inline-block">
                        <span class="hero-badge px-4 py-2 rounded-full text-sm font-semibold mb-6 inline-block">
                            🚀 The Future of Real Estate Analytics
                        </span>
                    </div>
                    <h1 class="text-5xl lg:text-6xl font-bold leading-tight">
                        Transform Your <span class="text-blue-300">Real Estate</span> Business with Smart Analytics
                    </h1>
                    <p class="text-xl text-blue-100 leading-relaxed">
                        Touch Estate empowers real estate professionals with cutting-edge tools for visitor data collection,
                        performance analytics, and streamlined operations.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
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
                <div class="lg:w-1/2 relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl blur-2xl opacity-20 animate-pulse"></div>
                    <div class="relative">
                        <div class="hero-image bg-white rounded-xl overflow-hidden">
                            <img src="{{ asset('images/landing/hero-dashboard.jpg') }}"
                                 alt="Touch Estate Dashboard"
                                 class="w-full h-auto rounded-xl shadow-2xl"
                                 loading="eager">
                        </div>
                        <div class="absolute -bottom-6 -right-6 bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg p-4 shadow-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                                <span class="text-sm font-medium">Live Analytics</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-gray-50 to-transparent"></div>
    </header>

    <!-- Features Section -->
    <section id="key-features" class="py-24 bg-white relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-64 h-64 bg-blue-100 rounded-full filter blur-3xl opacity-20 transform -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-64 h-64 bg-blue-100 rounded-full filter blur-3xl opacity-20 transform translate-x-1/2 translate-y-1/2"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="inline-block px-4 py-2 rounded-full bg-blue-100 text-blue-800 text-sm font-semibold mb-4">
                    Powerful Features
                </span>
                <h2 class="text-4xl font-bold mb-6">Everything You Need to Succeed</h2>
                <p class="text-xl text-gray-600">
                    Our comprehensive suite of tools helps you collect, analyze, and act on visitor data with ease.
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature Card 1 -->
                <div class="feature-card group bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
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
                        <span class="inline-block px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-sm">
                            Quick Setup
                        </span>
                    </div>
                </div>

                <!-- Feature Card 2 -->
                <div class="feature-card group bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
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
                        <span class="inline-block px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-sm">
                            Instant Access
                        </span>
                    </div>
                </div>

                <!-- Feature Card 3 -->
                <div class="feature-card group bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
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
                        <span class="inline-block px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-sm">
                            Smart Insights
                        </span>
                    </div>
                </div>
            </div>

            <!-- Feature Highlights -->
            <div class="mt-16 grid md:grid-cols-2 gap-8">
                <div class="bg-blue-50 rounded-2xl p-8">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-semibold">Real-time Data Collection</h4>
                    </div>
                    <p class="text-gray-600">Capture visitor information instantly and securely, with automatic data validation and storage.</p>
                </div>
                <div class="bg-blue-50 rounded-2xl p-8">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
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
            <div class="text-center max-w-3xl mx-auto mb-16">
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
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">Weekly Visitors</h3>
                            <p class="text-sm text-gray-500">Last 7 days</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                            <span class="text-sm font-medium text-gray-600">Total Visitors</span>
                        </div>
                    </div>
                    <canvas id="visitorsChart" height="300"></canvas>
                </div>

                <!-- Favorites Chart -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">Favorites Activity</h3>
                            <p class="text-sm text-gray-500">Last 7 days</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            <span class="text-sm font-medium text-gray-600">Favorites Added</span>
                        </div>
                    </div>
                    <canvas id="favoritesChart" height="300"></canvas>
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
            <div class="text-center max-w-3xl mx-auto mb-16">
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
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="inline-block px-4 py-2 rounded-full bg-blue-100 text-blue-800 text-sm font-semibold mb-4">
                    Simple Pricing
                </span>
                <h2 class="text-4xl font-bold mb-6">Choose Your Plan</h2>
                <p class="text-xl text-gray-600">
                    Start with our basic package and scale as you grow.
                </p>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-all duration-300">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                        <div class="text-center md:text-left">
                            <h3 class="text-2xl font-bold mb-2">Basic Package</h3>
                            <p class="text-gray-600 mb-4">Perfect for agencies with up to 24 properties</p>
                            <div class="flex items-baseline gap-2">
                                <span class="text-4xl font-bold">$475</span>
                                <span class="text-gray-500">/month</span>
                            </div>
                        </div>
                        <div class="flex-1">
                            <ul class="space-y-3 text-gray-600">
                                <li class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>24 NFC/QR tags</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Unlimited visitor tracking</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Basic analytics dashboard</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Email support</span>
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
                    <p>Need more tags? Additional 12 tags for just $200/month</p>
                    <p class="text-sm mt-2">* All prices are in CAD</p>
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
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="inline-block px-4 py-2 rounded-full bg-blue-100 text-blue-800 text-sm font-semibold mb-4">
                    Get in Touch
                </span>
                <h2 class="text-4xl font-bold mb-6">Start Your Journey Today</h2>
                <p class="text-xl text-gray-600">
                    Fill out the form below and we'll get back to you within 24 hours.
                </p>
            </div>

            <div class="max-w-2xl mx-auto">
                <form class="bg-white rounded-2xl shadow-lg p-8">
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
                        <label for="company" class="block text-sm font-medium text-gray-700 mb-2">Company</label>
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
                    <a href="#" class="text-gray-400 hover:text-white">Privacy Policy</a>
                    <a href="#" class="text-gray-400 hover:text-white">Terms of Service</a>
                    <a href="#" class="text-gray-400 hover:text-white">Contact Us</a>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-800 text-center text-gray-400 text-sm">
                <p>&copy; {{ date('Y') }} Touch Estate. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
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
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
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
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
