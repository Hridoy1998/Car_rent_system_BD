<?php

use Livewire\Volt\Component;
use App\Models\Booking;

new class extends Component
{
    public function getActionQueueProperty()
    {
        return Booking::with(['customer', 'car', 'damageReports', 'earnings'])
            ->whereHas('car', fn ($q) => $q->where('user_id', auth()->id()))
            ->whereIn('status', ['pending', 'approved', 'ongoing', 'returned'])
            ->latest()
            ->take(6)
            ->get();
    }

    public function updateStatus($id, $status)
    {
        $booking = Booking::with('car')->find($id);
        if ($booking && $booking->car->user_id === auth()->id()) {
            $booking->update(['status' => $status]);
        }
    }
};
?>

<div wire:poll.10s class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 rounded-[3rem] overflow-hidden shadow-2xl">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="text-[9px] font-black text-gray-600 uppercase tracking-[0.3em] bg-white/[0.01] border-b border-white/5">
                    <th class="px-10 py-7">Operator Identity</th>
                    <th class="px-10 py-7">Target Asset</th>
                    <th class="px-10 py-7">Status Delta</th>
                    <th class="px-10 py-7 text-right">Yield Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($this->actionQueue as $booking)
                <tr class="group hover:bg-white/[0.02] transition-colors">
                    <td class="px-10 py-8">
                        <a href="{{ route('profiles.show', $booking->customer) }}" class="flex items-center gap-4 group/renter">
                            <div class="w-12 h-12 rounded-2xl bg-gray-800 border border-white/10 flex items-center justify-center text-xs font-black text-indigo-400 group-hover/renter:bg-indigo-600 group-hover/renter:text-white transition-all overflow-hidden shadow-lg">
                                @if($booking->customer->profile_photo)
                                    <img src="{{ asset('storage/' . $booking->customer->profile_photo) }}" class="w-full h-full object-cover">
                                @else
                                    {{ strtoupper(substr($booking->customer->name, 0, 1)) }}
                                @endif
                            </div>
                            <div class="flex flex-col">
                                <a href="{{ route('owner.bookings.show', $booking) }}" class="text-xs font-black text-gray-200 uppercase tracking-tight hover:text-indigo-400 transition-colors">{{ $booking->customer->name }}</a>
                                <div class="text-[9px] text-gray-600 font-bold uppercase italic mt-0.5 tracking-widest leading-none">Reputation: High</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-10 py-8">
                        @php
                            $targetRoute = match($booking->status) {
                                'approved', 'ongoing', 'returned' => route('owner.logistics.show', $booking),
                                'completed' => route('owner.finance.show', ['earning' => $booking->earnings->first()->id ?? 0]), // Fallback if no earning
                                default => route('owner.bookings.show', $booking),
                            };
                            // If there's a pending damage report, prioritize Integrity hub
                            if ($booking->damageReports->where('status', 'pending')->count() > 0) {
                                $targetRoute = route('owner.integrity.show', $booking->damageReports->where('status', 'pending')->first());
                            }
                        @endphp
                        <a href="{{ $targetRoute }}" class="flex flex-col group/asset">
                            <span class="text-xs font-bold text-white uppercase tracking-widest group-hover/asset:text-indigo-400 transition-colors">{{ $booking->car->brand }}</span>
                            <span class="text-[9px] text-gray-600 font-black uppercase italic">{{ $booking->car->model }}</span>
                        </a>
                    </td>
                    <td class="px-10 py-8">
                            @php
                            $statusColors = [
                                'pending' => 'bg-amber-500/10 text-amber-500 border-amber-500/20 shadow-[0_0_10px_rgba(245,158,11,0.2)]',
                                'approved' => 'bg-blue-500/10 text-blue-500 border-blue-500/20',
                                'ongoing' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                                'returned' => 'bg-purple-500/10 text-purple-400 border-purple-500/20',
                            ];
                            $color = $statusColors[$booking->status] ?? 'bg-white/5 text-gray-500 border-white/10';
                        @endphp
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full {{ explode(' ', $color)[1] }} {{ $booking->status === 'pending' ? 'animate-pulse shadow-[0_0_8px_currentColor]' : '' }}"></span>
                            <span class="px-2.5 py-1 rounded-lg text-[8px] font-black uppercase tracking-widest border {{ $color }}">
                                {{ strtoupper($booking->status) }}
                            </span>
                        </div>
                    </td>
                    <td class="px-10 py-8 text-right">
                        <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            @if($booking->status === 'pending')
                                <button wire:click="updateStatus({{ $booking->id }}, 'approved')" class="p-2 bg-emerald-500/20 text-emerald-500 hover:bg-emerald-500 hover:text-white rounded-xl border border-emerald-500/20 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                </button>
                                <button wire:click="updateStatus({{ $booking->id }}, 'rejected')" class="p-2 bg-red-500/20 text-red-500 hover:bg-red-500 hover:text-white rounded-xl border border-red-500/20 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            @endif
                            <a href="{{ route('owner.bookings.show', $booking) }}" class="p-2 bg-white/5 text-gray-400 hover:text-white rounded-xl border border-white/10 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-10 py-32 text-center">
                        <div class="text-[10px] text-gray-700 font-black uppercase tracking-[0.4em] italic opacity-20">Awaiting tactical engagement signals</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>