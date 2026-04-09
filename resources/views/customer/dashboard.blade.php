<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white leading-tight">
            {{ __('Customer Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[120px] -z-10"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Welcome & Verification Banner -->
            <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 rounded-3xl p-8 shadow-2xl relative overflow-hidden">
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="flex items-center space-x-6">
                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-tr from-blue-600 to-indigo-500 flex items-center justify-center shadow-lg shadow-blue-500/20 text-white text-3xl font-bold">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-3xl font-bold text-white mb-1">Welcome back, {{ auth()->user()->name }}!</h3>
                            <p class="text-gray-400">Manage your trips and explore new destinations.</p>
                        </div>
                    </div>

                    <!-- Verification Status Card -->
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-4 min-w-[240px]">
                        <div class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Identity Status</div>
                        @if($verification && $verification->status === 'approved')
                            <div class="flex items-center text-emerald-400 font-bold">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Fully Verified
                            </div>
                        @elseif($verification && $verification->status === 'pending')
                            <div class="flex items-center text-amber-400 font-bold">
                                <svg class="w-5 h-5 mr-2 animate-pulse" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                Verification Pending
                            </div>
                        @else
                            <div class="space-y-3">
                                <div class="flex items-center text-red-400 font-bold">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                                    Not Verified
                                </div>
                                <a href="{{ route('customer.verifications.index') }}" class="block text-center py-2 bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold rounded-lg transition-all">Submit NID Now</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Trip Statistics -->
                <div class="lg:col-span-1 space-y-6">
                    <h3 class="text-xl font-bold text-white px-2">Trip Statistics</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-900/50 border border-white/5 p-6 rounded-2xl shadow-xl">
                            <div class="text-gray-500 text-xs font-bold uppercase tracking-widest mb-1">Active Trips</div>
                            <div class="text-3xl font-bold text-white">{{ $stats['active_bookings'] }}</div>
                        </div>
                        <div class="bg-gray-900/50 border border-white/5 p-6 rounded-2xl shadow-xl">
                            <div class="text-gray-500 text-xs font-bold uppercase tracking-widest mb-1">Total Trips</div>
                            <div class="text-3xl font-bold text-white">{{ $stats['total_bookings'] }}</div>
                        </div>
                    </div>

                    <a href="{{ route('home') }}" class="flex items-center justify-between p-6 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl text-white group transition-all hover:scale-[1.02] shadow-xl shadow-blue-600/20">
                        <div>
                            <div class="font-bold text-lg">Ready for a new trip?</div>
                            <div class="text-blue-100 text-sm">Browse available cars now</div>
                        </div>
                        <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </a>
                </div>

                <!-- Latest Booking & Activity -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="flex items-center justify-between px-2">
                        <h3 class="text-xl font-bold text-white">Latest Activity</h3>
                        <a href="{{ route('customer.bookings.index') }}" class="text-blue-400 hover:text-blue-300 text-sm font-bold">View history &rarr;</a>
                    </div>

                    @if($latestBooking)
                        <div class="bg-gray-900/50 border border-white/5 rounded-3xl overflow-hidden shadow-2xl group">
                            <div class="flex flex-col md:flex-row">
                                <div class="md:w-1/3 aspect-video md:aspect-auto relative overflow-hidden">
                                     @if($latestBooking->car->images->count() > 0)
                                        <img src="{{ Storage::url($latestBooking->car->images->first()->image_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    @endif
                                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent opacity-60"></div>
                                    <div class="absolute bottom-4 left-4">
                                        <span class="px-2.5 py-1 bg-blue-600 text-[10px] font-bold text-white rounded-lg uppercase tracking-widest">Latest Rental</span>
                                    </div>
                                </div>
                                <div class="md:w-2/3 p-6 space-y-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="text-2xl font-bold text-white">{{ $latestBooking->car->title }}</h4>
                                            <p class="text-gray-500 text-sm">{{ $latestBooking->car->location }}</p>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-xl font-bold text-white">৳ {{ number_format($latestBooking->total_price) }}</div>
                                            <div class="text-xs text-gray-500 uppercase font-black tracking-tighter">{{ $latestBooking->status }}</div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4 py-4 border-t border-white/10">
                                        <div>
                                            <div class="text-[10px] text-gray-500 uppercase font-bold tracking-widest">Pickup</div>
                                            <div class="text-white text-sm font-medium">{{ \Carbon\Carbon::parse($latestBooking->start_date)->format('M d, Y') }}</div>
                                        </div>
                                        <div>
                                            <div class="text-[10px] text-gray-500 uppercase font-bold tracking-widest">Return</div>
                                            <div class="text-white text-sm font-medium">{{ \Carbon\Carbon::parse($latestBooking->end_date)->format('M d, Y') }}</div>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between pt-2">
                                        @if($latestBooking->status === 'approved' && $latestBooking->payment_status === 'pending')
                                            <p class="text-xs text-amber-400 font-bold">Action required: Payment pending</p>
                                            <a href="{{ route('customer.bookings.index') }}" class="px-6 py-2 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold rounded-xl transition-all shadow-lg shadow-emerald-500/20">Pay Now</a>
                                        @else
                                            <p class="text-xs text-gray-500 font-medium italic">Tracking this booking updates in your history.</p>
                                            <a href="{{ route('customer.bookings.index') }}" class="text-blue-400 hover:text-blue-300 text-sm font-bold transition-colors underline underline-offset-4">Manage Booking</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-gray-900/50 border border-white/5 rounded-3xl p-12 text-center">
                            <div class="w-16 h-16 bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-4 border border-white/5 text-gray-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <h4 class="text-xl font-bold text-white mb-2">No active rentals yet</h4>
                            <p class="text-gray-500 text-sm mb-6 mx-auto max-w-xs">Once you start booking cars, your activity and trip history will appear here.</p>
                            <a href="{{ route('home') }}" class="inline-flex items-center text-blue-400 hover:text-blue-300 font-bold">Find a car now &rarr;</a>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
