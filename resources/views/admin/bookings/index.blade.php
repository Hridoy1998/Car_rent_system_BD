<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">{{ __('All Bookings') }}</h2>
    </x-slot>

    <div class="py-12 relative z-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 bg-green-500/10 border border-green-500/30 text-green-400 px-4 py-3 rounded-xl">{{ session('success') }}</div>
            @endif

            <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 overflow-hidden shadow-2xl sm:rounded-2xl">
                @if($bookings->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-800/50 border-b border-white/10 uppercase text-xs tracking-wider text-gray-400">
                                    <th class="p-4">#</th>
                                    <th class="p-4">Customer</th>
                                    <th class="p-4">Car</th>
                                    <th class="p-4">Dates</th>
                                    <th class="p-4">Total</th>
                                    <th class="p-4">Payment</th>
                                    <th class="p-4">Status</th>
                                    <th class="p-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @foreach($bookings as $booking)
                                    <tr class="hover:bg-white/5 transition-colors">
                                        <td class="p-4 text-gray-400 text-xs">#{{ $booking->id }}</td>
                                        <td class="p-4">
                                            <div class="text-white text-sm font-bold">{{ $booking->customer->name }}</div>
                                            <div class="text-gray-500 text-xs">{{ $booking->customer->email }}</div>
                                        </td>
                                        <td class="p-4 text-sm text-gray-300">{{ $booking->car->title }}</td>
                                        <td class="p-4 text-xs text-gray-300">
                                            {{ \Carbon\Carbon::parse($booking->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}
                                        </td>
                                        <td class="p-4 text-green-400 font-bold">৳{{ number_format($booking->total_price) }}</td>
                                        <td class="p-4">
                                            <span class="px-2 py-1 rounded text-xs font-bold uppercase {{ $booking->payment_status === 'paid' ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'bg-yellow-500/10 text-yellow-400 border border-yellow-500/20' }}">
                                                {{ $booking->payment_status }}
                                            </span>
                                        </td>
                                        <td class="p-4">
                                            <span class="px-2 py-1 rounded text-xs font-bold uppercase
                                                @if($booking->status === 'completed') bg-green-500/10 text-green-400 border border-green-500/20
                                                @elseif($booking->status === 'approved') bg-blue-500/10 text-blue-400 border border-blue-500/20
                                                @elseif($booking->status === 'pending') bg-yellow-500/10 text-yellow-400 border border-yellow-500/20
                                                @else bg-gray-500/10 text-gray-400 border border-gray-500/20 @endif">
                                                {{ $booking->status }}
                                            </span>
                                        </td>
                                        <td class="p-4">
                                            @if(in_array($booking->status, ['pending', 'approved']))
                                                <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
                                                    @csrf @method('PUT')
                                                    <select name="status" onchange="this.form.submit()" class="bg-gray-800 border border-white/10 text-white text-xs rounded px-2 py-1 focus:ring-indigo-500">
                                                        <option value="">Change...</option>
                                                        <option value="approved">Approve</option>
                                                        <option value="rejected">Reject</option>
                                                        <option value="cancelled">Cancel</option>
                                                    </select>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4 border-t border-white/10">{{ $bookings->links() }}</div>
                @else
                    <div class="p-12 text-center text-gray-400">No bookings found.</div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
