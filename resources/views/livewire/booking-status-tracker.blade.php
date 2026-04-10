<?php

use Livewire\Volt\Component;
use App\Models\Booking;

new class extends Component
{
    public Booking $booking;

    public function getStatusProperty()
    {
        return $this->booking->fresh()->status;
    }

    public function getProgressProperty()
    {
        $stages = [
            'pending' => 10,
            'approved' => 30,
            'ongoing' => 60,
            'returning' => 85,
            'completed' => 100,
            'cancelled' => 0,
            'rejected' => 0
        ];

        return $stages[$this->status] ?? 0;
    }
};
?>

<div wire:poll.5s class="glass p-8 rounded-[2.5rem] border-white/5 relative overflow-hidden group">
    <div class="flex justify-between items-start mb-8">
        <div>
            <h3 class="text-xs font-black text-gray-500 uppercase tracking-widest mb-1 italic">Mission Status</h3>
            <div class="text-2xl font-black text-white tracking-tighter uppercase italic flex items-center gap-3">
                @php
                    $colors = [
                        'pending' => 'text-amber-500',
                        'approved' => 'text-blue-500',
                        'ongoing' => 'text-emerald-400',
                        'returning' => 'text-purple-400',
                        'completed' => 'text-emerald-500',
                        'cancelled' => 'text-red-500',
                        'rejected' => 'text-red-600',
                    ];
                @endphp
                <span class="{{ $colors[$this->status] ?? 'text-gray-500' }}">{{ strtoupper($this->status) }}</span>
                @if(in_array($this->status, ['pending', 'ongoing', 'returning']))
                    <span class="w-2 h-2 rounded-full bg-current animate-ping"></span>
                @endif
            </div>
        </div>
        <div class="relative w-16 h-16 flex items-center justify-center">
            <svg class="w-full h-full transform -rotate-90">
                <circle cx="32" cy="32" r="28" stroke="currentColor" stroke-width="4" fill="transparent" class="text-white/5" />
                <circle cx="32" cy="32" r="28" stroke="currentColor" stroke-width="4" fill="transparent" 
                        stroke-dasharray="175.9" 
                        stroke-dashoffset="{{ 175.9 * (1 - $this->progress / 100) }}" 
                        class="text-indigo-500 transition-all duration-1000 ease-in-out" />
            </svg>
            <span class="absolute text-[8px] font-black text-white">{{ $this->progress }}%</span>
        </div>
    </div>

    <div class="space-y-4">
        <div class="flex items-center gap-4">
            <div class="w-1.5 h-1.5 rounded-full {{ $this->progress >= 30 ? 'bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]' : 'bg-gray-800' }}"></div>
            <span class="text-[10px] font-black uppercase tracking-widest {{ $this->progress >= 30 ? 'text-gray-200' : 'text-gray-700' }}">Authorization Secured</span>
        </div>
        <div class="flex items-center gap-4">
            <div class="w-1.5 h-1.5 rounded-full {{ $this->progress >= 60 ? 'bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]' : 'bg-gray-800' }}"></div>
            <span class="text-[10px] font-black uppercase tracking-widest {{ $this->progress >= 60 ? 'text-gray-200' : 'text-gray-700' }}">Asset Deployed</span>
        </div>
        <div class="flex items-center gap-4">
            <div class="w-1.5 h-1.5 rounded-full {{ $this->progress >= 100 ? 'bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]' : 'bg-gray-800' }}"></div>
            <span class="text-[10px] font-black uppercase tracking-widest {{ $this->progress >= 100 ? 'text-gray-200' : 'text-gray-700' }}">Mission Terminated</span>
        </div>
    </div>

    @if($this->status === 'approved' && auth()->check() && auth()->user()->role === 'customer')
        <a href="{{ route('customer.bookings.checkout', $booking) }}" class="mt-8 block w-full py-4 bg-indigo-600 hover:bg-indigo-500 text-white text-center text-[9px] font-black uppercase tracking-widest rounded-2xl transition-all shadow-[0_10px_20px_rgba(99,102,241,0.2)]">
            Finalize Settlement
        </a>
    @endif
</div>