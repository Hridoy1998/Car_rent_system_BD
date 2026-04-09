<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-black text-2xl leading-tight text-white">
                    {{ __('Transaction Oversight') }}
                </h2>
                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-[0.2em] mt-1">Global audit of vehicle lease agreements and financial settlement</p>
            </div>
            <div class="flex gap-4">
                 <div class="px-6 py-2 bg-gray-900 border border-white/10 rounded-2xl">
                    <p class="text-[8px] text-gray-600 font-black uppercase">Active Ledger</p>
                    <p class="text-xs font-black text-white">Total: {{ $bookings->total() }} Records</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen text-slate-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Global Search & Filters -->
            <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 p-6 rounded-[2rem] shadow-2xl flex flex-col md:flex-row gap-4 items-center justify-between">
                <form action="{{ route('admin.bookings.index') }}" method="GET" class="relative w-full md:w-96">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by user, car, or ID..." class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 pl-12 text-sm text-white focus:ring-indigo-500">
                    <svg class="absolute left-4 top-4 w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </form>
                <div class="flex gap-2">
                    <select class="bg-gray-950 border border-white/5 rounded-xl px-4 py-2 text-[10px] font-black uppercase tracking-widest text-gray-400 focus:ring-indigo-500">
                        <option>Status: All</option>
                        <option>Pending</option>
                        <option>Approved</option>
                        <option>Completed</option>
                    </select>
                </div>
            </div>

            <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 overflow-hidden shadow-2xl rounded-[2.5rem]">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-white/5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">
                                <th class="py-8 pl-8">Lease Manifest (Asset)</th>
                                <th class="py-8">Stakeholders (Host/Client)</th>
                                <th class="py-8">Financials</th>
                                <th class="py-8">Process Cycle</th>
                                <th class="py-8 text-right pr-8">Audit Control</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach ($bookings as $booking)
                                <tr class="group hover:bg-white/[0.02] transition-colors">
                                    <td class="py-8 pl-8">
                                        <div class="flex items-center gap-4">
                                            <div class="w-16 h-12 rounded-xl overflow-hidden border border-white/10 shadow-lg relative bg-gray-800">
                                                @if($booking->car->images->count() > 0)
                                                    <img src="{{ Storage::url($booking->car->images->first()->image_path) }}" class="w-full h-full object-cover">
                                                @endif
                                            </div>
                                            <div>
                                                <div class="text-[8px] text-indigo-500 font-black uppercase tracking-widest mb-1">ID #B-{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</div>
                                                <a href="{{ route('cars.show', $booking->car) }}" class="font-bold text-white hover:text-indigo-400 transition-colors block">{{ $booking->car->title }}</a>
                                                <div class="text-[9px] text-gray-600 font-bold uppercase mt-1">{{ $booking->car->location }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-8">
                                        <div class="space-y-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-6 h-6 rounded-md bg-purple-500/10 border border-purple-500/20 flex items-center justify-center text-[8px] font-black text-purple-400">H</div>
                                                <a href="{{ route('profiles.show', $booking->car->owner) }}" class="text-[10px] font-bold text-gray-300 hover:text-indigo-400 transition-colors">{{ $booking->car->owner->name }}</a>
                                            </div>
                                            <div class="flex items-center gap-3">
                                                <div class="w-6 h-6 rounded-md bg-green-500/10 border border-green-500/20 flex items-center justify-center text-[8px] font-black text-green-400">C</div>
                                                <a href="{{ route('profiles.show', $booking->customer) }}" class="text-[10px] font-bold text-gray-300 hover:text-indigo-400 transition-colors">{{ $booking->customer->name }}</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-8">
                                        <div class="text-[11px] font-black text-white">৳ {{ number_format($booking->total_price, 0) }}</div>
                                        <div class="flex items-center gap-1.5 mt-1">
                                            @if($booking->payment_status === 'paid')
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                <span class="text-[8px] font-black text-emerald-500 uppercase">Paid</span>
                                            @else
                                                <span class="w-1.5 h-1.5 rounded-full bg-yellow-500/50"></span>
                                                <span class="text-[8px] font-black text-gray-600 uppercase">Unpaid</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="py-8">
                                        @if($booking->status === 'pending')
                                            <span class="px-2 py-0.5 bg-yellow-500/10 text-yellow-400 border border-yellow-500/20 rounded-md text-[8px] font-black uppercase tracking-widest">Pending</span>
                                        @elseif($booking->status === 'approved')
                                            <span class="px-2 py-0.5 bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 rounded-md text-[8px] font-black uppercase tracking-widest">Authorized</span>
                                        @elseif($booking->status === 'completed')
                                            <span class="px-2 py-0.5 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 rounded-md text-[8px] font-black uppercase tracking-widest">Succeeded</span>
                                        @else
                                            <span class="px-2 py-0.5 bg-white/5 text-gray-500 border border-white/10 rounded-md text-[8px] font-black uppercase tracking-widest">{{ $booking->status }}</span>
                                        @endif
                                        <div class="text-[8px] text-gray-700 font-bold uppercase mt-2">{{ \Carbon\Carbon::parse($booking->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($booking->end_date)->format('M d') }}</div>
                                    </td>
                                    <td class="py-8 text-right pr-8">
                                        <div class="flex justify-end gap-2 group-hover:translate-x-[-4px] transition-transform">
                                            <a href="{{ route('admin.bookings.show', $booking) }}" class="p-3 bg-white/5 hover:bg-indigo-600 hover:text-white text-gray-400 rounded-2xl border border-white/5 transition-all shadow-lg">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </a>
                                            <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="cancelled">
                                                <button type="submit" class="p-3 bg-red-600/10 hover:bg-red-600 hover:text-white text-red-500 rounded-2xl border border-red-500/20 transition-all shadow-lg" title="Invoke Cancellation">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($bookings->hasPages())
                    <div class="p-8 border-t border-white/5">
                        {{ $bookings->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>

            @if($bookings->isEmpty())
                <div class="py-24 text-center">
                    <div class="text-4xl mb-4 opacity-10">📜</div>
                    <h3 class="text-gray-500 font-black uppercase tracking-widest text-xs">No Records Found</h3>
                    <p class="text-gray-700 text-[10px] italic mt-1">Transaction ledger is currently devoid of matching manifest entries.</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
