<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-white leading-tight">
                {{ __('Booking Hub') }} <span class="text-indigo-400 font-black">#{{ $booking->id }}</span>
            </h2>
            <div class="flex gap-2">
                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border {{ $booking->status === 'completed' ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20' : ($booking->status === 'cancelled' ? 'bg-red-500/10 text-red-400 border-red-500/20' : 'bg-indigo-500/10 text-indigo-400 border-indigo-500/20') }}">
                    {{ $booking->status }}
                </span>
                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border {{ $booking->payment_status === 'paid' ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20' : 'bg-amber-500/10 text-amber-400 border-amber-500/20' }}">
                    {{ $booking->payment_status }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-indigo-600/5 rounded-full blur-[150px] -z-10"></div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Live Tactical Tracker -->
            <div class="max-w-4xl mx-auto">
                <livewire:booking-status-tracker :booking="$booking" />
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 h-full">
                
                <!-- Left Column: Details & Finance -->
                <div class="lg:col-span-1 space-y-6 flex flex-col">
                    <!-- Vehicle Card -->
                    <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 rounded-3xl p-6 shadow-2xl">
                        <div class="aspect-video rounded-2xl overflow-hidden mb-4 border border-white/5 relative group">
                            <img src="{{ $booking->car->primary_image_url }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-950/80 to-transparent"></div>
                            <div class="absolute bottom-4 left-4">
                                <h3 class="text-xl font-black text-white leading-none">{{ $booking->car->brand }} {{ $booking->car->model }}</h3>
                                <p class="text-xs text-indigo-400 font-bold tracking-widest uppercase mt-1">{{ $booking->car->type }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white/5 rounded-2xl p-4 text-center border border-white/5">
                                <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1">Pickup</p>
                                <p class="text-white text-sm font-bold">{{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}</p>
                            </div>
                            <div class="bg-white/5 rounded-2xl p-4 text-center border border-white/5">
                                <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1">Return</p>
                                <p class="text-white text-sm font-bold">{{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Financial Hub -->
                    <div class="bg-indigo-600/10 backdrop-blur-xl border border-indigo-500/20 rounded-3xl p-8 shadow-2xl flex-1">
                        <h4 class="text-lg font-bold text-white mb-6">Financial Summary</h4>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-400 font-medium italic">Base Fare</span>
                                <span class="text-white font-mono">৳ {{ number_format($booking->total_price) }}</span>
                            </div>
                            
                            @foreach($booking->damageReports as $report)
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-red-400">Damage Report #{{ $report->id }}</span>
                                    <span class="text-red-400 font-mono">+ ৳ {{ number_format($report->resolution_cost ?? $report->cost ?? 0) }}</span>
                                </div>
                            @endforeach

                            <div class="pt-6 border-t border-white/10 flex justify-between items-end">
                                <div>
                                    <p class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.2em]">Total Outstanding</p>
                                    <h3 class="text-4xl font-black text-white">৳ {{ number_format($booking->total_price + $booking->damageReports->sum('cost')) }}</h3>
                                </div>
                            </div>

                            <!-- Actions Based on Role/Status -->
                            <div class="pt-8 space-y-3">
                                @if(auth()->user()->role === 'customer')
                                    @if($booking->status === 'approved' && $booking->payment_status === 'pending')
                                        <form action="{{ route('customer.bookings.pay', $booking) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="w-full py-4 bg-emerald-600 hover:bg-emerald-500 text-white font-black rounded-2xl shadow-xl shadow-emerald-600/20 transition-all uppercase tracking-widest">Confirm & Pay</button>
                                        </form>
                                    @endif
                                @endif

                                @if(auth()->user()->role === 'owner')
                                    @if($booking->status === 'pending')
                                        <div class="grid grid-cols-2 gap-3">
                                            <form action="{{ route('owner.bookings.update', $booking) }}" method="POST">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-black rounded-xl uppercase tracking-widest text-xs">Approve</button>
                                            </form>
                                            <form action="{{ route('owner.bookings.update', $booking) }}" method="POST">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="w-full py-3 bg-red-600/20 hover:bg-red-600/30 text-red-500 border border-red-500/20 font-black rounded-xl uppercase tracking-widest text-xs">Reject</button>
                                            </form>
                                        </div>
                                    @elseif($booking->status === 'approved' && $booking->payment_status === 'paid')
                                        <form action="{{ route('owner.bookings.update', $booking) }}" method="POST">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="completed">
                                            <button type="submit" class="w-full py-4 bg-emerald-600 hover:bg-emerald-500 text-white font-black rounded-2xl uppercase tracking-widest shadow-xl shadow-emerald-600/20">Mark Trip Completed</button>
                                        </form>
                                    @endif
                                @endif
                                
                                <a href="{{ route('invoices.download', $booking) }}" class="block text-center py-3 bg-white/5 hover:bg-white/10 text-gray-300 font-bold rounded-xl text-xs uppercase transition-all">Download Invoice</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Chat & Damage Reports -->
                <div class="lg:col-span-2 space-y-8 flex flex-col">
                    
                    <!-- Chat Integrated -->
                    <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 rounded-3xl overflow-hidden shadow-2xl flex flex-col flex-1">
                        <div class="px-6 py-4 border-b border-white/10 bg-gray-800/30 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-indigo-500/20 flex items-center justify-center font-bold text-indigo-400 border border-indigo-500/30">
                                @if(auth()->user()->role === 'customer')
                                    {{ substr($booking->car->owner->name, 0, 1) }}
                                @else
                                    {{ substr($booking->customer->name, 0, 1) }}
                                @endif
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-white">
                                    @if(auth()->user()->role === 'customer')
                                        <a href="{{ route('profiles.show', $booking->car->owner) }}" class="hover:text-indigo-400 transition-colors">{{ $booking->car->owner->name }}</a> <span class="ml-2 text-[10px] text-gray-500 uppercase font-black">Host</span>
                                    @else
                                        <a href="{{ route('profiles.show', $booking->customer) }}" class="hover:text-indigo-400 transition-colors">{{ $booking->customer->name }}</a> <span class="ml-2 text-[10px] text-gray-500 uppercase font-black">Customer</span>
                                    @endif
                                </h4>
                                <p class="text-[10px] text-emerald-500 flex items-center gap-1">
                                    <span class="w-1 h-1 rounded-full bg-emerald-500 animate-ping"></span>
                                    Active Trip Chat
                                </p>
                            </div>
                        </div>

                        <!-- Chat Messages - Inherit layout logic -->
                        <div class="flex-1 p-6 overflow-y-auto space-y-6 min-h-[400px]" id="messages-hub">
                             @forelse($booking->messages as $msg)
                                <div class="flex {{ $msg->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                                    <div class="flex flex-col {{ $msg->sender_id === auth()->id() ? 'items-end' : 'items-start' }} max-w-[80%]">
                                        <div class="px-4 py-3 rounded-2xl shadow-xl {{ $msg->sender_id === auth()->id() ? 'bg-indigo-600 text-white rounded-br-none' : 'bg-gray-800 text-gray-200 border border-white/10 rounded-bl-none' }}">
                                            <p class="text-sm leading-relaxed">{{ $msg->message }}</p>
                                        </div>
                                        <span class="mt-1.5 text-[10px] text-gray-600 font-bold uppercase tracking-tighter">{{ $msg->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="h-full flex flex-col items-center justify-center text-center opacity-40">
                                    <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                    <p class="text-sm font-bold tracking-widest uppercase">Start a conversation with your host</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Chat Input -->
                        <div class="p-4 border-t border-white/10 bg-gray-900/50">
                            <form action="{{ route('bookings.messages.store', $booking) }}" method="POST" class="flex gap-2">
                                @csrf
                                <input type="text" name="message" required autocomplete="off" placeholder="Discuss trip details..." class="flex-1 bg-gray-950 border border-white/5 rounded-2xl px-5 py-4 text-sm text-white focus:ring-2 focus:ring-indigo-500 transition-all outline-none">
                                <button type="submit" class="px-6 py-4 bg-indigo-600 hover:bg-indigo-500 text-white rounded-2xl transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Damage Reports Section -->
                    @if($booking->damageReports->count() > 0 || auth()->user()->role === 'owner')
                    <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 rounded-3xl p-8 shadow-2xl">
                        <div class="flex items-center justify-between mb-8">
                                <h4 class="text-xl font-bold text-white">Incident Reports</h4>
                                @if(auth()->user()->role === 'owner' && $booking->status === 'completed')
                                    <button onclick="document.getElementById('report-panel').classList.toggle('hidden')" class="text-xs font-bold text-indigo-400 border border-indigo-400/20 px-3 py-1.5 rounded-lg hover:bg-indigo-400/10 transition-all">New Report</button>
                                @endif
                        </div>

                        <!-- Damage Reports List -->
                        <div class="space-y-4">
                            @foreach($booking->damageReports as $report)
                                <div class="bg-gray-950/50 border border-white/5 rounded-2xl p-6 relative group overflow-hidden">
                                     <div class="absolute inset-y-0 left-0 w-1 {{ $report->status === 'resolved' ? 'bg-emerald-500' : ($report->status === 'disputed' ? 'bg-red-500' : 'bg-amber-500') }}"></div>
                                     <div class="flex flex-col md:flex-row gap-6">
                                        <div class="w-24 h-24 rounded-xl overflow-hidden bg-gray-800 border border-white/10 group-hover:scale-105 transition-transform">
                                            @if($report->image)
                                                <img src="{{ Storage::url($report->image) }}" class="w-full h-full object-cover cursor-pointer" onclick="window.open(this.src)">
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex justify-between items-start mb-2">
                                                <h5 class="text-white font-bold">{{ $report->description }}</h5>
                                                <span class="text-[10px] font-black uppercase tracking-widest px-2 py-1 bg-white/5 rounded border border-white/10 {{ $report->status === 'resolved' ? 'text-emerald-400' : ($report->status === 'disputed' ? 'text-red-400' : 'text-amber-400') }}">{{ $report->status }}</span>
                                            </div>
                                            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-4">Estimated Cost: <span class="text-white">৳ {{ number_format($report->cost) }}</span></p>
                                            
                                            <!-- Response Buttons for Customer -->
                                            @if(auth()->user()->role === 'customer' && $report->status === 'pending')
                                                <div class="flex gap-4">
                                                    <form action="{{ route('customer.damage-reports.respond', $report) }}" method="POST">
                                                        @csrf @method('PUT')
                                                        <input type="hidden" name="status" value="acknowledged">
                                                        <button type="submit" class="text-[10px] font-black uppercase tracking-widest text-emerald-400 underline hover:text-emerald-300">Acknowledge & Accept</button>
                                                    </form>
                                                    <form action="{{ route('customer.damage-reports.respond', $report) }}" method="POST">
                                                        @csrf @method('PUT')
                                                        <input type="hidden" name="status" value="disputed">
                                                        <button type="submit" class="text-[10px] font-black uppercase tracking-widest text-red-400 underline hover:text-red-300">Dispute Report</button>
                                                    </form>
                                                </div>
                                            @endif

                                            <!-- Admin Arbitration View -->
                                            @if(auth()->user()->role === 'admin' && $report->status === 'disputed')
                                                <div class="mt-4 pt-4 border-t border-white/10">
                                                    <form action="{{ route('admin.damage-reports.resolve', $report) }}" method="POST" class="space-y-4">
                                                        @csrf @method('PUT')
                                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                            <input type="number" name="resolution_cost" placeholder="Final Amount" required class="bg-gray-950 border border-white/10 rounded-xl px-4 py-2 text-xs text-white">
                                                            <textarea name="admin_notes" placeholder="Reasoning..." required class="bg-gray-950 border border-white/10 rounded-xl px-4 py-2 text-xs text-white"></textarea>
                                                        </div>
                                                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-[10px] font-bold rounded-lg uppercase">Settle Dispute</button>
                                                    </form>
                                                </div>
                                            @endif

                                            @if($report->status === 'resolved')
                                                <div class="mt-4 p-4 bg-emerald-500/5 border border-emerald-500/10 rounded-xl text-[11px] text-emerald-400">
                                                    <strong>Arbitration Outcome:</strong> ৳ {{ number_format($report->resolution_cost) }} final charge. <br>
                                                    <em>Admin Notes: {{ $report->admin_notes }}</em>
                                                </div>
                                            @endif
                                        </div>
                                     </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Damage Report Form Panel -->
                        <div id="report-panel" class="hidden mt-8 pt-8 border-t border-white/10">
                             <form action="{{ route('owner.bookings.damage-reports.store', $booking) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-1">Estimated Cost</label>
                                        <input type="number" name="cost" required placeholder="৳ Amount" class="w-full bg-gray-950 border border-white/5 rounded-xl px-4 py-3 text-sm text-white focus:ring-2 focus:ring-indigo-500 transition-all outline-none">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-1">Evidence Photo</label>
                                        <input type="file" name="image" required class="w-full text-xs text-gray-500 file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:bg-gray-800 file:text-indigo-400 hover:file:bg-gray-700">
                                    </div>
                                    <div class="md:col-span-2 space-y-2">
                                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-1">Description of damage</label>
                                        <textarea name="description" required rows="3" placeholder="Explain the incident clearly..." class="w-full bg-gray-950 border border-white/5 rounded-2xl px-5 py-4 text-sm text-white focus:ring-2 focus:ring-indigo-500 transition-all outline-none"></textarea>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <button type="submit" class="flex-1 py-4 bg-indigo-600 hover:bg-indigo-500 text-white font-black rounded-2xl transition-all shadow-xl shadow-indigo-600/20 uppercase tracking-widest">Submit Report</button>
                                    <button type="button" onclick="document.getElementById('report-panel').classList.add('hidden')" class="px-8 py-4 bg-gray-800 text-gray-400 font-black rounded-2xl hover:bg-gray-700 transition-all uppercase tracking-widest">Cancel</button>
                                </div>
                             </form>
                        </div>
                    </div>
                    @endif
                    
                </div>
            </div>

        </div>
    </div>

    <script>
        window.onload = () => {
            const container = document.getElementById('messages-hub');
            if (container) container.scrollTop = container.scrollHeight;
        }
    </script>
</x-app-layout>
