<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Manage Bookings') }}
        </h2>
    </x-slot>

    <div class="py-12 relative z-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 bg-green-500/10 border border-green-500/30 text-green-400 px-4 py-3 rounded-xl backdrop-blur-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 overflow-hidden shadow-2xl sm:rounded-2xl">
                @if($bookings->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-800/50 border-b border-white/10 uppercase text-xs tracking-wider text-gray-400">
                                    <th class="p-4 font-bold">Car</th>
                                    <th class="p-4 font-bold">Customer</th>
                                    <th class="p-4 font-bold">Dates</th>
                                    <th class="p-4 font-bold">Earnings</th>
                                    <th class="p-4 font-bold">Status</th>
                                    <th class="p-4 font-bold">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @foreach($bookings as $booking)
                                    <tr class="hover:bg-white/5 transition-colors">
                                        <td class="p-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 bg-gray-800 rounded-lg overflow-hidden border border-white/10 flex-shrink-0">
                                                    @if($booking->car->images->count() > 0)
                                                        <img src="{{ Storage::url($booking->car->images->first()->image_path) }}" alt="Car" class="w-full h-full object-cover">
                                                    @endif
                                                </div>
                                                <div class="text-sm font-bold text-white">{{ $booking->car->title }}</div>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <a href="{{ route('profiles.show', $booking->customer) }}" class="group flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-lg bg-indigo-500/10 flex items-center justify-center text-indigo-400 font-black text-xs border border-indigo-500/20 group-hover:bg-indigo-500 group-hover:text-white transition-all">
                                                    {{ substr($booking->customer->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <div class="text-sm font-bold text-white group-hover:text-indigo-400 transition-colors">{{ $booking->customer->name }}</div>
                                                    <div class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">View Renter History</div>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="p-4 text-sm text-gray-300">
                                            <div>{{ \Carbon\Carbon::parse($booking->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</div>
                                        </td>
                                        <td class="p-4 font-bold text-green-400">
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
                                                <a href="{{ route('bookings.messages.index', $booking) }}" class="text-xs bg-purple-500/10 hover:bg-purple-500/20 text-purple-400 px-3 py-1.5 rounded-lg border border-purple-500/30 transition-colors font-bold uppercase tracking-wider h-fit mt-[1px]">Chat</a>
                                                @if($booking->status === 'pending')
                                                    <form action="{{ route('owner.bookings.update', $booking) }}" method="POST">
                                                        @csrf @method('PUT')
                                                        <input type="hidden" name="status" value="approved">
                                                        <button type="submit" class="text-xs bg-blue-500/10 hover:bg-blue-500/20 text-blue-400 px-3 py-1.5 rounded-lg border border-blue-500/30 transition-colors font-bold uppercase tracking-wider">Approve</button>
                                                    </form>
                                                    <form action="{{ route('owner.bookings.update', $booking) }}" method="POST">
                                                        @csrf @method('PUT')
                                                        <input type="hidden" name="status" value="rejected">
                                                        <button type="submit" class="text-xs bg-red-500/10 hover:bg-red-500/20 text-red-400 px-3 py-1.5 rounded-lg border border-red-500/30 transition-colors font-bold uppercase tracking-wider">Reject</button>
                                                    </form>
                                                @elseif($booking->status === 'approved')
                                                    <form action="{{ route('owner.bookings.update', $booking) }}" method="POST">
                                                        @csrf @method('PUT')
                                                        <input type="hidden" name="status" value="completed">
                                                        <button type="submit" class="text-xs bg-green-500/10 hover:bg-green-500/20 text-green-400 px-3 py-1.5 rounded-lg border border-green-500/30 transition-colors font-bold uppercase tracking-wider" onclick="return confirm('Mark as completed? This will settle earnings.');">Mark Complete</button>
                                                    </form>
                                                @endif
                                            </div>
                                            
                                            @if($booking->status === 'completed' && !$booking->damageReports->count())
                                                <div class="mt-4 bg-red-900/10 p-3 rounded-xl border border-red-500/20">
                                                    <form action="{{ route('owner.bookings.damage-reports.store', $booking) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-2">
                                                        @csrf
                                                        <p class="text-xs text-red-400 font-bold tracking-wider uppercase mb-1">File Damage Report</p>
                                                        <div class="flex gap-2">
                                                            <input type="text" name="description" required placeholder="Describe damage..." class="flex-1 bg-gray-900 border border-white/10 text-white rounded text-xs py-1 px-2 focus:ring-red-500">
                                                            <input type="number" name="cost" placeholder="Cost ($)" min="0" class="w-24 bg-gray-900 border border-white/10 text-white rounded text-xs py-1 px-2 focus:ring-red-500">
                                                        </div>
                                                        <div class="flex justify-between items-center mt-1">
                                                            <input type="file" name="image" class="text-xs text-gray-400 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:font-bold file:bg-gray-800 file:text-red-400 hover:file:bg-gray-700">
                                                            <button type="submit" class="bg-red-600 hover:bg-red-500 text-white px-3 py-1 rounded text-xs font-bold transition-all">Submit Report</button>
                                                        </div>
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
                    <div class="p-12 text-center text-gray-400">
                        No bookings found for your vehicles yet.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
