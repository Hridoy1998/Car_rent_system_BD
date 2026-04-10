<x-public-layout>
    <div class="pt-32 pb-20 bg-gray-950 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Search Header -->
            <div class="mb-12">
                <h1 class="text-4xl font-black text-white italic tracking-tighter mb-4 uppercase">Available Cars</h1>
                <p class="text-gray-400 font-medium">
                    @if($location)
                        Found {{ $cars->total() }} results for "<span class="text-indigo-400">{{ $location }}</span>"
                    @else
                        Showing all {{ $cars->total() }} available cars in our network.
                    @endif
                </p>
            </div>

            <!-- Search Form Area -->
            <div class="mb-16 p-8 bg-white/[0.02] border border-white/10 rounded-[2.5rem] backdrop-blur-xl">
                <form action="{{ route('search') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="md:col-span-2 relative">
                        <label class="block text-[10px] text-gray-600 font-black uppercase tracking-widest mb-2 ml-4">Location or Model</label>
                        <input type="text" name="location" value="{{ $location }}" placeholder="Where to?" 
                            class="w-full bg-gray-950/50 border border-white/5 rounded-2xl px-6 py-4 text-white focus:border-indigo-500 focus:ring-0 transition-all placeholder-gray-700 font-bold uppercase text-xs tracking-widest">
                    </div>
                    <div>
                        <label class="block text-[10px] text-gray-600 font-black uppercase tracking-widest mb-2 ml-4">Start Date</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}"
                            class="w-full bg-gray-950/50 border border-white/5 rounded-2xl px-6 py-4 text-white focus:border-indigo-500 focus:ring-0 transition-all font-bold uppercase text-xs">
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full h-[58px] bg-indigo-600 hover:bg-indigo-500 text-white rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] transition-all shadow-lg shadow-indigo-600/20">
                            Apply Filters
                        </button>
                    </div>
                </form>
            </div>

            <!-- Results Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse ($cars as $car)
                    <div class="group bg-gray-900/30 backdrop-blur-xl rounded-[3rem] overflow-hidden border border-white/5 hover:border-indigo-500/20 transition-all duration-700 hover:shadow-[0_40px_80px_rgba(0,0,0,0.5)] flex flex-col relative">
                        <!-- Image Container -->
                        <a href="{{ route('cars.show', $car) }}" class="relative aspect-[16/10] overflow-hidden bg-gray-950 block">
                            <img src="{{ $car->primary_image_url }}" alt="{{ $car->title }}" class="w-full h-full object-cover transition-all duration-1000 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-transparent to-transparent opacity-80"></div>
                            
                            <!-- Price Badge -->
                            <div class="absolute top-6 right-6 z-20">
                                <div class="bg-indigo-600 px-5 py-2.5 rounded-2xl shadow-2xl border border-white/10">
                                    <span class="text-lg font-black text-white italic tracking-tight">৳{{ number_format($car->price_per_day, 0) }}</span>
                                    <span class="text-[8px] text-white/60 font-black uppercase tracking-widest ml-1">/Day</span>
                                </div>
                            </div>
                        </a>

                        <!-- Details -->
                        <div class="p-8 flex-1 flex flex-col justify-between">
                            <div>
                                <div class="flex justify-between items-start mb-6">
                                    <div class="flex flex-col">
                                        <span class="text-[10px] font-black text-indigo-500 uppercase tracking-[0.4em] mb-1 italic">{{ $car->brand }}</span>
                                        <a href="{{ route('cars.show', $car) }}">
                                            <h3 class="text-2xl font-black text-white italic tracking-tighter group-hover:text-indigo-400 transition-colors uppercase">
                                                {{ $car->model }}
                                            </h3>
                                        </a>
                                    </div>
                                    <div class="flex items-center bg-white/5 px-4 py-2 rounded-2xl border border-white/10 text-[11px] text-white font-black italic">
                                        <svg class="w-4 h-4 mr-2 text-yellow-500 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        {{ number_format($car->reviews_avg_rating ?: 5.0, 1) }}
                                    </div>
                                </div>
                                <p class="text-[10px] text-gray-500 mb-8 flex items-center font-bold uppercase tracking-widest italic leading-relaxed">
                                    <svg class="w-4 h-4 mr-3 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ $car->location }}
                                </p>
                            </div>

                            <div class="flex items-center justify-between pt-6 border-t border-white/5">
                                <a href="{{ route('profiles.show', $car->owner) }}" class="flex items-center gap-3 group/owner">
                                    <div class="w-10 h-10 rounded-2xl bg-gray-800 border border-white/10 flex items-center justify-center overflow-hidden group-hover/owner:border-indigo-500/50 transition-all">
                                        @if($car->owner->profile_photo)
                                            <img src="{{ Storage::url($car->owner->profile_photo) }}" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-[10px] font-black text-indigo-400 capitalize">{{ substr($car->owner->name, 0, 1) }}</span>
                                        @endif
                                    </div>
                                    <span class="text-[10px] font-black text-gray-500 group-hover/owner:text-indigo-400 transition-colors uppercase tracking-[0.2em] italic">{{ $car->owner->name }}</span>
                                </a>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('cars.show', $car) }}" class="px-6 py-3 bg-white/5 hover:bg-white/10 border border-white/10 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-40 bg-white/[0.01] rounded-[3rem] border border-white/5 border-dashed flex flex-col items-center justify-center">
                        <div class="w-24 h-24 rounded-[2rem] bg-gray-900 mb-8 border border-white/5 flex items-center justify-center">
                            <svg class="w-10 h-10 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-black text-white italic mb-2 uppercase tracking-tighter">No cars found</h3>
                        <p class="text-sm text-gray-600 font-medium uppercase tracking-widest">Try adjusting your location or dates.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-20">
                {{ $cars->links() }}
            </div>
        </div>
    </div>
</x-public-layout>
