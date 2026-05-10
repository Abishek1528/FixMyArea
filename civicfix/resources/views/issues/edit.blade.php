<x-app-layout>
    <div class="min-h-screen bg-[#0f111a] text-gray-300 font-sans">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            
            <!-- Header -->
            <div class="flex items-center space-x-4 mb-10">
                <a href="{{ route('issues.show', $issue) }}" class="p-2 hover:bg-[#1e2130] rounded-xl transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-white tracking-tight">Update Issue Status</h1>
                    <p class="text-gray-400 mt-1">{{ $issue->title }}</p>
                </div>
            </div>

            <div class="bg-[#161925] rounded-3xl border border-[#2d3142] shadow-2xl p-8">
                <form method="POST" action="{{ route('issues.update', $issue) }}" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <!-- Status Selection -->
                    <div class="space-y-3">
                        <label class="text-sm font-semibold text-gray-400 ml-1 uppercase tracking-wider">Current Status</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @php
                                $statusOptions = [
                                    'pending' => ['label' => 'Pending', 'color' => 'border-yellow-500 text-yellow-500', 'icon' => '⏳'],
                                    'investigating' => ['label' => 'Investigating', 'color' => 'border-blue-500 text-blue-500', 'icon' => '🔍'],
                                    'in_progress' => ['label' => 'In Progress', 'color' => 'border-indigo-500 text-indigo-500', 'icon' => '🔧'],
                                    'resolved' => ['label' => 'Resolved', 'color' => 'border-green-500 text-green-500', 'icon' => '✅'],
                                    'closed' => ['label' => 'Closed', 'color' => 'border-gray-500 text-gray-500', 'icon' => '🔒'],
                                ];
                            @endphp
                            
                            @foreach($statusOptions as $value => $option)
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="status" value="{{ $value }}" 
                                        class="peer sr-only" 
                                        {{ $issue->status === $value ? 'checked' : '' }}
                                        required>
                                    <div class="p-4 bg-[#0f111a] border-2 rounded-2xl transition-all {{ $issue->status === $value ? $option['color'] . ' bg-opacity-50' : 'border-[#2d3142] text-gray-400 hover:border-gray-600' }} peer-checked:{{ $option['color'] }}">
                                        <div class="flex items-center space-x-3">
                                            <span class="text-2xl">{{ $option['icon'] }}</span>
                                            <div class="flex-1">
                                                <p class="font-semibold">{{ $option['label'] }}</p>
                                            </div>
                                            <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center {{ $issue->status === $value ? 'border-current' : 'border-gray-600' }}">
                                                @if($issue->status === $value)
                                                    <div class="w-2.5 h-2.5 rounded-full bg-current"></div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('status')" />
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('issues.show', $issue) }}" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-[#1e2130] hover:bg-[#2d3142] text-gray-300 font-semibold rounded-2xl border border-[#2d3142] transition-all">
                            Cancel
                        </a>
                        <button type="submit" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-2xl shadow-lg shadow-indigo-500/20 transition-all active:scale-95">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
