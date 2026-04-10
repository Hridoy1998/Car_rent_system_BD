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
                        {{ $car->brand }} {{ $car->model }}
                    </h2>
                    <p class="text-[10px] text-gray-500 font-bold uppercase tracking-[0.3em] mt-1 italic">Asset Hash: #CAR-{{ str_pad($car->id, 5, '0', STR_PAD_LEFT) }} | Location: {{ $car->location }}</p>
                </div>
            </div>
            <div class="flex gap-3">
                 <a href="{{ route('admin.cars.edit', $car) }}" class="px-8 py-3 bg-indigo-600 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-indigo-600/20 hover:bg-indigo-500 transition-all">Edit Profile</a>
                 
                 @if($car->status === 'pending')
                    <form action="{{ route('admin.cars.update', $car) }}" method="POST">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="approved">
                        <button type="submit" class="px-8 py-3 bg-emerald-600 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-emerald-600/20 hover:bg-emerald-500 transition-all">Authorize Asset</button>
                    </form>
                 @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen text-slate-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <!-- Asset Specs & Status -->
                <div class="lg:col-span-1 space-y-10">
                    <div class="bg-gray-900/50 backdrop-blur-3xl border border-white/10 p-10 rounded-[3rem] shadow-2xl relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-purple-500/10 rounded-full blur-3xl"></div>
                        <h4 class="text-xs font-black text-white uppercase tracking-[0.4em] mb-10 italic flex items-center gap-3">
                            <span class="w-1.5 h-4 bg-purple-500 rounded-full"></span>
                            Asset Metadata
                        </h4>
                        
                        <div class="space-y-6 text-sm">
                            <div class="flex justify-between items-center border-b border-white/5 pb-4">
                                <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest">Brand Protocol</span>
                                <span class="font-bold text-white uppercase tracking-tighter">{{ $car->brand }}</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-white/5 pb-4">
                                <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest">Model variant</span>
                                <span class="font-bold text-white uppercase tracking-tighter">{{ $car->model }}</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-white/5 pb-4">
                                <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest">Build Year</span>
                                <span class="font-bold text-white uppercase tracking-tighter text-indigo-400">{{ $car->year }}</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-white/5 pb-4">
                                <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest">Body Class</span>
                                <span class="font-bold text-white uppercase tracking-tighter">{{ $car->car_type }}</span>
                            </div>
                             <div class="flex justify-between items-center border-b border-white/5 pb-4">
                                <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest">Transmission</span>
                                <span class="font-bold text-white uppercase tracking-tighter">{{ $car->transmission }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest">Fuel Node</span>
                                <span class="font-bold text-white uppercase tracking-tighter text-emerald-400">{{ $car->fuel_type }}</span>
                            </div>
                        </div>

                         <div class="mt-10 pt-10 border-t border-white/5 grid grid-cols-2 gap-4 text-center">
                            <div class="bg-white/5 p-4 rounded-3xl border border-white/5">
                                <p class="text-[8px] font-black text-gray-600 uppercase tracking-widest mb-1">Daily Fare</p>
                                <p class="text-xl font-black text-white italic tracking-tighter">৳ {{ number_format($car->price_per_day) }}</p>
                            </div>
                            <div class="bg-white/5 p-4 rounded-3xl border border-white/5">
                                <p class="text-[8px] font-black text-gray-600 uppercase tracking-widest mb-1">Status</p>
                                <p class="text-[9px] font-black text-emerald-400 uppercase tracking-widest">{{ $car->status }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Registrar (Owner) -->
                    <div class="bg-gray-900/50 backdrop-blur-3xl border border-white/10 p-10 rounded-[3rem] shadow-2xl">
                         <h4 class="text-xs font-black text-white uppercase tracking-[0.4em] mb-10 italic flex items-center gap-3">
                            <span class="w-1.5 h-4 bg-indigo-500 rounded-full"></span>
                            Asset Registrar
                        </h4>

                        <a href="{{ route('admin.users.show', $car->owner) }}" class="flex items-center gap-6 group">
                            <div class="w-14 h-14 rounded-2xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-xl font-black text-indigo-400 group-hover:bg-indigo-600 group-hover:text-white transition-all shadow-xl">
                                {{ substr($car->owner->name, 0, 1) }}
                            </div>
                            <div>
                                <h5 class="text-sm font-black text-white uppercase tracking-tight group-hover:text-indigo-400 transition-colors">{{ $car->owner->name }}</h5>
                                <p class="text-[9px] text-gray-500 font-bold uppercase tracking-widest mt-1">Fleet Host Active</p>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Asset Images & History -->
                <div class="lg:col-span-2 space-y-10">
                    
                    <!-- Visual Gallery -->
                    <div class="bg-gray-900/50 backdrop-blur-3xl border border-white/10 p-10 rounded-[3.5rem] shadow-2xl overflow-hidden">
                        <h4 class="text-xs font-black text-white uppercase tracking-[0.4em] mb-8 italic flex items-center gap-3">
                            <span class="p-1 bg-white rounded-md"></span>
                            Physical Artifact Gallery
                        </h4>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                            @foreach($car->images as $img)
                                <div class="aspect-[4/3] rounded-3xl border border-white/5 overflow-hidden group/img relative shadow-xl">
                                    <img src="{{ Storage::url($img->image_path) }}" class="w-full h-full object-cover group-hover/img:scale-110 transition-transform duration-700">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Asset Deployments (Bookings) -->
                    <div class="bg-gray-900/50 backdrop-blur-3xl border border-white/10 rounded-[3.5rem] shadow-2xl overflow-hidden">
                        <div class="p-10 border-b border-white/5 flex items-center justify-between">
                             <h4 class="text-xs font-black text-white uppercase tracking-[0.4em] italic flex items-center gap-3">
                                <span class="w-1.5 h-4 bg-amber-500 rounded-full"></span>
                                Deployment Audit Log
                            </h4>
                            <span class="text-[10px] font-black text-gray-600 uppercase tracking-widest">{{ $car->bookings->count() }} Deployments Found</span>
                        </div>
                        @if($car->bookings->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <tbody class="divide-y divide-white/5">
                                        @foreach($car->bookings->take(10) as $b)
                                            <tr class="group hover:bg-white/[0.02] transition-colors">
                                                <td class="px-10 py-8">
                                                    <div class="flex items-center gap-4">
                                                        <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center text-[10px] font-black text-white uppercase italic">
                                                            {{ substr($b->customer->name, 0, 1) }}
                                                        </div>
                                                        <div>
                                                            <a href="{{ route('admin.bookings.show', $b) }}" class="font-bold text-white hover:text-indigo-400 block transition-colors">#MISSION-{{ strtoupper(substr($b->id, 0, 8)) }}</a>
                                                            <p class="text-[8px] text-gray-500 font-bold uppercase tracking-widest">Operator: {{ $b->customer->name }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-10 py-8">
                                                    <div class="text-[10px] font-bold text-indigo-400 font-mono">
                                                        {{ \Carbon\Carbon::parse($b->start_date)->format('M d') }} >> {{ \Carbon\Carbon::parse($b->end_date)->format('M d, Y') }}
                                                    </div>
                                                </td>
                                                <td class="px-10 py-8">
                                                    <span class="px-3 py-1 bg-white/5 border border-white/10 text-gray-500 text-[8px] font-black uppercase tracking-widest rounded-lg">{{ $b->status }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                             <div class="py-20 text-center opacity-30 italic text-[10px] font-black tracking-widest uppercase italic font-black">Fleet asset has no active deployment history</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
