<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-black text-3xl text-white tracking-tighter uppercase italic">
                    {{ __('Asset Assembly') }}
                </h2>
                <p class="text-[10px] text-indigo-400 font-bold uppercase tracking-[0.3em] mt-1 italic italic">Deploying New Strategic Vehicle Prototype</p>
            </div>
             <a href="{{ route('owner.cars.index') }}" class="text-[10px] font-black text-gray-500 hover:text-white transition-colors uppercase tracking-widest bg-white/5 px-6 py-3 rounded-2xl border border-white/5 flex items-center gap-3 group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M11 19l-7-7 7-7"></path></svg>
                Abort Protocol
            </a>
        </div>
    </x-slot>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <div class="py-12 bg-gray-950 min-h-screen text-slate-200 relative overflow-hidden">
        <!-- Strategic Glows -->
        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-purple-600/5 rounded-full blur-[120px] -z-10 animate-pulse"></div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if ($errors->any())
                <div class="mb-10 bg-red-500/10 border border-red-500/50 text-red-500 p-8 rounded-[2.5rem] animate-pulse shadow-2xl shadow-red-500/10">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="p-2 bg-red-500 rounded-xl text-white">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <h4 class="font-black uppercase tracking-widest text-sm italic">Validation Fault Detected</h4>
                    </div>
                    <ul class="list-disc pl-10 font-bold text-xs uppercase tracking-tight space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('owner.cars.store') }}" method="POST" enctype="multipart/form-data" class="space-y-12">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    
                    <!-- Primary Vector: Identity & Technicals -->
                    <div class="space-y-12">
                        
                        <!-- Core Identity Module -->
                        <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 p-12 rounded-[3.5rem] shadow-2xl relative overflow-hidden group">
                             <div class="absolute -right-4 -top-4 w-32 h-32 bg-indigo-500/5 rounded-full blur-3xl group-hover:bg-indigo-500/10 transition-all"></div>
                             
                             <h3 class="text-xl font-black text-white mb-10 italic tracking-tighter flex items-center gap-4">
                                <span class="w-1.5 h-8 bg-indigo-500 rounded-full shadow-[0_0_15px_rgba(99,102,241,0.5)]"></span>
                                ASSET IDENTITY
                             </h3>
                            
                            <div class="space-y-8">
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black text-gray-600 uppercase tracking-[0.4em] ms-4">Market Headline</label>
                                    <input type="text" name="title" required value="{{ old('title') }}" class="w-full bg-gray-950/50 border border-white/5 rounded-2xl p-5 text-white focus:ring-2 focus:ring-indigo-500/50 outline-none transition-all placeholder:text-gray-800 font-bold" placeholder="e.g. 2024 PORSCHE 911 GT3 RS">
                                </div>

                                <div class="grid grid-cols-2 gap-8">
                                    <div class="space-y-3">
                                        <label class="text-[10px] font-black text-gray-600 uppercase tracking-[0.4em] ms-4">Manufacturer</label>
                                        <input type="text" name="brand" required value="{{ old('brand') }}" class="w-full bg-gray-950/50 border border-white/5 rounded-2xl p-5 text-white focus:ring-2 focus:ring-indigo-500/50 outline-none font-bold">
                                    </div>
                                    <div class="space-y-3">
                                        <label class="text-[10px] font-black text-gray-600 uppercase tracking-[0.4em] ms-4">Unit Model</label>
                                        <input type="text" name="model" required value="{{ old('model') }}" class="w-full bg-gray-950/50 border border-white/5 rounded-2xl p-5 text-white focus:ring-2 focus:ring-indigo-500/50 outline-none font-bold">
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-8">
                                    <div class="space-y-3">
                                        <label class="text-[10px] font-black text-gray-600 uppercase tracking-[0.4em] ms-4">Release Year</label>
                                        <input type="number" name="year" required value="{{ old('year', date('Y')) }}" class="w-full bg-gray-950/50 border border-white/5 rounded-2xl p-5 text-white focus:ring-2 focus:ring-indigo-500/50 outline-none font-bold">
                                    </div>
                                    <div class="space-y-3">
                                        <label class="text-[10px] font-black text-gray-600 uppercase tracking-[0.4em] ms-4">Configuration</label>
                                        <select name="type" required class="w-full bg-gray-950/50 border border-white/5 rounded-2xl p-5 text-white focus:ring-2 focus:ring-indigo-500/50 outline-none font-bold appearance-none">
                                            <option value="SUV">Strategic Cruiser (SUV)</option>
                                            <option value="Sedan">Urban Executive (Sedan)</option>
                                            <option value="Hatchback">Agile Hatch</option>
                                            <option value="Van">Logistics Van</option>
                                            <option value="Other">Other Prototype</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-8">
                                    <div class="space-y-3">
                                        <label class="text-[10px] font-black text-gray-600 uppercase tracking-[0.4em] ms-4">License Plate</label>
                                        <input type="text" name="license_plate" required value="{{ old('license_plate') }}" class="w-full bg-gray-950/50 border border-white/5 rounded-2xl p-5 text-white focus:ring-2 focus:ring-indigo-500/50 outline-none font-bold" placeholder="e.g. DHAKA-METRO-KA-1234">
                                    </div>
                                    <div class="space-y-3">
                                        <label class="text-[10px] font-black text-gray-600 uppercase tracking-[0.4em] ms-4">Tactical Color</label>
                                        <input type="text" name="color" value="{{ old('color') }}" class="w-full bg-gray-950/50 border border-white/5 rounded-2xl p-5 text-white focus:ring-2 focus:ring-indigo-500/50 outline-none font-bold" placeholder="e.g. Phantom Black">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Technical Matrix Module -->
                        <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 p-12 rounded-[3.5rem] shadow-2xl relative overflow-hidden group">
                             <div class="absolute -right-4 -top-4 w-32 h-32 bg-purple-500/5 rounded-full blur-3xl group-hover:bg-purple-500/10 transition-all"></div>
                             
                             <h3 class="text-xl font-black text-white mb-10 italic tracking-tighter flex items-center gap-4">
                                <span class="w-1.5 h-8 bg-purple-500 rounded-full shadow-[0_0_15px_rgba(168,85,247,0.5)]"></span>
                                TECHNICAL MATRIX
                             </h3>

                            <div class="grid grid-cols-2 gap-8">
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black text-gray-600 uppercase tracking-[0.4em] ms-4">Drivetrain</label>
                                    <select name="transmission" required class="w-full bg-gray-950/50 border border-white/5 rounded-2xl p-5 text-white focus:ring-2 focus:ring-purple-500/50 outline-none font-bold appearance-none">
                                        <option value="Auto">Automatic Intelligence</option>
                                        <option value="Manual">Manual Control</option>
                                    </select>
                                </div>
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black text-gray-600 uppercase tracking-[0.4em] ms-4">Fuel Paradigm</label>
                                    <input type="text" name="fuel_type" required value="{{ old('fuel_type') }}" class="w-full bg-gray-950/50 border border-white/5 rounded-2xl p-5 text-white focus:ring-2 focus:ring-purple-500/50 outline-none font-bold" placeholder="Octane / Hybrid / EV">
                                </div>
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black text-gray-600 uppercase tracking-[0.4em] ms-4">Engine Intel</label>
                                    <input type="text" name="engine_capacity" required value="{{ old('engine_capacity') }}" class="w-full bg-gray-950/50 border border-white/5 rounded-2xl p-5 text-white focus:ring-2 focus:ring-purple-500/50 outline-none font-bold" placeholder="e.g. 3.0L Flat-Six">
                                </div>
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black text-gray-600 uppercase tracking-[0.4em] ms-4">Personnel Capacity</label>
                                    <input type="number" name="seats" required value="{{ old('seats', 5) }}" class="w-full bg-gray-950/50 border border-white/5 rounded-2xl p-5 text-white focus:ring-2 focus:ring-purple-500/50 outline-none font-bold">
                                </div>
                            </div>
                        </div>

                         <!-- Fiscal Logic Module -->
                         <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 p-12 rounded-[3.5rem] shadow-2xl relative overflow-hidden group">
                             <div class="absolute -right-4 -top-4 w-32 h-32 bg-emerald-500/5 rounded-full blur-3xl group-hover:bg-emerald-500/10 transition-all"></div>
                             
                             <h3 class="text-xl font-black text-white mb-10 italic tracking-tighter flex items-center gap-4">
                                <span class="w-1.5 h-8 bg-emerald-500 rounded-full shadow-[0_0_15px_rgba(16,185,129,0.5)]"></span>
                                FISCAL LOGIC
                             </h3>
                            
                            <div class="grid grid-cols-2 gap-8 mb-10">
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black text-gray-600 uppercase tracking-[0.4em] ms-4">Daily Yield (৳)</label>
                                    <input type="number" name="price_per_day" required value="{{ old('price_per_day') }}" class="w-full bg-gray-950/50 border border-white/5 rounded-2xl p-5 text-white focus:ring-2 focus:ring-emerald-500/50 outline-none font-bold text-center text-xl">
                                </div>
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black text-gray-600 uppercase tracking-[0.4em] ms-4">Monthly Target (৳)</label>
                                    <input type="number" name="price_per_month" required value="{{ old('price_per_month') }}" class="w-full bg-gray-950/50 border border-white/5 rounded-2xl p-5 text-white focus:ring-2 focus:ring-emerald-500/50 outline-none font-bold text-center text-xl">
                                </div>
                            </div>
                            
                            <div class="space-y-8">
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black text-gray-600 uppercase tracking-[0.4em] ms-4">Fuel Handover Protocol</label>
                                    <input type="text" name="fuel_policy" value="{{ old('fuel_policy', 'FULL-TO-FULL') }}" class="w-full bg-gray-950/50 border border-white/5 rounded-2xl p-5 text-white focus:ring-2 focus:ring-emerald-500/50 outline-none font-bold uppercase tracking-widest text-xs">
                                </div>
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black text-gray-600 uppercase tracking-[0.4em] ms-4">Insurance Designation</label>
                                    <input type="text" name="insurance_info" value="{{ old('insurance_info', 'Comprehensive Platform Liability') }}" class="w-full bg-gray-950/50 border border-white/5 rounded-2xl p-5 text-white focus:ring-2 focus:ring-emerald-500/50 outline-none font-bold text-xs">
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Secondary Vector: Geospatial & Visuals -->
                    <div class="space-y-12">
                        
                        <!-- Geospatial Deployment Module -->
                        <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 p-12 rounded-[4rem] shadow-2xl relative overflow-hidden group">
                             <div class="absolute -right-4 -top-4 w-32 h-32 bg-amber-500/5 rounded-full blur-3xl group-hover:bg-amber-500/10 transition-all"></div>
                             
                             <h3 class="text-xl font-black text-white mb-10 italic tracking-tighter flex items-center gap-4">
                                <span class="w-1.5 h-8 bg-amber-500 rounded-full shadow-[0_0_15px_rgba(245,158,11,0.5)]"></span>
                                GEOSPATIAL DEPLOYMENT
                             </h3>
                            
                            <div class="space-y-8">
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black text-gray-600 uppercase tracking-[0.4em] ms-4">Base Station (City/Area)</label>
                                    <input type="text" name="location" id="location_input" required value="{{ old('location') }}" class="w-full bg-gray-950/50 border border-white/5 rounded-2xl p-5 text-white focus:ring-2 focus:ring-amber-500/50 outline-none font-bold" placeholder="e.g. Uttara sector 4, Dhaka">
                                </div>

                                <div class="space-y-4">
                                    <label class="text-[10px] font-black text-gray-600 uppercase tracking-[0.4em] ms-4">Tactical Coordination (Drag pin to target)</label>
                                    <div id="map-picker" class="w-full h-[450px] rounded-[3rem] border-4 border-white/5 overflow-hidden z-0 shadow-inner group-hover:border-amber-500/20 transition-all"></div>
                                    <input type="hidden" name="latitude" id="lat_field" value="{{ old('latitude', 23.8103) }}">
                                    <input type="hidden" name="longitude" id="lng_field" value="{{ old('longitude', 90.4125) }}">
                                </div>
                                <div class="flex justify-center gap-6 text-[8px] font-black text-gray-700 uppercase tracking-widest italic opacity-50">
                                     <span>Lat: <span id="lat_display">23.8103</span></span>
                                     <span>Lng: <span id="lng_display">90.4125</span></span>
                                </div>
                            </div>
                        </div>

                        <!-- Visual Asset Seed (Photos) -->
                        <div class="bg-gray-900/40 backdrop-blur-3xl border border-white/5 p-12 rounded-[4rem] shadow-2xl overflow-hidden relative group">
                             <div class="absolute -right-4 -top-4 w-32 h-32 bg-pink-500/5 rounded-full blur-3xl group-hover:bg-pink-500/10 transition-all"></div>
                             
                             <h3 class="text-xl font-black text-white mb-10 italic tracking-tighter flex items-center gap-4">
                                <span class="w-1.5 h-8 bg-pink-500 rounded-full shadow-[0_0_15px_rgba(236,72,153,0.5)]"></span>
                                VISUAL ASSET CAPTURE
                             </h3>
                            
                            <div class="space-y-8 text-center">
                                <div class="relative border-4 border-dashed border-white/5 rounded-[3rem] p-16 hover:border-pink-500/30 transition-all cursor-pointer bg-black/30 group/upload" onclick="document.getElementById('images').click()">
                                    <div class="absolute inset-0 bg-pink-500/5 opacity-0 group-hover/upload:opacity-100 transition-opacity rounded-[3rem]"></div>
                                    <svg class="w-16 h-16 text-gray-800 mx-auto mb-6 scale-90 group-hover/upload:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <p class="text-sm text-gray-400 font-extrabold mb-2 uppercase tracking-tight">Initiate Visual Ingestion</p>
                                    <p class="text-[9px] text-gray-700 font-black uppercase tracking-[0.3em]">Multi-vector capture supported (PNG, JPG)</p>
                                    <input type="file" name="images[]" id="images" multiple class="hidden" accept="image/*" onchange="previewImages(event)">
                                </div>
                                <div id="image-previews" class="grid grid-cols-4 gap-4 px-2"></div>
                            </div>
                        </div>

                        <!-- Final Authorization -->
                        <div class="pt-8 text-center space-y-6">
                            <button type="submit" class="w-full py-6 bg-white text-gray-950 font-black rounded-3xl shadow-[0_0_50px_rgba(255,255,255,0.1)] hover:shadow-emerald-500/20 hover:bg-emerald-500 hover:text-white transition-all uppercase tracking-[0.4em] text-sm animate-bounce-subtle">
                                AUTHORIZE DEPLOYMENT
                            </button>
                            <p class="text-[8px] text-gray-600 font-black uppercase tracking-widest italic opacity-50">By authorizing, you certify that technical specs match physical asset integrity.</p>
                        </div>

                    </div>

                </div>
            </form>

        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Strategic Map Logistics
        const defaultLat = document.getElementById('lat_field').value;
        const defaultLng = document.getElementById('lng_field').value;
        
        const map = L.map('map-picker', {
            center: [defaultLat, defaultLng],
            zoom: 14,
            zoomControl: false,
            className: 'neon-map'
        });

        // Use a dark, premium map tile set if possible, otherwise standard with CSS filters
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        // Apply dark filter to map container via CSS if needed, but here we'll just keep it clean
        const markerIcon = L.divIcon({
            className: 'custom-div-icon',
            html: "<div class='w-8 h-8 bg-amber-500 rounded-full border-4 border-white shadow-2xl animate-pulse'></div>",
            iconSize: [32, 32],
            iconAnchor: [16, 16]
        });

        const marker = L.marker([defaultLat, defaultLng], { 
            draggable: true,
            icon: markerIcon
        }).addTo(map);

        marker.on('dragend', function(e) {
            const pos = marker.getLatLng();
            updateCoords(pos.lat, pos.lng);
        });

        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            updateCoords(e.latlng.lat, e.latlng.lng);
        });

        function updateCoords(lat, lng) {
            document.getElementById('lat_field').value = lat;
            document.getElementById('lng_field').value = lng;
            document.getElementById('lat_display').textContent = parseFloat(lat).toFixed(4);
            document.getElementById('lng_display').textContent = parseFloat(lng).toFixed(4);
        }

        // Logic Visual Ingestion (Image Preview)
        function previewImages(event) {
            const container = document.getElementById('image-previews');
            container.innerHTML = '';
            const files = event.target.files;
            
            for(let i=0; i<files.length; i++) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'aspect-square rounded-2xl overflow-hidden border border-white/10 shadow-lg animate-in zoom-in-50 duration-300';
                    div.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                    container.appendChild(div);
                }
                reader.readAsDataURL(files[i]);
            }
        }
    </script>

    <style>
        @keyframes bounce-subtle {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
        .animate-bounce-subtle { animation: bounce-subtle 4s infinite ease-in-out; }
    </style>
</x-app-layout>