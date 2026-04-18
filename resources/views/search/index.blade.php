<x-public-layout>
    <!-- Header Hero: Classic Collection Style -->
    <div class="relative pt-40 pb-24 bg-[#050B1A] overflow-hidden bg-cover bg-center" style="background-image: url('{{ asset('images/assets/autovia_hero_car.png') }}');">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-[2px]"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
            <div class="bg-black/10 backdrop-blur-md px-10 py-12 rounded-[3rem] border border-white/10 inline-block">
                <nav class="flex justify-center text-[10px] font-black uppercase tracking-[0.4em] text-white/70 mb-6 italic" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-3">
                        <li><a href="{{ route('home') }}" class="hover:text-orange-500 transition-colors">Home</a></li>
                        <li><span class="text-orange-500">/</span></li>
                        <li class="text-white">Full Registry</li>
                    </ol>
                </nav>
                <h1 class="text-4xl md:text-6xl lg:text-8xl font-black text-white uppercase tracking-tighter leading-none italic mb-4">
                    Car <span class="text-orange-500">Inventory</span>
                </h1>
                <p class="text-gray-400 font-bold text-[10px] uppercase tracking-[0.4em] leading-loose italic opacity-80">
                    @if($location)
                        Results For <span class="text-white">"{{ $location }}"</span>
                    @else
                        Calibrating All Available Units
                    @endif
                </p>
            </div>
        </div>
    </div>

    <div class="bg-gray-50 min-h-screen pb-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Strategic Filter Console (Unified Design) -->
            <div class="relative md:-mt-12 mb-20 z-30" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-white p-2 rounded-[2rem] shadow-2xl shadow-blue-900/10 border border-gray-100">
                    <div class="bg-white p-8 md:p-12 rounded-[1.8rem] border border-gray-50">
                        <form action="{{ route('search') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                        <div class="space-y-4">
                            <label class="block text-[11px] font-black text-gray-900 uppercase tracking-[0.4em] ml-1 italic">Location</label>
                            <input type="text" name="location" value="{{ $location }}" placeholder="ANY CITY / SECTOR" class="w-full px-6 py-4 bg-white border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-blue-900/10 focus:border-blue-900 font-black text-blue-900 uppercase tracking-widest text-xs transition-all italic placeholder-gray-500 shadow-sm">
                        </div>
                        <div class="space-y-4">
                            <label class="block text-[11px] font-black text-gray-900 uppercase tracking-[0.4em] ml-1 italic">Start Date</label>
                            <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full px-6 py-4 bg-white border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-blue-900/10 focus:border-blue-900 font-black text-blue-900 text-xs transition-all uppercase italic shadow-sm">
                        </div>
                        <div class="space-y-4">
                            <label class="block text-[11px] font-black text-gray-900 uppercase tracking-[0.4em] ml-1 italic">End Date</label>
                            <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full px-6 py-4 bg-white border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-blue-900/10 focus:border-blue-900 font-black text-blue-900 text-xs transition-all uppercase italic shadow-sm">
                        </div>
                            <div>
                                <button type="submit" class="w-full py-5 bg-blue-900 hover:bg-orange-500 text-white font-black rounded-2xl shadow-xl shadow-blue-900/20 transition-all duration-300 uppercase tracking-[0.2em] italic text-xs h-[64px] flex items-center justify-center gap-3">
                                    <span>Search Cars</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Results Grid: Structured Excellence -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @forelse ($cars as $car)
                    <x-car-card :car="$car" />
                @empty
                    <div class="col-span-full py-40 bg-white rounded-[3rem] border-2 border-dashed border-gray-100 flex flex-col items-center justify-center text-center px-6">
                        <div class="w-24 h-24 rounded-[2rem] bg-gray-50 mb-8 flex items-center justify-center border border-gray-100">
                            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <h3 class="text-3xl font-black text-gray-900 mb-4 uppercase tracking-tight italic">Zero Units Isolated</h3>
                        <p class="text-gray-400 font-bold max-w-sm uppercase tracking-widest text-xs leading-loose">The requested parameters produced no matched signals. Please recalibrate your deployment hub or model search.</p>
                        <a href="{{ route('search') }}" class="mt-10 px-10 py-4 border border-blue-900/20 text-blue-900 font-black text-[10px] uppercase tracking-[0.3em] rounded-2xl hover:bg-blue-900 hover:text-white transition-all">Clear Parameters</a>
                    </div>
                @endforelse
            </div>

            <!-- Enhanced Pagination -->
            <div class="mt-24 flex justify-center">
                <div class="p-2 bg-white rounded-[2rem] shadow-xl shadow-blue-900/5 border border-gray-100">
                    {{ $cars->links() }}
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
