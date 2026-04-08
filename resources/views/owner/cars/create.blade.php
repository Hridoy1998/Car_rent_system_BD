<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-white bg-gray-950">
            {{ __('List a New Car') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen text-slate-200">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg border border-white/5 p-8">

                @if ($errors->any())
                    <div class="mb-4 bg-red-500/10 border border-red-500/50 text-red-500 p-4 rounded-xl">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('owner.cars.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Basics -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Listing Title</label>
                            <input type="text" name="title" required class="w-full bg-gray-950 border border-white/10 rounded-lg text-white focus:ring-indigo-500 focus:border-indigo-500 p-2.5" placeholder="e.g. 2021 Toyota Corolla LE">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Location / Pickup Area</label>
                            <input type="text" name="location" required class="w-full bg-gray-950 border border-white/10 rounded-lg text-white focus:ring-indigo-500 focus:border-indigo-500 p-2.5" placeholder="e.g. Gulshan 1, Dhaka">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Brand</label>
                            <input type="text" name="brand" required class="w-full bg-gray-950 border border-white/10 rounded-lg text-white focus:ring-indigo-500 focus:border-indigo-500 p-2.5" placeholder="Toyota">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Model</label>
                            <input type="text" name="model" required class="w-full bg-gray-950 border border-white/10 rounded-lg text-white focus:ring-indigo-500 focus:border-indigo-500 p-2.5" placeholder="Corolla">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Year</label>
                            <input type="number" name="year" min="1900" max="{{ date('Y')+1 }}" required class="w-full bg-gray-950 border border-white/10 rounded-lg text-white focus:ring-indigo-500 focus:border-indigo-500 p-2.5" placeholder="2021">
                        </div>
                    </div>

                    <!-- Specs -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Type</label>
                            <select name="type" required class="w-full bg-gray-950 border border-white/10 rounded-lg text-white focus:ring-indigo-500 focus:border-indigo-500 p-2.5">
                                <option value="Sedan">Sedan</option>
                                <option value="SUV">SUV</option>
                                <option value="Hatchback">Hatchback</option>
                                <option value="Van">Van</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Transmission</label>
                            <select name="transmission" required class="w-full bg-gray-950 border border-white/10 rounded-lg text-white focus:ring-indigo-500 focus:border-indigo-500 p-2.5">
                                <option value="Auto">Automatic</option>
                                <option value="Manual">Manual</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Fuel Type</label>
                            <input type="text" name="fuel_type" required class="w-full bg-gray-950 border border-white/10 rounded-lg text-white focus:ring-indigo-500 focus:border-indigo-500 p-2.5" placeholder="Petrol / Hybrid">
                        </div>
                    </div>

                    <!-- Pricing -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Price per Day (৳)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">৳</span>
                                <input type="number" name="price_per_day" required min="0" class="w-full bg-gray-950 border border-white/10 rounded-lg text-white focus:ring-indigo-500 focus:border-indigo-500 p-2.5 pl-8" placeholder="3500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Price per Month (৳) <span class="text-xs text-gray-500">(Optional)</span></label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">৳</span>
                                <input type="number" name="price_per_month" min="0" class="w-full bg-gray-950 border border-white/10 rounded-lg text-white focus:ring-indigo-500 focus:border-indigo-500 p-2.5 pl-8" placeholder="80000" required>
                            </div>
                        </div>
                    </div>

                    <!-- Details -->
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Description</label>
                        <textarea name="description" rows="4" class="w-full bg-gray-950 border border-white/10 rounded-lg text-white focus:ring-indigo-500 focus:border-indigo-500 p-2.5" placeholder="Detail any specific features, rules, or conditions of the car..."></textarea>
                    </div>

                    <!-- Images -->
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Images (Multiple)</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-white/10 border-dashed rounded-lg bg-gray-950/50 hover:bg-gray-950 transition-colors">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-400 justify-center">
                                    <label class="relative cursor-pointer bg-transparent rounded-md font-medium text-indigo-500 hover:text-indigo-400 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Upload files</span>
                                        <input id="images" name="images[]" type="file" multiple class="sr-only" accept="image/*">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, WEBP up to 2MB per image</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t border-white/10">
                        <a href="{{ route('owner.cars.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-300 hover:text-white mr-4">Cancel</a>
                        <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white rounded-lg font-bold shadow-[0_0_15px_rgba(79,70,229,0.3)] transition-all">List Car</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
