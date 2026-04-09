<x-app-layout>
    <div class="py-24 bg-gray-950 min-h-screen flex items-center justify-center relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-purple-500/10 via-transparent to-transparent -z-10"></div>
        
        <div class="max-w-2xl w-full px-4 text-center">
            <div class="w-24 h-24 bg-purple-500/20 rounded-[2.5rem] flex items-center justify-center text-purple-400 mx-auto mb-10 shadow-[0_0_50px_rgba(139,92,246,0.2)] animate-pulse">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>

            <h1 class="text-4xl md:text-5xl font-black text-white mb-4 tracking-tight">Fleet Expansion!</h1>
            <p class="text-gray-400 text-lg mb-12">Your vehicle has been submitted for approval. Our admins will verify the details and list it on the marketplace within 24 hours.</p>

            <div class="bg-gray-900/50 backdrop-blur-3xl border border-white/10 rounded-[3rem] p-10 text-left shadow-2xl space-y-8 relative group overflow-hidden">
                <div class="absolute top-0 right-0 p-8 opacity-5 group-hover:opacity-10 transition-opacity">
                    <svg class="w-32 h-32 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>

                <h4 class="text-xl font-bold text-white mb-6">Pro Tips for Hosts</h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-5 bg-white/5 rounded-2xl border border-white/5 transition-all hover:bg-white/10">
                        <p class="text-[10px] font-black text-purple-400 uppercase tracking-widest mb-2">Tip #1</p>
                        <p class="text-xs text-gray-300 font-bold">Fast Response</p>
                        <p class="text-[10px] text-gray-500 mt-1 italic leading-relaxed">Hosts who respond within 1 hour have a 3x higher booking rate.</p>
                    </div>
                    <div class="p-5 bg-white/5 rounded-2xl border border-white/5 transition-all hover:bg-white/10">
                        <p class="text-[10px] font-black text-purple-400 uppercase tracking-widest mb-2">Tip #2</p>
                        <p class="text-xs text-gray-300 font-bold">Photo Quality</p>
                        <p class="text-[10px] text-gray-500 mt-1 italic leading-relaxed">Bright, outdoor photos at sundown attract more renters.</p>
                    </div>
                </div>

                <div class="pt-8 flex gap-4">
                    <a href="{{ route('owner.dashboard') }}" class="flex-1 py-4 bg-purple-600 hover:bg-purple-500 text-white font-black rounded-2xl text-center transition-all shadow-xl shadow-purple-600/20 uppercase tracking-widest text-xs tracking-widest">Back to HQ</a>
                    <a href="{{ route('owner.cars.index') }}" class="flex-1 py-4 bg-gray-800 hover:bg-gray-700 text-gray-400 font-black rounded-2xl text-center transition-all uppercase tracking-widest text-xs tracking-widest">View Fleet</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
