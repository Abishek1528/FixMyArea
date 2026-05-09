<x-app-layout>
    <div class="min-h-screen bg-[#0f111a] text-gray-300 font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            
            <!-- Welcome Header -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10 gap-6">
                <div class="flex items-center space-x-4">
                    <div class="bg-[#1e2130] p-3 rounded-2xl shadow-lg border border-[#2d3142]">
                        <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-white tracking-tight">User Dashboard</h1>
                        <p class="text-gray-400 mt-1">Manage and track your reported community issues.</p>
                    </div>
                </div>
                
                <a href="{{ route('issues.create') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-2xl shadow-lg shadow-indigo-500/20 transition-all active:scale-95 group">
                    <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Report New Issue
                </a>
            </div>

            <!-- Stats Overview -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <div class="bg-[#161925] p-6 rounded-3xl border border-[#2d3142] shadow-xl">
                    <p class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-1">Total Reported</p>
                    <p class="text-3xl font-bold text-white">{{ $stats['total'] }}</p>
                </div>
                <div class="bg-[#161925] p-6 rounded-3xl border border-[#2d3142] shadow-xl">
                    <p class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-1">Pending</p>
                    <p class="text-3xl font-bold text-yellow-500">{{ $stats['pending'] }}</p>
                </div>
                <div class="bg-[#161925] p-6 rounded-3xl border border-[#2d3142] shadow-xl">
                    <p class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-1">In Progress</p>
                    <p class="text-3xl font-bold text-blue-500">{{ $stats['in_progress'] }}</p>
                </div>
                <div class="bg-[#161925] p-6 rounded-3xl border border-[#2d3142] shadow-xl">
                    <p class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-1">Resolved</p>
                    <p class="text-3xl font-bold text-green-500">{{ $stats['resolved'] }}</p>
                </div>
            </div>

            <!-- Issues List Section -->
            <div class="bg-[#161925] rounded-3xl border border-[#2d3142] shadow-2xl overflow-hidden">
                <div class="p-8 border-b border-[#2d3142] flex items-center justify-between">
                    <h2 class="text-xl font-bold text-white">Your Reports</h2>
                    <div class="flex items-center space-x-2 text-sm text-gray-500">
                        <span class="w-3 h-3 bg-indigo-500 rounded-full animate-pulse"></span>
                        <span>Live Updates</span>
                    </div>
                </div>

                @if($issues->isEmpty())
                    <div class="p-20 text-center">
                        <div class="bg-[#1e2130] w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 border border-[#2d3142]">
                            <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">No issues reported yet</h3>
                        <p class="text-gray-500 max-w-sm mx-auto mb-8">You haven't submitted any reports. Help improve your community by reporting potholes, broken lights, or waste issues.</p>
                        <a href="{{ route('issues.create') }}" class="text-indigo-400 hover:text-indigo-300 font-semibold underline decoration-2 underline-offset-4">
                            Start your first report
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-[#0f111a]/50 text-gray-400 text-xs uppercase tracking-widest font-bold">
                                    <th class="px-8 py-5 border-b border-[#2d3142]">Issue Details</th>
                                    <th class="px-8 py-5 border-b border-[#2d3142]">Category</th>
                                    <th class="px-8 py-5 border-b border-[#2d3142]">Status</th>
                                    <th class="px-8 py-5 border-b border-[#2d3142]">Reported Date</th>
                                    <th class="px-8 py-5 border-b border-[#2d3142] text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#2d3142]">
                                @foreach($issues as $issue)
                                    <tr class="hover:bg-[#1e2130]/30 transition-colors group">
                                        <td class="px-8 py-6">
                                            <div class="flex flex-col">
                                                <span class="text-white font-semibold group-hover:text-indigo-400 transition-colors">{{ $issue->title }}</span>
                                                <span class="text-gray-500 text-sm mt-1 flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    </svg>
                                                    {{ Str::limit($issue->address ?? 'No address provided', 40) }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6">
                                            <span class="px-3 py-1 bg-[#1e2130] text-indigo-400 rounded-full text-xs font-bold border border-[#2d3142]">
                                                {{ $issue->category }}
                                            </span>
                                        </td>
                                        <td class="px-8 py-6">
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
                                                {{ ucfirst($issue->status) }}
                                            </span>
                                        </td>
                                        <td class="px-8 py-6 text-gray-400 text-sm">
                                            {{ $issue->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-8 py-6 text-right">
                                            <button class="p-2 text-gray-500 hover:text-white transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    @if($issues->hasPages())
                        <div class="px-8 py-6 bg-[#0f111a]/30 border-t border-[#2d3142]">
                            {{ $issues->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
