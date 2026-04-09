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
                            <input type="date" name="start_date" class="bg-transparent border-none text-white focus:ring-0 p-0 text-sm w-full">
                        </div>
                        <div class="px-4 py-3 bg-gray-900/50 rounded-2xl">
                            <label class="block text-xs text-gray-400 font-medium uppercase tracking-wider mb-1">Until</label>
                            <input type="date" name="end_date" class="bg-transparent border-none text-white focus:ring-0 p-0 text-sm w-full">
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
                <a href="{{ route('search') }}" class="hidden md:flex items-center text-indigo-400 hover:text-indigo-300 font-medium transition-colors">
                    View all 
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($featuredCars as $car)
                <div class="group bg-white/5 rounded-3xl overflow-hidden border border-white/10 hover:border-indigo-500/50 transition-all duration-300 hover:shadow-[0_0_30px_rgba(79,70,229,0.15)] flex flex-col">
                    <a href="{{ route('cars.show', $car) }}" class="relative h-64 overflow-hidden bg-gray-900 block">
                        <div class="absolute top-4 right-4 z-20 flex gap-2">
                            @auth
                                @if(auth()->user()->isCustomer())
                                    <form action="{{ route('customer.favorites.toggle', $car) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="p-2 {{ $car->isFavoritedBy(auth()->user()) ? 'bg-indigo-600 text-white' : 'bg-gray-950/80 text-gray-400' }} backdrop-blur-md rounded-xl border border-white/10 transition-all hover:scale-110 active:scale-90 shadow-xl">
                                            <svg class="w-4 h-4" fill="{{ $car->isFavoritedBy(auth()->user()) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                        </button>
                                    </form>
                                @endif
                            @endauth
                            <div class="bg-gray-950/80 backdrop-blur-md px-4 py-1.5 rounded-full border border-white/10">
                                <span class="font-bold text-white">৳{{ number_format($car->price_per_day, 0) }}</span>
                                <span class="text-sm text-gray-400">/day</span>
                            </div>
                        </div>
                    </a>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <a href="{{ route('cars.show', $car) }}">
                                    <h3 class="text-xl font-bold text-white group-hover:text-indigo-400 transition-colors tracking-tight">
                                        @if(!$car->is_available)
                                            <span class="text-[9px] bg-red-500/20 text-red-400 px-2 py-0.5 rounded mr-2 uppercase tracking-widest align-middle border border-red-500/30 font-black">Rented</span>
                                        @endif
                                        {{ $car->title }}
                                    </h3>
                                </a>
                                <div class="flex items-center bg-indigo-500/10 px-2.5 py-1 rounded-lg text-sm text-indigo-400 font-bold">
                                    <svg class="w-3.5 h-3.5 mr-1 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    {{ number_format($car->reviews->avg('rating') ?: 5.0, 1) }}
                                </div>
                            </div>
                            <p class="text-[11px] text-gray-500 mb-6 flex items-center tracking-wide font-medium">
                                <svg class="w-4 h-4 mr-1 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <a href="{{ route('search', ['location' => $car->location]) }}" class="hover:text-white transition-colors">{{ $car->location }}</a>
                            </p>
                        </div>
                        <div class="flex items-center justify-between pt-4 border-t border-white/5">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-white/5 flex items-center justify-center overflow-hidden border border-white/10">
                                    @if($car->owner->avatar)
                                        <img src="{{ Storage::url($car->owner->avatar) }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-[8px] font-black uppercase tracking-tighter">{{ substr($car->owner->name, 0, 2) }}</span>
                                    @endif
                                </div>
                                <a href="{{ route('profiles.show', $car->owner) }}" class="text-[10px] font-bold text-gray-500 hover:text-white transition-colors uppercase tracking-widest">{{ $car->owner->name }}</a>
                            </div>
                            <div class="flex items-center gap-3 text-[10px] text-gray-500 font-black uppercase tracking-widest">
                                <span class="flex items-center">{{ $car->transmission }}</span>
                                <span class="w-1 h-1 rounded-full bg-gray-800"></span>
                                <span class="flex items-center">{{ $car->fuel_type }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-400 italic">
                        No featured vehicles available right now. Check back soon!
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- How it works -->
    <section class="py-24 bg-gray-950 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">How it Works</h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">Experience the future of car sharing with our streamlined, 3-step process.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center relative">
                <!-- Line connecting steps -->
                <div class="hidden md:block absolute top-[60px] left-[15%] right-[15%] h-0.5 bg-gradient-to-r from-transparent via-white/10 to-transparent -z-10"></div>
                
                <div class="bg-gray-900/30 p-8 rounded-[3rem] border border-white/5 hover:bg-white/5 transition-all group">
                    <div class="w-24 h-24 mx-auto bg-gray-900 rounded-3xl border border-white/10 flex items-center justify-center mb-6 shadow-xl shadow-black/40 text-4xl text-indigo-400 rotate-3 transition-transform group-hover:rotate-6">
                        🔍
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Find a car</h3>
                    <p class="text-sm text-gray-500 italic">Enter location & date to browse unique cars shared by locals.</p>
                </div>
                
                <div class="bg-gray-900/30 p-8 rounded-[3rem] border border-white/5 hover:bg-white/5 transition-all group">
                    <div class="w-24 h-24 mx-auto bg-gray-900 rounded-3xl border border-white/10 flex items-center justify-center mb-6 shadow-xl shadow-black/40 text-4xl text-purple-400 -rotate-3 transition-transform group-hover:-rotate-6">
                        📅
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Book trip</h3>
                    <p class="text-sm text-gray-500 italic">Found the perfect drive? Book instantly via our secure platform.</p>
                </div>

                <div class="bg-gray-900/30 p-8 rounded-[3rem] border border-white/5 hover:bg-white/5 transition-all group">
                    <div class="w-24 h-24 mx-auto bg-gray-900 rounded-3xl border border-white/10 flex items-center justify-center mb-6 shadow-xl shadow-black/40 text-4xl text-pink-400 rotate-3 transition-transform group-hover:rotate-6">
                        🚗
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Hit the road</h3>
                    <p class="text-sm text-gray-500 italic">Coordinate pickup via chat and start your journey with ease.</p>
                </div>
            </div>
            
            <div class="mt-20 text-center flex flex-col items-center gap-6">
                <a href="{{ route('register') }}" class="inline-block px-12 py-5 bg-white text-gray-950 font-black rounded-2xl text-lg hover:bg-gray-200 transition-all shadow-[0_0_30px_rgba(255,255,255,0.1)] uppercase tracking-[0.2em] text-sm">Get Started</a>
                <a href="{{ route('pages.how-it-works') }}" class="text-xs font-black text-indigo-400 uppercase tracking-widest hover:text-indigo-300">Detailed Guide &rarr;</a>
            </div>
        </div>
    </section>
</x-public-layout>
