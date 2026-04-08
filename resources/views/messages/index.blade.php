<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Chat - ') }} {{ $booking->car->title }}
        </h2>
    </x-slot>

    <div class="py-12 relative z-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 border border-white/10 overflow-hidden shadow-2xl sm:rounded-2xl flex flex-col h-[700px]">
                
                <!-- Chat Header -->
                <div class="p-4 border-b border-white/10 flex items-center justify-between bg-gray-800/50">
                    <div>
                        <h3 class="text-white font-bold">{{ $booking->car->title }}</h3>
                        <p class="text-xs text-gray-400">Booking Dates: {{ \Carbon\Carbon::parse($booking->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</p>
                    </div>
                    <div class="text-sm px-3 py-1 bg-white/5 rounded-lg text-gray-300">
                        @if(auth()->id() === $booking->user_id)
                            Host: <span class="font-bold">{{ $booking->car->owner->name }}</span>
                        @else
                            Customer: <span class="font-bold">{{ $booking->customer->name }}</span>
                        @endif
                    </div>
                </div>

                <!-- Messages Output -->
                <div class="flex-1 p-6 overflow-y-auto flex flex-col space-y-4" id="messages-container">
                    @forelse($messages as $msg)
                        <div class="flex {{ $msg->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-[75%] px-4 py-2 rounded-2xl {{ $msg->sender_id === auth()->id() ? 'bg-indigo-600 text-white rounded-br-none' : 'bg-gray-800 text-gray-200 border border-white/5 rounded-bl-none' }}">
                                <p class="text-sm whitespace-pre-wrap">{{ $msg->message }}</p>
                                <div class="text-[10px] opacity-60 mt-1 {{ $msg->sender_id === auth()->id() ? 'text-right' : 'text-left' }}">
                                    {{ $msg->created_at->format('H:i, M d') }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-gray-500 mt-20">
                            No messages yet. Send a message to start the conversation!
                        </div>
                    @endforelse
                </div>

                <!-- Input Box -->
                <div class="p-4 bg-gray-800/50 border-t border-white/10">
                    <form action="{{ route('bookings.messages.store', $booking) }}" method="POST" class="flex gap-2">
                        @csrf
                        <input type="text" name="message" required autocomplete="off" placeholder="Type your message..." class="flex-1 bg-gray-900 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 transition-all">
                        <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl transition-all">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Scroll to bottom
        const container = document.getElementById('messages-container');
        container.scrollTop = container.scrollHeight;
    </script>
</x-app-layout>
