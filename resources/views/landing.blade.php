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
            background: linear-gradient(135deg, #1a365d 0%, #2c5282 100%);
        }
        .feature-card {
            transition: transform 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Hero Section -->
    <header class="gradient-bg text-white">
        <div class="container mx-auto px-6 py-16">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2">
                    <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-4">
                        Transform Your Real Estate Business with Smart Analytics
                    </h1>
                    <p class="text-xl mb-8">
                        Touch Estate provides powerful tools for real estate professionals to collect visitor data, analyze performance, and streamline operations.
                    </p>
                    <a href="#pricing" class="bg-white text-blue-900 px-8 py-3 rounded-lg font-semibold hover:bg-blue-100 transition duration-300">
                        Get Started
                    </a>
                </div>
                <div class="md:w-1/2 mt-8 md:mt-0">
                    <img src="/images/hero-image.png" alt="Touch Estate Dashboard" class="rounded-lg shadow-xl">
                </div>
            </div>
        </div>
    </header>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Key Features</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="feature-card bg-white p-6 rounded-lg shadow-lg">
                    <div class="text-blue-600 mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Easy Configuration</h3>
                    <p class="text-gray-600">Set up your properties in minutes with our intuitive interface. No technical expertise required.</p>
                </div>
                <div class="feature-card bg-white p-6 rounded-lg shadow-lg">
                    <div class="text-blue-600 mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Easy Visitor Connection</h3>
                    <p class="text-gray-600">Visitors can connect instantly through QR codes or NFC tags, making data collection seamless.</p>
                </div>
                <div class="feature-card bg-white p-6 rounded-lg shadow-lg">
                    <div class="text-blue-600 mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
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
                    <h3 class="text-xl font-semibold mb-4">Weekly Visitors</h3>
                    <canvas id="visitorsChart" height="300"></canvas>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
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
                    <img src="/images/mortgage-icon.png" alt="Mortgage Brokers" class="w-16 h-16 mx-auto mb-4">
                    <h3 class="text-xl font-semibold">Mortgage Brokers</h3>
                    <p class="text-gray-600">Connect with mortgage professionals to streamline the buying process.</p>
                </div>
                <div class="text-center">
                    <img src="/images/crm-icon.png" alt="CRM Systems" class="w-16 h-16 mx-auto mb-4">
                    <h3 class="text-xl font-semibold">CRM Systems</h3>
                    <p class="text-gray-600">Sync your data with popular CRM platforms for better lead management.</p>
                </div>
                <div class="text-center">
                    <img src="/images/api-icon.png" alt="API Access" class="w-16 h-16 mx-auto mb-4">
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