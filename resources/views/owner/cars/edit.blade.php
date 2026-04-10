<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-black text-3xl text-white tracking-tighter uppercase italic">
                    {{ __('Asset Modification') }}
                </h2>
                <p class="text-[10px] text-indigo-400 font-bold uppercase tracking-[0.3em] mt-1 italic">Optimizing Parameters for: {{ $car->brand }} {{ $car->model }}</p>
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
                <div class="mb-8 bg-red-500/10 border border-red-500/50 text-red-500 p-8 rounded-[2.5rem] shadow-2xl">
                    <h4 class="text-[10px] font-black uppercase tracking-widest mb-4 flex items-center gap-2">
                        <span class="w-2 h-2 bg-red-500 rounded-full animate-ping"></span>
                        Configuration Blocked
                    </h4>
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="text-[10px] font-bold uppercase tracking-tight">• {{ $error }}</li>
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
                        <div class="bg-gray-900/50 backdrop-blur-3xl border border-white/10 p-10 rounded-[3.5rem] shadow-2xl">
                            <h3 class="text-xl font-bold text-white mb-8 flex items-center gap-3 italic">
                                <span class="w-1.5 h-6 bg-indigo-500 rounded-full"></span>
                                Identity Profile
                            </h3>
                            
                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-4">Listing Headline</label>
                                    <input type="text" name="title" required value="{{ old('title', $car->title) }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white font-bold focus:ring-2 focus:ring-indigo-500 outline-none transition-all" placeholder="e.g. 2023 Tesla Model 3 Performance">
                                </div>

                                <div class="grid grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-4">Manufacturer</label>
                                        <input type="text" name="brand" required value="{{ old('brand', $car->brand) }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white font-bold focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-4">Model Variant</label>
                                        <input type="text" name="model" required value="{{ old('model', $car->model) }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white font-bold focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-4">Year</label>
                                        <input type="number" name="year" required value="{{ old('year', $car->year) }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white font-mono focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-4">Chassis Style</label>
                                        <select name="type" required class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white font-black uppercase tracking-widest text-[10px] focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                                            @foreach(['Sedan', 'SUV', 'Hatchback', 'Van', 'Luxury'] as $t)
                                                <option value="{{ $t }}" {{ $car->type === $t ? 'selected' : '' }}>{{ $t }} Chassis</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Technical Matrix -->
                        <div class="bg-gray-900/50 backdrop-blur-3xl border border-white/10 p-10 rounded-[3.5rem] shadow-2xl">
                             <h3 class="text-xl font-bold text-white mb-8 flex items-center gap-3 italic">
                                <span class="w-1.5 h-6 bg-purple-500 rounded-full"></span>
                                Technical Parameters
                            </h3>

                            <div class="grid grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-4">Transmission</label>
                                    <select name="transmission" required class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white font-black uppercase tracking-widest text-[10px] focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                                        <option value="Auto" {{ $car->transmission === 'Auto' ? 'selected' : '' }}>Automatic</option>
                                        <option value="Manual" {{ $car->transmission === 'Manual' ? 'selected' : '' }}>Manual</option>
                                    </select>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-4">Propulsion System</label>
                                    <input type="text" name="fuel_type" required value="{{ old('fuel_type', $car->fuel_type) }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white font-bold focus:ring-2 focus:ring-indigo-500 outline-none transition-all" placeholder="Petrol / Electric / Hybrid">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-4">Displacement</label>
                                    <input type="text" name="engine_capacity" required value="{{ old('engine_capacity', $car->engine_capacity) }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white font-mono focus:ring-2 focus:ring-indigo-500 outline-none transition-all" placeholder="e.g. 1500cc">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-4">Occupancy Limits</label>
                                    <input type="number" name="seats" required value="{{ old('seats', $car->seats) }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white font-mono focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                                </div>
                            </div>
                        </div>

                        <!-- Financials & Policy -->
                         <div class="bg-gray-900/50 backdrop-blur-3xl border border-white/10 p-10 rounded-[3.5rem] shadow-2xl">
                             <h3 class="text-xl font-bold text-white mb-8 flex items-center gap-3 italic">
                                <span class="w-1.5 h-6 bg-emerald-500 rounded-full"></span>
                                Yield Protocol
                            </h3>
                            <div class="grid grid-cols-2 gap-6 mb-8">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-4 text-emerald-400">Daily Fare (৳)</label>
                                    <input type="number" name="price_per_day" required value="{{ old('price_per_day', (int)$car->price_per_day) }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-5 text-emerald-400 text-xl font-black focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-4 text-emerald-400">Monthly Yield (৳)</label>
                                    <input type="number" name="price_per_month" required value="{{ old('price_per_month', (int)$car->price_per_month) }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-5 text-emerald-400 text-xl font-black focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                                </div>
                            </div>
                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-4">Fuel Strategy</label>
                                    <input type="text" name="fuel_policy" value="{{ old('fuel_policy', $car->fuel_policy) }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white font-bold focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-4">Insurance Manifest</label>
                                    <input type="text" name="insurance_info" value="{{ old('insurance_info', $car->insurance_info) }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white font-bold focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Right Column: Location (Map) & Photos -->
                    <div class="space-y-12">
                        
                        <!-- Geospatial Deployment -->
                        <div class="bg-gray-900/50 backdrop-blur-3xl border border-white/10 p-10 rounded-[3.5rem] shadow-2xl">
                             <h3 class="text-xl font-bold text-white mb-8 flex items-center gap-3 italic">
                                <span class="w-1.5 h-6 bg-pink-500 rounded-full"></span>
                                Geospatial Parameters
                            </h3>
                            
                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-4">Deployment Node (Area/City)</label>
                                    <input type="text" name="location" id="location_input" required value="{{ old('location', $car->location) }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white font-bold focus:ring-2 focus:ring-indigo-500 outline-none transition-all" placeholder="e.g. Bashundhara R/A, Dhaka">
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-4">Coordinate Calibration</label>
                                    <div id="map-picker" class="w-full h-[400px] rounded-[2.5rem] border border-white/10 overflow-hidden shadow-2xl z-0"></div>
                                    <input type="hidden" name="latitude" id="lat_field" value="{{ old('latitude', $car->latitude ?: 23.8103) }}">
                                    <input type="hidden" name="longitude" id="lng_field" value="{{ old('longitude', $car->longitude ?: 90.4125) }}">
                                </div>
                            </div>
                        </div>

                        <!-- Visual Artifacts -->
                        <div class="bg-gray-900/50 backdrop-blur-3xl border border-white/10 p-10 rounded-[3.5rem] shadow-2xl overflow-hidden relative group">
                            <h3 class="text-xl font-bold text-white mb-8 flex items-center gap-3 italic">
                                <span class="w-1.5 h-6 bg-orange-500 rounded-full"></span>
                                Visual Evidence Suite
                            </h3>
                            
                            <div class="space-y-8">
                                <div class="border-2 border-dashed border-white/10 rounded-[2.5rem] p-12 hover:border-indigo-500/50 transition-all cursor-pointer bg-black/20 group/upload" onclick="document.getElementById('images').click()">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-600 group-hover/upload:text-indigo-400 transition-colors mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Ingest Additional Visual Artifacts</p>
                                    </div>
                                    <input type="file" name="images[]" id="images" multiple class="hidden" accept="image/*" onchange="previewImages(event)">
                                </div>

                                <div id="image-previews" class="grid grid-cols-4 gap-4">
                                    @foreach($car->images as $img)
                                        <div class="aspect-square rounded-2xl overflow-hidden border border-white/10 relative group/img">
                                            <img src="{{ Storage::url($img->image_path) }}" class="w-full h-full object-cover">
                                            <div class="absolute inset-0 bg-red-600/80 opacity-0 group-hover/img:opacity-100 flex items-center justify-center transition-all backdrop-blur-[2px] text-center">
                                                <span class="text-[8px] font-black uppercase text-white leading-tight">Delete via<br>Inventory Hub</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Strategic Audit Trail -->
                        <div class="bg-gray-900/50 backdrop-blur-3xl border border-white/10 p-10 rounded-[3.5rem] shadow-2xl relative overflow-hidden group">
                             <div class="absolute -right-10 -top-10 w-48 h-48 bg-amber-500/5 rounded-full blur-[80px] group-hover:bg-amber-500/10 transition-all"></div>
                             <h3 class="text-xl font-bold text-white mb-8 flex items-center gap-3 italic">
                                <span class="w-1.5 h-6 bg-amber-500 rounded-full"></span>
                                Change Intelligence
                            </h3>
                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ms-4">Modification Rationale (Required)</label>
                                    <textarea name="edit_reason" required class="w-full bg-gray-950 border border-white/5 rounded-[2rem] p-6 text-white text-sm focus:ring-2 focus:ring-amber-500 outline-none transition-all italic leading-relaxed" placeholder="Briefly describe the parameters modified and the operational rationale..."></textarea>
                                </div>
                                @if($car->last_edit_reason)
                                    <div class="p-6 bg-white/5 border border-white/5 rounded-2xl">
                                        <p class="text-[8px] font-black text-gray-600 uppercase tracking-widest mb-2 italic">Previous Audit Statement:</p>
                                        <p class="text-xs text-gray-400 font-medium italic leading-relaxed">"{{ $car->last_edit_reason }}"</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Final Deployment -->
                        <div class="pt-12 text-center flex flex-col items-center gap-8">
                            <button type="submit" class="w-full py-8 bg-white text-gray-950 font-black rounded-[2.5rem] shadow-2xl hover:bg-indigo-600 hover:text-white transition-all uppercase tracking-[0.6em] text-xs group relative overflow-hidden">
                                <span class="relative z-10">Commit Strategic Update</span>
                                <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-purple-600 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            </button>
                            <p class="text-[8px] text-gray-500 font-black uppercase tracking-[0.3em] italic animate-pulse">Asset status remains 'Pending' until platform audit</p>
                            
                            <a href="{{ route('owner.cars.index') }}" class="text-[9px] font-black text-gray-600 hover:text-white uppercase tracking-widest transition-colors flex items-center gap-2 group">
                                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7 7-7"></path></svg>
                                Abort Calibration
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
            const files = event.target.files;
            
            for(let i=0; i<files.length; i++) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'aspect-square rounded-2xl overflow-hidden border border-indigo-500/50 shadow-[0_0_20px_rgba(79,70,229,0.2)] animate-pulse';
                    div.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                    container.appendChild(div);
                }
                reader.readAsDataURL(files[i]);
            }
        }
    </script>
</x-app-layout>
