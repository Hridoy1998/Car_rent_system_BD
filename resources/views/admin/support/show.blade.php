<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-6">
                <a href="{{ route('admin.support.index') }}" class="p-3 bg-gray-900 border border-white/10 rounded-2xl text-gray-500 hover:text-white transition-all shadow-xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <div>
                    <h2 class="font-black text-2xl leading-tight text-white uppercase tracking-tighter italic">
                        {{ __('Intercept Protocol') }}
                    </h2>
                    <p class="text-[10px] text-indigo-400 font-bold uppercase tracking-[0.2em] mt-1">Direct stream observation: #B-{{ $booking->id }}</p>
                </div>
            </div>
             <div class="flex gap-3">
                <span class="px-5 py-2 bg-red-600/10 border border-red-500/20 text-red-500 text-[9px] font-black uppercase tracking-widest rounded-xl animate-pulse">
                    Monitoring Active
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Context Tray -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                <a href="{{ route('profiles.show', $booking->customer) }}" class="bg-gray-900/60 border border-white/5 p-6 rounded-[2rem] flex items-center gap-4 group/renter hover:border-indigo-500/30 transition-all">
                    <div class="w-10 h-10 rounded-xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-xs font-black text-indigo-400 font-black group-hover/renter:bg-indigo-600 group-hover/renter:text-white transition-all">{{ substr($booking->customer->name, 0, 1) }}</div>
                    <div>
                        <p class="text-[9px] text-gray-600 font-black uppercase tracking-widest">Client Identity</p>
                        <p class="text-xs font-black text-white italic uppercase group-hover/renter:text-indigo-400 transition-colors">{{ $booking->customer->name }}</p>
                    </div>
                </a>
                <a href="{{ route('profiles.show', $booking->car->owner) }}" class="bg-gray-900/60 border border-white/5 p-6 rounded-[2rem] flex items-center gap-4 group/host hover:border-pink-500/30 transition-all">
                    <div class="w-10 h-10 rounded-xl bg-pink-500/10 border border-pink-500/20 flex items-center justify-center text-xs font-black text-pink-400 font-black group-hover/host:bg-pink-600 group-hover/host:text-white transition-all">{{ substr($booking->car->owner->name, 0, 1) }}</div>
                    <div>
                        <p class="text-[9px] text-gray-600 font-black uppercase tracking-widest">Host Authority</p>
                        <p class="text-xs font-black text-white italic uppercase group-hover/host:text-pink-400 transition-colors">{{ $booking->car->owner->name }}</p>
                    </div>
                </a>
            </div>

            <!-- Intercepted Stream -->
            <div class="bg-gray-900/40 backdrop-blur-2xl border border-white/5 rounded-[3rem] overflow-hidden shadow-2xl flex flex-col h-[600px]">
                <div class="p-8 border-b border-white/5 bg-white/[0.02]">
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-[0.3em] flex items-center gap-3">
                         <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                         Raw Signal Log
                    </h3>
                </div>

                <div class="flex-1 overflow-y-auto p-10 space-y-6 scrollbar-hide">
                    @forelse($booking->messages as $message)
                        <div class="flex {{ $message->sender_id === $booking->customer_id ? 'justify-start' : 'justify-end' }}">
                            <div class="max-w-[80%] space-y-1">
                                <div class="flex items-center gap-2 {{ $message->sender_id === $booking->customer_id ? 'flex-row' : 'flex-row-reverse' }}">
                                    <span class="text-[8px] font-black uppercase tracking-widest {{ $message->sender_id === $booking->customer_id ? 'text-indigo-400' : 'text-pink-400' }}">
                                        {{ $message->sender->name }}
                                    </span>
                                    <span class="text-[7px] text-gray-700 font-bold uppercase">{{ $message->created_at->format('H:i') }}</span>
                                </div>
                                <div class="px-6 py-4 rounded-3xl text-xs leading-relaxed font-bold shadow-2xl border 
                                    {{ $message->sender_id === $booking->customer_id 
                                        ? 'bg-gray-800/80 border-indigo-500/10 text-gray-200 ml-4 rounded-tl-none' 
                                        : 'bg-indigo-600/10 border-pink-500/10 text-gray-100 mr-4 rounded-tr-none' }}">
                                    {{ $message->content }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="h-full flex items-center justify-center">
                            <p class="text-[10px] text-gray-700 font-black uppercase tracking-[0.4em] italic opacity-20 text-center">No meaningful transmissions detected in this frequency</p>
                        </div>
                    @endforelse
                </div>
                
                <div class="p-10 border-t border-white/5 bg-gray-950/50 flex items-center justify-between">
                     <p class="text-[9px] text-gray-600 font-black uppercase tracking-widest italic leading-relaxed max-w-sm">ADMIN NOTICE: This interception protocol is for platform security and quality assurance only. Direct interference is currently disabled.</p>
                     <button disabled class="px-8 py-3 bg-white/5 text-gray-700 text-[9px] font-black uppercase tracking-widest rounded-2xl border border-white/5 cursor-not-allowed">Direct Intervention Locked</button>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
