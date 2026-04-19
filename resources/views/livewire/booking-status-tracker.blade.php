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

<div class="relative bg-white border border-gray-100 p-6 md:p-14 rounded-[2rem] md:rounded-[4rem] shadow-[0_45px_110px_rgba(0,0,0,0.03)] overflow-hidden group">
    <div class="absolute -right-20 -top-20 w-48 md:w-64 h-48 md:h-64 bg-gray-50 rounded-full blur-[80px] md:blur-[100px] group-hover:bg-orange-50/30 transition-all duration-1000"></div>
    <div class="flex flex-col sm:flex-row justify-between items-center gap-8 mb-10 md:mb-12">
        <div class="text-center sm:text-left">
            <h3 class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2 italic leading-none">Operational Status</h3>
            <div class="text-3xl md:text-4xl font-black text-[#050B1A] tracking-tight uppercase italic flex items-center justify-center sm:justify-start gap-4 leading-none">
                @php
                    $colors = [
                        'pending' => 'text-amber-500',
                        'approved' => 'text-blue-500',
                        'ongoing' => 'text-emerald-500',
                        'returning' => 'text-purple-500',
                        'completed' => 'text-emerald-600',
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
        <div class="relative w-20 h-20 md:w-24 md:h-24 flex items-center justify-center">
            <svg class="w-full h-full transform -rotate-90">
                <circle cx="40" cy="40" r="35" stroke="currentColor" stroke-width="6" fill="transparent" class="text-gray-50" />
                <circle cx="40" cy="40" r="35" stroke="currentColor" stroke-width="6" fill="transparent" 
                        stroke-dasharray="219.9" 
                        stroke-dashoffset="{{ 219.9 * (1 - $this->progress / 100) }}" 
                        class="text-orange-500 transition-all duration-1000 ease-in-out" />
            </svg>
            <span class="absolute text-xs md:text-sm font-black text-[#050B1A] italic">{{ $this->progress }}%</span>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 md:gap-12 relative z-10 border-t border-gray-50 pt-10 md:pt-12">
        <div class="flex items-center gap-5">
            <div class="w-12 h-12 md:w-16 md:h-16 bg-[#050B1A] rounded-xl md:rounded-[1.5rem] flex items-center justify-center text-white shadow-xl border border-white/10 italic font-black text-xl md:text-2xl group-hover:rotate-12 transition-transform">MS</div>
            <div>
                <h4 class="text-sm md:text-base font-black text-[#050B1A] uppercase italic tracking-tight leading-none">Protocol</h4>
                <p class="text-[9px] text-gray-400 font-black uppercase tracking-widest mt-2 italic leading-none truncate">Phase: {{ $this->status }}</p>
            </div>
        </div>
        <div class="space-y-4">
            <div class="flex items-center gap-4">
                <div class="w-2 h-2 rounded-full {{ $this->progress >= 30 ? 'bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.4)]' : 'bg-gray-100' }}"></div>
                <span class="text-[10px] font-black uppercase tracking-widest {{ $this->progress >= 30 ? 'text-[#050B1A]' : 'text-gray-300' }}">Authorization Secured</span>
            </div>
            <div class="flex items-center gap-4">
                <div class="w-2 h-2 rounded-full {{ $this->progress >= 60 ? 'bg-emerald-500 shadow-[0_0_100px_rgba(16,185,129,0.4)]' : 'bg-gray-100' }}"></div>
                <span class="text-[10px] font-black uppercase tracking-widest {{ $this->progress >= 60 ? 'text-[#050B1A]' : 'text-gray-300' }}">Asset Deployed</span>
            </div>
            <div class="flex items-center gap-4">
                <div class="w-2 h-2 rounded-full {{ $this->progress >= 100 ? 'bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.4)]' : 'bg-gray-100' }}"></div>
                <span class="text-[10px] font-black uppercase tracking-widest {{ $this->progress >= 100 ? 'text-[#050B1A]' : 'text-gray-300' }}">Mission Terminated</span>
            </div>
        </div>
    </div>

    @if($this->status === 'approved' && auth()->check() && auth()->user()->role === 'customer')
        <a href="{{ route('customer.bookings.checkout', $booking) }}" class="mt-8 block w-full py-4 bg-indigo-600 hover:bg-indigo-500 text-white text-center text-[9px] font-black uppercase tracking-widest rounded-2xl transition-all shadow-[0_10px_20px_rgba(99,102,241,0.2)]">
            Finalize Settlement
        </a>
    @endif
</div>