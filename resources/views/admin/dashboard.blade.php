<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-white tracking-tight">
                {{ __('Admin Command Center') }}
            </h2>
            <div class="flex items-center space-x-3">
                <span class="flex h-3 w-3 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-indigo-500"></span>
                </span>
                <span class="text-gray-400 text-sm font-medium">System Live</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen relative overflow-hidden">
        <!-- Abstract Background Glows -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-indigo-600/10 rounded-full blur-[120px] -z-10"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-purple-600/10 rounded-full blur-[120px] -z-10"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Metrics Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Revenue -->
                <div class="bg-gray-900/50 backdrop-blur-xl border border-white/5 p-6 rounded-2xl shadow-xl relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-3 opacity-10 group-hover:opacity-20 transition-opacity">
                        <svg class="w-12 h-12 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Revenue</p>
                    <h3 class="text-3xl font-bold text-white tracking-tight">৳ {{ number_format($stats['total_revenue']) }}</h3>
                    <div class="mt-4 flex items-center text-xs font-semibold text-emerald-500">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                        Platform Earnings
                    </div>
                </div>

                <!-- Bookings -->
                <div class="bg-gray-900/50 backdrop-blur-xl border border-white/5 p-6 rounded-2xl shadow-xl relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-3 opacity-10 group-hover:opacity-20 transition-opacity">
                        <svg class="w-12 h-12 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
                    </div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Bookings</p>
                    <h3 class="text-3xl font-bold text-white tracking-tight">{{ $stats['total_bookings'] }}</h3>
                    <div class="mt-4 flex items-center text-xs font-semibold text-indigo-500">
                        <span class="bg-indigo-500/10 px-2 py-0.5 rounded">{{ $stats['active_bookings'] }} active</span>
                    </div>
                </div>

                <!-- Users -->
                <div class="bg-gray-900/50 backdrop-blur-xl border border-white/5 p-6 rounded-2xl shadow-xl relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-3 opacity-10 group-hover:opacity-20 transition-opacity">
                        <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Platform Users</p>
                    <h3 class="text-3xl font-bold text-white tracking-tight">{{ $stats['total_users'] }}</h3>
                    <div class="mt-4 flex items-center text-xs font-semibold text-blue-500">
                        <span class="text-red-500">{{ $stats['blocked_users'] }} blocked</span>
                    </div>
                </div>

                <!-- Cars -->
                <div class="bg-gray-900/50 backdrop-blur-xl border border-white/5 p-6 rounded-2xl shadow-xl relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-3 opacity-10 group-hover:opacity-20 transition-opacity">
                        <svg class="w-12 h-12 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                    </div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Fleet Approval</p>
                    <h3 class="text-3xl font-bold text-white tracking-tight">{{ $stats['pending_cars_count'] }}</h3>
                    <div class="mt-4 flex items-center text-xs font-semibold text-purple-500 uppercase tracking-widest">
                        Awaiting Review
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Recent Bookings Table -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center justify-between px-2">
                        <h3 class="text-lg font-bold text-white tracking-tight">Recent Activity</h3>
                        <a href="{{ route('admin.bookings.index') }}" class="text-xs font-semibold text-indigo-400 hover:text-indigo-300 transition-colors">See all bookings &rarr;</a>
                    </div>
                    
                    <div class="bg-gray-900/50 backdrop-blur-xl border border-white/5 rounded-2xl overflow-hidden shadow-2xl">
                        <table class="w-full text-left">
                            <thead class="bg-white/5">
                                <tr>
                                    <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Customer</th>
                                    <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Car</th>
                                    <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Status</th>
                                    <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest text-right">Revenue</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($recentBookings as $booking)
                                <tr class="hover:bg-white/[0.02] transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-gray-700 to-gray-800 flex items-center justify-center text-[10px] font-bold text-indigo-400 border border-white/5">
                                                {{ strtoupper(substr($booking->customer->name, 0, 2)) }}
                                            </div>
                                            <span class="text-sm font-medium text-gray-300">{{ $booking->customer->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm text-gray-400">{{ $booking->car->title }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $statusColors = [
                                                'pending' => 'bg-amber-500/10 text-amber-500 border-amber-500/20',
                                                'approved' => 'bg-blue-500/10 text-blue-500 border-blue-500/20',
                                                'completed' => 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20',
                                                'cancelled' => 'bg-red-500/10 text-red-500 border-red-500/20',
                                            ];
                                            $color = $statusColors[$booking->status] ?? $statusColors['pending'];
                                        @endphp
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-tight border {{ $color }}">
                                            {{ $booking->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="text-sm font-mono font-bold text-white">৳ {{ number_format($booking->total_price) }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-500 text-sm">No recent bookings found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Side Panel: Action Queue -->
                <div class="space-y-6">
                    <!-- Pending Cars -->
                    <div class="space-y-4">
                        <div class="flex items-center justify-between px-2">
                            <h3 class="text-lg font-bold text-white tracking-tight">Car Approvals</h3>
                            <span class="px-2 py-0.5 bg-indigo-500/10 text-indigo-400 text-[10px] font-bold rounded-lg border border-indigo-500/20">{{ $stats['pending_cars_count'] }} New</span>
                        </div>
                        <div class="bg-gray-900/50 backdrop-blur-xl border border-white/5 rounded-2xl p-4 shadow-xl">
                            @forelse($pendingCars as $car)
                            <div class="flex items-center justify-between p-3 rounded-xl hover:bg-white/5 transition-colors group">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-lg bg-gray-800 border border-white/5 overflow-hidden">
                                        @if($car->images->first())
                                            <img src="{{ Storage::url($car->images->first()->image_path) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-600">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-200">{{ $car->brand }} {{ $car->model }}</p>
                                        <p class="text-[10px] text-gray-500">by {{ $car->owner->name }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('admin.cars.show', $car) }}" class="w-8 h-8 rounded-lg bg-indigo-500/10 flex items-center justify-center text-indigo-400 opacity-0 group-hover:opacity-100 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                            </div>
                            @empty
                            <p class="text-xs text-center text-gray-600 py-4 italic">No cars awaiting approval.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- User Verifications -->
                    <div class="space-y-4">
                        <div class="flex items-center justify-between px-2">
                            <h3 class="text-lg font-bold text-white tracking-tight">Identity Queue</h3>
                            <span class="px-2 py-0.5 bg-purple-500/10 text-purple-400 text-[10px] font-bold rounded-lg border border-purple-500/20">{{ $stats['pending_verifications_count'] }} Queue</span>
                        </div>
                        <div class="bg-gray-900/50 backdrop-blur-xl border border-white/5 rounded-2xl p-4 shadow-xl">
                            @forelse($pendingVerifications as $verify)
                            <div class="flex items-center justify-between p-3 rounded-xl hover:bg-white/5 transition-colors group">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-full bg-purple-500/10 flex items-center justify-center border border-purple-500/20">
                                        <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-200">{{ $verify->user->name }}</p>
                                        <p class="text-[10px] text-gray-500 uppercase font-bold tracking-tighter">{{ $verify->document_type }} Verification</p>
                                    </div>
                                </div>
                                <a href="{{ route('admin.verifications.index') }}" class="px-3 py-1 rounded-lg bg-gray-800 text-[10px] font-bold text-gray-400 hover:text-white transition-colors">Review</a>
                            </div>
                            @empty
                            <p class="text-xs text-center text-gray-600 py-4 italic">No verifications pending.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
