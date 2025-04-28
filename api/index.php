<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yanami.store Monitoring | Status Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.9/dist/chart.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <style>
        .pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .glow {
            box-shadow: 0 0 10px rgba(74, 222, 128, 0.7);
        }
        .slide-in {
            animation: slideIn 0.3s ease-out;
        }
        @keyframes slideIn {
            from { transform: translateY(10px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .bounce {
            animation: bounce 1s infinite;
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
        
        /* Dark mode styles */
        .dark {
            background-color: #1a202c;
            color: #e2e8f0;
        }
        .dark .bg-white {
            background-color: #2d3748;
        }
        .dark .text-gray-800 {
            color: #e2e8f0;
        }
        .dark .text-gray-600 {
            color: #a0aec0;
        }
        .dark .text-gray-500 {
            color: #a0aec0;
        }
        .dark .bg-gray-100 {
            background-color: #4a5568;
        }
        .dark .bg-gray-50 {
            background-color: #4a5568;
        }
        .dark .divide-gray-200 {
            border-color: #4a5568;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen dark:bg-gray-900 transition-colors duration-300">
    <!-- Navbar -->
    <nav class="bg-white dark:bg-gray-800 shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <a href="/" class="flex items-center">
                        <i class="fas fa-store text-blue-600 dark:text-blue-400 text-2xl mr-2"></i>
                        <span class="font-bold text-xl text-gray-800 dark:text-white">Yanami.store</span>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="https://yanami.store" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                        <i class="fas fa-home mr-1"></i> Main Site
                    </a>
                    <a href="#" class="text-blue-600 dark:text-blue-400 font-medium">
                        <i class="fas fa-chart-line mr-1"></i> Status
                    </a>
                    <a href="https://yanami.store/kontak" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                        <i class="fas fa-envelope mr-1"></i> Contact
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <!-- Header with dark mode toggle -->
        <header class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Yanami.store Monitoring</h1>
                    <p class="text-gray-600 dark:text-gray-400">Real-time status and performance metrics</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="bg-white dark:bg-gray-800 p-3 rounded-lg shadow flex items-center slide-in">
                        <div class="w-3 h-3 rounded-full bg-green-500 mr-2 pulse"></div>
                        <span class="text-sm font-medium">Operational</span>
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        Last updated: <span id="lastUpdated">Just now</span>
                    </div>
                    <button id="themeToggle" class="p-2 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                        <i class="fas fa-moon dark:hidden"></i>
                        <i class="fas fa-sun hidden dark:block"></i>
                    </button>
                </div>
            </div>
        </header>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow hover:shadow-md transition-shadow fade-in">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Uptime (24 hours)</p>
                        <p class="text-2xl font-bold text-green-600">99.98%</p>
                    </div>
                    <div class="bg-green-100 dark:bg-green-900 p-3 rounded-full bounce">
                        <i class="fas fa-check-circle text-green-600 dark:text-green-400"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                        <div class="h-full bg-green-500 rounded-full" style="width: 99.98%"></div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow hover:shadow-md transition-shadow fade-in">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Response Time</p>
                        <p class="text-2xl font-bold text-blue-600">128ms</p>
                    </div>
                    <div class="bg-blue-100 dark:bg-blue-900 p-3 rounded-full bounce">
                        <i class="fas fa-tachometer-alt text-blue-600 dark:text-blue-400"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                        <div class="h-full bg-blue-500 rounded-full" style="width: 85%"></div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow hover:shadow-md transition-shadow fade-in">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Downtime (30 days)</p>
                        <p class="text-2xl font-bold text-yellow-600">2m 14s</p>
                    </div>
                    <div class="bg-yellow-100 dark:bg-yellow-900 p-3 rounded-full bounce">
                        <i class="fas fa-clock text-yellow-600 dark:text-yellow-400"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                        <div class="h-full bg-yellow-500 rounded-full" style="width: 5%"></div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow hover:shadow-md transition-shadow fade-in">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Incidents (7 days)</p>
                        <p class="text-2xl font-bold text-red-600">1</p>
                    </div>
                    <div class="bg-red-100 dark:bg-red-900 p-3 rounded-full bounce">
                        <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                        <div class="h-full bg-red-500 rounded-full" style="width: 15%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Status Timeline -->
            <div class="lg:col-span-2 bg-white dark:bg-gray-800 p-6 rounded-lg shadow hover:shadow-lg transition-shadow slide-in">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white">Status Timeline</h2>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded text-sm hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">24 hours</button>
                        <button class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 rounded text-sm hover:bg-blue-200 dark:hover:bg-blue-800 transition-colors">7 days</button>
                        <button class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded text-sm hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">30 days</button>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <!-- Current Status -->
                    <div class="border-l-4 border-green-500 pl-4 py-2 bg-green-50 dark:bg-green-900 bg-opacity-30 rounded-r slide-in">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-medium">Operational</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">All systems running smoothly</p>
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">Now</div>
                        </div>
                    </div>
                    
                    <!-- Past Incidents -->
                    <div class="border-l-4 border-red-500 pl-4 py-2 bg-red-50 dark:bg-red-900 bg-opacity-30 rounded-r slide-in">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-medium">Partial Outage</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">API response delays due to increased traffic</p>
                                <div class="mt-2 text-xs bg-red-100 dark:bg-red-800 text-red-700 dark:text-red-300 px-2 py-1 rounded inline-block">
                                    <i class="fas fa-exclamation-circle mr-1"></i> Resolved after 12 minutes
                                </div>
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400"><span class="current-year"></span>-04-26, 14:32 UTC</div>
                        </div>
                    </div>
                    
                    <div class="border-l-4 border-green-500 pl-4 py-2 bg-green-50 dark:bg-green-900 bg-opacity-30 rounded-r slide-in">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-medium">Operational</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">All systems normal</p>
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400"><span class="current-year"></span>-04-26, 14:20 UTC</div>
                        </div>
                    </div>
                    
                    <div class="border-l-4 border-yellow-500 pl-4 py-2 bg-yellow-50 dark:bg-yellow-900 bg-opacity-30 rounded-r slide-in">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-medium">Performance Issues</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Response times slower than usual</p>
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400"><span class="current-year"></span>-04-24, 09:15 UTC</div>
                        </div>
                    </div>
                    
                    <div class="border-l-4 border-red-500 pl-4 py-2 bg-red-50 dark:bg-red-900 bg-opacity-30 rounded-r slide-in">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-medium">Outage</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Server outage due to unscheduled maintenance</p>
                                <div class="mt-2 text-xs bg-red-100 dark:bg-red-800 text-red-700 dark:text-red-300 px-2 py-1 rounded inline-block">
                                    <i class="fas fa-exclamation-circle mr-1"></i> Resolved after 1 hour 5 minutes
                                </div>
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400"><span class="current-year"></span>-03-15, 03:45 UTC</div>
                        </div>
                    </div>
                </div>
                
                <button class="mt-6 text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 flex items-center transition-colors">
                    <i class="fas fa-history mr-2"></i> View complete incident history
                </button>
            </div>
            
            <!-- Response Time Chart -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow hover:shadow-lg transition-shadow slide-in">
                <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-6">Response Time (24 hours)</h2>
                <div class="h-64">
                    <canvas id="responseTimeChart"></canvas>
                </div>
                <div class="mt-4 grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Average</p>
                        <p class="font-bold">132ms</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Maximum</p>
                        <p class="font-bold">428ms</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Monitored Services -->
        <div class="mt-8 bg-white dark:bg-gray-800 p-6 rounded-lg shadow hover:shadow-lg transition-all slide-in">
            <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-6">Monitored Services</h2>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Service</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Uptime</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Response Time</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Last Check</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                        <i class="fas fa-globe text-blue-600 dark:text-blue-400"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">Main Website</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">yanami.store</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
                                    Operational
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">99.99%</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">142ms</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">Just now</td>
                        </tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center">
                                        <i class="fas fa-server text-purple-600 dark:text-purple-400"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">API Service</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">api.yanami.store</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
                                    Operational
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">99.97%</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">98ms</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">15 seconds ago</td>
                        </tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-yellow-100 dark:bg-yellow-900 rounded-full flex items-center justify-center">
                                        <i class="fas fa-database text-yellow-600 dark:text-yellow-400"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">Database</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">DB.json</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
                                    Operational
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">100.00%</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">24ms</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">30 seconds ago</td>
                        </tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-red-100 dark:bg-red-900 rounded-full flex items-center justify-center">
                                        <i class="fas fa-envelope text-red-600 dark:text-red-400"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">Email Service</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">SMTP/IMAP</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200">
                                    Degraded
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">99.89%</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">312ms</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">1 minute ago</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Footer -->
        <footer class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400 py-6 border-t border-gray-200 dark:border-gray-700">
            <p>© <span class="current-year"></span> Yanami.store. All rights reserved.</p>
            <p class="mt-2">Last system check: <span id="footerLastChecked">Just now</span></p>
        </footer>
    </div>

    <script>
        // Set current year for incidents and footer
        document.querySelectorAll('.current-year').forEach(el => {
            el.textContent = new Date().getFullYear();
        });
        
        // Theme toggle functionality - fixed
        const themeToggle = document.getElementById('themeToggle');
        const html = document.documentElement;
        
        // Check user preference
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            html.classList.add('dark');
        } else {
            html.classList.remove('dark');
        }
        
        themeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' : 'light');
        });
        
        // Update timestamps
        function updateTimestamps() {
            const now = moment().format('D MMM YYYY, HH:mm:ss');
            document.getElementById('lastUpdated').textContent = now;
            
            const footerLastChecked = document.getElementById('footerLastChecked');
            if (footerLastChecked) {
                footerLastChecked.textContent = now;
            }
        }
        
        setInterval(updateTimestamps, 30000);
        updateTimestamps();
        
        // Initialize ChartJS properly
        document.addEventListener('DOMContentLoaded', function() {
            // Make sure Chart.js is loaded
            if (typeof Chart !== 'undefined') {
                const ctx = document.getElementById('responseTimeChart').getContext('2d');
                const responseTimeChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: Array.from({length: 24}, (_, i) => `${i}:00`),
                        datasets: [{
                            label: 'Response Time (ms)',
                            data: [142, 135, 128, 121, 118, 115, 112, 110, 108, 112, 118, 125, 
                                   132, 138, 145, 152, 158, 165, 172, 168, 155, 145, 138, 132],
                            borderColor: 'rgba(59, 130, 246, 1)',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            borderWidth: 2,
                            pointRadius: 0,
                            tension: 0.4,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: false,
                                min: 100,
                                ticks: {
                                    callback: function(value) {
                                        return value + 'ms';
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
                
                // Simulate real-time updates
                setInterval(() => {
                    // Randomly update chart data
                    const data = responseTimeChart.data.datasets[0].data;
                    const lastValue = data[data.length - 1];
                    const newValue = Math.max(100, Math.min(200, lastValue + (Math.random() * 20 - 10)));
                    
                    data.shift();
                    data.push(Math.round(newValue))
                    
                    responseTimeChart.update();
                    updateTimestamps();
                    
                    // Occasionally change status (5% chance)
                    if(Math.random() < 0.05) {
                        const statusIndicators = document.querySelectorAll('[class*="bg-green-100"]');
                        statusIndicators.forEach(indicator => {
                            indicator.classList.remove('bg-green-100', 'text-green-800', 'dark:bg-green-900', 'dark:text-green-200');
                            indicator.classList.add('bg-yellow-100', 'text-yellow-800', 'dark:bg-yellow-900', 'dark:text-yellow-200');
                            
                            // Revert after 5 seconds
                            setTimeout(() => {
                                indicator.classList.remove('bg-yellow-100', 'text-yellow-800', 'dark:bg-yellow-900', 'dark:text-yellow-200');
                                indicator.classList.add('bg-green-100', 'text-green-800', 'dark:bg-green-900', 'dark:text-green-200');
                            }, 5000);
                        });
                    }
                }, 5000);
            } else {
                console.error('Chart.js not loaded. Please check your connection or the script tag.');
                document.getElementById('responseTimeChart').innerHTML = '<div class="flex items-center justify-center h-full bg-gray-100 dark:bg-gray-700 rounded p-4 text-center"><p class="text-gray-500 dark:text-gray-400">Chart could not be loaded. Please refresh the page.</p></div>';
            }
        });
        
        // Animate elements on scroll
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('.slide-in, .fade-in');
            elements.forEach(el => {
                const elementTop = el.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                
                if (elementTop < windowHeight - 100) {
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }
            });
        };
        
        // Set initial state for animations
        document.querySelectorAll('.slide-in').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        });
        
        document.querySelectorAll('.fade-in').forEach(el => {
            el.style.opacity = '0';
            el.style.transition = 'opacity 0.5s ease';
        });
        
        window.addEventListener('load', () => {
            setTimeout(() => {
                animateOnScroll();
            }, 300);
        });
        
        window.addEventListener('scroll', animateOnScroll);
    </script>
</body>
</html>
