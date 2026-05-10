<x-app-layout>
    <div class="min-h-screen bg-[#0f111a] text-gray-300 font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            
            <!-- Header -->
            <div class="flex items-center space-x-4 mb-8">
                <a href="{{ route('dashboard') }}" class="p-2 hover:bg-[#1e2130] rounded-xl transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-white tracking-tight">Community Map</h1>
                    <p class="text-gray-400 mt-1">View all reported issues in your community</p>
                </div>
            </div>

            <!-- Stats Bar -->
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
                @php
                    $stats = [
                        'total' => $issues->count(),
                        'pending' => $issues->where('status', 'pending')->count(),
                        'investigating' => $issues->where('status', 'investigating')->count(),
                        'in_progress' => $issues->where('status', 'in_progress')->count(),
                        'resolved' => $issues->where('status', 'resolved')->count(),
                    ];
                    $statusLabels = [
                        'total' => 'Total',
                        'pending' => 'Pending',
                        'investigating' => 'Investigating',
                        'in_progress' => 'In Progress',
                        'resolved' => 'Resolved',
                    ];
                @endphp
                @foreach($stats as $key => $count)
                    <div class="bg-[#161925] p-4 rounded-2xl border border-[#2d3142] text-center">
                        <p class="text-2xl font-bold text-white">{{ $count }}</p>
                        <p class="text-xs text-gray-500 mt-1 uppercase tracking-wider">{{ $statusLabels[$key] }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Map Container -->
            <div class="bg-[#161925] rounded-3xl border border-[#2d3142] shadow-2xl overflow-hidden">
                <div id="map" class="w-full h-[600px] rounded-3xl"></div>
            </div>

            <!-- Legend -->
            <div class="mt-6 bg-[#161925] rounded-3xl border border-[#2d3142] p-6">
                <h3 class="text-white font-semibold mb-4">Issue Categories</h3>
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                    @php
                        $categoryColors = [
                            'Roads' => 'bg-red-500',
                            'Lighting' => 'bg-yellow-500',
                            'Waste' => 'bg-green-500',
                            'Water' => 'bg-blue-500',
                            'Other' => 'bg-purple-500',
                        ];
                    @endphp
                    @foreach(['Roads', 'Lighting', 'Waste', 'Water', 'Other'] as $category)
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 rounded-full {{ $categoryColors[$category] }}"></div>
                            <span class="text-gray-400 text-sm">{{ $category }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    
    <style>
        .custom-marker {
            background: transparent !important;
            border: none !important;
        }
    </style>
    
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Map initializing...');
            
            // Initialize the map
            const map = L.map('map').setView([12.9532, 77.6189], 13);

            // Add OpenStreetMap tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19,
            }).addTo(map);

            // Category colors
            const categoryColors = {
                'Roads': '#ef4444',
                'Lighting': '#eab308',
                'Waste': '#22c55e',
                'Water': '#3b82f6',
                'Other': '#a855f7',
            };

            // Status colors for popup
            const statusColors = {
                'pending': '#eab308',
                'investigating': '#3b82f6',
                'in_progress': '#6366f1',
                'resolved': '#22c55e',
                'closed': '#6b7280',
            };

            // Add markers for all issues
            const issues = @json($issues);
            console.log('Issues data:', issues);
            
            issues.forEach((issue, index) => {
                console.log(`Processing issue ${index}:`, issue);
                const lat = parseFloat(issue.latitude);
                const lng = parseFloat(issue.longitude);
                
                if (lat && lng) {
                    console.log(`Adding marker for issue at:`, lat, lng);
                    const color = categoryColors[issue.category] || '#6366f1';
                    
                    // Create custom icon with color
                    const customIcon = L.divIcon({
                        className: 'custom-marker',
                        html: `<div style="
                            background-color: ${color}; 
                            width: 36px; 
                            height: 36px; 
                            border-radius: 50%; 
                            display: flex; 
                            align-items: center; 
                            justify-content: center; 
                            border: 4px solid white; 
                            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
                            position: relative;
                        ">
                            <div style="
                                width: 0;
                                height: 0;
                                border-left: 8px solid transparent;
                                border-right: 8px solid transparent;
                                border-top: 12px solid ${color};
                                position: absolute;
                                bottom: -12px;
                            "></div>
                        </div>`,
                        iconSize: [36, 48],
                        iconAnchor: [18, 48],
                        popupAnchor: [0, -48],
                    });

                    // Create marker
                    const marker = L.marker([lat, lng], { icon: customIcon })
                        .addTo(map);

                    // Create popup content
                    const popupContent = `
                        <div style="min-width: 200px;">
                            <h3 style="font-weight: bold; margin-bottom: 8px; color: #1f2937;">${issue.title}</h3>
                            <div style="margin-bottom: 8px;">
                                <span style="display: inline-block; padding: 2px 8px; border-radius: 9999px; font-size: 12px; font-weight: bold; background-color: ${statusColors[issue.status]}20; color: ${statusColors[issue.status]}; border: 1px solid ${statusColors[issue.status]}40;">
                                    ${issue.status.charAt(0).toUpperCase() + issue.status.slice(1).replace('_', ' ')}
                                </span>
                                <span style="display: inline-block; padding: 2px 8px; border-radius: 9999px; font-size: 12px; font-weight: bold; background-color: ${color}20; color: ${color}; border: 1px solid ${color}40; margin-left: 4px;">
                                    ${issue.category}
                                </span>
                            </div>
                            <p style="margin-bottom: 8px; color: #4b5563; font-size: 14px;">${issue.description.substring(0, 100)}${issue.description.length > 100 ? '...' : ''}</p>
                            ${issue.address ? `<p style="margin-bottom: 8px; color: #6b7280; font-size: 12px;">📍 ${issue.address}</p>` : ''}
                        </div>
                    `;

                    marker.bindPopup(popupContent);
                    console.log('Marker added successfully');
                } else {
                    console.log('Skipping issue without coordinates:', issue);
                }
            });
        });
    </script>
</x-app-layout>
