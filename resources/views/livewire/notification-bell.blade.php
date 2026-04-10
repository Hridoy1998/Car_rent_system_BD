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
    <button @click="open = !open" class="text-gray-400 hover:text-white transition-all relative p-2 rounded-xl hover:bg-white/5 border border-transparent hover:border-white/10 group">
        <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
        </svg>
        
        @if($this->notifications->count() > 0)
            <span class="absolute top-1.5 right-1.5 flex h-4 w-4">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-4 w-4 bg-indigo-500 text-[9px] items-center justify-center font-black text-white shadow-[0_0_10px_rgba(99,102,241,0.8)]">
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
         class="absolute right-0 mt-4 w-80 glass rounded-[2rem] shadow-2xl z-50 overflow-hidden border-white/10" 
         x-cloak>
        
        <div class="px-6 py-4 border-b border-white/5 bg-white/5 flex justify-between items-center">
            <span class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Tactical Activity</span>
            @if($this->notifications->count() > 0)
                <button wire:click="markAllAsRead" class="text-[8px] font-black text-indigo-400 hover:text-white uppercase tracking-widest transition-colors">Mark all read</button>
            @endif
        </div>

        <div class="max-h-[28rem] overflow-y-auto custom-scrollbar">
            @forelse($this->notifications->take(6) as $notification)
                <a href="{{ route('notifications.show', $notification->id) }}" class="block px-6 py-5 hover:bg-white/[0.03] border-b border-white/5 transition-all group/note relative">
                    <div class="flex gap-4">
                        <div class="w-2 h-2 rounded-full {{ $notification->read_at ? 'bg-gray-700' : 'bg-indigo-500 shadow-[0_0_8px_rgba(99,102,241,0.5)]' }} mt-1.5 flex-shrink-0"></div>
                        <div class="flex-1">
                            <p class="text-[11px] {{ $notification->read_at ? 'text-gray-500' : 'text-gray-200' }} font-bold leading-relaxed mb-1">{{ $notification->data['message'] ?? 'New operational update' }}</p>
                            <div class="flex items-center gap-2 text-[9px] text-gray-600 font-black uppercase tracking-widest italic">
                                <span>{{ $notification->created_at->diffForHumans() }}</span>
                                @if(!$notification->read_at)
                                <span class="text-indigo-400 font-black tracking-tighter ml-auto opacity-0 group-hover/note:opacity-100 transition-opacity whitespace-nowrap">Engage →</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="px-6 py-12 text-center text-[10px] font-black text-gray-700 uppercase tracking-[0.3em] italic opacity-30">
                    No active signals detected
                </div>
            @endforelse
        </div>

        @if($this->notifications->count() > 0)
        <div class="p-2 border-t border-white/5">
            <a href="{{ route('notifications.index') }}" class="block w-full py-3 text-center text-[9px] font-black uppercase tracking-[0.4em] text-indigo-400 hover:text-white hover:bg-indigo-500/10 rounded-xl transition-all">
                Full Activity Archive →
            </a>
        </div>
        @endif
    </div>
</div>