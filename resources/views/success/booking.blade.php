<x-app-layout>
    <div class="py-24 bg-gray-950 min-h-screen flex items-center justify-center relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-indigo-500/10 via-transparent to-transparent -z-10"></div>
        
        <div class="max-w-2xl w-full px-4 text-center">
            <div class="w-24 h-24 bg-emerald-500/20 rounded-[2.5rem] flex items-center justify-center text-emerald-400 mx-auto mb-10 shadow-[0_0_50px_rgba(16,185,129,0.2)] animate-bounce">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
            </div>

            <h1 class="text-4xl md:text-5xl font-black text-white mb-4 tracking-tight">Booking Requested!</h1>
            <p class="text-gray-400 text-lg mb-12">Your request has been sent to the host. You'll be notified as soon as they approve your trip.</p>

            <div class="bg-gray-900/50 backdrop-blur-3xl border border-white/10 rounded-[3rem] p-10 text-left shadow-2xl space-y-8 relative group overflow-hidden">
                <div class="absolute top-0 right-0 p-8 opacity-5 group-hover:opacity-10 transition-opacity">
                    <svg class="w-32 h-32 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>

                <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                    <span class="w-1 h-6 bg-indigo-500 rounded-full"></span>
                    What happens next?
                </h3>
                
                <div class="space-y-6">
                    <div class="flex gap-5">
                        <div class="w-6 h-6 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-[10px] font-black text-indigo-400">1</div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-200">Host Approval</h4>
                            <p class="text-xs text-gray-500 mt-1 italic">Hosts usually respond within 2-4 hours. Keep an eye on your inbox.</p>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="w-6 h-6 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-[10px] font-black text-indigo-400">2</div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-200">Complete Payment</h4>
                            <p class="text-xs text-gray-500 mt-1 italic">Once approved, you'll need to pay to confirm your reservation and lock in the dates.</p>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="w-6 h-6 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-[10px] font-black text-indigo-400">3</div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-200">Start Chatting</h4>
                            <p class="text-xs text-gray-500 mt-1 italic">Go to the Booking Hub to introduce yourself and coordinate the hand-off.</p>
                        </div>
                    </div>
                </div>

                <div class="pt-8 grid grid-cols-2 gap-4">
                    <a href="{{ route('customer.bookings.show', $booking) }}" class="flex-1 py-4 bg-indigo-600 hover:bg-indigo-500 text-white font-black rounded-2xl text-center transition-all shadow-xl shadow-indigo-600/20 uppercase tracking-widest text-xs">View My Hub</a>
                    <a href="{{ route('home') }}" class="flex-1 py-4 bg-gray-800 hover:bg-gray-700 text-gray-400 font-black rounded-2xl text-center transition-all uppercase tracking-widest text-xs">Browse More</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
