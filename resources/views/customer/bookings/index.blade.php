<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-black text-2xl leading-tight text-white">
                    {{ __('Travel Itineraries') }}
                </h2>
                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-[0.2em] mt-1">Status of your decentralized car-sharing requests</p>
            </div>
            <a href="{{ route('home') }}" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-[10px] font-black uppercase tracking-widest rounded-xl transition-all shadow-xl shadow-indigo-600/20">
                Initiate New Booking
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-indigo-600/5 rounded-full blur-[150px] -z-10"></div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-8 bg-emerald-500/10 border border-emerald-500/50 text-emerald-400 p-4 rounded-2xl font-bold text-sm flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 overflow-hidden shadow-2xl rounded-[2.5rem]">
                @if($bookings->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-white/5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">
                                    <th class="pb-6 pl-8">Vehicle & Destination</th>
                                    <th class="pb-6">Host Intel</th>
                                    <th class="pb-6">Timeframe</th>
                                    <th class="pb-6">Outcome (Price)</th>
                                    <th class="pb-6 text-right pr-8">Status Cycle</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @foreach($bookings as $booking)
                                    <tr class="group hover:bg-white/[0.02] transition-colors">
                                        <td class="py-8 pl-8">
                                            <div class="flex items-center gap-4">
                                                <div class="w-16 h-12 rounded-xl overflow-hidden border border-white/10 shadow-lg bg-gray-800">
                                                    @if($booking->car->images->count() > 0)
                                                        <img src="{{ Storage::url($booking->car->images->first()->image_path) }}" alt="Car" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                                    @endif
                                                </div>
                                                <div>
                                                    <a href="{{ route('cars.show', $booking->car) }}" class="text-sm font-bold text-white hover:text-indigo-400 transition-colors block">
                                                        {{ $booking->car->title }}
                                                    </a>
                                                    <div class="text-[9px] text-gray-500 font-bold uppercase tracking-widest mt-1">{{ $booking->car->location }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-8">
                                            <a href="{{ route('profiles.show', $booking->car->owner) }}" class="flex items-center gap-3 group/owner">
                                                <div class="w-8 h-8 rounded-lg bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-[10px] font-black text-indigo-400 group-hover/owner:bg-indigo-600 group-hover/owner:text-white transition-all">
                                                    {{ substr($booking->car->owner->name, 0, 1) }}
                                                </div>
                                                <div class="text-sm font-bold text-gray-300 group-hover/owner:text-white transition-colors">{{ $booking->car->owner->name }}</div>
                                            </a>
                                        </td>
                                        <td class="py-8 text-[11px] font-mono text-gray-400">
                                            <div>{{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}</div>
                                            <div class="text-gray-600 mt-1">→ {{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</div>
                                        </td>
                                        <td class="py-8">
                                            <div class="text-sm font-black text-white">৳ {{ number_format($booking->total_price, 0) }}</div>
                                            @if($booking->payment_status === 'paid')
                                                <span class="text-[8px] font-black uppercase tracking-widest text-emerald-400">Settled ✓</span>
                                            @else
                                                <span class="text-[8px] font-black uppercase tracking-widest text-yellow-500/50">Await Settlement</span>
                                            @endif
                                        </td>
                                        <td class="py-8 text-right pr-8">
                                            <div class="flex items-center justify-end gap-3">
                                                 {{-- Action Buttons --}}
                                                 <div class="flex gap-2">
                                                    <a href="{{ route('bookings.messages.index', $booking) }}" class="p-2.5 bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white rounded-xl border border-white/5 transition-all" title="Chat with Host">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                                    </a>
                                                    
                                                    @if(in_array($booking->status, ['completed', 'approved']))
                                                        <a href="{{ route('invoices.download', $booking) }}" class="p-2.5 bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white rounded-xl border border-white/5 transition-all" title="Download Invoice">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                        </a>
                                                    @endif
                                                 </div>

                                                @if($booking->status === 'approved' && $booking->payment_status === 'pending')
                                                    <form action="{{ route('customer.bookings.pay', $booking) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-[10px] font-black uppercase tracking-widest rounded-xl transition-all shadow-xl shadow-indigo-600/20">Finalize Payment</button>
                                                    </form>
                                                @endif

                                                <div class="min-w-[100px]">
                                                    @if($booking->status === 'pending')
                                                        <span class="px-3 py-1 bg-yellow-500/10 text-yellow-400 border border-yellow-500/20 rounded-lg text-[9px] font-black uppercase tracking-widest">Awaiting Approval</span>
                                                    @elseif($booking->status === 'approved')
                                                        <span class="px-3 py-1 bg-blue-500/10 text-blue-400 border border-blue-500/20 rounded-lg text-[9px] font-black uppercase tracking-widest">Active Schedule</span>
                                                    @elseif($booking->status === 'completed')
                                                        <span class="px-3 py-1 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 rounded-lg text-[9px] font-black uppercase tracking-widest">Completed</span>
                                                    @else
                                                        <span class="px-3 py-1 bg-gray-500/10 text-gray-400 border border-gray-500/20 rounded-lg text-[9px] font-black uppercase tracking-widest">{{ $booking->status }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="py-24 text-center">
                        <div class="w-24 h-24 bg-gray-900 rounded-[2rem] border border-white/5 flex items-center justify-center mx-auto mb-6 text-4xl opacity-20">🛸</div>
                        <h3 class="text-white font-black uppercase tracking-widest text-sm mb-2">Workspace Empty</h3>
                        <p class="text-gray-600 text-[11px] italic">You have no active vehicle lease authorizations at this time.</p>
                    </div>
                @endif
            </div>

            @if($bookings->hasPages())
                <div class="mt-8">
                    {{ $bookings->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
