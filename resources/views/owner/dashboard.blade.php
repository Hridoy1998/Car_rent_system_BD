<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white leading-tight">
            {{ __('Owner Command Center') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-emerald-600/10 rounded-full blur-[120px] -z-10"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Metrics Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Earnings -->
                <div class="bg-gray-900/50 backdrop-blur-xl border border-white/5 p-6 rounded-2xl shadow-xl relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-3 opacity-10 group-hover:opacity-20 transition-opacity">
                        <svg class="w-12 h-12 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Earnings</p>
                    <h3 class="text-3xl font-bold text-white tracking-tight">৳ {{ number_format($stats['total_earnings']) }}</h3>
                    <div class="mt-4 flex items-center text-xs font-semibold text-emerald-500">
                        <span class="bg-emerald-500/10 px-2 py-0.5 rounded">All time profit</span>
                    </div>
                </div>

                <!-- Active Bookings -->
                <div class="bg-gray-900/50 backdrop-blur-xl border border-white/5 p-6 rounded-2xl shadow-xl relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-3 opacity-10 group-hover:opacity-20 transition-opacity">
                        <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
                    </div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Active Roles</p>
                    <h3 class="text-3xl font-bold text-white tracking-tight">{{ $stats['active_bookings'] }}</h3>
                    <div class="mt-4 flex items-center text-xs font-semibold text-blue-500">
                        <span class="bg-blue-500/10 px-2 py-0.5 rounded">Awaiting Action</span>
                    </div>
                </div>

                <!-- Approved Cars -->
                <div class="bg-gray-900/50 backdrop-blur-xl border border-white/5 p-6 rounded-2xl shadow-xl relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-3 opacity-10 group-hover:opacity-20 transition-opacity">
                        <svg class="w-12 h-12 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Live Fleet</p>
                    <h3 class="text-3xl font-bold text-white tracking-tight">{{ $stats['approved_cars'] }}</h3>
                    <div class="mt-4 flex items-center text-xs font-semibold text-indigo-500">
                        <span class="bg-indigo-500/10 px-2 py-0.5 rounded">Visible to public</span>
                    </div>
                </div>

                <!-- Pending Cars -->
                <div class="bg-gray-900/50 backdrop-blur-xl border border-white/5 p-6 rounded-2xl shadow-xl relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-3 opacity-10 group-hover:opacity-20 transition-opacity">
                        <svg class="w-12 h-12 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Pending Approval</p>
                    <h3 class="text-3xl font-bold text-white tracking-tight">{{ $stats['pending_cars'] }}</h3>
                    <div class="mt-4 flex items-center text-xs font-semibold text-amber-500">
                        <span class="bg-amber-500/10 px-2 py-0.5 rounded">Awaiting Admin</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Recent Bookings -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center justify-between px-2">
                        <h3 class="text-lg font-bold text-white tracking-tight">Recent Rental Requests</h3>
                        <a href="{{ route('owner.bookings.index') }}" class="text-xs font-semibold text-emerald-400 hover:text-emerald-300 transition-colors">Manage all &rarr;</a>
                    </div>
                    
                    <div class="bg-gray-900/50 backdrop-blur-xl border border-white/5 rounded-2xl overflow-hidden shadow-2xl">
                        <table class="w-full text-left">
                            <thead class="bg-white/5">
                                <tr>
                                    <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Customer</th>
                                    <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Vehicle</th>
                                    <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Period</th>
                                    <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($recentBookings as $booking)
                                <tr class="hover:bg-white/[0.02] transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-300">{{ $booking->customer->name }}</div>
                                        <div class="text-[10px] text-gray-500">#{{ $booking->id }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm text-gray-400">{{ $booking->car->title }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-[10px] text-gray-500">{{ \Carbon\Carbon::parse($booking->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($booking->end_date)->format('M d') }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('owner.bookings.index') }}" class="px-3 py-1 bg-emerald-500/10 hover:bg-emerald-500/20 text-emerald-400 text-[10px] font-bold rounded-lg border border-emerald-500/20 transition-all uppercase">Manage</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-500 text-sm italic">No rental requests at the moment.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Side Panel: Fleet Overview -->
                <div class="space-y-6">
                    <div class="flex items-center justify-between px-2">
                        <h3 class="text-lg font-bold text-white tracking-tight">Your Fleet</h3>
                        <a href="{{ route('owner.cars.index') }}" class="text-xs font-semibold text-emerald-400 hover:text-emerald-300 transition-colors">Manage Fleet &rarr;</a>
                    </div>
                    
                    <div class="bg-gray-900/50 backdrop-blur-xl border border-white/5 rounded-2xl p-4 shadow-xl space-y-4">
                        @forelse($recentCars as $car)
                        <div class="flex items-center justify-between p-3 rounded-xl hover:bg-white/5 transition-colors group">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 rounded-lg bg-gray-800 border border-white/5 overflow-hidden">
                                     @if($car->images->count() > 0)
                                        <img src="{{ Storage::url($car->images->first()->image_path) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-700 text-xs">NO IMG</div>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-200">{{ $car->brand }} {{ $car->model }}</p>
                                    <div class="flex items-center gap-2 mt-0.5">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $car->status === 'approved' ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                                        <span class="text-[10px] text-gray-500 uppercase font-black tracking-tighter">{{ $car->status }}</span>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('owner.cars.edit', $car) }}" class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-gray-400 hover:text-white transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>
                        </div>
                        @empty
                        <div class="text-center py-8">
                            <p class="text-gray-500 text-sm mb-4">No vehicles listed yet.</p>
                            <a href="{{ route('owner.cars.create') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold rounded-xl transition-all">Add Your First Car</a>
                        </div>
                        @endforelse
                    </div>

                    <!-- Add New Button -->
                    @if($recentCars->count() > 0)
                    <a href="{{ route('owner.cars.create') }}" class="flex items-center justify-center gap-3 p-4 bg-white/5 border border-dashed border-white/20 rounded-2xl text-gray-400 hover:text-white hover:border-emerald-500/50 hover:bg-emerald-500/5 transition-all group">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        <span class="font-bold text-sm">Add Another Vehicle</span>
                    </a>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
