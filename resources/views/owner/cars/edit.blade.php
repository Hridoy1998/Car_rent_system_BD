    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-black text-3xl text-white tracking-tighter uppercase italic">
                    {{ __('Asset Modification') }}
                </h2>
                <p class="text-[10px] text-indigo-400 font-bold uppercase tracking-[0.3em] mt-1 italic italic">Optimizing Parameters for: {{ $car->brand }} {{ $car->model }}</p>
            </div>
             <a href="{{ route('owner.cars.index') }}" class="text-[10px] font-black text-gray-500 hover:text-white transition-colors uppercase tracking-widest bg-white/5 px-6 py-3 rounded-2xl border border-white/5 flex items-center gap-3 group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M11 19l-7-7 7-7"></path></svg>
                Abort Protocol
            </a>
        </div>
    </x-slot>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <div class="py-12 bg-gray-950 min-h-screen text-slate-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if ($errors->any())
                <div class="mb-8 bg-red-500/10 border border-red-500/50 text-red-500 p-6 rounded-3xl animate-pulse">
                    <ul class="list-disc pl-5 font-bold text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('owner.cars.update', $car) }}" method="POST" enctype="multipart/form-data" class="space-y-12">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    
                    <!-- Left Column: Basics & Specs -->
                    <div class="space-y-12">
                        
                        <!-- Core Identity -->
                        <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 p-10 rounded-[2.5rem] shadow-2xl">
                            <h3 class="text-xl font-bold text-white mb-8 flex items-center gap-3">
                                <span class="w-1 h-6 bg-indigo-500 rounded-full"></span>
                                Vehicle Identity
                            </h3>
                            
                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-2">Listing Headline</label>
                                    <input type="text" name="title" required value="{{ old('title', $car->title) }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white focus:ring-indigo-500" placeholder="e.g. 2023 Tesla Model 3 Performance">
                                </div>

                                <div class="grid grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-2">Brand</label>
                                        <input type="text" name="brand" required value="{{ old('brand', $car->brand) }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white focus:ring-indigo-500">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-2">Model</label>
                                        <input type="text" name="model" required value="{{ old('model', $car->model) }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white focus:ring-indigo-500">
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-2">Manufacturing Year</label>
                                        <input type="number" name="year" required value="{{ old('year', $car->year) }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white focus:ring-indigo-500">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-2">Body Type</label>
                                        <select name="type" required class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white focus:ring-indigo-500">
                                            @foreach(['Sedan', 'SUV', 'Hatchback', 'Van', 'Luxury'] as $t)
                                                <option value="{{ $t }}" {{ $car->type === $t ? 'selected' : '' }}>{{ $t }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Technical Matrix -->
                        <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 p-10 rounded-[2.5rem] shadow-2xl">
                             <h3 class="text-xl font-bold text-white mb-8 flex items-center gap-3">
                                <span class="w-1 h-6 bg-purple-500 rounded-full"></span>
                                Technical Matrix
                            </h3>

                            <div class="grid grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-2">Transmission</label>
                                    <select name="transmission" required class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white focus:ring-indigo-500">
                                        <option value="Auto" {{ $car->transmission === 'Auto' ? 'selected' : '' }}>Automatic</option>
                                        <option value="Manual" {{ $car->transmission === 'Manual' ? 'selected' : '' }}>Manual</option>
                                    </select>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-2">Fuel Paradigm</label>
                                    <input type="text" name="fuel_type" required value="{{ old('fuel_type', $car->fuel_type) }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white focus:ring-indigo-500" placeholder="Petrol / Electric / Hybrid">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-2">Engine Displacement</label>
                                    <input type="text" name="engine_capacity" required value="{{ old('engine_capacity', $car->engine_capacity) }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white focus:ring-indigo-500" placeholder="e.g. 1500cc / 2.0L">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-2">Capacity (Seats)</label>
                                    <input type="number" name="seats" required value="{{ old('seats', $car->seats) }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white focus:ring-indigo-500">
                                </div>
                            </div>
                        </div>

                        <!-- Financials & Policy -->
                         <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 p-10 rounded-[2.5rem] shadow-2xl">
                             <h3 class="text-xl font-bold text-white mb-8 flex items-center gap-3">
                                <span class="w-1 h-6 bg-emerald-500 rounded-full"></span>
                                Commercial Protocol
                            </h3>
                            <div class="grid grid-cols-2 gap-6 mb-8">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-2">Daily Revenue (৳)</label>
                                    <input type="number" name="price_per_day" required value="{{ old('price_per_day', (int)$car->price_per_day) }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white focus:ring-indigo-500">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-2">Monthly Bundle (৳)</label>
                                    <input type="number" name="price_per_month" required value="{{ old('price_per_month', (int)$car->price_per_month) }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white focus:ring-indigo-500">
                                </div>
                            </div>
                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-2">Fuel Policy</label>
                                    <input type="text" name="fuel_policy" value="{{ old('fuel_policy', $car->fuel_policy) }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white focus:ring-indigo-500">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-2">Insurance level</label>
                                    <input type="text" name="insurance_info" value="{{ old('insurance_info', $car->insurance_info) }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white focus:ring-indigo-500">
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Right Column: Location (Map) & Photos -->
                    <div class="space-y-12">
                        
                        <!-- Spatial Awareness (Map Picker) -->
                        <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 p-10 rounded-[2.5rem] shadow-2xl">
                             <h3 class="text-xl font-bold text-white mb-8 flex items-center gap-3">
                                <span class="w-1 h-6 bg-pink-500 rounded-full"></span>
                                Geospatial Deployment
                            </h3>
                            
                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-2">Pickup Territory (City/Area)</label>
                                    <input type="text" name="location" id="location_input" required value="{{ old('location', $car->location) }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white focus:ring-indigo-500" placeholder="e.g. Bashundhara R/A, Dhaka">
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-2">Precise Coordinates (Drag pin on map)</label>
                                    <div id="map-picker" class="w-full h-[400px] rounded-[2rem] border-4 border-white/5 overflow-hidden z-0"></div>
                                    <input type="hidden" name="latitude" id="lat_field" value="{{ old('latitude', $car->latitude ?: 23.8103) }}">
                                    <input type="hidden" name="longitude" id="lng_field" value="{{ old('longitude', $car->longitude ?: 90.4125) }}">
                                </div>
                            </div>
                        </div>

                        <!-- Visual Evidence (Photos) -->
                        <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 p-10 rounded-[2.5rem] shadow-2xl overflow-hidden relative group">
                            <h3 class="text-xl font-bold text-white mb-8 flex items-center gap-3">
                                <span class="w-1 h-6 bg-orange-500 rounded-full"></span>
                                Asset Visuals
                            </h3>
                            
                            <div class="space-y-6 text-center">
                                <div class="border-2 border-dashed border-white/10 rounded-3xl p-12 hover:border-indigo-500/50 transition-all cursor-pointer bg-black/20" onclick="document.getElementById('images').click()">
                                    <svg class="w-12 h-12 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <p class="text-sm text-gray-400 font-bold mb-1">Click to add more photos</p>
                                    <input type="file" name="images[]" id="images" multiple class="hidden" accept="image/*" onchange="previewImages(event)">
                                </div>
                                <div id="image-previews" class="grid grid-cols-4 gap-4">
                                    @foreach($car->images as $img)
                                        <div class="aspect-square rounded-xl overflow-hidden border border-white/10 relative group">
                                            <img src="{{ Storage::url($img->image_path) }}" class="w-full h-full object-cover">
                                            <div class="absolute inset-0 bg-red-600/60 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity cursor-not-allowed text-[10px] font-black uppercase text-white">To Delete<br>Use Inventory</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Strategic Audit Trail -->
                        <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 p-10 rounded-[2.5rem] shadow-2xl relative overflow-hidden group">
                             <div class="absolute -right-4 -top-4 w-32 h-32 bg-amber-500/5 rounded-full blur-3xl group-hover:bg-amber-500/10 transition-all"></div>
                             <h3 class="text-xl font-bold text-white mb-8 flex items-center gap-3">
                                <span class="w-1 h-6 bg-amber-500 rounded-full"></span>
                                Change Intelligence
                            </h3>
                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-2">Reason for Strategic Update (Required for Authorization)</label>
                                <textarea name="edit_reason" required class="w-full bg-gray-950 border border-white/5 rounded-2xl p-6 text-white text-sm focus:ring-indigo-500 min-h-[120px]" placeholder="Briefly describe the parameters modified and the operational rationale..."></textarea>
                                @if($car->last_edit_reason)
                                    <div class="mt-4 p-4 bg-white/5 border border-white/5 rounded-2xl">
                                        <p class="text-[9px] font-black text-gray-600 uppercase tracking-widest mb-2 italic">Prior Audit Statement:</p>
                                        <p class="text-[11px] text-gray-400 font-medium italic">"{{ $car->last_edit_reason }}"</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Deployment -->
                        <div class="pt-12 text-center flex flex-col items-center gap-6">
                            <button type="submit" class="w-full py-6 bg-white text-gray-950 font-black rounded-3xl shadow-[0_0_50px_rgba(255,255,255,0.1)] hover:shadow-indigo-500/20 hover:bg-indigo-600 hover:text-white transition-all uppercase tracking-[0.4em] text-sm group">
                                SUBMIT FOR AUTHORIZATION
                                <div class="mt-1 text-[8px] opacity-40 font-bold tracking-widest group-hover:opacity-100 italic">CAR WILL BE HIDDEN UNTIL ADMIN AUDIT</div>
                            </button>
                            <a href="{{ route('owner.cars.index') }}" class="text-[10px] font-black text-gray-600 uppercase tracking-widest hover:text-white transition-colors flex items-center gap-2">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7 7-7"></path></svg>
                                Abort Protocol
                            </a>
                        </div>

                    </div>

                </div>
            </form>

        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Map Initialization
        const defaultLat = document.getElementById('lat_field').value;
        const defaultLng = document.getElementById('lng_field').value;
        
        const map = L.map('map-picker', {
            center: [defaultLat, defaultLng],
            zoom: 13,
            zoomControl: false
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        const marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

        marker.on('dragend', function(e) {
            const pos = marker.getLatLng();
            document.getElementById('lat_field').value = pos.lat;
            document.getElementById('lng_field').value = pos.lng;
        });

        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            document.getElementById('lat_field').value = e.latlng.lat;
            document.getElementById('lng_field').value = e.latlng.lng;
        });

        // Image Preview
        function previewImages(event) {
            const container = document.getElementById('image-previews');
            // Keep existing server images, append new ones
            const files = event.target.files;
            
            for(let i=0; i<files.length; i++) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'aspect-square rounded-xl overflow-hidden border border-indigo-500/50 shadow-[0_0_10px_rgba(79,70,229,0.2)]';
                    div.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                    container.appendChild(div);
                }
                reader.readAsDataURL(files[i]);
            }
        }
    </script>
</x-app-layout>
