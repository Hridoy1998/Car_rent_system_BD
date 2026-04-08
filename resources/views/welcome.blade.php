<x-public-layout>
    <!-- Hero Section -->
    <div class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <!-- Abstract glowing background element -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[1000px] h-[500px] bg-gradient-to-tr from-indigo-500/20 via-purple-500/20 to-transparent blur-[120px] rounded-full pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-8">
                Rent the perfect car.<br/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400">
                    Anywhere in Bangladesh.
                </span>
            </h1>
            <p class="max-w-2xl mx-auto text-lg md:text-xl text-gray-400 mb-12">
                Skip the rental counter. Rent unique, highly-rated cars directly from verified local owners in Dhaka, Chittagong, and beyond.
            </p>

            <!-- Search Bar Glassmorphism -->
            <div class="max-w-4xl mx-auto bg-white/5 backdrop-blur-xl border border-white/10 p-2 rounded-3xl shadow-2xl shadow-black/50">
                <form action="{{ route('search') }}" method="GET" class="flex flex-col md:flex-row items-center gap-2">
                    <div class="w-full relative px-4 py-3 bg-gray-900/50 rounded-2xl">
                        <label class="block text-xs text-gray-400 font-medium uppercase tracking-wider mb-1">Where</label>
                        <input type="text" name="location" placeholder="City, Airport, or Address" class="w-full bg-transparent border-none text-white focus:ring-0 p-0 placeholder-gray-600 text-lg">
                    </div>
                    <div class="w-full md:w-auto flex-shrink-0 flex gap-2">
                        <div class="px-4 py-3 bg-gray-900/50 rounded-2xl">
                            <label class="block text-xs text-gray-400 font-medium uppercase tracking-wider mb-1">From</label>
                            <input type="date" disabled class="bg-transparent border-none text-white focus:ring-0 p-0 text-sm cursor-not-allowed">
                        </div>
                        <div class="px-4 py-3 bg-gray-900/50 rounded-2xl">
                            <label class="block text-xs text-gray-400 font-medium uppercase tracking-wider mb-1">Until</label>
                            <input type="date" disabled class="bg-transparent border-none text-white focus:ring-0 p-0 text-sm cursor-not-allowed">
                        </div>
                    </div>
                    <button type="submit" class="w-full md:w-auto px-8 py-5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white rounded-2xl font-bold text-lg transition-all duration-300 shadow-[0_0_20px_rgba(79,70,229,0.3)] hover:shadow-[0_0_30px_rgba(79,70,229,0.5)]">
                        Search
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Featured Cars -->
    <section class="py-24 bg-gray-950 relative border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Featured Vehicles</h2>
                    <p class="text-gray-400 text-lg">Top rated cars available right now</p>
                </div>
                <a href="#" class="hidden md:flex items-center text-indigo-400 hover:text-indigo-300 font-medium transition-colors">
                    View all 
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($featuredCars as $car)
                <div class="group bg-white/5 rounded-3xl overflow-hidden border border-white/10 hover:border-indigo-500/50 transition-all duration-300 hover:shadow-[0_0_30px_rgba(79,70,229,0.15)] flex flex-col">
                    <a href="{{ route('cars.show', $car) }}" class="relative h-64 overflow-hidden bg-gray-900 block">
                        @if($car->images->count() > 0)
                            <img src="{{ Storage::url($car->images->first()->image_path) }}" alt="{{ $car->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                        @else
                            <img src="https://images.unsplash.com/photo-1549317661-bc32c0734c19?auto=format&fit=crop&w=800&q=80" alt="{{ $car->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                        @endif
                        <div class="absolute top-4 right-4 bg-gray-900/80 backdrop-blur-md px-4 py-1.5 rounded-full border border-white/10">
                            <span class="font-bold text-white">৳{{ number_format($car->price_per_day, 0) }}</span>
                            <span class="text-sm text-gray-400">/day</span>
                        </div>
                    </a>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <a href="{{ route('cars.show', $car) }}">
                                    <h3 class="text-xl font-bold text-white group-hover:text-indigo-400 transition-colors">{{ $car->title }}</h3>
                                </a>
                                <div class="flex items-center bg-indigo-500/10 px-2 py-1 rounded text-sm text-indigo-400">
                                    <svg class="w-4 h-4 mr-1 pb-0.5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    {{ number_format($car->reviews->avg('rating') ?: 5.0, 1) }}
                                </div>
                            </div>
                            <p class="text-sm text-gray-400 mb-6 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $car->location }}
                            </p>
                        </div>
                        <div class="flex items-center gap-4 text-sm text-gray-300 font-medium">
                            <span class="flex items-center"><svg class="w-4 h-4 mr-1 stroke-current" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg> {{ $car->transmission }}</span>
                            <span class="flex items-center"><svg class="w-4 h-4 mr-1 stroke-current" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg> {{ $car->fuel_type }}</span>
                        </div>
                    </div>
                </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-400">
                        No featured vehicles available right now. Check back soon!
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- How it works -->
    <section class="py-24 bg-gray-900 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">How CarRent BD Works</h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">Skip the hassle of a traditional car rental and book your perfect drive with just a few taps.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center relative pointer-events-none">
                <!-- Line connecting steps -->
                <div class="hidden md:block absolute top-[60px] left-[15%] right-[15%] h-0.5 bg-gradient-to-r from-transparent via-white/10 to-transparent -z-10"></div>
                
                <div class="relative">
                    <div class="w-24 h-24 mx-auto bg-gray-800 rounded-3xl border border-white/10 flex items-center justify-center mb-6 shadow-xl shadow-black/40 text-4xl text-indigo-400 rotate-3 transition-transform hover:rotate-6">
                        🔍
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">1. Find a car</h3>
                    <p class="text-gray-400">Enter a location and date and browse hundreds of cars shared by local hosts.</p>
                </div>
                
                <div class="relative">
                    <div class="w-24 h-24 mx-auto bg-gray-800 rounded-3xl border border-white/10 flex items-center justify-center mb-6 shadow-xl shadow-black/40 text-4xl text-purple-400 -rotate-3 transition-transform hover:-rotate-6">
                        📅
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">2. Book your trip</h3>
                    <p class="text-gray-400">Found the perfect car? Book it online instantly via our secure platform.</p>
                </div>

                <div class="relative">
                    <div class="w-24 h-24 mx-auto bg-gray-800 rounded-3xl border border-white/10 flex items-center justify-center mb-6 shadow-xl shadow-black/40 text-4xl text-pink-400 rotate-3 transition-transform hover:rotate-6">
                        🚗
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">3. Hit the road</h3>
                    <p class="text-gray-400">Pick up the car from your host, and explore the roads with total freedom.</p>
                </div>
            </div>
            
            <div class="mt-20 text-center">
                <a href="{{ route('register') }}" class="inline-block px-10 py-5 bg-white text-gray-950 font-bold rounded-full text-lg hover:bg-gray-200 transition-colors shadow-xl">
                    Get Started Now
                </a>
            </div>
        </div>
    </section>
</x-public-layout>
