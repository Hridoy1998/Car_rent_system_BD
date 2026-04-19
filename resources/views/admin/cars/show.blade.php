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
                        {{ $car->brand }} <span class="text-indigo-500">{{ $car->model }}</span>
                    </h2>
                    <div class="flex items-center gap-4 mt-3">
                        <span class="w-8 h-px bg-indigo-500/30"></span>
                        <p class="text-[9px] text-gray-400 font-black uppercase tracking-[0.4em] italic">
                            Asset Brief #{{ str_pad($car->id, 5, '0', STR_PAD_LEFT) }} | {{ $car->location }}
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.cars.edit', $car) }}" class="px-8 py-3 bg-white border-2 border-gray-100 text-[#050B1A] rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-gray-200/50 hover:bg-indigo-600 hover:text-white hover:border-indigo-600 transition-all italic active:scale-95 leading-none">Edit Calibration</a>
                
                @if($car->status === 'pending')
                    <div class="flex items-center gap-3">
                        <form action="{{ route('admin.cars.update', $car) }}" method="POST">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="px-6 py-3 bg-white border-2 border-red-100 text-red-600 text-[10px] font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-red-600 hover:text-white transition-all shadow-lg shadow-red-500/5 italic active:scale-95 leading-none">Decline</button>
                        </form>
                        <form action="{{ route('admin.cars.update', $car) }}" method="POST">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="approved">
                            <button type="submit" class="px-8 py-3 bg-[#050B1A] text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-emerald-500 transition-all shadow-xl shadow-[#050B1A]/20 italic active:scale-95 leading-none">Authorize</button>
                        </form>
                    </div>
                @else
                    <span class="px-6 py-2.5 bg-gray-100 text-gray-500 text-[10px] font-black uppercase tracking-[0.3em] rounded-xl border-2 border-gray-100 italic shadow-inner">{{ $car->status }}</span>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen relative overflow-hidden">
        <!-- Institutional Decoration -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#050B1A 1px, transparent 1px); background-size: 50px 50px;"></div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12 relative z-10">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <!-- Asset Intelligence Monolith (Sidebar) -->
                <div class="lg:col-span-1 space-y-10">
                    <div class="bg-white border-2 border-gray-100 p-10 rounded-[3.5rem] shadow-[0_45px_100px_rgba(0,0,0,0.02)] relative overflow-hidden">
                        <div class="absolute -right-4 -top-4 w-32 h-32 bg-blue-50 rounded-full blur-3xl"></div>
                        <h4 class="text-xs font-black text-[#050B1A] uppercase tracking-[0.4em] mb-12 italic flex items-center gap-3">
                            <span class="w-2 h-6 bg-indigo-500 rounded-full"></span>
                            Asset Metadata
                        </h4>
                        
                        <div class="space-y-6 text-sm">
                            <div class="flex justify-between items-center border-b border-gray-50 pb-6">
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic">Registry Brand</span>
                                <span class="font-black text-[#050B1A] uppercase tracking-tighter italic">{{ $car->brand }}</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-gray-50 pb-6">
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic">Model Variant</span>
                                <span class="font-black text-[#050B1A] uppercase tracking-tighter italic">{{ $car->model }}</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-gray-50 pb-6">
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic">Build Epoch</span>
                                <span class="font-black text-indigo-600 uppercase tracking-tighter italic">{{ $car->year }}</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-gray-50 pb-6">
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic">Body Class</span>
                                <span class="font-black text-[#050B1A] uppercase tracking-tighter italic">{{ $car->car_type }}</span>
                            </div>
                             <div class="flex justify-between items-center border-b border-gray-50 pb-6">
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic">Transmission</span>
                                <span class="font-black text-[#050B1A] uppercase tracking-tighter italic">{{ $car->transmission }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic">Fuel Node</span>
                                <span class="font-black text-emerald-600 uppercase tracking-tighter italic">{{ $car->fuel_type }}</span>
                            </div>
                        </div>

                         <div class="mt-12 pt-12 border-t border-gray-50 grid grid-cols-2 gap-6 text-center">
                            <div class="bg-gray-50/50 p-6 rounded-[2rem] border-2 border-white shadow-sm">
                                <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1 italic">Daily Rate</p>
                                <p class="text-2xl font-black text-[#050B1A] italic tracking-tighter">৳{{ number_format($car->price_per_day) }}</p>
                            </div>
                            <div class="bg-gray-50/50 p-6 rounded-[2rem] border-2 border-white shadow-sm">
                                <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1 italic">Status</p>
                                <p class="text-[10px] font-black text-indigo-500 uppercase tracking-widest italic">{{ $car->status }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Registrar Intelligence -->
                    <div class="bg-white border-2 border-gray-100 p-10 rounded-[3.5rem] shadow-[0_45px_100px_rgba(0,0,0,0.02)] group hover:shadow-2xl transition-all duration-500">
                         <h4 class="text-xs font-black text-[#050B1A] uppercase tracking-[0.4em] mb-10 italic flex items-center gap-3">
                            <span class="w-1.5 h-6 bg-emerald-500 rounded-full"></span>
                            Asset Registrar
                        </h4>

                        <a href="{{ route('admin.users.show', $car->owner) }}" class="flex items-center gap-6">
                            <div class="w-16 h-16 rounded-2xl bg-gray-50 border-2 border-white flex items-center justify-center text-xl font-black text-[#050B1A] group-hover:bg-[#050B1A] group-hover:text-white transition-all shadow-inner italic">
                                {{ substr($car->owner->name, 0, 1) }}
                            </div>
                            <div>
                                <h5 class="text-sm font-black text-[#050B1A] uppercase tracking-tight group-hover:text-indigo-600 transition-colors italic">{{ $car->owner->name }}</h5>
                                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-1 italic">Fleet Host Verified</p>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Visual Intelligence & Audit Manifest (Main Content) -->
                <div class="lg:col-span-2 space-y-10">
                    
                    <!-- Visual Artifact Gallery -->
                    <div class="bg-white border-2 border-gray-100 p-10 rounded-[3.5rem] md:rounded-[4.5rem] shadow-[0_45px_100px_rgba(0,0,0,0.02)] overflow-hidden">
                        <div class="flex items-center justify-between mb-10">
                            <h4 class="text-xs font-black text-[#050B1A] uppercase tracking-[0.4em] italic flex items-center gap-3">
                                <span class="w-5 h-5 bg-[#050B1A] rounded-md text-white flex items-center justify-center text-[10px]">G</span>
                                Physical Artifacts
                            </h4>
                            <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic">{{ $car->images->count() }} Files Captured</span>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                            @foreach($car->images as $img)
                                <div class="aspect-[4/3] rounded-[2rem] border-4 border-gray-50 overflow-hidden group/img relative shadow-xl bg-gray-100">
                                    <img src="{{ Storage::url($img->image_path) }}" class="w-full h-full object-cover group-hover/img:scale-110 transition-transform duration-700">
                                    <div class="absolute inset-0 bg-indigo-500/10 opacity-0 group-hover/img:opacity-100 transition-opacity pointer-events-none"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Deployment Audit Manifest -->
                    <div class="bg-white border-2 border-gray-100 rounded-[3.5rem] md:rounded-[4.5rem] shadow-[0_45px_100px_rgba(0,0,0,0.02)] overflow-hidden">
                        <div class="p-10 border-b border-gray-50 flex flex-col md:flex-row items-center justify-between gap-6">
                             <div class="flex items-center gap-6">
                                <div class="w-14 h-14 bg-[#050B1A] rounded-2xl flex items-center justify-center text-white italic font-black text-xl shadow-2xl">DL</div>
                                <div>
                                    <h4 class="text-2xl font-black text-[#050B1A] uppercase italic tracking-tight leading-none">Deployment Log</h4>
                                    <p class="text-[9px] text-gray-400 font-black uppercase tracking-widest mt-2 italic">Institutional Lifecycle Audit</p>
                                </div>
                             </div>
                            <span class="px-5 py-2 bg-gray-50 rounded-xl text-[10px] font-black text-gray-500 uppercase tracking-widest italic border-2 border-white">{{ $car->bookings->count() }} OPERATIONS</span>
                        </div>
                        @if($car->bookings->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="bg-gray-50/50 text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] italic">
                                            <th class="px-10 py-6">Mission ID</th>
                                            <th class="px-10 py-6">Operation Window</th>
                                            <th class="px-10 py-6 text-right">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-50">
                                        @foreach($car->bookings->take(10) as $b)
                                            <tr class="group hover:bg-gray-50/50 transition-colors cursor-pointer" onclick="window.location='{{ route('admin.bookings.show', $b) }}'">
                                                <td class="px-10 py-8">
                                                    <div class="flex items-center gap-6">
                                                        <div class="w-11 h-11 rounded-xl bg-gray-50 border-2 border-white flex items-center justify-center text-xs font-black text-[#050B1A] group-hover:bg-[#050B1A] group-hover:text-white transition-all shadow-sm italic">
                                                            {{ substr($b->customer->name, 0, 1) }}
                                                        </div>
                                                        <div>
                                                            <div class="text-[11px] font-black text-[#050B1A] uppercase tracking-tighter italic">#OP-{{ str_pad($b->id, 5, '0', STR_PAD_LEFT) }}</div>
                                                            <p class="text-[8px] text-gray-400 font-black uppercase tracking-widest mt-1 italic">Operator: {{ $b->customer->name }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-10 py-8">
                                                    <div class="text-[11px] font-black text-[#050B1A] uppercase tracking-tighter italic">
                                                        {{ \Carbon\Carbon::parse($b->start_date)->format('d M') }} 
                                                        <span class="text-gray-300 mx-2">→</span> 
                                                        {{ \Carbon\Carbon::parse($b->end_date)->format('d M, Y') }}
                                                    </div>
                                                    <div class="text-[7px] text-gray-400 font-black uppercase mt-1 tracking-widest italic">Temporal Registry OK</div>
                                                </td>
                                                <td class="px-10 py-8 text-right">
                                                    <span class="px-4 py-1.5 bg-gray-50 border-2 border-white text-gray-500 text-[9px] font-black uppercase tracking-widest rounded-xl italic shadow-sm group-hover:bg-[#050B1A] group-hover:text-white transition-all">{{ $b->status }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                             <div class="py-32 text-center text-gray-200 text-[10px] font-black uppercase tracking-[0.6em] italic leading-relaxed">No Institutional Deployment History Recorded</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
