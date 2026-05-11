<x-app-layout>
    <div class="min-h-screen bg-[#0f111a] text-gray-300 font-sans">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            
            @if (session('status') === 'status-updated')
                <div class="mb-8 p-4 bg-green-500/10 border-l-4 border-green-500 text-green-400 shadow-sm rounded-r-lg" role="alert">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="font-bold">{{ session('message') }}</p>
                    </div>
                </div>
            @endif

            <!-- Header -->
            <div class="flex items-center space-x-4 mb-8">
                <a href="{{ route('dashboard') }}" class="p-2 hover:bg-[#1e2130] rounded-xl transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div class="flex-1">
                    <h1 class="text-2xl font-bold text-white tracking-tight">{{ $issue->title }}</h1>
                    <div class="flex items-center space-x-3 mt-2">
                        <span class="px-3 py-1 bg-[#1e2130] text-indigo-400 rounded-full text-xs font-bold border border-[#2d3142]">
                            {{ $issue->category }}
                        </span>
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20',
                                'investigating' => 'bg-blue-500/10 text-blue-500 border-blue-500/20',
                                'in_progress' => 'bg-indigo-500/10 text-indigo-500 border-indigo-500/20',
                                'resolved' => 'bg-green-500/10 text-green-500 border-green-500/20',
                                'closed' => 'bg-gray-500/10 text-gray-500 border-gray-500/20',
                            ];
                            $colorClass = $statusColors[$issue->status] ?? $statusColors['pending'];
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $colorClass }}">
                            {{ ucfirst(str_replace('_', ' ', $issue->status)) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Image Card -->
                    @if($issue->image)
                        <div class="bg-[#161925] rounded-3xl border border-[#2d3142] shadow-2xl overflow-hidden">
                            <img src="{{ Storage::url($issue->image) }}" alt="{{ $issue->title }}" class="w-full h-auto object-cover">
                        </div>
                    @endif
                    <!-- Issue Details Card -->
                    <div class="bg-[#161925] rounded-3xl border border-[#2d3142] shadow-2xl p-8">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="bg-[#1e2130] p-2 rounded-xl">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h2 class="text-lg font-semibold text-white">Description</h2>
                        </div>
                        <p class="text-gray-400 leading-relaxed">{{ $issue->description }}</p>
                    </div>

                    <!-- Location Card -->
                    @if($issue->address)
                        <div class="bg-[#161925] rounded-3xl border border-[#2d3142] shadow-2xl p-8">
                            <div class="flex items-center space-x-3 mb-6">
                                <div class="bg-[#1e2130] p-2 rounded-xl">
                                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <h2 class="text-lg font-semibold text-white">Location</h2>
                            </div>
                            <p class="text-gray-400">{{ $issue->address }}</p>
                        </div>
                    @endif

                    <!-- Timeline -->
                    <div class="bg-[#161925] rounded-3xl border border-[#2d3142] shadow-2xl p-8">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="bg-[#1e2130] p-2 rounded-xl">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h2 class="text-lg font-semibold text-white">Lifecycle Timeline</h2>
                        </div>
                        
                        @php
                            $timelineSteps = [
                                'pending' => ['title' => 'Reported', 'description' => 'Issue has been submitted and is awaiting review'],
                                'investigating' => ['title' => 'Investigating', 'description' => 'Issue is being investigated'],
                                'in_progress' => ['title' => 'In Progress', 'description' => 'Work has started on fixing this issue'],
                                'resolved' => ['title' => 'Resolved', 'description' => 'Issue has been fixed'],
                                'closed' => ['title' => 'Closed', 'description' => 'Issue has been closed'],
                            ];
                            $statusOrder = ['pending', 'investigating', 'in_progress', 'resolved', 'closed'];
                            $currentIndex = array_search($issue->status, $statusOrder);
                        @endphp

                        <div class="space-y-8">
                            @foreach($statusOrder as $index => $status)
                                @if(array_key_exists($status, $timelineSteps))
                                    <div class="flex items-start space-x-4">
                                        <div class="flex flex-col items-center">
                                            <div class="w-10 h-10 rounded-full flex items-center justify-center border-2 @if($index <= $currentIndex) border-green-500 bg-green-500/10 @else border-gray-600 bg-[#1e2130] @endif">
                                                @if($index < $currentIndex)
                                                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                    </svg>
                                                @elseif($index === $currentIndex)
                                                    <div class="w-3 h-3 rounded-full bg-indigo-500 animate-pulse"></div>
                                                @else
                                                    <div class="w-3 h-3 rounded-full bg-gray-600"></div>
                                                @endif
                                            </div>
                                            @if($index < count($statusOrder) - 1)
                                                <div class="w-0.5 h-16 @if($index < $currentIndex) bg-green-500 @else bg-gray-700 @endif"></div>
                                            @endif
                                        </div>
                                        <div class="flex-1 pt-2">
                                            <h3 class="text-white font-semibold">{{ $timelineSteps[$status]['title'] }}</h3>
                                            <p class="text-gray-500 text-sm mt-1">{{ $timelineSteps[$status]['description'] }}</p>
                                            @if($status === $issue->status)
                                                <p class="text-indigo-400 text-xs mt-2">Current Status</p>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Quick Actions -->
                    <div class="bg-[#161925] rounded-3xl border border-[#2d3142] shadow-2xl p-6">
                        <h3 class="text-white font-semibold mb-4">Quick Actions</h3>
                        <a href="{{ route('issues.edit', $issue) }}" class="w-full inline-flex items-center justify-center px-4 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-2xl shadow-lg shadow-indigo-500/20 transition-all active:scale-95">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Update Status
                        </a>
                    </div>

                    <!-- Info Card -->
                    <div class="bg-[#161925] rounded-3xl border border-[#2d3142] shadow-2xl p-6">
                        <h3 class="text-white font-semibold mb-4">Report Information</h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-gray-500 text-xs uppercase tracking-wider font-semibold mb-1">Reported On</p>
                                <p class="text-gray-300">{{ $issue->created_at->format('F d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500 text-xs uppercase tracking-wider font-semibold mb-1">Last Updated</p>
                                <p class="text-gray-300">{{ $issue->updated_at->format('F d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500 text-xs uppercase tracking-wider font-semibold mb-1">Report ID</p>
                                <p class="text-gray-300 font-mono text-sm">#{{ str_pad($issue->id, 6, '0', STR_PAD_LEFT) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
