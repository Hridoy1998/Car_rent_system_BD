<x-public-layout>
    <div class="min-h-screen bg-gray-50 flex items-center justify-center px-4 py-32 overflow-hidden relative">
        <!-- Abstract Background Decoration -->
        <div class="absolute top-0 left-0 w-full h-full pointer-events-none overflow-hidden">
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-900/5 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-orange-500/5 rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-3xl w-full text-center relative z-10" data-aos="fade-up">
            <!-- Massive 404 Graphic -->
            <div class="relative inline-block mb-8">
                <h1 class="text-[12rem] md:text-[18rem] font-black text-blue-900/10 leading-none select-none">404</h1>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="text-4xl md:text-6xl font-black text-blue-900 uppercase tracking-tighter">
                        Oops<span class="text-orange-500">!</span>
                    </div>
                </div>
            </div>

            <h2 class="text-3xl md:text-5xl font-black text-gray-900 mb-6 tracking-tight">
                Page Not Found
            </h2>
            
            <p class="text-lg text-gray-600 mb-12 max-w-lg mx-auto font-medium">
                The road you're looking for seems to have hit a dead end. Let's get you back on track to your next destination.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('home') }}" class="w-full sm:w-auto px-10 py-4 bg-blue-900 hover:bg-blue-800 text-white font-bold rounded-lg shadow-xl shadow-blue-900/20 transition-all uppercase tracking-widest text-sm">
                    Back to Home
                </a>
                <a href="{{ route('search') }}" class="w-full sm:w-auto px-10 py-4 bg-white border border-gray-200 hover:border-blue-900 text-blue-900 font-bold rounded-lg transition-all uppercase tracking-widest text-sm">
                    Browse Fleet
                </a>
            </div>
        </div>
        
        <!-- Animated Elements -->
        <div class="absolute bottom-20 left-1/2 -translate-x-1/2 w-full max-w-4xl opacity-20 pointer-events-none">
             <div class="h-1 bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
        </div>
    </div>
</x-public-layout>
