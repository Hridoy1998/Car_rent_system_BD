<x-public-layout>
    <x-slot name="title">{{ $car->year }} {{ $car->brand }} {{ $car->model }} - CarRent BD</x-slot>

    <div class="pt-28 pb-20 bg-gray-950 min-h-screen relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-indigo-600/5 rounded-full blur-[150px] -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumbs & Trust Bar -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <nav class="flex text-xs font-bold uppercase tracking-widest text-gray-500" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-2">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a></li>
                        <li><svg class="w-3 h-3 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg></li>
                <li class="text-white">
                    <a href="{{ route('search', ['location' => $car->location]) }}" class="hover:text-indigo-400 transition-colors uppercase tracking-widest text-[10px]">{{ $car->location }}</a>
                </li>
                <li><svg class="w-3 h-3 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg></li>
                <li class="text-white">{{ $car->brand }} {{ $car->model }}</li>
                    </ol>
                </nav>
                <div class="flex items-center gap-4 bg-white/5 px-4 py-2 rounded-2xl border border-white/5">
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        <span class="text-[10px] font-black text-gray-300 uppercase tracking-widest">Insurance Verified</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                
                <!-- Gallery & Specs -->
                <div class="lg:col-span-2 space-y-12">
                    
                    <!-- Main Gallery Hub -->
                    <div class="space-y-4">
                        <div class="aspect-[16/9] w-full rounded-[2.5rem] overflow-hidden bg-gray-900 border border-white/10 relative shadow-2xl group">
                            @if($car->images->count() > 0)
                                <img src="{{ Storage::url($car->images->where('is_primary', true)->first()->image_path ?? $car->images->first()->image_path) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-700">NO VEHICLE IMAGES</div>
                            @endif
                            <div class="absolute top-6 right-6 px-4 py-2 bg-gray-950/80 backdrop-blur-md rounded-2xl text-[10px] font-black text-white uppercase tracking-widest border border-white/10">
                                1 of {{ $car->images->count() ?: 1 }} Photos
                            </div>
                        </div>
                        
                        @if($car->images->count() > 1)
                        <div class="flex gap-4 overflow-x-auto pb-4 scrollbar-hide">
                            @foreach($car->images as $image)
                                <div class="w-32 h-20 flex-shrink-0 rounded-2xl overflow-hidden border-2 {{ $loop->first ? 'border-indigo-500 shadow-[0_0_15px_rgba(79,70,229,0.3)]' : 'border-white/5 opacity-50 hover:opacity-100' }} transition-all cursor-pointer">
                                    <img src="{{ Storage::url($image->image_path) }}" class="w-full h-full object-cover">
                                </div>
                            @endforeach
                        </div>
                        @endif
                    </div>

                    <!-- Enhanced Specs Grid -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        @php
                            $specs = [
                                ['label' => 'Engine', 'val' => $car->engine_capacity ?: '1.5L', 'icon' => 'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.638.319a4 4 0 01-1.833.446H8.43a4 4 0 01-1.833-.446l-.638-.319a6 6 0 00-3.86-.517l-2.387.477a2 2 0 00-1.022.547V18a2 2 0 002 2h15a2 2 0 002-2v-2.572z'],
                                ['label' => 'Fuel', 'val' => $car->fuel_type, 'icon' => 'M3 4a1 1 0 011-1h16a1 1 0 110 2H4a1 1 0 01-1-1zm10 10V6m0 8h9m-9 0H5m12 1a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z'],
                                ['label' => 'Seats', 'val' => $car->seats . ' Pass.', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                                ['label' => 'Gearbox', 'val' => $car->transmission, 'icon' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z'],
                            ];
                        @endphp
                        @foreach($specs as $spec)
                        <div class="bg-white/5 border border-white/10 rounded-3xl p-6 text-center group hover:bg-white/[0.07] transition-all">
                            <svg class="w-6 h-6 mx-auto mb-3 text-indigo-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $spec['icon'] }}"></path></svg>
                            <div class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">{{ $spec['label'] }}</div>
                            <div class="text-white font-black">{{ $spec['val'] }}</div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Description & Features -->
                    <div class="space-y-10">
                        <section>
                            <h3 class="text-2xl font-black text-white mb-4">Description</h3>
                            <p class="text-gray-400 leading-relaxed text-lg">{{ $car->description ?: 'No detailed description available.' }}</p>
                        </section>

                        <!-- Geospatial Deployment (Map) -->
                        <section>
                            <h3 class="text-2xl font-black text-white mb-6">Deployment Territory</h3>
                            <div class="bg-gray-900 border border-white/10 rounded-[2.5rem] p-4 shadow-2xl overflow-hidden">
                                <div id="discovery-map" class="w-full h-[400px] rounded-[2rem] z-0"></div>
                            </div>
                            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mt-4 flex items-center gap-2">
                                <svg class="w-4 h-4 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                Approximate Location: {{ $car->location }}
                            </p>
                        </section>

                        <section>
                            <h3 class="text-2xl font-black text-white mb-6">Premium Features</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @php
                                    $features = $car->features ? explode(',', $car->features) : ['Air Conditioning', 'Bluetooth Audio', 'GPS Navigation', 'Backup Camera', 'Cruise Control'];
                                @endphp
                                @foreach($features as $f)
                                    <div class="flex items-center gap-3 bg-white/5 px-6 py-4 rounded-2xl border border-white/5 text-gray-300 font-bold">
                                        <div class="w-2 h-2 rounded-full bg-indigo-500 shadow-[0_0_8px_rgba(79,70,229,0.8)]"></div>
                                        {{ trim($f) }}
                                    </div>
                                @endforeach
                            </div>
                        </section>

                        <section class="bg-indigo-600/10 border border-indigo-500/20 rounded-3xl p-8">
                            <h4 class="text-white font-black text-xl mb-4 flex items-center gap-3">
                                <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Rental Policy
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-sm">
                                <div>
                                    <p class="text-gray-500 uppercase font-black tracking-widest text-[10px] mb-2">Fuel Policy</p>
                                    <p class="text-white font-bold">{{ $car->fuel_policy ?: 'Full to Full' }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500 uppercase font-black tracking-widest text-[10px] mb-2">Insurance</p>
                                    <p class="text-white font-bold">{{ $car->insurance_info ?: 'Comprehensive Liability Coverage' }}</p>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <!-- Booking Panel -->
                <div class="lg:col-span-1">
                    <div class="sticky top-28 space-y-6">
                        
                        <!-- Main Booking Card -->
                        <div class="bg-gray-900 border border-white/10 p-8 rounded-[2.5rem] shadow-2xl relative overflow-hidden">
                            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-600 to-purple-600"></div>
                            
                            <div class="flex justify-between items-start mb-6">
                                <div>
                                    <p class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-1">Pricing</p>
                                    <div class="flex items-end gap-2">
                                        <span class="text-4xl font-black text-white">৳ {{ number_format($car->price_per_day) }}</span>
                                        <span class="text-gray-500 font-bold mb-1">/ day</span>
                                    </div>
                                </div>
                                <div class="w-12 h-12 rounded-2xl bg-white/5 border border-white/5 flex items-center justify-center text-yellow-500">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                </div>
                            </div>

                            <form action="{{ route('customer.bookings.store') }}" method="POST" class="space-y-6">
                                @csrf
                                <input type="hidden" name="car_id" value="{{ $car->id }}">
                                
                                <div class="grid grid-cols-1 gap-4">
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-2">Rental Start</label>
                                        <input type="date" name="start_date" required min="{{ date('Y-m-d') }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl px-5 py-4 text-white focus:ring-2 focus:ring-indigo-500 transition-all outline-none">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-2">Rental End</label>
                                        <input type="date" name="end_date" required min="{{ date('Y-m-d') }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl px-5 py-4 text-white focus:ring-2 focus:ring-indigo-500 transition-all outline-none">
                                    </div>
                                </div>

                                @error('car_id') <p class="text-red-400 text-xs">{{ $message }}</p> @enderror

                                @guest
                                    <a href="{{ route('login') }}" class="block text-center w-full py-5 bg-gray-800 text-white font-black rounded-2xl uppercase tracking-widest transition-all hover:bg-gray-700">Login to Book</a>
                                @else
                                    <button type="submit" class="w-full py-5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-black rounded-[1.5rem] uppercase tracking-widest shadow-[0_0_30px_rgba(79,70,229,0.3)] hover:scale-[1.02] transition-all">Instant Booking</button>
                                @endguest
                            </form>
                            
                            <p class="text-center text-[10px] text-gray-600 mt-6 font-bold uppercase tracking-tighter">Identity verification required for this vehicle</p>
                        </div>

                        <!-- Host Insight Card -->
                        <div class="bg-gray-900/50 backdrop-blur-xl border border-white/5 p-8 rounded-[2.5rem] relative group">
                            <div class="flex items-center gap-6 mb-6">
                                <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-indigo-500 to-indigo-700 flex items-center justify-center text-2xl font-black text-white shadow-xl">
                                    {{ substr($car->owner->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">Meet the Host</p>
                                    <h4 class="text-xl font-bold text-white">{{ $car->owner->name }}</h4>
                                    <p class="text-[10px] text-indigo-400 font-bold uppercase">Top Rated Professional</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div class="text-center p-3 bg-white/5 rounded-2xl">
                                    <div class="text-lg font-black text-white">4.9</div>
                                    <div class="text-[8px] text-gray-500 uppercase font-black">Rating</div>
                                </div>
                                <div class="text-center p-3 bg-white/5 rounded-2xl">
                                    <div class="text-lg font-black text-white">100%</div>
                                    <div class="text-[8px] text-gray-500 uppercase font-black">Response</div>
                                </div>
                            </div>
                            <a href="{{ route('profiles.show', $car->owner) }}" class="block text-center py-4 bg-white/5 border border-white/5 text-sm font-black text-gray-300 rounded-2xl hover:bg-indigo-600 hover:text-white transition-all uppercase tracking-widest">View Profile & Fleet</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lat = {{ $car->latitude ?: 23.8103 }};
            const lng = {{ $car->longitude ?: 90.4125 }};
            
            const map = L.map('discovery-map', {
                center: [lat, lng],
                zoom: 13,
                zoomControl: false,
                attributionControl: false
            });

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

            L.circle([lat, lng], {
                color: '#6366f1',
                fillColor: '#6366f1',
                fillOpacity: 0.2,
                radius: 1000
            }).addTo(map);

            L.marker([lat, lng]).addTo(map);
        });
    </script>
</x-public-layout>
