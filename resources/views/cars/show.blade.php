<x-public-layout>
    <x-slot name="title">{{ $car->year }} {{ $car->brand }} {{ $car->model }} - CarRent BD</x-slot>

    <div class="pt-28 pb-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumbs -->
        <nav class="flex text-sm text-gray-500 mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <span class="hover:text-white transition-colors cursor-pointer">Cars</span>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <span class="text-gray-300 font-medium">{{ $car->brand }} {{ $car->model }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <!-- Left Column: Image Gallery -->
            <div class="lg:col-span-2 space-y-4">
                <!-- Main Image -->
                <div class="aspect-[16/10] w-full rounded-3xl overflow-hidden bg-gray-900 border border-white/5 relative group">
                    @if($car->images->count() > 0)
                        <img src="{{ Storage::url($car->images->where('is_primary', true)->first()->image_path ?? $car->images->first()->image_path) }}" alt="{{ $car->title }}" class="w-full h-full object-cover">
                    @else
                        <img src="https://images.unsplash.com/photo-1549317661-bc32c0734c19?auto=format&fit=crop&w=1200&q=80" alt="{{ $car->title }}" class="w-full h-full object-cover">
                    @endif
                </div>
                
                <!-- Thumbnails (If multiple) -->
                @if($car->images->count() > 1)
                <div class="grid grid-cols-4 gap-4">
                    @foreach($car->images as $image)
                        <div class="aspect-video rounded-xl overflow-hidden bg-gray-900 border {{ $loop->first ? 'border-indigo-500' : 'border-white/5 opacity-60 hover:opacity-100 cursor-pointer' }} transition-all">
                            <img src="{{ Storage::url($image->image_path) }}" class="w-full h-full object-cover" alt="Thumbnail">
                        </div>
                    @endforeach
                </div>
                @endif

                <!-- Specs Grid -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-8">
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-4 text-center">
                        <div class="text-gray-400 text-xs uppercase tracking-wider mb-1 font-medium">Year</div>
                        <div class="text-white font-bold text-lg">{{ $car->year }}</div>
                    </div>
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-4 text-center">
                        <div class="text-gray-400 text-xs uppercase tracking-wider mb-1 font-medium">Body Type</div>
                        <div class="text-white font-bold text-lg">{{ $car->type }}</div>
                    </div>
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-4 text-center">
                        <div class="text-gray-400 text-xs uppercase tracking-wider mb-1 font-medium">Fuel</div>
                        <div class="text-white font-bold text-lg">{{ $car->fuel_type }}</div>
                    </div>
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-4 text-center">
                        <div class="text-gray-400 text-xs uppercase tracking-wider mb-1 font-medium">Transmission</div>
                        <div class="text-white font-bold text-lg">{{ $car->transmission }}</div>
                    </div>
                </div>

                <!-- Description -->
                <div class="pt-8">
                    <h3 class="text-2xl font-bold text-white mb-4">About this car</h3>
                    <div class="prose prose-invert max-w-none text-gray-300 leading-relaxed">
                        @if($car->description)
                            {{ $car->description }}
                        @else
                            <p>No detailed description provided by the owner.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column: Product Details & Booking -->
            <div class="lg:col-span-1">
                <div class="sticky top-28 space-y-6">
                    
                    <!-- Dynamic Management Controls -->
                    @auth
                        @if (auth()->user()->id === $car->user_id)
                            <div class="flex flex-col gap-3 p-5 bg-gradient-to-br from-gray-900 to-gray-800 border border-indigo-500/30 rounded-3xl shadow-[0_0_20px_rgba(79,70,229,0.1)]">
                                <div class="flex items-center gap-2 mb-2">
                                    <div class="w-2 h-2 rounded-full {{ $car->status === 'approved' ? 'bg-green-400 shadow-[0_0_10px_rgba(74,222,128,0.8)]' : 'bg-yellow-400 shadow-[0_0_10px_rgba(250,204,21,0.8)]' }}"></div>
                                    <span class="text-sm font-bold text-white tracking-wide uppercase">{{ ucfirst($car->status) }}</span>
                                </div>
                                <p class="text-xs text-gray-400 mb-2">You are the owner of this vehicle. Manage your listing below.</p>
                                <div class="grid grid-cols-2 gap-3">
                                    <a href="{{ route('owner.cars.edit', $car) }}" class="text-center py-2.5 bg-indigo-500/10 hover:bg-indigo-500/20 text-indigo-400 border border-indigo-500/30 rounded-xl text-sm font-bold transition-colors">
                                        Edit Details
                                    </a>
                                    <form action="{{ route('owner.cars.destroy', $car) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-full py-2.5 bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/30 rounded-xl text-sm font-bold transition-colors">
                                            Delete Car
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @elseif (auth()->user()->role === 'admin')
                            <div class="flex flex-col gap-3 p-5 bg-indigo-950/50 border border-indigo-500/30 rounded-3xl">
                                <h3 class="text-indigo-400 font-bold text-sm uppercase tracking-wider">Admin Controls</h3>
                                <p class="text-xs text-gray-400">Manage platform listings.</p>
                                <div class="grid grid-cols-2 gap-3 mt-2">
                                    @if($car->status === 'pending')
                                        <form action="{{ route('admin.cars.update', $car) }}" method="POST" class="inline">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="w-full py-2.5 bg-green-500 hover:bg-green-400 text-white rounded-xl text-sm font-bold transition-colors shadow-lg shadow-green-500/20">
                                                Approve
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" class="inline {{ $car->status === 'approved' ? 'col-span-2' : '' }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-full py-2.5 bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/30 rounded-xl text-sm font-bold transition-colors">
                                            Delete Listing
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endauth

                    <!-- Main Booking Card -->
                    <div class="bg-white/5 border border-white/10 p-8 rounded-3xl backdrop-blur-xl">
                        <div class="mb-2">
                            <span class="text-xs font-bold tracking-wider text-indigo-400 uppercase">{{ $car->brand }}</span>
                        </div>
                        <h1 class="text-3xl font-extrabold text-white mb-2">
                            @if(!$car->is_available)
                                <span class="text-xs bg-red-500/20 text-red-400 px-2 py-1 rounded mr-2 uppercase tracking-wider align-middle border border-red-500/30">Rented Today</span>
                            @endif
                            {{ $car->title }}
                        </h1>
                        
                        <div class="flex items-center gap-2 mb-6">
                            <div class="flex items-center text-yellow-400">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            </div>
                            <span class="text-white font-bold">{{ number_format($car->reviews->avg('rating') ?: 5.0, 1) }}</span>
                            <span class="text-gray-500 text-sm">({{ $car->reviews->count() }} trips)</span>
                            <span class="mx-2 text-gray-700">&bull;</span>
                            <span class="text-gray-400 text-sm flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $car->location }}
                            </span>
                        </div>

                        <div class="py-6 border-t border-b border-white/10 mb-8">
                            <div class="flex items-end gap-2 mb-1">
                                <span class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400">৳{{ number_format($car->price_per_day, 0) }}</span>
                                <span class="text-lg text-gray-500 mb-1">/ day</span>
                            </div>
                            @if($car->price_per_month)
                                <p class="text-sm text-gray-400">or ৳{{ number_format($car->price_per_month, 0) }}/mo</p>
                            @endif
                        </div>

                        <form action="{{ route('customer.bookings.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="car_id" value="{{ $car->id }}">
                            
                            <div class="flex flex-col gap-4 mb-6">
                                <div>
                                    <label class="block text-xs font-bold tracking-wider text-gray-400 uppercase mb-2">Check-in</label>
                                    <input type="date" name="start_date" required min="{{ date('Y-m-d') }}" class="w-full bg-gray-900 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 transition-all">
                                    @error('start_date') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-bold tracking-wider text-gray-400 uppercase mb-2">Check-out</label>
                                    <input type="date" name="end_date" required min="{{ date('Y-m-d') }}" class="w-full bg-gray-900 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 transition-all">
                                    @error('end_date') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            @error('car_id')
                                <div class="bg-red-500/10 border border-red-500/30 text-red-400 p-3 rounded-xl mb-4 text-sm">{{ $message }}</div>
                            @enderror

                            @guest
                                <a href="{{ route('login') }}" class="block text-center w-full py-4 bg-gray-800 hover:bg-gray-700 text-white rounded-2xl font-bold text-lg transition-all border border-white/10">
                                    Sign In to Book
                                </a>
                            @else
                                <button type="submit" class="w-full py-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white rounded-2xl font-bold text-lg shadow-[0_0_20px_rgba(79,70,229,0.3)] hover:shadow-[0_0_30px_rgba(79,70,229,0.5)] transition-all">
                                    Book This Car
                                </button>
                                <p class="text-center text-xs text-gray-500 mt-4">You won't be charged until approved by the owner.</p>
                            @endguest
                        </form>
                    </div>

                    <!-- Host Info -->
                    <div class="bg-gray-900/50 border border-white/5 p-6 rounded-3xl flex items-center gap-4">
                        <div class="w-14 h-14 rounded-full bg-indigo-500/20 text-indigo-400 flex items-center justify-center text-xl font-bold border border-indigo-500/30">
                            {{ substr($car->owner->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider font-bold mb-1">Hosted By</p>
                            <p class="text-white font-bold text-lg">{{ $car->owner->name }}</p>
                            <p class="text-sm text-gray-400">Joined {{ $car->owner->created_at->format('M Y') }}</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-public-layout>
