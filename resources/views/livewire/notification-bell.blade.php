<?php

use Livewire\Volt\Component;

new class extends Component
{
    public function getNotificationsProperty()
    {
        return auth()->check() ? auth()->user()->unreadNotifications : collect();
    }

    public function markAsRead($id)
    {
        if (auth()->check()) {
            auth()->user()->notifications()->find($id)?->markAsRead();
        }
    }

    public function markAllAsRead()
    {
        if (auth()->check()) {
            auth()->user()->unreadNotifications->markAsRead();
        }
    }
};
?>

<div class="relative" x-data="{ open: false }">
    <button @click="open = !open" class="inline-flex items-center justify-center p-1 px-4 bg-gray-50 hover:bg-white text-gray-400 hover:text-orange-500 transition-all duration-300 rounded-2xl border border-gray-100 group h-10 relative shadow-sm">
        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
        </svg>
        
        @if($this->notifications->count() > 0)
            <span class="absolute -top-1 -right-1 flex h-5 w-5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-5 w-5 bg-orange-500 text-[9px] items-center justify-center font-black text-white shadow-lg border-2 border-white">
                    {{ $this->notifications->count() }}
                </span>
            </span>
        @endif
    </button>

    <div x-show="open" 
         @click.away="open = false" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95 translate-y-[-10px]"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         class="fixed sm:absolute inset-x-4 sm:right-0 sm:inset-auto mt-2 sm:mt-5 w-auto sm:w-[22rem] bg-white rounded-[2rem] sm:rounded-[2.5rem] shadow-[0_40px_100px_rgba(0,0,0,0.15)] z-[60] overflow-hidden border border-gray-100" 
         x-cloak>
        
        <div class="px-8 py-6 border-b border-gray-50 bg-gray-50/50 flex justify-between items-center">
            <span class="text-[10px] font-black uppercase tracking-[0.4em] text-[#050B1A] italic">Tactical Activity</span>
            @if($this->notifications->count() > 0)
                <button wire:click="markAllAsRead" class="text-[9px] font-black text-orange-500 hover:text-[#050B1A] uppercase tracking-widest transition-colors italic leading-none">Mark all read</button>
            @endif
        </div>

        <div class="max-h-[32rem] overflow-y-auto custom-scrollbar">
            @forelse($this->notifications->take(8) as $notification)
                <a href="{{ route('notifications.show', $notification->id) }}" class="block px-8 py-6 hover:bg-gray-50/50 border-b border-gray-50 transition-all group/note relative">
                    <div class="flex gap-5">
                        <div class="mt-1.5 flex-shrink-0 relative">
                            <div class="w-2.5 h-2.5 rounded-full {{ $notification->read_at ? 'bg-gray-200' : 'bg-orange-500 shadow-lg shadow-orange-500/20' }}"></div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[12px] {{ $notification->read_at ? 'text-gray-400 font-bold' : 'text-[#050B1A] font-black' }} tracking-tight leading-snug mb-2 italic">{{ $notification->data['message'] ?? 'New operational update' }}</p>
                            <div class="flex items-center gap-2 text-[9px] text-gray-400 font-black uppercase tracking-widest italic leading-none">
                                <span>{{ $notification->created_at->diffForHumans() }}</span>
                                @if(!$notification->read_at)
                                <span class="text-orange-500 opacity-0 group-hover/note:opacity-100 transition-opacity whitespace-nowrap ml-auto">Engage →</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="px-8 py-20 text-center">
                    <div class="text-4xl grayscale opacity-10 mb-6">🛰️</div>
                    <div class="text-gray-300 text-[10px] font-black uppercase tracking-[0.5em] italic">NULL ACTIVITY SIGNAL</div>
                </div>
            @endforelse
        </div>

        @if($this->notifications->count() > 0)
        <div class="p-3 border-t border-gray-50 bg-gray-50/20">
            <a href="{{ route('notifications.index') }}" class="flex items-center justify-center w-full py-4 text-center text-[10px] font-black uppercase tracking-[0.3em] text-[#050B1A] hover:bg-[#050B1A] hover:text-white rounded-2xl transition-all italic shadow-sm hover:shadow-xl">
                Full Activity Archive →
            </a>
        </div>
        @endif
    </div>
</div>