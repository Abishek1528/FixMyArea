<x-app-layout>
    <div class="min-h-screen bg-primary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10 gap-6">
                <div class="flex items-center space-x-4">
                    <div class="bg-gradient-to-br from-primary-600 to-primary-700 p-3 rounded-2xl shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-primary-900 tracking-tight">Community Issues</h1>
                        <p class="text-gray-500 mt-1">Browse and upvote issues reported by your neighbors.</p>
                    </div>
                </div>
                
                @auth
                    <a href="{{ route('issues.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-br from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-semibold rounded-2xl shadow-lg shadow-primary-500/20 transition-all active:scale-95 group">
                        <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                        </svg>
                        Report New Issue
                    </a>
                @endauth
            </div>

            <!-- Issues Grid -->
            @if($issues->isEmpty())
                <div class="p-20 text-center">
                    <div class="bg-primary-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 border border-primary-100">
                        <svg class="w-10 h-10 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-primary-900 mb-2">No issues yet</h3>
                    <p class="text-gray-500 max-w-sm mx-auto mb-8">Be the first to report an issue in your community!</p>
                    @auth
                        <a href="{{ route('issues.create') }}" class="text-primary-600 hover:text-primary-700 font-semibold underline decoration-2 underline-offset-4">
                            Start your first report
                        </a>
                    @endauth
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($issues as $issue)
                        <div class="bg-white rounded-3xl border border-primary-100 shadow-2xl overflow-hidden hover:shadow-primary-500/10 hover:border-primary-300 transition-all group">
                            @if($issue->image)
                                <div class="h-48 overflow-hidden">
                                    <img src="{{ Storage::url($issue->image) }}" alt="{{ $issue->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                            @endif
                            <div class="p-6">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center space-x-2">
                                        <span class="px-3 py-1 bg-primary-50 text-primary-700 rounded-full text-xs font-bold border border-primary-200">
                                            {{ $issue->category }}
                                        </span>
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
                                            {{ ucfirst(str_replace('_', ' ', $issue->status)) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <a href="{{ route('issues.show', $issue) }}" class="block">
                                    <h3 class="text-lg font-semibold text-primary-900 group-hover:text-primary-700 transition-colors mb-2">
                                        {{ $issue->title }}
                                    </h3>
                                </a>
                                
                                <p class="text-gray-500 text-sm leading-relaxed mb-4 line-clamp-3">
                                    {{ Str::limit($issue->description, 100) }}
                                </p>

                                @if($issue->address)
                                    <div class="flex items-center text-gray-500 text-xs mb-4">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        </svg>
                                        {{ Str::limit($issue->address, 30) }}
                                    </div>
                                @endif

                                <div class="flex items-center justify-between pt-4 border-t border-primary-100">
                                    <div class="flex items-center text-gray-500 text-xs">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        {{ $issue->user->name }}
                                    </div>

                                    @auth
                                        <form action="{{ route('issues.upvote', $issue) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="flex items-center space-x-1 px-3 py-1.5 rounded-xl transition-all {{ auth()->user()->upvotedIssues()->where('issue_id', $issue->id)->exists() ? 'bg-primary-50 text-primary-700 border border-primary-200' : 'bg-primary-50 text-gray-500 border border-primary-100 hover:text-primary-700 hover:border-primary-300' }}">
                                                <svg class="w-4 h-4" fill="{{ auth()->user()->upvotedIssues()->where('issue_id', $issue->id)->exists() ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                                </svg>
                                                <span class="text-xs font-semibold">{{ $issue->upvotes_count }}</span>
                                            </button>
                                        </form>
                                    @endauth
                                    @guest
                                        <div class="flex items-center space-x-1 px-3 py-1.5 rounded-xl bg-primary-50 text-gray-500 border border-primary-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                            </svg>
                                            <span class="text-xs font-semibold">{{ $issue->upvotes_count }}</span>
                                        </div>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($issues->hasPages())
                    <div class="mt-10 px-8 py-6 bg-white rounded-3xl border border-primary-100">
                        {{ $issues->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-app-layout>
