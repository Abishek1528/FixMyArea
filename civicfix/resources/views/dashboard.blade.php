<x-app-layout>
    <div class="min-h-screen bg-primary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            
            <!-- Welcome Header -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10 gap-6">
                <div class="flex items-center space-x-4">
                    <div class="bg-gradient-to-br from-primary-600 to-primary-700 p-3 rounded-2xl shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-primary-900 tracking-tight">User Dashboard</h1>
                        <p class="text-gray-500 mt-1">Manage and track your reported community issues.</p>
                    </div>
                </div>
                
                <a href="{{ route('issues.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-br from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-semibold rounded-2xl shadow-lg shadow-primary-500/20 transition-all active:scale-95 group">
                    <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    Report New Issue
                </a>
            </div>

            <!-- Stats Overview -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <div class="bg-white p-6 rounded-3xl border border-primary-100 shadow-xl">
                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-1">Total Reported</p>
                    <p class="text-3xl font-bold text-primary-900">{{ $stats['total'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-primary-100 shadow-xl">
                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-1">Pending</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ $stats['pending'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-primary-100 shadow-xl">
                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-1">In Progress</p>
                    <p class="text-3xl font-bold text-primary-600">{{ $stats['in_progress'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-primary-100 shadow-xl">
                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-1">Resolved</p>
                    <p class="text-3xl font-bold text-green-600">{{ $stats['resolved'] }}</p>
                </div>
            </div>

            <!-- Issues List Section -->
            <div class="bg-white rounded-3xl border border-primary-100 shadow-2xl overflow-hidden">
                <div class="p-8 border-b border-primary-100 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-primary-900">Your Reports</h2>
                    <div class="flex items-center space-x-2 text-sm text-gray-500">
                        <span class="w-3 h-3 bg-primary-500 rounded-full animate-pulse"></span>
                        <span>Live Updates</span>
                    </div>
                </div>

                @if($issues->isEmpty())
                    <div class="p-20 text-center">
                        <div class="bg-primary-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 border border-primary-100">
                            <svg class="w-10 h-10 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-primary-900 mb-2">No issues reported yet</h3>
                        <p class="text-gray-500 max-w-sm mx-auto mb-8">You haven't submitted any reports. Help improve your community by reporting potholes, broken lights, or waste issues.</p>
                        <a href="{{ route('issues.create') }}" class="text-primary-600 hover:text-primary-700 font-semibold underline decoration-2 underline-offset-4">
                            Start your first report
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-primary-50 text-gray-500 text-xs uppercase tracking-widest font-bold">
                                    <th class="px-8 py-5 border-b border-primary-100">Issue Details</th>
                                    <th class="px-8 py-5 border-b border-primary-100">Category</th>
                                    <th class="px-8 py-5 border-b border-primary-100">Status</th>
                                    <th class="px-8 py-5 border-b border-primary-100">Reported Date</th>
                                    <th class="px-8 py-5 border-b border-primary-100 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-primary-100">
                                @foreach($issues as $issue)
                                    <tr class="hover:bg-primary-50 transition-colors group">
                                        <td class="px-8 py-6">
                                            <div class="flex items-start gap-4">
                                                @if($issue->image)
                                                    <div class="flex-shrink-0 w-16 h-16 rounded-xl overflow-hidden border border-primary-100 shadow">
                                                        <img src="{{ Storage::url($issue->image) }}" alt="{{ $issue->title }}" class="w-full h-full object-cover">
                                                    </div>
                                                @endif
                                                <div class="flex flex-col">
                                                    <a href="{{ route('issues.show', $issue) }}" class="text-primary-900 font-semibold group-hover:text-primary-700 transition-colors">{{ $issue->title }}</a>
                                                    <span class="text-gray-500 text-sm mt-1 flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                        </svg>
                                                        {{ Str::limit($issue->address ?? 'No address provided', 40) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6">
                                            <span class="px-3 py-1 bg-primary-50 text-primary-700 rounded-full text-xs font-bold border border-primary-200">
                                                {{ $issue->category }}
                                            </span>
                                        </td>
                                        <td class="px-8 py-6">
                                            @php
                                                $statusColors = [
                                                    'pending' => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                                                    'investigating' => 'bg-blue-50 text-blue-700 border-blue-200',
                                                    'in_progress' => 'bg-primary-50 text-primary-700 border-primary-200',
                                                    'resolved' => 'bg-green-50 text-green-700 border-green-200',
                                                    'closed' => 'bg-gray-50 text-gray-700 border-gray-200',
                                                ];
                                                $colorClass = $statusColors[$issue->status] ?? $statusColors['pending'];
                                            @endphp
                                            <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $colorClass }}">
                                                {{ ucfirst($issue->status) }}
                                            </span>
                                        </td>
                                        <td class="px-8 py-6 text-gray-500 text-sm">
                                            {{ $issue->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-8 py-6 text-right">
                                            <a href="{{ route('issues.show', $issue) }}" class="p-2 text-gray-500 hover:text-primary-700 transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    @if($issues->hasPages())
                        <div class="px-8 py-6 bg-primary-50 border-t border-primary-100">
                            {{ $issues->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
