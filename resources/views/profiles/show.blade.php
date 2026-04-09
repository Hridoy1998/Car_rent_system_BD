<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white leading-tight">
            {{ __('User Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen relative overflow-hidden">
        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-indigo-600/10 rounded-full blur-[120px] -z-10"></div>
        <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-purple-600/10 rounded-full blur-[120px] -z-10"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Profile Header -->
            <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 rounded-3xl p-8 lg:p-12 shadow-2xl relative overflow-hidden">
                <div class="relative z-10 flex flex-col md:flex-row items-center gap-8">
                    <div class="relative">
                        <div class="w-32 h-32 lg:w-40 lg:h-40 rounded-[2.5rem] bg-indigo-500/10 border-2 border-indigo-500/30 flex items-center justify-center text-5xl font-black text-white shadow-[0_0_30px_rgba(79,70,229,0.3)] overflow-hidden">
                            @if($user->profile_photo)
                                <img src="{{ Storage::url($user->profile_photo) }}" class="w-full h-full object-cover">
                            @else
                                {{ substr($user->name, 0, 1) }}
                            @endif
                        </div>
                        @if($user->is_verified)
                            <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-emerald-500 rounded-2xl flex items-center justify-center border-4 border-gray-950 shadow-xl" title="Identity Verified">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                        @endif
                    </div>

                    <div class="flex-1 text-center md:text-left">
                        <div class="flex flex-col md:flex-row md:items-center gap-4 mb-4">
                            <h3 class="text-4xl font-extrabold text-white tracking-tight">{{ $user->name }}</h3>
                            <div class="flex items-center justify-center md:justify-start gap-2">
                                <span class="px-3 py-1 bg-white/5 rounded-full text-xs font-bold text-gray-400 border border-white/10 uppercase tracking-widest">{{ $user->role }}</span>
                                <span class="px-3 py-1 bg-indigo-500/10 rounded-full text-xs font-bold text-indigo-400 border border-indigo-500/20 uppercase tracking-widest">Since {{ $user->created_at->format('Y') }}</span>
                            </div>
                        </div>

                        @if($user->address)
                            <div class="flex items-center justify-center md:justify-start gap-2 text-gray-500 font-bold text-xs uppercase tracking-widest mb-4">
                                <svg class="w-4 h-4 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                {{ $user->address }}
                            </div>
                        @endif

                        <p class="text-gray-400 text-lg mb-6 max-w-2xl leading-relaxed italic">
                            {{ $user->bio ?: 'Member of CarRent BD community, committed to building a trusted car-sharing environment.' }}
                        </p>
                        
                        <div class="flex flex-wrap items-center justify-center md:justify-start gap-8">
                            <div class="flex items-center gap-2">
                                <div class="text-yellow-400 flex">
                                    @for($i=0; $i<5; $i++)
                                        <svg class="w-5 h-5 {{ $i < round($stats['rating']) ? 'fill-current' : 'fill-gray-700' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    @endfor
                                </div>
                                <span class="text-white font-bold">{{ number_format($stats['rating'], 1) }} Rating</span>
                            </div>
                            <div class="text-gray-400 text-sm font-bold uppercase tracking-widest border-l border-white/10 pl-8">
                                <span class="text-white text-xl">{{ $stats['host_trips'] }}</span> Trips Hosted
                            </div>
                            <div class="text-gray-400 text-sm font-bold uppercase tracking-widest border-l border-white/10 pl-8">
                                <span class="text-white text-xl">{{ $stats['renter_trips'] }}</span> Trips Taken
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Fleet (If Owner) -->
            @if($user->role === 'owner' || $user->role === 'admin')
                <div class="space-y-6">
                    <h3 class="text-2xl font-bold text-white px-2">Published Fleet</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @forelse($cars as $car)
                            <a href="{{ route('cars.show', $car) }}" class="bg-gray-900/50 backdrop-blur-xl border border-white/5 rounded-3xl overflow-hidden shadow-xl group hover:border-indigo-500/30 transition-all duration-300 transform hover:-translate-y-2">
                                <div class="aspect-video relative overflow-hidden">
                                     @if($car->images->count() > 0)
                                        <img src="{{ Storage::url($car->images->first()->image_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    @endif
                                    <div class="absolute inset-0 bg-gradient-to-t from-gray-950 to-transparent"></div>
                                    <div class="absolute bottom-4 left-4">
                                        <div class="text-xs font-bold text-indigo-400 uppercase tracking-widest mb-1">{{ $car->brand }}</div>
                                        <div class="text-xl font-bold text-white leading-tight">{{ $car->model }}</div>
                                    </div>
                                </div>
                                <div class="p-6 flex items-center justify-between">
                                    <div>
                                        <div class="text-2xl font-black text-white">৳ {{ number_format($car->price_per_day) }}</div>
                                        <div class="text-[10px] text-gray-500 uppercase font-black">per day</div>
                                    </div>
                                    <div class="flex items-center gap-1.5 bg-white/5 px-2.5 py-1 rounded-lg">
                                        <svg class="w-3 h-3 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <span class="text-xs font-black text-white">{{ number_format($car->reviews->avg('rating') ?: 5.0, 1) }}</span>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="lg:col-span-3 py-12 text-center text-gray-500 italic">No active car listings found for this user.</div>
                        @endforelse
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
