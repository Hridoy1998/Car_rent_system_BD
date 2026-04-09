<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-black text-2xl leading-tight text-white uppercase tracking-tighter">
                    {{ __('Support Command Hub') }}
                </h2>
                <p class="text-[10px] text-indigo-400 font-bold uppercase tracking-[0.2em] mt-1">Global monitoring of platform-wide stakeholder communications</p>
            </div>
            <div class="flex items-center gap-3">
                 <span class="px-4 py-2 bg-indigo-600/10 border border-indigo-500/20 text-indigo-400 text-[10px] font-black uppercase tracking-widest rounded-xl">
                    {{ $activeChats->total() }} Signal Streams Detected
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen relative overflow-hidden">
        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-indigo-600/5 rounded-full blur-[120px] -z-10"></div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            <div class="grid grid-cols-1 gap-6">
                @forelse($activeChats as $booking)
                <div class="bg-gray-900/40 backdrop-blur-2xl border border-white/5 p-8 rounded-[2.5rem] shadow-2xl group hover:border-indigo-500/30 transition-all">
                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                        <!-- Stakeholders -->
                        <div class="lg:col-span-1 space-y-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-xs font-black text-indigo-400">
                                    {{ substr($booking->customer->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-[10px] text-gray-500 font-black uppercase mb-1">Customer / Renter</p>
                                    <a href="{{ route('profiles.show', $booking->customer) }}" class="text-xs font-black text-white italic tracking-tight hover:text-indigo-400 transition-colors">{{ $booking->customer->name }}</a>
                                </div>
                            </div>
                             <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-pink-500/10 border border-pink-500/20 flex items-center justify-center text-xs font-black text-pink-400">
                                    {{ substr($booking->car->owner->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-[10px] text-gray-500 font-black uppercase mb-1">Host / Owner</p>
                                    <a href="{{ route('profiles.show', $booking->car->owner) }}" class="text-xs font-black text-white italic tracking-tight hover:text-pink-400 transition-colors">{{ $booking->car->owner->name }}</a>
                                </div>
                            </div>
                        </div>

                        <!-- Asset & Intel -->
                        <div class="lg:col-span-1 flex flex-col justify-center">
                            <div class="p-4 bg-gray-950/50 rounded-3xl border border-white/5">
                                <p class="text-[9px] text-indigo-500 font-black uppercase tracking-widest mb-2">Subject Asset</p>
                                <a href="{{ route('cars.show', $booking->car) }}" class="text-sm font-black text-white italic hover:text-indigo-400 transition-colors">{{ $booking->car->brand }} {{ $booking->car->model }}</a>
                                <p class="text-[10px] text-gray-600 mt-1 font-bold uppercase">Booking #B-{{ $booking->id }}</p>
                            </div>
                        </div>

                        <!-- Last Signal -->
                        <div class="lg:col-span-1 flex flex-col justify-center">
                            @php $lastMsg = $booking->messages->last(); @endphp
                            <div class="space-y-2">
                                <p class="text-[10px] text-gray-600 font-black uppercase tracking-widest">Last Signal Pulse</p>
                                <p class="text-xs text-gray-400 line-clamp-2 italic leading-relaxed">"{{ $lastMsg->content ?? 'No transmission' }}"</p>
                                <p class="text-[8px] text-indigo-400 font-black uppercase mt-1">{{ $lastMsg ? $lastMsg->created_at->diffForHumans() : '' }}</p>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="lg:col-span-1 flex items-center justify-end">
                            <a href="{{ route('admin.support.show', $booking) }}" class="px-8 py-4 bg-indigo-600 hover:bg-indigo-500 text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-2xl shadow-xl shadow-indigo-600/20 transition-all">Intercept Stream</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="py-24 text-center">
                    <div class="w-24 h-24 bg-gray-900 rounded-[2rem] border border-white/5 flex items-center justify-center mx-auto mb-6 text-4xl opacity-20">📡</div>
                    <h3 class="text-white font-black uppercase tracking-widest text-sm mb-2">No Signal Detected</h3>
                    <p class="text-gray-600 text-[11px] italic">Platform message streams are currently offline or devoid of active traffic.</p>
                </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $activeChats->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
