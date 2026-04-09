<x-public-layout>
    <x-slot name="title">Browse Cars - CarRent BD</x-slot>

    <div class="pt-28 pb-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Search Header -->
        <div class="mb-12">
            <h1 class="text-4xl font-extrabold text-white mb-4">
                @if($location)
                    Cars in <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">{{ $location }}</span>
                @else
                    Discover Your Perfect Ride
                @endif
            </h1>
            <p class="text-gray-400 text-lg">Browse {{ $cars->total() }} available vehicles to book for your next journey.</p>
        </div>

        <!-- Refine Search Form -->
        <div class="bg-gray-900 border border-white/10 p-4 rounded-3xl mb-12 shadow-2xl">
            <form action="{{ route('search') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 ml-1">Location or Brand</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <input type="text" name="location" value="{{ request('location') }}" placeholder="Where to?" class="w-full bg-gray-950 border-0 rounded-2xl pl-12 pr-4 py-4 text-white focus:ring-2 focus:ring-indigo-500 placeholder-gray-600 transition-all">
                    </div>
                </div>
                
                <!-- Placeholders for Dates, functional in Phase 2 -->
                <div class="md:w-48">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 ml-1">From</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full bg-gray-950/50 border border-white/5 rounded-2xl px-4 py-4 text-white focus:ring-2 focus:ring-indigo-500 transition-all">
                </div>
                <div class="md:w-48">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 ml-1">Until</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full bg-gray-950/50 border border-white/5 rounded-2xl px-4 py-4 text-white focus:ring-2 focus:ring-indigo-500 transition-all">
                </div>
                
                <div class="flex items-end">
                    <button type="submit" class="w-full md:w-auto bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white px-8 py-4 rounded-2xl font-bold text-lg shadow-[0_0_20px_rgba(79,70,229,0.3)] hover:shadow-[0_0_30px_rgba(79,70,229,0.5)] transition-all transform hover:-translate-y-0.5">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <!-- Results Grid -->
        @if($cars->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($cars as $car)
                    <a href="{{ route('cars.show', $car) }}" class="group bg-gray-900 border border-white/5 rounded-3xl overflow-hidden hover:border-indigo-500/50 transition-all duration-300 hover:shadow-[0_0_30px_rgba(79,70,229,0.15)] hover:-translate-y-1 block">
                        <div class="aspect-[4/3] bg-gray-800 relative overflow-hidden">
                            @if($car->images->count() > 0)
                                <img src="{{ Storage::url($car->images->where('is_primary', true)->first()->image_path ?? $car->images->first()->image_path) }}" alt="{{ $car->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-600">No Image</div>
                            @endif
                            
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
                                <div class="bg-gray-950/80 backdrop-blur-md px-3 py-1 rounded-full border border-white/10 text-white font-bold text-sm">
                                    ৳{{ number_format($car->price_per_day, 0) }}<span class="text-gray-400 font-normal text-xs">/d</span>
                                </div>
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-bold tracking-wider text-indigo-400 uppercase">{{ $car->brand }}</span>
                                <div class="flex items-center text-sm font-medium text-white group-hover:text-yellow-400 transition-colors">
                                    <svg class="w-4 h-4 mr-1 pb-0.5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    {{ number_format($car->reviews->avg('rating') ?: 5.0, 1) }}
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-white mb-2 line-clamp-1">
                                @if(!$car->is_available)
                                    <span class="text-xs bg-red-500/20 text-red-400 px-2 py-0.5 rounded mr-1 uppercase tracking-wider align-middle border border-red-500/30">Rented</span>
                                @endif
                                {{ $car->title }}
                            </h3>
                            <div class="flex items-center text-gray-500 text-sm">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $car->location }}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            
            <div class="mt-12">
                {{ $cars->links() }}
            </div>
        @else
            <div class="text-center py-20 bg-gray-900 border border-white/5 rounded-3xl">
                <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-500">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-white mb-2">No cars found</h3>
                <p class="text-gray-400 mb-8 max-w-md mx-auto">We couldn't find any approved vehicles matching your search criteria. Try a different location or remove filters.</p>
                <a href="{{ route('search') }}" class="inline-flex py-3 px-6 bg-white/10 hover:bg-white/20 text-white rounded-xl font-medium transition-colors">
                    Clear Search
                </a>
            </div>
        @endif

    </div>
</x-public-layout>
