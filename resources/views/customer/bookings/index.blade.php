<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('My Bookings') }}
            </h2>
            <a href="{{ route('home') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-bold rounded-lg transition-colors shadow-lg shadow-indigo-600/20">
                Book Another Car
            </a>
        </div>
    </x-slot>

    <div class="py-12 relative z-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 bg-green-500/10 border border-green-500/30 text-green-400 px-4 py-3 rounded-xl backdrop-blur-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-3 rounded-xl backdrop-blur-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 overflow-hidden shadow-2xl sm:rounded-2xl">
                @if($bookings->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-800/50 border-b border-white/10 uppercase text-xs tracking-wider text-gray-400">
                                    <th class="p-4 font-bold">Car</th>
                                    <th class="p-4 font-bold">Host</th>
                                    <th class="p-4 font-bold">Dates</th>
                                    <th class="p-4 font-bold">Total</th>
                                    <th class="p-4 font-bold">Status</th>
                                    <th class="p-4 font-bold">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @foreach($bookings as $booking)
                                    <tr class="hover:bg-white/5 transition-colors">
                                        <td class="p-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-12 h-12 bg-gray-800 rounded-lg overflow-hidden border border-white/10 flex-shrink-0">
                                                    @if($booking->car->images->count() > 0)
                                                        <img src="{{ Storage::url($booking->car->images->first()->image_path) }}" alt="Car" class="w-full h-full object-cover">
                                                    @else
                                                        <div class="w-full h-full flex items-center justify-center text-gray-500 text-xs">No img</div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <a href="{{ route('cars.show', $booking->car) }}" class="text-white font-bold hover:text-indigo-400 transition-colors">
                                                        {{ $booking->car->title }}
                                                    </a>
                                                    <div class="text-xs text-gray-500 uppercase tracking-wider">{{ $booking->car->location }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4 text-sm text-gray-300">
                                            {{ $booking->car->owner->name }}
                                        </td>
                                        <td class="p-4 text-sm text-gray-300">
                                            <div>{{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}</div>
                                            <div class="text-gray-500 text-xs">to {{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</div>
                                        </td>
                                        <td class="p-4 font-bold text-white">
                                            ৳{{ number_format($booking->total_price, 0) }}
                                        </td>
                                        <td class="p-4">
                                            @if($booking->status === 'pending')
                                                <span class="px-2 py-1 bg-yellow-500/10 text-yellow-400 border border-yellow-500/20 rounded text-xs font-bold uppercase tracking-wider">Pending</span>
                                            @elseif($booking->status === 'approved')
                                                <span class="px-2 py-1 bg-blue-500/10 text-blue-400 border border-blue-500/20 rounded text-xs font-bold uppercase tracking-wider">Approved</span>
                                            @elseif($booking->status === 'completed')
                                                <span class="px-2 py-1 bg-green-500/10 text-green-400 border border-green-500/20 rounded text-xs font-bold uppercase tracking-wider">Completed</span>
                                            @else
                                                <span class="px-2 py-1 bg-gray-500/10 text-gray-400 border border-gray-500/20 rounded text-xs font-bold uppercase tracking-wider">{{ ucfirst($booking->status) }}</span>
                                            @endif
                                        </td>
                                        <td class="p-4">
                                            <div class="flex items-center gap-2">
                                                <a href="{{ route('bookings.messages.index', $booking) }}" class="text-xs bg-purple-500/10 hover:bg-purple-500/20 text-purple-400 px-3 py-1.5 rounded-lg border border-purple-500/30 transition-colors font-bold uppercase tracking-wider inline-block">Chat</a>
                                                
                                                @if(in_array($booking->status, ['pending', 'approved']))
                                                    <form action="{{ route('customer.bookings.update', $booking) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                                                        @csrf @method('PUT')
                                                        <input type="hidden" name="status" value="cancelled">
                                                        <button type="submit" class="text-xs bg-red-500/10 hover:bg-red-500/20 text-red-400 px-3 py-1.5 rounded-lg border border-red-500/30 transition-colors font-bold uppercase tracking-wider">
                                                            Cancel
                                                        </button>
                                                    </form>
                                                @endif

                                                @if(in_array($booking->status, ['completed', 'approved']))
                                                    <a href="{{ route('invoices.download', $booking) }}" class="text-xs bg-indigo-500/10 hover:bg-indigo-500/20 text-indigo-400 px-3 py-1.5 rounded-lg border border-indigo-500/30 transition-colors font-bold uppercase tracking-wider inline-block h-fit mt-[1px]">
                                                        Invoice
                                                    </a>
                                                @endif
                                            </div>
                                            
                                            @if($booking->status === 'completed' && !$booking->car->reviews->where('user_id', auth()->id())->count())
                                                <div class="mt-4 bg-gray-800/50 p-3 rounded-xl border border-white/10">
                                                    <form action="{{ route('customer.bookings.reviews.store', $booking) }}" method="POST" class="flex items-center gap-2">
                                                        @csrf
                                                        <select name="rating" required class="bg-gray-900 border border-white/10 text-white rounded text-xs py-1 px-2 focus:ring-indigo-500">
                                                            <option value="5">⭐⭐⭐⭐⭐ 5</option>
                                                            <option value="4">⭐⭐⭐⭐ 4</option>
                                                            <option value="3">⭐⭐⭐ 3</option>
                                                            <option value="2">⭐⭐ 2</option>
                                                            <option value="1">⭐ 1</option>
                                                        </select>
                                                        <input type="text" name="comment" placeholder="Leave a review..." class="flex-1 bg-gray-900 border border-white/10 text-white rounded text-xs py-1 px-2 focus:ring-indigo-500">
                                                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-3 py-1 rounded text-xs font-bold transition-all">Submit Review</button>
                                                    </form>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($bookings->hasPages())
                        <div class="p-4 border-t border-white/10">
                            {{ $bookings->links() }}
                        </div>
                    @endif
                @else
                    <div class="p-12 text-center">
                        <div class="w-20 h-20 bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-4 border border-white/10">
                            <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">No bookings yet</h3>
                        <p class="text-gray-400 mx-auto max-w-md">Find the perfect car and request a trip. Your upcoming bookings will appear here.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
