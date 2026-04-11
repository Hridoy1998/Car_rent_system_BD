<x-public-layout>
    <!-- Hero Section -->
    <div class="relative pt-32 pb-40 lg:pt-48 lg:pb-48 overflow-hidden">
        <!-- Dynamic Gradient Glows -->
        <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-indigo-600/10 rounded-full blur-[140px] animate-pulse pointer-events-none"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] bg-purple-600/10 rounded-full blur-[140px] animate-pulse pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-3 px-6 py-2 rounded-2xl bg-white/5 border border-white/10 mb-10 overflow-hidden group">
                <span class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_12px_rgba(16,185,129,1)]"></span>
                <span class="text-[10px] font-black text-gray-400 uppercase tracking-[0.4em] group-hover:text-white transition-colors duration-500">Premium Car Sharing in Bangladesh</span>
            </div>

            <h1 class="text-6xl md:text-8xl font-black tracking-tight mb-8 text-white italic leading-[1.1]">
                CAR RENTAL, <br/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-purple-400 to-indigo-400 drop-shadow-2xl">
                    REDEFINED.
                </span>
            </h1>
            
            <p class="max-w-2xl mx-auto text-sm md:text-base text-gray-400 mb-16 font-medium tracking-wide leading-relaxed">
                Connect with the most reliable local car owners in Bangladesh. <br class="hidden whitespace-pre md:block"/> Transparent rentals, verified cars, and safe journeys.
            </p>

            <!-- Refined Search Architecture -->
            <div class="max-w-4xl mx-auto p-2 bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-[2.5rem] shadow-2xl relative">
                <form action="{{ route('search') }}" method="GET" class="flex flex-col md:flex-row items-center gap-2">
                    <div class="w-full relative px-8 py-5 bg-gray-950/60 rounded-[2.2rem] border border-white/5 group focus-within:border-indigo-500/50 transition-all">
                        <label class="block text-[9px] text-gray-600 font-black uppercase tracking-widest mb-1 italic">Pick-up Location</label>
                        <input type="text" name="location" placeholder=" Dhaka, CTG, Sylhet..." class="w-full bg-transparent border-none text-white focus:ring-0 p-0 placeholder-gray-800 text-lg font-bold tracking-tight">
                    </div>
                    
                    <div class="w-full md:w-auto flex gap-2">
                        <div class="w-1/2 px-6 py-5 bg-gray-950/60 rounded-[2.2rem] border border-white/5 group focus-within:border-indigo-500/50 transition-all">
                            <label class="block text-[9px] text-gray-600 font-black uppercase tracking-widest mb-1 italic">Start Date</label>
                            <input type="date" name="start_date" class="bg-transparent border-none text-white focus:ring-0 p-0 text-xs font-bold w-full uppercase">
                        </div>
                        <div class="w-1/2 px-6 py-5 bg-gray-950/60 rounded-[2.2rem] border border-white/5 group focus-within:border-indigo-500/50 transition-all">
                            <label class="block text-[9px] text-gray-600 font-black uppercase tracking-widest mb-1 italic">End Date</label>
                            <input type="date" name="end_date" class="bg-transparent border-none text-white focus:ring-0 p-0 text-xs font-bold w-full uppercase">
                        </div>
                    </div>

                    <button type="submit" class="w-full md:w-auto px-10 py-6 bg-indigo-600 hover:bg-indigo-500 text-white rounded-[2.2rem] font-black text-xs uppercase tracking-widest transition-all duration-500 shadow-xl shadow-indigo-600/20">
                        Find Your Car
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Featured Cars -->
    <section class="py-32 relative bg-gray-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center mb-20 px-4 gap-6 text-center md:text-left">
                <div>
                    <div class="flex items-center justify-center md:justify-start gap-3 mb-4">
                        <span class="w-10 h-0.5 bg-indigo-500 rounded-full"></span>
                        <span class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.4em]">Our Best Models</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-black text-white italic tracking-tighter">FEATURED CARS</h2>
                </div>
                <a href="{{ route('search') }}" class="group flex items-center gap-4 text-[11px] font-black text-gray-500 hover:text-white uppercase tracking-[0.3em] transition-all">
                    See All Cars 
                    <div class="w-12 h-12 rounded-full border border-white/10 flex items-center justify-center group-hover:bg-indigo-600 group-hover:border-indigo-500 group-hover:scale-110 transition-all duration-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </div>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($featuredCars as $car)
                <x-car-card :car="$car" />
                @empty
                    <div class="col-span-full group py-32 bg-gray-900/20 rounded-[3rem] border border-white/5 border-dashed flex flex-col items-center justify-center">
                        <div class="w-20 h-20 rounded-[2rem] bg-gray-900 mb-8 border border-white/5 flex items-center justify-center group-hover:border-indigo-500/20 transition-all duration-700">
                             <svg class="w-8 h-8 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <div class="text-[11px] text-gray-700 font-black uppercase tracking-[0.5em] italic">Looking for available cars...</div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Trust & Performance Statistics -->
    <section class="py-24 bg-gray-950/50 border-y border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-12">
                <div class="text-center group">
                    <div class="text-4xl md:text-5xl font-black text-white italic tracking-tighter mb-2 group-hover:text-indigo-400 transition-colors">98%</div>
                    <div class="text-[10px] font-black text-gray-600 uppercase tracking-widest">Car Condition</div>
                </div>
                <div class="text-center group">
                    <div class="text-4xl md:text-5xl font-black text-white italic tracking-tighter mb-2 group-hover:text-purple-400 transition-colors">150+</div>
                    <div class="text-[10px] font-black text-gray-600 uppercase tracking-widest">Verified Owners</div>
                </div>
                <div class="text-center group">
                    <div class="text-4xl md:text-5xl font-black text-white italic tracking-tighter mb-2 group-hover:text-emerald-400 transition-colors">0.2s</div>
                    <div class="text-[10px] font-black text-gray-600 uppercase tracking-widest">Quick Approval</div>
                </div>
                <div class="text-center group">
                    <div class="text-4xl md:text-5xl font-black text-white italic tracking-tighter mb-2 group-hover:text-blue-400 transition-colors">24/7</div>
                    <div class="text-[10px] font-black text-gray-600 uppercase tracking-widest">Support Team</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Simple engagement flow (User Friendly Steps) -->
    <section class="py-32 bg-gray-950 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-24">
                <div class="inline-block px-5 py-2 bg-indigo-600/10 border border-indigo-500/20 rounded-full text-[10px] font-black text-indigo-400 uppercase tracking-[0.4em] mb-6 italic">Simple 3-Step Process</div>
                <h2 class="text-4xl md:text-6xl font-black text-white italic tracking-tighter">HOW IT WORKS</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="bg-white/[0.02] p-10 rounded-[3rem] border border-white/5 hover:border-indigo-500/20 transition-all duration-700">
                    <div class="text-5xl font-black text-white/5 mb-8 italic">01.</div>
                    <h3 class="text-xl font-black text-white mb-4 uppercase tracking-widest italic">Choose Your Car</h3>
                    <p class="text-[13px] text-gray-500 font-medium leading-relaxed tracking-wide">Browse our premium collection. Filter by your exact needs and style.</p>
                </div>
                <div class="bg-white/[0.02] p-10 rounded-[3rem] border border-white/5 hover:border-purple-500/20 transition-all duration-700">
                    <div class="text-5xl font-black text-white/5 mb-8 italic">02.</div>
                    <h3 class="text-xl font-black text-white mb-4 uppercase tracking-widest italic">Book & Pay</h3>
                    <p class="text-[13px] text-gray-500 font-medium leading-relaxed tracking-wide">Select your dates and complete the payment through our secure checkout system.</p>
                </div>
                <div class="bg-white/[0.02] p-10 rounded-[3rem] border border-white/5 hover:border-emerald-500/20 transition-all duration-700">
                    <div class="text-5xl font-black text-white/5 mb-8 italic">03.</div>
                    <h3 class="text-xl font-black text-white mb-4 uppercase tracking-widest italic">Start Your Trip</h3>
                    <p class="text-[13px] text-gray-500 font-medium leading-relaxed tracking-wide">Coordinate with the owner, inspect your car, and enjoy your premium journey.</p>
                </div>
            </div>

            <div class="mt-24 text-center">
                <a href="{{ route('register') }}" class="group relative inline-flex items-center gap-4 px-16 py-8 bg-white text-gray-950 font-black rounded-[2.5rem] hover:bg-gray-200 transition-all duration-500 overflow-hidden">
                    <span class="relative z-10 text-xs uppercase tracking-[0.3em] italic">Join for Free Now</span>
                    <svg class="w-5 h-5 relative z-10 transition-transform duration-500 group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        </div>
    </section>n>
</x-public-layout>
