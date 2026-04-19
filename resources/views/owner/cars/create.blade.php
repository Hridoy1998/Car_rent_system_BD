<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-8">
            <div>
                <h2 class="font-black text-4xl text-[#050B1A] tracking-tight uppercase italic leading-[1.1]">
                    Asset <span class="text-orange-500">Assembly</span>
                </h2>
                <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest mt-3 italic leading-none">
                    CRS BD Strategic Fleet Expansion Hub
                </p>
            </div>
            <div class="flex items-center gap-8">
                <a href="{{ route('owner.cars.index') }}" class="text-[10px] font-black text-gray-500 hover:text-[#050B1A] uppercase tracking-widest italic flex items-center gap-3 transition-all group">
                    <svg class="w-5 h-5 group-hover:-translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7 7-7"></path></svg>
                    Abort Protocol
                </a>
            </div>
        </div>
    </x-slot>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <div class="bg-gray-50 min-h-screen relative overflow-hidden pb-24 font-outfit">
        <!-- Institutional Grid Decoration -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#050B1A 1px, transparent 1px); background-size: 40px 40px;"></div>

        <!-- Institutional Hero: Asset Assembly Banner -->
        <div class="relative py-24 md:py-32 mb-12 md:mb-16 -mt-12 overflow-hidden rounded-b-[3rem] md:rounded-b-[5rem] group">
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 group-hover:scale-110" style="background-image: url('{{ asset('images/assets/asset_assembly_banner.png') }}');"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#050B1A] via-[#050B1A]/80 to-transparent"></div>
            
            <div class="relative max-w-7xl mx-auto px-6 lg:px-8">
                <div class="max-w-3xl">
                    <div class="inline-flex items-center gap-3 px-4 py-2 bg-orange-500/10 border border-orange-500/20 rounded-xl mb-6 backdrop-blur-md">
                        <span class="w-1.5 h-1.5 bg-orange-500 rounded-full animate-pulse"></span>
                        <span class="text-[10px] font-black text-orange-500 uppercase tracking-widest italic">New Asset Calibration</span>
                    </div>
                    <h1 class="text-5xl md:text-8xl font-black text-white uppercase tracking-tight italic leading-[1.1] mb-8">
                        Construct <br> <span class="text-orange-500 text-glow-orange">Asset.</span>
                    </h1>
                    <p class="text-gray-300 font-bold text-xs uppercase tracking-widest mt-6 italic opacity-80 leading-relaxed max-w-xl">
                        Synthesize new vehicle profiles into the decentralized fleet ledger. Define yielding parameters and visual artifacts for marketplace propagation.
                    </p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            
            @if ($errors->any())
                <div class="mb-12 bg-white border border-red-100 p-8 rounded-[3rem] shadow-[0_40px_100px_rgba(239,68,68,0.05)] border-l-8 border-l-red-500">
                    <div class="flex items-center gap-6 mb-6">
                        <div class="w-12 h-12 bg-red-50 rounded-2xl flex items-center justify-center text-red-500 shadow-sm border border-red-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-black text-[#050B1A] uppercase italic tracking-tighter leading-none">Assembly Fault Detected</h4>
                            <p class="text-[9px] text-gray-400 font-black uppercase tracking-[0.3em] mt-2 italic">Parameter validation engine blocked deployment</p>
                        </div>
                    </div>
                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-3 ps-4">
                        @foreach ($errors->all() as $error)
                            <li class="text-[10px] font-black text-red-600 uppercase tracking-widest italic flex items-center gap-3">
                                <span class="w-1 h-1 bg-red-500 rounded-full"></span>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('owner.cars.store') }}" method="POST" enctype="multipart/form-data" class="space-y-16">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                    
                    <!-- Left Context: Strategic Modules -->
                    <div class="lg:col-span-2 space-y-12">
                        
                        <!-- Module: Asset Blueprint -->
                        <div class="bg-white border border-gray-100 p-10 md:p-14 rounded-[4rem] shadow-[0_40px_100px_rgba(0,0,0,0.02)] transition-all hover:shadow-2xl group">
                            <div class="flex items-center gap-6 mb-12">
                                <div class="w-16 h-16 bg-[#050B1A] rounded-2xl flex items-center justify-center text-white shadow-xl border border-white/10 italic font-black text-2xl group-hover:scale-110 transition-transform">
                                    BP
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-3xl font-black text-[#050B1A] uppercase italic tracking-tight leading-none group-hover:translate-x-1 transition-transform">Asset Blueprint</h3>
                                    <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest mt-3 italic flex items-center gap-4 leading-none">
                                        Primary Identity Metadata
                                        <span class="h-px flex-1 bg-gray-50"></span>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="space-y-10">
                                <div class="space-y-4">
                                    <label class="text-[11px] font-black text-gray-500 uppercase tracking-widest ms-6 italic leading-none">Market Headline</label>
                                    <input type="text" name="title" required value="{{ old('title') }}" class="w-full bg-gray-100/50 border-2 border-gray-200 rounded-[2rem] p-6 text-[#050B1A] font-black text-sm uppercase tracking-widest focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 focus:bg-white transition-all italic placeholder-gray-400 outline-none" placeholder="e.g. 2024 PORSCHE 911 GT3 RS">
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                    <div class="space-y-4">
                                        <label class="text-[11px] font-black text-gray-500 uppercase tracking-widest ms-6 italic leading-none">Brand Identity</label>
                                        <input type="text" name="brand" required placeholder="Ex: Toyota, BMW..." class="w-full bg-gray-50 border-2 border-gray-200 rounded-[2rem] p-6 text-[#050B1A] font-black text-base uppercase tracking-widest italic focus:bg-white focus:border-orange-500 transition-all outline-none">
                                    </div>
                                    <div class="space-y-4">
                                        <label class="text-[11px] font-black text-gray-500 uppercase tracking-widest ms-6 italic leading-none">Model Prototype</label>
                                        <input type="text" name="model" required placeholder="Ex: Supra, i8..." class="w-full bg-gray-50 border-2 border-gray-200 rounded-[2rem] p-6 text-[#050B1A] font-black text-base uppercase tracking-widest italic focus:bg-white focus:border-orange-500 transition-all outline-none">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                                    <div class="space-y-4">
                                        <label class="text-[11px] font-black text-gray-500 uppercase tracking-widest ms-6 italic leading-none">Registry Year</label>
                                        <input type="number" name="year" required placeholder="YYYY" class="w-full bg-gray-50 border-2 border-gray-200 rounded-[2rem] p-6 text-[#050B1A] font-black text-base italic focus:bg-white focus:border-orange-500 transition-all outline-none">
                                    </div>
                                    <div class="space-y-4 md:col-span-2">
                                        <label class="text-[11px] font-black text-gray-500 uppercase tracking-widest ms-6 italic leading-none">License Serial (Plate)</label>
                                        <input type="text" name="license_plate" required placeholder="Ex: DHAKA-METRO-KA-1234" class="w-full bg-gray-50 border-2 border-gray-200 rounded-[2rem] p-6 text-[#050B1A] font-black text-base uppercase tracking-widest italic focus:bg-white focus:border-orange-500 transition-all outline-none">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                    <div class="space-y-4">
                                        <label class="text-[11px] font-black text-gray-500 uppercase tracking-widest ms-6 italic leading-none">Structural Chassis</label>
                                        <div class="relative group">
                                            <select name="type" required class="w-full bg-gray-100/50 border-2 border-gray-200 rounded-[2rem] p-6 text-[#050B1A] font-black text-[11px] uppercase tracking-[0.2em] focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 focus:bg-white transition-all italic appearance-none cursor-pointer outline-none">
                                                <option value="Sedan">Institutional Sedan</option>
                                                <option value="SUV">Institutional SUV</option>
                                                <option value="Hatchback">Institutional Hatchback</option>
                                                <option value="Van">Institutional Van</option>
                                                <option value="Luxury">Institutional Luxury</option>
                                            </select>
                                            <div class="absolute right-8 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-y-4">
                                        <label class="text-[11px] font-black text-gray-500 uppercase tracking-widest ms-6 italic leading-none">Tactical Coloration</label>
                                        <input type="text" name="color" value="{{ old('color') }}" class="w-full bg-gray-100/50 border-2 border-gray-200 rounded-[2rem] p-6 text-[#050B1A] font-black text-sm uppercase tracking-widest focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 focus:bg-white transition-all italic outline-none" placeholder="e.g. Obsidian Black">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Module: Technical Matrix -->
                        <div class="bg-white border border-gray-100 p-10 md:p-14 rounded-[4rem] shadow-[0_40px_100px_rgba(0,0,0,0.02)] transition-all hover:shadow-2xl group">
                            <div class="flex items-center gap-6 mb-12">
                                <div class="w-16 h-16 bg-orange-500 rounded-2xl flex items-center justify-center text-white shadow-xl border border-white/10 italic font-black text-2xl group-hover:scale-110 transition-transform">
                                    TM
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-3xl font-black text-[#050B1A] uppercase italic tracking-tight leading-none group-hover:translate-x-1 transition-transform">Asset Matrix</h3>
                                    <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest mt-3 italic flex items-center gap-4 leading-none">
                                        Operational Technical Constants
                                        <span class="h-px flex-1 bg-gray-50"></span>
                                    </p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                <div class="space-y-4">
                                    <label class="text-[11px] font-black text-gray-500 uppercase tracking-widest ms-6 italic leading-none">Transmission Protocol</label>
                                    <div class="relative">
                                        <select name="transmission" required class="w-full bg-gray-100/50 border-2 border-gray-200 rounded-[2rem] p-6 text-[#050B1A] font-black text-[11px] uppercase tracking-[0.2em] focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 focus:bg-white transition-all italic appearance-none cursor-pointer outline-none">
                                            <option value="Auto">Automatic Intelligence</option>
                                            <option value="Manual">Manual Control Override</option>
                                        </select>
                                        <div class="absolute right-8 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <label class="text-[11px] font-black text-gray-500 uppercase tracking-widest ms-6 italic leading-none">Fuelsystem Paradigm</label>
                                    <input type="text" name="fuel_type" required value="{{ old('fuel_type') }}" class="w-full bg-gray-100/50 border-2 border-gray-200 rounded-[2rem] p-6 text-[#050B1A] font-black text-sm uppercase tracking-widest focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 focus:bg-white transition-all italic outline-none" placeholder="Octane / Hybrid / EV">
                                </div>
                                <div class="space-y-4">
                                    <label class="text-[11px] font-black text-gray-500 uppercase tracking-widest ms-6 italic leading-none">Displacement Vector</label>
                                    <input type="text" name="engine_capacity" required value="{{ old('engine_capacity') }}" class="w-full bg-gray-100/50 border-2 border-gray-200 rounded-[2rem] p-6 text-[#050B1A] font-black text-sm uppercase tracking-widest focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 focus:bg-white transition-all italic placeholder:text-gray-400 font-outfit outline-none" placeholder="e.g. 1500cc">
                                </div>
                                <div class="space-y-4">
                                    <label class="text-[11px] font-black text-gray-500 uppercase tracking-widest ms-6 italic leading-none">Personnel Capacity</label>
                                    <input type="number" name="seats" required value="{{ old('seats', 5) }}" class="w-full bg-gray-100/50 border-2 border-gray-200 rounded-[2rem] p-6 text-[#050B1A] font-black text-xl tracking-tighter focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 focus:bg-white transition-all italic font-outfit outline-none">
                                </div>
                            </div>
                        </div>

                        <!-- Module: Yield Protocol -->
                        <div class="bg-[#050B1A] p-10 md:p-14 rounded-[4rem] shadow-2xl relative overflow-hidden group border border-white/5">
                            <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/5 rounded-full blur-[100px] group-hover:bg-white/10 transition-all duration-700"></div>
                            
                            <div class="flex items-center gap-6 mb-12 relative z-10">
                                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-[#050B1A] shadow-xl border border-white/10 italic font-black text-2xl group-hover:rotate-12 transition-transform">
                                    YP
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-3xl font-black text-white uppercase italic tracking-tight leading-none">Yield Protocol</h3>
                                    <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest mt-3 italic flex items-center gap-4 leading-none">
                                        Strategic Compensation Parameters
                                        <span class="h-px flex-1 bg-white/5"></span>
                                    </p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 relative z-10">
                                <div class="space-y-4">
                                    <label class="text-[11px] font-black text-gray-500 uppercase tracking-widest ms-6 italic leading-none">Tactical Daily Fare (৳)</label>
                                    <div class="relative group/input">
                                        <span class="absolute left-8 top-1/2 -translate-y-1/2 text-orange-500 font-black text-2xl group-focus-within/input:scale-110 transition-transform">৳</span>
                                        <input type="number" name="price_per_day" required value="{{ old('price_per_day') }}" class="w-full bg-white/5 border-2 border-white/20 rounded-[2.5rem] py-8 ps-16 pe-8 text-white font-black text-4xl tracking-tighter focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500/50 transition-all italic font-outfit outline-none">
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <label class="text-[11px] font-black text-gray-500 uppercase tracking-widest ms-6 italic leading-none">Monthly Portfolio Yield (৳)</label>
                                    <div class="relative group/input">
                                        <span class="absolute left-8 top-1/2 -translate-y-1/2 text-emerald-500 font-black text-2xl group-focus-within/input:scale-110 transition-transform">৳</span>
                                        <input type="number" name="price_per_month" required value="{{ old('price_per_month') }}" class="w-full bg-white/5 border-2 border-white/20 rounded-[2.5rem] py-8 ps-16 pe-8 text-white font-black text-4xl tracking-tighter focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-500/50 transition-all italic font-outfit outline-none">
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mt-10 relative z-10">
                                <div class="space-y-4">
                                    <label class="text-[11px] font-black text-gray-500 uppercase tracking-widest ms-6 italic leading-none">Fuel Strategy Policy</label>
                                    <input type="text" name="fuel_policy" value="{{ old('fuel_policy', 'FULL-TO-FULL') }}" class="w-full bg-white/5 border-2 border-white/20 rounded-[2rem] p-6 text-white font-black text-xs uppercase tracking-widest focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500/50 transition-all italic outline-none">
                                </div>
                                <div class="space-y-4">
                                    <label class="text-[11px] font-black text-gray-500 uppercase tracking-widest ms-6 italic leading-none">Insurance Registry Manifest</label>
                                    <input type="text" name="insurance_info" value="{{ old('insurance_info', 'Comprehensive Platform Liability') }}" class="w-full bg-white/5 border-2 border-white/20 rounded-[2rem] p-6 text-white font-black text-xs uppercase tracking-widest focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500/50 transition-all italic outline-none">
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Right Context: Geospatial & Visuals -->
                    <div class="space-y-12">
                        
                        <!-- Module: Geospatial Deployment -->
                        <div class="bg-white border border-gray-100 p-10 md:p-12 rounded-[4rem] shadow-[0_40px_100px_rgba(0,0,0,0.02)] transition-all hover:shadow-2xl group">
                            <div class="flex items-center gap-6 mb-10">
                                <div class="w-14 h-14 bg-[#050B1A] rounded-2xl flex items-center justify-center text-white shadow-xl border border-white/10 italic font-black text-xl group-hover:rotate-12 transition-transform">
                                    GS
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-2xl font-black text-[#050B1A] uppercase italic tracking-tight leading-none">Geospatial</h3>
                                    <p class="text-[9px] text-gray-400 font-black uppercase tracking-widest mt-2 italic leading-none">Operational Deployment Node</p>
                                </div>
                            </div>
                            
                            <div class="space-y-8">
                                <div class="space-y-4">
                                    <label class="text-[11px] font-black text-gray-500 uppercase tracking-widest ms-6 italic leading-none">Deployment Node (Location)</label>
                                    <input type="text" name="location" required placeholder="Ex: Dhaka, Mirpur..." class="w-full bg-gray-50 border-2 border-gray-200 rounded-[2rem] p-6 text-[#050B1A] font-black text-base uppercase tracking-widest italic focus:bg-white focus:border-orange-500 transition-all outline-none">
                                </div>

                                <div class="space-y-4">
                                    <label class="text-[10px] font-black text-gray-600 uppercase tracking-widest ms-4 italic leading-none">Coordinate Calibration (Target Pin)</label>
                                    <div id="map-picker" class="w-full h-[400px] rounded-[2.5rem] border-4 border-gray-100 overflow-hidden shadow-inner group-hover:border-orange-500/20 transition-all z-0"></div>
                                    <input type="hidden" name="latitude" id="lat_field" value="{{ old('latitude', 23.8103) }}">
                                    <input type="hidden" name="longitude" id="lng_field" value="{{ old('longitude', 90.4125) }}">
                                </div>
                                <div class="flex justify-between items-center px-4">
                                    <div class="flex items-center gap-6">
                                        <div class="hidden md:flex flex-col items-end">
                                            <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic leading-tight">Assembly Node</span>
                                            <span class="text-[10px] font-black text-emerald-500 italic mt-1 leading-none">CALIBRATION READY</span>
                                        </div>
                                    </div>
                                    <div class="h-8 w-px bg-gray-100"></div>
                                    <div class="flex flex-col text-right">
                                        <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest italic">Lng Coordinate</span>
                                        <span id="lng_display" class="text-[10px] font-black text-[#050B1A] italic">90.4125</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Module: Visual Evidence Suite -->
                        <div class="bg-white border-2 border-gray-100 p-10 md:p-12 rounded-[4rem] shadow-[0_45px_110px_rgba(0,0,0,0.03)] transition-all hover:shadow-2xl group overflow-hidden relative">
                            <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-orange-500/5 rounded-full blur-[80px] group-hover:bg-orange-500/10 transition-all duration-700"></div>
                            
                            <div class="flex items-center gap-6 mb-12">
                                <div class="w-16 h-16 bg-[#050B1A] rounded-2xl flex items-center justify-center text-white shadow-xl border border-white/10 italic font-black text-2xl group-hover:rotate-12 transition-transform">
                                    VE
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-3xl font-black text-[#050B1A] uppercase italic tracking-tighter leading-none">Evidence Suite</h3>
                                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-[0.4em] mt-3 italic flex items-center gap-4">
                                        Media Ingestion Terminal
                                        <span class="h-px flex-1 bg-gray-50"></span>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="space-y-10 relative z-10">
                                <div class="relative group/upload cursor-pointer" onclick="document.getElementById('images').click()">
                                    <div class="bg-gray-50/80 border-4 border-dashed border-gray-200 rounded-[3rem] p-16 text-center group-hover/upload:border-orange-500 group-hover/upload:bg-orange-50/20 transition-all duration-700 relative overflow-hidden">
                                        <div class="absolute inset-0 bg-white opacity-0 group-hover/upload:opacity-100 transition-opacity"></div>
                                        <div class="relative z-10 text-center">
                                            <div class="w-20 h-20 bg-orange-500 rounded-[2rem] flex items-center justify-center text-white mx-auto mb-8 shadow-2xl group-hover/upload:scale-110 group-hover/upload:rotate-12 transition-all duration-500">
                                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                                            </div>
                                            <p class="text-base font-black text-[#050B1A] uppercase tracking-tighter italic leading-none mb-4">Ingest Strategic Artifacts</p>
                                            <p class="text-[9px] text-gray-500 font-black uppercase tracking-[0.3em] italic">Multi-Vector Media Capture Supported</p>
                                        </div>
                                    </div>
                                    <input type="file" name="images[]" id="images" multiple class="hidden" accept="image/*" onchange="previewImages(event)">
                                </div>

                                <div id="image-previews" class="grid grid-cols-2 gap-6 px-2"></div>
                            </div>
                        </div>

                        <!-- Strategic Authorization -->
                        <div class="pt-8 space-y-8">
                            <button type="submit" class="w-full py-10 bg-[#050B1A] hover:bg-emerald-500 text-white font-black rounded-[2.5rem] shadow-2xl hover:shadow-emerald-500/20 transition-all group relative overflow-hidden">
                                <span class="relative z-10 uppercase tracking-[0.6em] text-[13px] italic">Authorize Deployment</span>
                                <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-emerald-400 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                            </button>
                            
                            <div class="flex flex-col items-center gap-6">
                                <p class="text-[9px] text-gray-400 font-black uppercase tracking-[0.4em] italic text-center leading-relaxed">
                                    <span class="text-[#050B1A] animate-pulse">NOTE:</span> Deployment status will be set to <span class="text-orange-500">'Pending Audit'</span><br>awaiting administrative verification.
                                </p>
                            </div>
                        </div>

                    </div>

                </div>
            </form>

        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Institutional Map Calibration
        const defaultLat = document.getElementById('lat_field').value;
        const defaultLng = document.getElementById('lng_field').value;
        
        const map = L.map('map-picker', {
            center: [defaultLat, defaultLng],
            zoom: 14,
            zoomControl: false,
            className: 'institutional-map'
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        const institutionalIcon = L.divIcon({
            className: 'custom-pin',
            html: `
                <div class="relative w-12 h-12">
                    <div class="absolute inset-0 bg-orange-500/20 rounded-full animate-ping"></div>
                    <div class="absolute inset-2 bg-orange-500 rounded-full border-4 border-white shadow-2xl flex items-center justify-center">
                        <div class="w-2 h-2 bg-white rounded-full"></div>
                    </div>
                </div>
            `,
            iconSize: [48, 48],
            iconAnchor: [24, 24]
        });

        const marker = L.marker([defaultLat, defaultLng], { 
            draggable: true,
            icon: institutionalIcon 
        }).addTo(map);

        marker.on('dragend', function(e) {
            const pos = marker.getLatLng();
            updateGeospatialArtifacts(pos.lat, pos.lng);
        });

        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            updateGeospatialArtifacts(e.latlng.lat, e.latlng.lng);
        });

        function updateGeospatialArtifacts(lat, lng) {
            document.getElementById('lat_field').value = lat;
            document.getElementById('lng_field').value = lng;
            document.getElementById('lat_display').textContent = parseFloat(lat).toFixed(6);
            document.getElementById('lng_display').textContent = parseFloat(lng).toFixed(6);
        }

        // Logic Visual Ingestion (Image Preview)
        function previewImages(event) {
            const container = document.getElementById('image-previews');
            container.innerHTML = ''; // Clear existing previews for "Create"
            const files = event.target.files;
            
            for(let i=0; i<files.length; i++) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'aspect-video rounded-2xl overflow-hidden border-2 border-orange-500 shadow-xl animate-in zoom-in-50 duration-500 relative group/new';
                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-full object-cover">
                        <div class="absolute top-2 right-2 bg-orange-500 text-white text-[8px] font-black px-3 py-1 rounded-full uppercase tracking-widest italic">New Ingestion</div>
                    `;
                    container.appendChild(div);
                }
                reader.readAsDataURL(files[i]);
            }
        }
    </script>

    <style>
        .institutional-map { filter: grayscale(1) contrast(1.2) brightness(1.05); transition: filter 0.5s ease; }
        .institutional-map:hover { filter: grayscale(0.2) contrast(1); }
        .leaflet-container { font-family: 'Outfit', sans-serif !important; }
        option { font-family: 'Outfit', sans-serif; font-weight: 900; background: #fff; color: #050B1A; }
    </style>
</x-app-layout>