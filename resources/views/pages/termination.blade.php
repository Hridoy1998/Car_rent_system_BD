<x-public-layout>
    <!-- Header Hero: Departure Protocols Context -->
    <div class="relative pt-40 pb-24 bg-[#050B1A] overflow-hidden">
        <!-- Abstract Brand Elements -->
        <div class="absolute top-0 right-0 w-1/2 h-full bg-blue-900/10 rounded-bl-full blur-[120px]"></div>
        <div class="absolute bottom-0 left-0 w-1/3 h-1/2 bg-orange-500/5 rounded-tr-full blur-[100px]"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
            <div class="inline-flex items-center gap-3 mb-8">
                <span class="w-12 h-1 bg-red-500 rounded-full"></span>
                <span class="text-[10px] font-black text-red-500 uppercase tracking-[0.4em]">Deactivation Phase</span>
                <span class="w-12 h-1 bg-red-500 rounded-full"></span>
            </div>
            <h1 class="text-5xl md:text-7xl font-black text-white mb-6 uppercase tracking-tight italic leading-none">
                Account <span class="text-red-500">Termination</span>
            </h1>
            <p class="text-gray-400 font-bold text-lg max-w-2xl mx-auto uppercase tracking-widest leading-relaxed">
                Finalized protocols for the <span class="text-white">permanent removal</span> of personnel records and fleet associations.
            </p>
        </div>
    </div>

    <div class="bg-gray-50 min-h-screen py-32">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-100 rounded-[3rem] p-12 md:p-20 shadow-2xl shadow-blue-900/5 text-center space-y-12" data-aos="fade-up">
                <div class="w-24 h-24 mx-auto bg-red-50 rounded-[2rem] flex items-center justify-center text-red-500 mb-8 border border-red-100 shadow-sm transition-transform hover:scale-110 duration-500">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                
                <div class="space-y-6">
                    <h2 class="text-3xl font-black text-gray-900 uppercase tracking-tight italic">Finalizing Departure</h2>
                    <p class="text-gray-500 font-bold uppercase tracking-[0.1em] text-[10px] leading-loose max-w-2xl mx-auto">
                        Executing this protocol is irreversible. All personnel telemetry, mission history, and fleet registry associations will be permanently purged from the CRS BD master database in accordance with primary privacy mandates.
                    </p>
                </div>

                <div class="pt-10 border-t border-gray-100">
                    @auth
                        <form action="#" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="group relative inline-flex items-center justify-center px-12 py-6 bg-red-600 hover:bg-red-700 text-white text-[10px] font-black uppercase tracking-[0.4em] rounded-2xl transition-all duration-500 shadow-2xl shadow-red-500/20 italic" onclick="return confirm('Initiate total deactivation of personnel records?')">
                                <span>Terminate Permanent Records</span>
                                <svg class="w-4 h-4 ml-3 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="group relative inline-flex items-center justify-center px-12 py-6 bg-blue-900 hover:bg-blue-800 text-white text-[10px] font-black uppercase tracking-[0.4em] rounded-2xl transition-all duration-500 shadow-2xl shadow-blue-900/20 italic">
                            <span>Authenticate to Manage Protocol</span>
                            <svg class="w-4 h-4 ml-3 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
