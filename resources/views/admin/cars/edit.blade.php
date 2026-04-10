<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-6">
                <div class="w-16 h-12 rounded-2xl bg-gray-900 border border-white/10 overflow-hidden shadow-2xl">
                    @if($car->images->count() > 0)
                        <img src="{{ Storage::url($car->images->first()->image_path) }}" class="w-full h-full object-cover">
                    @endif
                </div>
                <div>
                    <h2 class="font-black text-3xl text-white leading-tight uppercase italic tracking-tighter">
                        Reconfigure Asset <span class="text-indigo-500">#{{ $car->id }}</span>
                    </h2>
                    <p class="text-[10px] text-gray-500 font-bold uppercase tracking-[0.3em] mt-1 italic">Correcting platform metadata for {{ $car->brand }} {{ $car->model }}</p>
                </div>
            </div>
            <a href="{{ route('admin.cars.show', $car) }}" class="px-8 py-3 bg-white/5 text-gray-400 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-white/10 transition-all border border-white/5">Abort Refactor</a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen text-slate-200">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <form action="{{ route('admin.cars.update', $car) }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                @csrf @method('PUT')
                
                <!-- Tactical Config Grid -->
                <div class="bg-gray-900/50 backdrop-blur-3xl border border-white/10 p-10 rounded-[3.5rem] shadow-2xl space-y-12">
                     <h4 class="text-xs font-black text-white uppercase tracking-[0.4em] italic flex items-center gap-3">
                        <span class="w-1.5 h-4 bg-indigo-500 rounded-full"></span>
                        Asset Calibration Parameters
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <!-- Brand & Model -->
                        <div class="space-y-3">
                            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ms-4 text-indigo-400">Manufacturer</label>
                            <input type="text" name="brand" value="{{ old('brand', $car->brand) }}" required class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white font-bold focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                        </div>
                        <div class="space-y-3">
                            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ms-4 text-indigo-400">Model Variant</label>
                            <input type="text" name="model" value="{{ old('model', $car->model) }}" required class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white font-bold focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                        </div>
                        <div class="space-y-3">
                            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ms-4">Manufacturing Year</label>
                            <input type="number" name="year" value="{{ old('year', $car->year) }}" required class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white font-mono focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                        </div>

                        <!-- Technical Specs -->
                        <div class="space-y-3">
                            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ms-4">Chassis Type (SUV/Sedan)</label>
                            <input type="text" name="type" value="{{ old('type', $car->type) }}" required class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white font-bold focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                        </div>
                        <div class="space-y-3">
                            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ms-4">Propulsion System (Fuel)</label>
                            <input type="text" name="fuel_type" value="{{ old('fuel_type', $car->fuel_type) }}" required class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white font-bold focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                        </div>
                        <div class="space-y-3">
                            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ms-4">Transmission Protocol</label>
                            <select name="transmission" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white font-bold uppercase tracking-widest text-[10px] focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                                <option value="manual" {{ $car->transmission === 'manual' ? 'selected' : '' }}>Manual Transmission</option>
                                <option value="automatic" {{ $car->transmission === 'automatic' ? 'selected' : '' }}>Automatic Transmission</option>
                            </select>
                        </div>

                        <!-- Identity & Physicals -->
                        <div class="space-y-3">
                            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ms-4 text-emerald-500">License Plate</label>
                            <input type="text" name="license_plate" value="{{ old('license_plate', $car->license_plate) }}" required class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white font-mono focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                        </div>
                        <div class="space-y-3">
                            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ms-4">Exterior Color</label>
                            <input type="text" name="color" value="{{ old('color', $car->color) }}" required class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white font-bold focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                        </div>
                        <div class="space-y-3">
                            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ms-4">Occupancy Limits (Seats)</label>
                            <input type="number" name="seats" value="{{ old('seats', $car->seats) }}" required class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white font-mono focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <!-- Pricing Model -->
                        <div class="space-y-3">
                            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ms-4 text-emerald-400">Daily Mission Fare (BDT)</label>
                            <input type="number" name="price_per_day" value="{{ old('price_per_day', $car->price_per_day) }}" required class="w-full bg-gray-950 border border-emerald-500/10 rounded-2xl p-5 text-emerald-400 text-xl font-black focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                        </div>
                        <div class="space-y-3">
                            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ms-4 text-emerald-400">Monthly Mission Fare (BDT)</label>
                            <input type="number" name="price_per_month" value="{{ old('price_per_month', $car->price_per_month) }}" class="w-full bg-gray-950 border border-emerald-500/10 rounded-2xl p-5 text-emerald-400 text-xl font-black focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                         <!-- Operational Metadata -->
                        <div class="space-y-3">
                            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ms-4">Deployment Node (Location)</label>
                            <input type="text" name="location" value="{{ old('location', $car->location) }}" required class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white font-bold focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                        </div>
                        <div class="space-y-3">
                            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ms-4">Asset Status Lifecycle</label>
                            <select name="status" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-indigo-400 font-black uppercase tracking-widest text-[10px] focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                                <option value="pending" {{ $car->status === 'pending' ? 'selected' : '' }}>Pending Maintenance/Audit</option>
                                <option value="approved" {{ $car->status === 'approved' ? 'selected' : '' }}>Approved Active Status</option>
                                <option value="rejected" {{ $car->status === 'rejected' ? 'selected' : '' }}>Rejected Access Mode</option>
                            </select>
                        </div>
                    </div>

                     <!-- Detailed Telemetry -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                         <div class="space-y-3">
                            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ms-4">Engine Capacity / Displacement</label>
                            <input type="text" name="engine_capacity" value="{{ old('engine_capacity', $car->engine_capacity) }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white font-mono focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                        </div>
                         <div class="space-y-3">
                            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ms-4">Standard Fuel Policy</label>
                            <input type="text" name="fuel_policy" value="{{ old('fuel_policy', $car->fuel_policy) }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white font-bold focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ms-4">Comprehensive Insurance Metadata</label>
                        <input type="text" name="insurance_info" value="{{ old('insurance_info', $car->insurance_info) }}" class="w-full bg-gray-950 border border-white/5 rounded-2xl p-4 text-white font-bold focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                    </div>

                    <div class="space-y-3">
                        <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ms-4">Tactical Description Payload</label>
                        <textarea name="description" rows="4" class="w-full bg-gray-950 border border-white/5 rounded-[2rem] p-6 text-white text-sm focus:ring-2 focus:ring-indigo-500 outline-none transition-all italic leading-relaxed">{{ old('description', $car->description) }}</textarea>
                    </div>

                    <!-- Asset Features (JSON Array) -->
                    <div class="space-y-4">
                        <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ms-4">Integrated Feature Modules</label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @php
                                $commonFeatures = ['AC System', 'GPS Navigation', 'Bluetooth Hub', 'Rear Camera', 'Sunroof', 'Leather Interior', 'Keyless Entry', 'Safety Airbags'];
                                $carFeatures = $car->features ?? [];
                            @endphp
                            @foreach($commonFeatures as $feature)
                                <label class="flex items-center gap-3 p-4 bg-gray-950 border border-white/5 rounded-2xl cursor-pointer hover:border-indigo-500/50 transition-all">
                                    <input type="checkbox" name="features[]" value="{{ $feature }}" {{ in_array($feature, $carFeatures) ? 'checked' : '' }} class="rounded border-white/10 bg-gray-900 text-indigo-600 focus:ring-indigo-500">
                                    <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest">{{ $feature }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Visual Evidence Terminal (Photos) -->
                    <div class="pt-12 border-t border-white/5 space-y-8">
                         <h4 class="text-xs font-black text-white uppercase tracking-[0.4em] italic flex items-center gap-3">
                            <span class="w-1.5 h-4 bg-emerald-500 rounded-full"></span>
                            Visual Evidence Terminal
                        </h4>

                        <!-- Current Artifacts -->
                        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                            @foreach($car->images as $image)
                                <div class="relative group/img aspect-video rounded-2xl overflow-hidden border border-white/10 bg-gray-950 shadow-2xl">
                                    <img src="{{ Storage::url($image->image_path) }}" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-red-600/60 flex items-center justify-center opacity-0 group-hover/img:opacity-100 transition-opacity backdrop-blur-[2px]">
                                        <label class="flex flex-col items-center gap-2 cursor-pointer">
                                            <input type="checkbox" name="delete_images[]" value="{{ $image->id }}" class="w-5 h-5 rounded border-white/20 bg-gray-900 text-red-500 focus:ring-red-500">
                                            <span class="text-[8px] font-black text-white uppercase tracking-[0.2em]">Purge Artifact</span>
                                        </label>
                                    </div>
                                    @if($image->is_primary)
                                        <div class="absolute top-2 left-2 px-2 py-1 bg-emerald-600 text-[8px] font-black text-white uppercase tracking-widest rounded-lg shadow-xl">Primary</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <!-- Ingest New Artifacts -->
                        <div class="space-y-4">
                            <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest ms-4">Ingest New Visual Artifacts</label>
                            <div class="relative group">
                                <input type="file" name="images[]" multiple class="block w-full text-xs text-gray-500 font-bold italic file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-emerald-600 file:text-white hover:file:bg-emerald-500 cursor-pointer bg-white/5 p-4 rounded-3xl border border-dashed border-white/20 transition-all hover:border-emerald-500/50">
                            </div>
                            <p class="text-[8px] text-gray-600 uppercase tracking-widest font-bold italic">Support: multi-select JPG, PNG, WEBP artifact ingestion.</p>
                        </div>
                    </div>

                    <div class="pt-10">
                        <button type="submit" class="w-full py-6 bg-indigo-600 hover:bg-indigo-500 text-white font-black text-sm uppercase tracking-[0.4em] rounded-[2rem] shadow-2xl shadow-indigo-600/20 transition-all transform hover:scale-[1.01] active:scale-[0.98]">Commit Asset Refactor</button>
                    </div>
                </div>

                @if($errors->any())
                    <div class="bg-red-500/10 border border-red-500/20 p-8 rounded-[2.5rem] space-y-2">
                        @foreach ($errors->all() as $error)
                            <div class="flex items-center gap-3 text-red-500 text-[10px] font-black uppercase tracking-widest">
                                <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                {{ $error }}
                            </div>
                        @endforeach
                    </div>
                @endif
            </form>

        </div>
    </div>
</x-app-layout>
