<x-app-layout>
    <div class="min-h-screen bg-[#0f111a] text-gray-300 font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <!-- Header Section -->
            <div class="flex items-center space-x-4 mb-10">
                <div class="bg-[#1e2130] p-3 rounded-2xl shadow-lg border border-[#2d3142]">
                    <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white tracking-tight">Report an Issue</h1>
                    <p class="text-gray-400 mt-1">Help us improve by reporting issues you encounter in your community.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Form Column -->
                <div class="lg:col-span-2">
                    <div class="bg-[#161925] rounded-3xl p-8 border border-[#2d3142] shadow-2xl">
                        <form method="POST" action="{{ route('issues.store') }}" class="space-y-8">
                            @csrf

                            <!-- Issue Title -->
                            <div class="space-y-2">
                                <label for="title" class="text-sm font-semibold text-gray-400 ml-1 uppercase tracking-wider">Issue Title</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500 group-focus-within:text-indigo-500 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </div>
                                    <input type="text" name="title" id="title" required
                                        class="block w-full pl-12 pr-4 py-4 bg-[#0f111a] border-[#2d3142] rounded-2xl text-white placeholder-gray-600 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all shadow-inner"
                                        placeholder="e.g., Pothole on Main Street">
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>

                            <!-- Category -->
                            <div class="space-y-2">
                                <label for="category" class="text-sm font-semibold text-gray-400 ml-1 uppercase tracking-wider">Category</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500 group-focus-within:text-indigo-500 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                        </svg>
                                    </div>
                                    <select name="category" id="category" required
                                        class="block w-full pl-12 pr-10 py-4 bg-[#0f111a] border-[#2d3142] rounded-2xl text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all appearance-none shadow-inner">
                                        <option value="" disabled selected>Select a Category</option>
                                        <option value="Roads">Roads / Potholes</option>
                                        <option value="Lighting">Street Lighting</option>
                                        <option value="Waste">Waste / Garbage</option>
                                        <option value="Water">Water / Drainage</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-gray-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('category')" />
                            </div>

                            <!-- Description -->
                            <div class="space-y-2">
                                <label for="description" class="text-sm font-semibold text-gray-400 ml-1 uppercase tracking-wider">Description</label>
                                <div class="relative group">
                                    <div class="absolute top-4 left-4 pointer-events-none text-gray-500 group-focus-within:text-indigo-500 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                                        </svg>
                                    </div>
                                    <textarea name="description" id="description" rows="5" required
                                        class="block w-full pl-12 pr-4 py-4 bg-[#0f111a] border-[#2d3142] rounded-2xl text-white placeholder-gray-600 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all shadow-inner resize-none"
                                        placeholder="Describe the issue in detail..."></textarea>
                                    <div class="absolute bottom-4 right-4 text-xs text-gray-600">0/1000</div>
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            <!-- Location -->
                            <div class="space-y-2">
                                <label for="address" class="text-sm font-semibold text-gray-400 ml-1 uppercase tracking-wider">Location Address (Optional)</label>
                                <div class="flex space-x-4">
                                    <div class="relative flex-1 group">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500 group-focus-within:text-indigo-500 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                        <input type="text" name="address" id="address"
                                            class="block w-full pl-12 pr-4 py-4 bg-[#0f111a] border-[#2d3142] rounded-2xl text-white placeholder-gray-600 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all shadow-inner"
                                            placeholder="e.g., 123 Main St, Springfield">
                                    </div>
                                    <button type="button" class="px-6 py-4 bg-[#1e2130] hover:bg-[#2d3142] border border-[#2d3142] text-indigo-400 rounded-2xl flex items-center space-x-2 transition-all shadow-lg active:scale-95">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-3.44A20.01 20.01 0 006 12c0-5.523 4.477-10 10-10s10 4.477 10 10c0 2.11-.653 4.07-1.777 5.69a9.493 9.493 0 01-3.44 3.44M8 21l4-4 4 4m-4-4v8" />
                                        </svg>
                                        <span class="font-semibold text-sm whitespace-nowrap">Use My Location</span>
                                    </button>
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('address')" />
                            </div>

                            <!-- Image Upload Placeholder -->
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-gray-400 ml-1 uppercase tracking-wider">Add Photos (Optional)</label>
                                <div class="border-2 border-dashed border-[#2d3142] rounded-3xl p-10 flex flex-col items-center justify-center space-y-4 hover:border-indigo-500/50 transition-colors bg-[#0f111a]/50 cursor-pointer group">
                                    <div class="bg-[#1e2130] p-4 rounded-full group-hover:scale-110 transition-transform shadow-xl">
                                        <svg class="w-8 h-8 text-gray-500 group-hover:text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-white font-medium">Drag and drop images here, or click to browse</p>
                                        <p class="text-sm text-gray-500 mt-1">JPG, PNG up to 5MB</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex items-center space-x-6 pt-6">
                                <button type="submit"
                                    class="px-10 py-4 bg-indigo-600 hover:bg-indigo-500 text-white rounded-2xl font-bold shadow-xl shadow-indigo-500/20 transition-all active:scale-95 flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                    </svg>
                                    <span>Submit Report</span>
                                </button>
                                <a href="{{ route('dashboard') }}"
                                    class="px-8 py-4 bg-[#1e2130] hover:bg-[#2d3142] text-gray-400 hover:text-white rounded-2xl font-bold transition-all">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Sidebar Tips Column -->
                <div class="space-y-8">
                    <!-- Tips Card -->
                    <div class="bg-[#161925] rounded-3xl p-8 border border-[#2d3142] shadow-xl">
                        <div class="flex items-center space-x-3 mb-6">
                            <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.674a1 1 0 00.951-.658l1.393-4.179a3 3 0 00-.515-2.903L14.306 7.961A1.104 1.104 0 0013.07 6H10.93a1.104 1.104 0 00-1.238 1.961l-1.801 1.3a3 3 0 00-.515 2.903l1.393 4.179a1 1 0 00.951.658z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21v-1" />
                            </svg>
                            <h3 class="text-xl font-bold text-white">Tips for a better report</h3>
                        </div>
                        <ul class="space-y-6">
                            <li class="flex items-start space-x-4">
                                <div class="bg-[#1e2130] p-2 rounded-xl text-indigo-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-white font-semibold mb-1">Be specific and clear</p>
                                    <p class="text-sm text-gray-500 leading-relaxed">Provide as much detail as possible to help us understand the context.</p>
                                </div>
                            </li>
                            <li class="flex items-start space-x-4">
                                <div class="bg-[#1e2130] p-2 rounded-xl text-indigo-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-white font-semibold mb-1">Add location</p>
                                    <p class="text-sm text-gray-500 leading-relaxed">Helps us find and fix the issue faster in your neighborhood.</p>
                                </div>
                            </li>
                            <li class="flex items-start space-x-4">
                                <div class="bg-[#1e2130] p-2 rounded-xl text-indigo-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-white font-semibold mb-1">Include photos</p>
                                    <p class="text-sm text-gray-500 leading-relaxed">Images help us visually verify and assess the severity.</p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Community Banner -->
                    <div class="bg-gradient-to-br from-indigo-900/40 to-[#161925] rounded-3xl p-8 border border-indigo-500/20 text-center shadow-xl relative overflow-hidden group">
                        <div class="absolute -right-4 -top-4 w-24 h-24 bg-indigo-500/10 rounded-full blur-2xl group-hover:bg-indigo-500/20 transition-all"></div>
                        <div class="relative z-10">
                            <div class="mb-6 flex justify-center">
                                <div class="relative">
                                    <svg class="w-20 h-20 text-indigo-400 opacity-20" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <svg class="w-10 h-10 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <h4 class="text-xl font-bold text-white mb-2">Together, we can make our community better!</h4>
                            <p class="text-sm text-gray-400 mb-6 leading-relaxed">Thank you for taking the time to report this issue. Your contribution matters.</p>
                            <div class="flex justify-center">
                                <svg class="w-8 h-8 text-indigo-500 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
