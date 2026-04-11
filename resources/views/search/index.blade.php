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
                    <x-car-card :car="$car" />
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
