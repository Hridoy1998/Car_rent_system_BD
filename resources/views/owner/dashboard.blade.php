<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center text-white bg-gray-950">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Owner Dashboard') }}
            </h2>
            <a href="{{ route('owner.cars.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 rounded-lg text-white font-medium transition-colors shadow-[0_0_15px_rgba(79,70,229,0.5)]">
                + Add Car
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen text-slate-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Metrics -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Total Cars -->
                <div class="bg-gray-900 border border-white/10 rounded-2xl p-6 shadow-xl relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <svg class="w-16 h-16 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <p class="text-gray-400 text-sm font-medium mb-1">Total Cars</p>
                    <h3 class="text-3xl font-bold text-white">{{ $totalCars }}</h3>
                </div>

                <!-- Pending Approvals -->
                <div class="bg-gray-900 border border-white/10 rounded-2xl p-6 shadow-xl relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <svg class="w-16 h-16 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="text-gray-400 text-sm font-medium mb-1">Pending Review</p>
                    <h3 class="text-3xl font-bold text-yellow-500">{{ $pendingCars }}</h3>
                </div>

                <!-- Active Bookings -->
                <a href="{{ route('owner.bookings.index') }}" class="block bg-gray-900 border border-white/10 rounded-2xl p-6 shadow-xl relative overflow-hidden group hover:border-indigo-500/50 transition-all">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <svg class="w-16 h-16 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <p class="text-gray-400 text-sm font-medium mb-1">Manage Bookings</p>
                    <h3 class="text-3xl font-bold text-white">{{ $activeBookings }}</h3>
                </a>

                <!-- Total Earnings -->
                <div class="bg-gray-900 border border-white/10 rounded-2xl p-6 shadow-xl relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <svg class="w-16 h-16 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="text-gray-400 text-sm font-medium mb-1">Total Earnings</p>
                    <h3 class="text-3xl font-bold text-white">৳{{ number_format($totalEarnings) }}</h3>
                </div>
            </div>

            <!-- Recent Cars -->
            <div class="bg-gray-900 border border-white/10 overflow-hidden shadow-xl sm:rounded-2xl">
                <div class="p-6 border-b border-white/5 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-white">Recent Additions</h3>
                    <a href="{{ route('owner.cars.index') }}" class="text-indigo-400 text-sm hover:text-indigo-300">View All</a>
                </div>
                <div class="p-0">
                    <table class="w-full text-left border-collapse">
                        <tbody class="divide-y divide-white/5">
                            @forelse ($recentCars as $car)
                                <tr class="hover:bg-white/5 transition-colors">
                                    <td class="py-4 pl-6">
                                        <div class="flex items-center text-sm font-medium text-white">
                                            {{ $car->title }}
                                        </div>
                                    </td>
                                    <td class="py-4 text-sm text-gray-400">
                                        {{ $car->type }}
                                    </td>
                                    <td class="py-4 font-mono text-sm">
                                        <div class="text-white">৳{{ number_format($car->price_per_day) }}/d</div>
                                    </td>
                                    <td class="py-4 pr-6 text-right">
                                        @if($car->status === 'approved')
                                            <span class="px-2 py-1 bg-green-500/10 text-green-400 rounded-full text-xs font-semibold border border-green-500/20">Active</span>
                                        @elseif($car->status === 'pending')
                                            <span class="px-2 py-1 bg-yellow-500/10 text-yellow-500 rounded-full text-xs font-semibold border border-yellow-500/20">Pending</span>
                                        @else
                                            <span class="px-2 py-1 bg-red-500/10 text-red-400 rounded-full text-xs font-semibold border border-red-500/20">Rejected</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-12 text-center text-gray-500">
                                        No cars listed yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
