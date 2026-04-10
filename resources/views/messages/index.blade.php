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
                <div class="flex-1 p-6 overflow-y-auto flex flex-col space-y-4" id="messages-container" 
                     x-data="{ 
                        messages: {{ Js::from($messages->map(function($msg) {
                            return [
                                'id' => $msg->id,
                                'message' => $msg->message,
                                'sender_id' => $msg->sender_id,
                                'created_at' => $msg->created_at->format('H:i, M d'),
                            ];
                        })) }},
                        authId: {{ auth()->id() }},
                        init() {
                            this.$nextTick(() => this.scrollToBottom());
                            
                            if (window.Echo) {
                                window.Echo.private('booking.{{ $booking->id }}')
                                    .listen('MessageSent', (e) => {
                                        // e contains the payload from broadcastWith
                                        let dateObj = new Date(e.created_at);
                                        let timeString = ('0' + dateObj.getHours()).slice(-2) + ':' + ('0' + dateObj.getMinutes()).slice(-2) + ', ' + dateObj.toLocaleString('en-us', { month: 'short', day: 'numeric' });
                                        
                                        this.messages.push({
                                            id: e.id,
                                            message: e.message,
                                            sender_id: e.sender_id,
                                            created_at: timeString
                                        });
                                        this.$nextTick(() => this.scrollToBottom());
                                    });
                            }
                        },
                        scrollToBottom() {
                            const container = document.getElementById('messages-container');
                            if(container) container.scrollTop = container.scrollHeight;
                        }
                     }">
                     
                    <template x-for="msg in messages" :key="msg.id">
                        <div class="flex" :class="msg.sender_id === authId ? 'justify-end' : 'justify-start'">
                            <div class="max-w-[75%] px-4 py-2 rounded-2xl" :class="msg.sender_id === authId ? 'bg-indigo-600 text-white rounded-br-none' : 'bg-gray-800 text-gray-200 border border-white/5 rounded-bl-none'">
                                <p class="text-sm whitespace-pre-wrap" x-text="msg.message"></p>
                                <div class="text-[10px] opacity-60 mt-1" :class="msg.sender_id === authId ? 'text-right' : 'text-left'" x-text="msg.created_at"></div>
                            </div>
                        </div>
                    </template>

                    <div x-show="messages.length === 0" class="text-center text-gray-500 mt-20" x-cloak>
                        No messages yet. Send a message to start the conversation!
                    </div>

                    <!-- Alpine handles submission to avoid refresh -->
                    <form @submit.prevent="
                            let msg = $refs.msgInput.value;
                            if(!msg) return;
                            $refs.msgInput.value = '';
                            
                            axios.post('{{ route('bookings.messages.store', $booking) }}', { message: msg })
                                .then(res => {
                                    // Local echo handles appending for the sender if configured, 
                                    // but we can just let standard store happen or push locally.
                                    // Because the controller broadcasts 'toOthers()', the sender won't receive the echo event.
                                    // So we optimistically append it:
                                    let now = new Date();
                                    let timeString = ('0' + now.getHours()).slice(-2) + ':' + ('0' + now.getMinutes()).slice(-2) + ', ' + now.toLocaleString('en-us', { month: 'short', day: 'numeric' });
                                    messages.push({
                                        id: Date.now(),
                                        message: msg,
                                        sender_id: authId,
                                        created_at: timeString
                                    });
                                    $nextTick(() => scrollToBottom());
                                }).catch(err => {
                                    console.error(err);
                                    $refs.msgInput.value = msg; // restore on fail
                                });
                        " 
                        class="fixed bottom-0 left-0 right-0 p-4 bg-gray-800/90 backdrop-blur-xl border-t border-white/10 sm:relative sm:bg-transparent sm:border-t mt-4 gap-2 flex"
                        style="transform: translateZ(0);">
                        
                        <input type="text" x-ref="msgInput" required autocomplete="off" placeholder="Type your message..." class="flex-1 bg-gray-900 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 transition-all">
                        <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl transition-all">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
