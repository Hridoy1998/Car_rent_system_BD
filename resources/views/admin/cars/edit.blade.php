<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-center justify-between gap-8 px-4 sm:px-0">
            <div class="flex items-center gap-8">
                <div class="w-20 h-16 rounded-[1.5rem] bg-gray-950 border-4 border-white shadow-2xl overflow-hidden shrink-0">
                    @if($car->images->count() > 0)
                        <img src="{{ $car->primary_image_url }}" class="w-full h-full object-cover">
                    @endif
                </div>
                <div>
                    <h2 class="font-black text-4xl text-[#050B1A] tracking-tighter uppercase italic leading-none">
                        Asset <span class="text-indigo-500">Calibration</span>
                    </h2>
                    <div class="flex items-center gap-4 mt-3">
                        <span class="w-8 h-px bg-indigo-500/30"></span>
                        <p class="text-[9px] text-gray-400 font-black uppercase tracking-[0.4em] italic">
                            RECONFIGURING ARTIFACT #{{ $car->id }} | {{ $car->brand }} {{ $car->model }}
                        </p>
                    </div>
                </div>
            </div>
            
            <a href="{{ route('admin.cars.show', $car) }}" class="px-8 py-3 bg-white border-2 border-gray-100 text-gray-400 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:border-red-500 hover:text-red-500 transition-all italic active:scale-95 leading-none">Abort Refactor</a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen relative overflow-hidden">
        <!-- Institutional Decoration -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#050B1A 1px, transparent 1px); background-size: 50px 50px;"></div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            
            <form action="{{ route('admin.cars.update', $car) }}" method="POST" enctype="multipart/form-data" class="space-y-12">
                @csrf @method('PUT')
                
                <!-- Main Calibration Monolith -->
                <div class="bg-white border-2 border-gray-100 p-10 md:p-16 rounded-[3.5rem] md:rounded-[4.5rem] shadow-[0_45px_100px_rgba(0,0,0,0.02)] space-y-16">
                     <h4 class="text-xs font-black text-[#050B1A] uppercase tracking-[0.4em] italic flex items-center gap-3">
                        <span class="w-2 h-6 bg-indigo-500 rounded-full"></span>
                        Parameter Calibration Grid
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                        <!-- Primary Identity -->
                        <div class="space-y-4">
                            <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic ms-4">Manufacturer Registry</label>
                            <input type="text" name="brand" value="{{ old('brand', $car->brand) }}" required class="w-full bg-gray-50/50 border-2 border-gray-100 rounded-2xl p-5 text-[#050B1A] font-black uppercase tracking-tight focus:ring-8 focus:ring-indigo-500/5 focus:border-indigo-500 outline-none transition-all italic">
                        </div>
                        <div class="space-y-4">
                            <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic ms-4">Model Variant</label>
                            <input type="text" name="model" value="{{ old('model', $car->model) }}" required class="w-full bg-gray-50/50 border-2 border-gray-100 rounded-2xl p-5 text-[#050B1A] font-black uppercase tracking-tight focus:ring-8 focus:ring-indigo-500/5 focus:border-indigo-500 outline-none transition-all italic">
                        </div>
                        <div class="space-y-4">
                            <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic ms-4">Build Epoch (Year)</label>
                            <input type="number" name="year" value="{{ old('year', $car->year) }}" required class="w-full bg-gray-50/50 border-2 border-gray-100 rounded-2xl p-5 text-[#050B1A] font-black focus:ring-8 focus:ring-indigo-500/5 focus:border-indigo-500 outline-none transition-all italic">
                        </div>

                        <!-- Technical Matrix -->
                        <div class="space-y-4">
                            <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic ms-4">Chassis Spec (SUV/Sedan)</label>
                            <input type="text" name="type" value="{{ old('type', $car->car_type) }}" required class="w-full bg-gray-50/50 border-2 border-gray-100 rounded-2xl p-5 text-[#050B1A] font-black uppercase tracking-tight focus:ring-8 focus:ring-indigo-500/5 focus:border-indigo-500 outline-none transition-all italic">
                        </div>
                        <div class="space-y-4">
                            <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic ms-4">Propulsion System</label>
                            <input type="text" name="fuel_type" value="{{ old('fuel_type', $car->fuel_type) }}" required class="w-full bg-gray-50/50 border-2 border-gray-100 rounded-2xl p-5 text-[#050B1A] font-black uppercase tracking-tight focus:ring-8 focus:ring-indigo-500/5 focus:border-indigo-500 outline-none transition-all italic">
                        </div>
                        <div class="space-y-4">
                            <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic ms-4">Transmission Protocol</label>
                            <select name="transmission" class="w-full bg-gray-50/50 border-2 border-gray-100 rounded-2xl p-5 text-[#050B1A] font-black uppercase tracking-widest text-[10px] focus:ring-8 focus:ring-indigo-500/5 focus:border-indigo-500 outline-none transition-all italic appearance-none">
                                <option value="manual" {{ $car->transmission === 'manual' ? 'selected' : '' }}>Manual Protocol</option>
                                <option value="automatic" {{ $car->transmission === 'automatic' ? 'selected' : '' }}>Automatic Protocol</option>
                            </select>
                        </div>

                        <!-- Physical Attributes -->
                        <div class="space-y-4">
                            <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic ms-4">License Artifact ID</label>
                            <input type="text" name="license_plate" value="{{ old('license_plate', $car->license_plate) }}" required class="w-full bg-gray-50/50 border-2 border-gray-100 rounded-2xl p-5 text-emerald-600 font-black focus:ring-8 focus:ring-emerald-500/5 focus:border-emerald-500 outline-none transition-all italic">
                        </div>
                        <div class="space-y-4">
                            <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic ms-4">Optical Signature (Color)</label>
                            <input type="text" name="color" value="{{ old('color', $car->color) }}" required class="w-full bg-gray-50/50 border-2 border-gray-100 rounded-2xl p-5 text-[#050B1A] font-black uppercase tracking-tight focus:ring-8 focus:ring-indigo-500/5 focus:border-indigo-500 outline-none transition-all italic">
                        </div>
                        <div class="space-y-4">
                            <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic ms-4">Occupancy Capacity</label>
                            <input type="number" name="seats" value="{{ old('seats', $car->seats) }}" required class="w-full bg-gray-50/50 border-2 border-gray-100 rounded-2xl p-5 text-[#050B1A] font-black focus:ring-8 focus:ring-indigo-500/5 focus:border-indigo-500 outline-none transition-all italic">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <!-- Revenue Logic Modification -->
                        <div class="bg-gray-50/50 p-10 rounded-[2.5rem] border-2 border-white shadow-inner space-y-8">
                            <h5 class="text-[10px] font-black text-[#050B1A] uppercase tracking-widest italic flex items-center gap-3">
                                <span class="w-1.5 h-4 bg-emerald-500 rounded-full"></span>
                                Revenue Logic
                            </h5>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                                <div class="space-y-3">
                                    <label class="text-[8px] font-black text-gray-400 uppercase tracking-widest italic">Daily Mission (BDT)</label>
                                    <input type="number" name="price_per_day" value="{{ old('price_per_day', $car->price_per_day) }}" required class="w-full bg-white border-2 border-gray-100 rounded-xl p-4 text-[#050B1A] text-xl font-black focus:border-emerald-500 outline-none transition-all italic">
                                </div>
                                <div class="space-y-3">
                                    <label class="text-[8px] font-black text-gray-400 uppercase tracking-widest italic">Monthly Mission (BDT)</label>
                                    <input type="number" name="price_per_month" value="{{ old('price_per_month', $car->price_per_month) }}" class="w-full bg-white border-2 border-gray-100 rounded-xl p-4 text-[#050B1A] text-xl font-black focus:border-emerald-500 outline-none transition-all italic">
                                </div>
                            </div>
                        </div>

                        <!-- Operational Status Lifecycle -->
                        <div class="bg-gray-50/50 p-10 rounded-[2.5rem] border-2 border-white shadow-inner space-y-8">
                             <h5 class="text-[10px] font-black text-[#050B1A] uppercase tracking-widest italic flex items-center gap-3">
                                <span class="w-1.5 h-4 bg-indigo-500 rounded-full"></span>
                                Lifecycle Status
                            </h5>
                            <div class="space-y-4">
                                <label class="text-[8px] font-black text-gray-400 uppercase tracking-widest italic">Admin Authorization State</label>
                                <select name="status" class="w-full bg-white border-2 border-gray-100 rounded-xl p-5 text-indigo-600 font-black uppercase tracking-widest text-[10px] focus:border-indigo-500 outline-none transition-all italic appearance-none cursor-pointer">
                                    <option value="pending" {{ $car->status === 'pending' ? 'selected' : '' }}>Pending Audit / Review</option>
                                    <option value="approved" {{ $car->status === 'approved' ? 'selected' : '' }}>Institutional Approval State</option>
                                    <option value="rejected" {{ $car->status === 'rejected' ? 'selected' : '' }}>Rejected Artifact Mode</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic ms-4">Tactical Asset Description</label>
                        <textarea name="description" rows="5" class="w-full bg-gray-50/50 border-2 border-gray-100 rounded-[2.5rem] p-8 text-[#050B1A] text-sm font-bold focus:ring-8 focus:ring-indigo-500/5 focus:border-indigo-500 outline-none transition-all italic leading-relaxed">{{ old('description', $car->description) }}</textarea>
                    </div>

                    <!-- Visual Artifact Management -->
                    <div class="pt-16 border-t-2 border-gray-50 space-y-12">
                         <h4 class="text-xs font-black text-[#050B1A] uppercase tracking-[0.4em] italic flex items-center gap-3">
                            <span class="w-2 h-6 bg-emerald-500 rounded-full"></span>
                            Visual Artifact Management
                        </h4>

                        <!-- Current Intelligence Artifacts -->
                        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8">
                            @foreach($car->images as $image)
                                <div class="relative group/img aspect-video rounded-3xl overflow-hidden border-4 border-white bg-gray-50 shadow-xl group hover:shadow-2xl transition-all duration-500">
                                    <img src="{{ Storage::url($image->image_path) }}" class="w-full h-full object-cover transition-all duration-700">
                                    <div class="absolute inset-0 bg-red-600/80 flex items-center justify-center opacity-0 group-hover/img:opacity-100 transition-opacity backdrop-blur-sm">
                                        <label class="flex flex-col items-center gap-3 cursor-pointer p-4">
                                            <input type="checkbox" name="delete_images[]" value="{{ $image->id }}" class="w-6 h-6 rounded-lg border-2 border-white/20 bg-[#050B1A]/20 text-white focus:ring-white">
                                            <span class="text-[9px] font-black text-white uppercase tracking-[0.2em] italic">Purge Artifact</span>
                                        </label>
                                    </div>
                                    @if($image->is_primary)
                                        <div class="absolute top-3 left-3 px-3 py-1.5 bg-emerald-500 text-[8px] font-black text-white uppercase tracking-widest rounded-xl shadow-lg italic">Primary</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <!-- Artifact Ingestion Terminal -->
                        <div class="bg-gray-50/50 p-10 rounded-[3rem] border-2 border-white shadow-inner space-y-6 text-center">
                            <label class="text-[10px] font-black text-[#050B1A] uppercase tracking-widest italic block">Ingest New Visual Artifacts</label>
                            <div class="relative flex flex-col items-center justify-center p-12 border-4 border-dashed border-gray-100 rounded-[2.5rem] bg-white group hover:border-indigo-500/50 transition-all cursor-pointer overflow-hidden">
                                <input type="file" name="images[]" multiple class="absolute inset-0 opacity-0 cursor-pointer">
                                <div class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center text-gray-300 group-hover:bg-indigo-500 group-hover:text-white transition-all shadow-sm mb-4 italic font-black text-2xl">+</div>
                                <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest italic group-hover:text-indigo-600 transition-colors">Select Archive Files (JPG, PNG, WEBP)</p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-8 text-center">
                        <button type="submit" class="w-full md:w-auto px-16 py-6 bg-[#050B1A] hover:bg-indigo-600 text-white font-black text-xs uppercase tracking-[0.5em] rounded-[2rem] shadow-2xl shadow-[#050B1A]/20 transition-all transform hover:scale-[1.02] active:scale-[0.98] italic">Commit Asset Refactor</button>
                    </div>
                </div>

                @if($errors->any())
                    <div class="bg-red-50 border-2 border-red-100 p-10 rounded-[3rem] shadow-xl shadow-red-500/5 flex flex-col items-center gap-6">
                        <div class="w-12 h-12 bg-red-500 rounded-2xl flex items-center justify-center text-white font-black italic shadow-lg">!</div>
                        <div class="space-y-4 text-center">
                            @foreach ($errors->all() as $error)
                                <div class="text-red-600 text-[10px] font-black uppercase tracking-widest italic">{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </form>

        </div>
    </div>
</x-app-layout>
