<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Touch Estate - Smart Real Estate Analytics & Data Collection</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
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
                        <a href="#features" class="bg-blue-800 bg-opacity-50 text-white px-8 py-4 rounded-xl font-semibold hover:bg-opacity-70 transition duration-300 text-center border border-blue-400">
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
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Key Features</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="feature-card bg-white p-6 rounded-lg shadow-lg">
                    <img src="{{ asset('images/landing/easy-config.jpg') }}" alt="Easy Configuration" class="w-16 h-16 mx-auto mb-4">
                    <h3 class="text-xl font-semibold mb-2">Easy Configuration</h3>
                    <p class="text-gray-600">Set up your properties in minutes with our intuitive interface. No technical expertise required.</p>
                </div>
                <div class="feature-card bg-white p-6 rounded-lg shadow-lg">
                    <img src="{{ asset('images/landing/visitor-connect.jpg') }}" alt="Easy Visitor Connection" class="w-16 h-16 mx-auto mb-4">
                    <h3 class="text-xl font-semibold mb-2">Easy Visitor Connection</h3>
                    <p class="text-gray-600">Visitors can connect instantly through QR codes or NFC tags, making data collection seamless.</p>
                </div>
                <div class="feature-card bg-white p-6 rounded-lg shadow-lg">
                    <img src="{{ asset('images/landing/analytics.jpg') }}" alt="Powerful Analytics" class="w-16 h-16 mx-auto mb-4">
                    <h3 class="text-xl font-semibold mb-2">Powerful Analytics</h3>
                    <p class="text-gray-600">Gain deep insights into visitor behavior, property performance, and market trends.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Analytics Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Analytics Dashboard</h2>
            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <img src="{{ asset('images/landing/visitors-chart.jpg') }}" alt="Weekly Visitors" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h3 class="text-xl font-semibold mb-4">Weekly Visitors</h3>
                    <canvas id="visitorsChart" height="300"></canvas>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <img src="{{ asset('images/landing/favorites-chart.jpg') }}" alt="Favorites Activity" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h3 class="text-xl font-semibold mb-4">Favorites Activity</h3>
                    <canvas id="favoritesChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </section>

    <!-- Integrations Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Seamless Integrations</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <img src="{{ asset('images/landing/mortgage-integration.jpg') }}" alt="Mortgage Brokers" class="w-24 h-24 mx-auto mb-4">
                    <h3 class="text-xl font-semibold">Mortgage Brokers</h3>
                    <p class="text-gray-600">Connect with mortgage professionals to streamline the buying process.</p>
                </div>
                <div class="text-center">
                    <img src="{{ asset('images/landing/crm-integration.jpg') }}" alt="CRM Systems" class="w-24 h-24 mx-auto mb-4">
                    <h3 class="text-xl font-semibold">CRM Systems</h3>
                    <p class="text-gray-600">Sync your data with popular CRM platforms for better lead management.</p>
                </div>
                <div class="text-center">
                    <img src="{{ asset('images/landing/api-integration.jpg') }}" alt="API Access" class="w-24 h-24 mx-auto mb-4">
                    <h3 class="text-xl font-semibold">API Access</h3>
                    <p class="text-gray-600">Custom integrations through our powerful API.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Simple, Transparent Pricing</h2>
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <div class="text-center mb-8">
                        <img src="{{ asset('images/landing/pricing-tags.jpg') }}" alt="NFC/QR Tags" class="w-32 h-32 mx-auto mb-4">
                        <h3 class="text-2xl font-bold">Basic Package</h3>
                        <p class="text-gray-600">Perfect for agencies with up to 24 properties</p>
                    </div>
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div class="mb-4 md:mb-0">
                            <p class="text-4xl font-bold">$475 CAD</p>
                            <p class="text-gray-600">per month</p>
                        </div>
                        <div class="text-center md:text-left">
                            <p class="font-semibold">Includes:</p>
                            <ul class="list-disc list-inside text-gray-600">
                                <li>24 NFC/QR tags</li>
                                <li>Unlimited visitor tracking</li>
                                <li>Basic analytics dashboard</li>
                                <li>Email support</li>
                            </ul>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <a href="#" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                                Get Started
                            </a>
                        </div>
                    </div>
                </div>
                <div class="mt-8 text-center">
                    <p class="text-gray-600">Need more tags? Additional 12 tags for just $200 CAD/month</p>
                </div>
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
