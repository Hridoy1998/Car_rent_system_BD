<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-black text-2xl text-white leading-tight">
                {{ __('Activity Feed') }}
            </h2>
            <form action="{{ route('notifications.markAllAsRead') }}" method="POST">
                @csrf
                <button type="submit" class="text-[10px] font-black uppercase tracking-widest text-indigo-400 border border-indigo-400/20 px-3 py-1.5 rounded-lg hover:bg-indigo-400/10 transition-all">Clear All</button>
            </form>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen relative overflow-hidden">
        <div class="absolute top-0 left-0 w-[600px] h-[600px] bg-purple-600/5 rounded-full blur-[150px] -z-10"></div>
        
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-4">
                @forelse($notifications as $notification)
                    <div class="bg-gray-900/50 backdrop-blur-xl border {{ $notification->read_at ? 'border-white/5' : 'border-indigo-500/30 bg-indigo-500/5' }} rounded-3xl p-6 transition-all hover:bg-gray-900/80 group">
                        <div class="flex gap-6">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-xl shadow-lg border border-white/10 {{ $notification->read_at ? 'bg-gray-800 text-gray-400' : 'bg-indigo-600 text-white shadow-indigo-600/20' }}">
                                    @php
                                        $icon = match($notification->type) {
                                            'App\Notifications\BookingRequested' => '📅',
                                            'App\Notifications\BookingStatusUpdated' => '🔄',
                                            'App\Notifications\PaymentSuccessful' => '💰',
                                            'App\Notifications\CarApproved' => '✨',
                                            default => '🔔',
                                        };
                                    @endphp
                                    {{ $icon }}
                                </div>
                            </div>
                            
                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="text-sm font-bold {{ $notification->read_at ? 'text-gray-400' : 'text-white' }}">
                                        {{ $notification->data['title'] ?? 'New Notification' }}
                                    </h4>
                                    <span class="text-[10px] text-gray-600 font-bold uppercase tracking-tighter">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                                
                                <p class="text-xs {{ $notification->read_at ? 'text-gray-500' : 'text-gray-300' }} leading-relaxed italic mb-4">
                                    {{ $notification->data['message'] ?? 'You have a new activity on your account.' }}
                                </p>

                                <div class="flex items-center justify-between">
                                    <div class="flex gap-2">
                                        <a href="{{ route('notifications.show', $notification->id) }}" class="text-[10px] font-black uppercase tracking-widest px-3 py-1.5 bg-white/5 hover:bg-white/10 text-gray-300 rounded-lg border border-white/5 transition-all">Engage Action</a>
                                    </div>
                                    
                                    @if(!$notification->read_at)
                                        <div class="flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full animate-pulse shadow-[0_0_8px_rgba(99,102,241,1)]"></span>
                                            <span class="text-[9px] font-black uppercase tracking-widest text-indigo-400">Action Required</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20 bg-gray-900/30 rounded-[3rem] border border-white/5 border-dashed">
                        <div class="text-4xl mb-4 opacity-20">📭</div>
                        <h3 class="text-white font-bold uppercase tracking-widest text-sm mb-2">Silence is golden</h3>
                        <p class="text-gray-600 text-xs italic">All your activity will appear here like a digital heartbeat.</p>
                    </div>
                @endforelse

                <div class="mt-8">
                    {{ $notifications->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
