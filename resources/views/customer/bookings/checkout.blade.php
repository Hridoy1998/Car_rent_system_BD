<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-3xl text-white tracking-tighter italic uppercase">
            {{ __('SOVEREIGN CHECKOUT') }}
        </h2>
        <p class="text-[10px] text-indigo-400 font-black uppercase tracking-[0.3em] mt-1 italic">Protocol Secure Settlement Node</p>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen relative overflow-hidden">
        <!-- Secure Gradients -->
        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-indigo-600/10 rounded-full blur-[120px] -z-10 animate-pulse"></div>
        
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                
                <!-- Asset Summary -->
                <div class="space-y-8">
                    <div class="glass p-8 rounded-[2.5rem] border-white/5 shadow-2xl relative overflow-hidden group">
                        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>
                        <h3 class="text-xs font-black text-gray-500 uppercase tracking-widest mb-6 italic">Target Asset</h3>
                        
                        <div class="aspect-video rounded-3xl overflow-hidden border border-white/10 shadow-inner mb-6">
                            <img src="{{ $booking->car->primary_image_url }}" class="w-full h-full object-cover">
                        </div>
                        
                        <div>
                            <h4 class="text-2xl font-black text-white tracking-tighter">{{ $booking->car->brand }} {{ $booking->car->model }}</h4>
                            <div class="flex items-center gap-3 mt-2">
                                <span class="px-2 py-0.5 bg-white/5 text-gray-400 text-[8px] font-bold uppercase rounded border border-white/5">{{ $booking->car->year }}</span>
                                <span class="text-[9px] text-gray-600 font-bold uppercase tracking-widest">{{ $booking->car->type }}</span>
                            </div>
                        </div>

                        <div class="mt-8 pt-8 border-t border-white/5 grid grid-cols-2 gap-6">
                            <div>
                                <p class="text-[8px] text-gray-600 font-black uppercase tracking-widest mb-1">Epoch Start</p>
                                <p class="text-xs font-bold text-white uppercase">{{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-[8px] text-gray-600 font-black uppercase tracking-widest mb-1">Epoch End</p>
                                <p class="text-xs font-bold text-white uppercase">{{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Settlement Module -->
                <div class="space-y-8">
                    <div class="glass p-10 rounded-[2.5rem] border-indigo-500/20 shadow-2xl relative">
                        <div class="absolute inset-0 bg-indigo-500/[0.02] rounded-[2.5rem]"></div>
                        <h3 class="text-xs font-black text-indigo-400 uppercase tracking-widest mb-10 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span>
                            Settlement Ledger
                        </h3>

                        <div class="space-y-4 mb-10">
                            <div class="flex justify-between items-center text-gray-400 text-xs font-bold uppercase tracking-widest">
                                <span>Day Rate Cap</span>
                                <span class="text-white">৳ {{ number_format($booking->car->price_per_day) }}</span>
                            </div>
                            <div class="flex justify-between items-center text-gray-400 text-xs font-bold uppercase tracking-widest">
                                <span>Duration Epoch</span>
                                <span class="text-white">{{ \Carbon\Carbon::parse($booking->start_date)->diffInDays($booking->end_date) ?: 1 }} Days</span>
                            </div>
                            <div class="flex justify-between items-center text-gray-400 text-[10px] font-black uppercase tracking-widest pt-4 border-t border-white/5">
                                <span class="text-indigo-400">Security Deposit</span>
                                <span class="text-white">৳ {{ number_format($booking->security_deposit_amount) }}</span>
                            </div>
                            <div class="h-px bg-gradient-to-r from-transparent via-white/10 to-transparent my-6"></div>
                            <div class="flex justify-between items-end">
                                <span class="text-[10px] font-black text-gray-600 uppercase tracking-[0.3em] italic">Total Settle</span>
                                <span class="text-4xl font-black text-white tracking-tighter">৳ {{ number_format($booking->total_price) }}</span>
                            </div>
                        </div>

                        <form action="{{ route('customer.bookings.pay', $booking) }}" method="POST" class="space-y-6">
                            @csrf
                            <div class="p-6 bg-gray-950/80 border border-white/5 rounded-3xl space-y-4">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest">Payment Method</span>
                                    <div class="flex gap-2">
                                        <div class="w-8 h-5 bg-white/5 rounded border border-white/10 flex items-center justify-center text-[6px] font-black opacity-50 italic">VISA</div>
                                        <div class="w-8 h-5 bg-white/5 rounded border border-white/10 flex items-center justify-center text-[6px] font-black opacity-50 italic">BKASH</div>
                                    </div>
                                </div>
                                <div class="text-[10px] text-emerald-400 font-bold italic flex items-center gap-2 bg-emerald-500/5 p-3 rounded-xl border border-emerald-500/10">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                    End-to-end encrypted protocol active
                                </div>
                            </div>

                            <button type="submit" class="w-full py-5 bg-indigo-600 hover:bg-indigo-500 text-white font-black text-[10px] uppercase tracking-[0.4em] rounded-[2rem] shadow-[0_20px_40px_rgba(99,102,241,0.2)] transition-all transform hover:scale-[1.02] active:scale-[0.98]">
                                Authorize Transaction
                            </button>
                        </form>
                        
                        <a href="{{ route('customer.bookings.index') }}" class="block text-center mt-6 text-[8px] font-black text-gray-600 hover:text-white uppercase tracking-widest transition-colors">Abort Settlement →</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
