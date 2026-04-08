<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-white bg-gray-950">
            {{ __('Edit Car: ') . $car->title }}
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

                <form action="{{ route('owner.cars.update', $car) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Basics -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Listing Title</label>
                            <input type="text" name="title" value="{{ old('title', $car->title) }}" required class="w-full bg-gray-950 border border-white/10 rounded-lg text-white focus:ring-indigo-500 focus:border-indigo-500 p-2.5">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Location / Pickup Area</label>
                            <input type="text" name="location" value="{{ old('location', $car->location) }}" required class="w-full bg-gray-950 border border-white/10 rounded-lg text-white focus:ring-indigo-500 focus:border-indigo-500 p-2.5">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Brand</label>
                            <input type="text" name="brand" value="{{ old('brand', $car->brand) }}" required class="w-full bg-gray-950 border border-white/10 rounded-lg text-white focus:ring-indigo-500 focus:border-indigo-500 p-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Model</label>
                            <input type="text" name="model" value="{{ old('model', $car->model) }}" required class="w-full bg-gray-950 border border-white/10 rounded-lg text-white focus:ring-indigo-500 focus:border-indigo-500 p-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Year</label>
                            <input type="number" name="year" value="{{ old('year', $car->year) }}" min="1900" max="{{ date('Y')+1 }}" required class="w-full bg-gray-950 border border-white/10 rounded-lg text-white focus:ring-indigo-500 focus:border-indigo-500 p-2.5">
                        </div>
                    </div>

                    <!-- Specs -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Type</label>
                            <select name="type" required class="w-full bg-gray-950 border border-white/10 rounded-lg text-white focus:ring-indigo-500 focus:border-indigo-500 p-2.5">
                                <option value="Sedan" {{ $car->type === 'Sedan' ? 'selected' : '' }}>Sedan</option>
                                <option value="SUV" {{ $car->type === 'SUV' ? 'selected' : '' }}>SUV</option>
                                <option value="Hatchback" {{ $car->type === 'Hatchback' ? 'selected' : '' }}>Hatchback</option>
                                <option value="Van" {{ $car->type === 'Van' ? 'selected' : '' }}>Van</option>
                                <option value="Other" {{ $car->type === 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Transmission</label>
                            <select name="transmission" required class="w-full bg-gray-950 border border-white/10 rounded-lg text-white focus:ring-indigo-500 focus:border-indigo-500 p-2.5">
                                <option value="Auto" {{ $car->transmission === 'Auto' ? 'selected' : '' }}>Automatic</option>
                                <option value="Manual" {{ $car->transmission === 'Manual' ? 'selected' : '' }}>Manual</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Fuel Type</label>
                            <input type="text" name="fuel_type" value="{{ old('fuel_type', $car->fuel_type) }}" required class="w-full bg-gray-950 border border-white/10 rounded-lg text-white focus:ring-indigo-500 focus:border-indigo-500 p-2.5">
                        </div>
                    </div>

                    <!-- Details -->
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Description</label>
                        <textarea name="description" rows="4" class="w-full bg-gray-950 border border-white/10 rounded-lg text-white focus:ring-indigo-500 focus:border-indigo-500 p-2.5">{{ old('description', $car->description) }}</textarea>
                    </div>

                    <!-- Pricing -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Price per Day (৳)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">৳</span>
                                <input type="number" name="price_per_day" value="{{ old('price_per_day', (int)$car->price_per_day) }}" required min="0" class="w-full bg-gray-950 border border-white/10 rounded-lg text-white focus:ring-indigo-500 focus:border-indigo-500 p-2.5 pl-8">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Price per Month (৳) <span class="text-xs text-gray-500">(Optional)</span></label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">৳</span>
                                <input type="number" name="price_per_month" value="{{ old('price_per_month', (int)$car->price_per_month) }}" min="0" class="w-full bg-gray-950 border border-white/10 rounded-lg text-white focus:ring-indigo-500 focus:border-indigo-500 p-2.5 pl-8" required>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t border-white/10">
                        <a href="{{ route('owner.cars.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-300 hover:text-white mr-4">Cancel</a>
                        <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white rounded-lg font-bold shadow-[0_0_15px_rgba(79,70,229,0.3)] transition-all">Save Changes</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
