<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-6">
                <div class="w-16 h-16 rounded-[2rem] bg-indigo-600 flex items-center justify-center text-3xl font-black text-white shadow-2xl shadow-indigo-600/50">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <h2 class="font-black text-3xl text-white leading-tight uppercase italic tracking-tighter">
                        {{ $user->name }}
                    </h2>
                    <p class="text-[10px] text-gray-500 font-bold uppercase tracking-[0.3em] mt-1 italic">Identity Hash: #USR-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</p>
                </div>
            </div>
            <div class="flex gap-3">
                 <a href="{{ route('admin.users.edit', $user) }}" class="px-8 py-3 bg-indigo-600 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-indigo-600/20 hover:bg-indigo-500 transition-all">
                    Edit Identity
                 </a>
                 <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf @method('PUT')
                    <input type="hidden" name="is_blocked" value="{{ $user->is_blocked ? '0' : '1' }}">
                    <button type="submit" class="px-8 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all {{ $user->is_blocked ? 'bg-emerald-600 text-white shadow-xl shadow-emerald-600/20' : 'bg-red-600 text-white shadow-xl shadow-red-600/20' }}">
                        {{ $user->is_blocked ? 'Authorize Access' : 'Invoke Restriction' }}
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen text-slate-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <!-- Profile & Stats -->
                <div class="lg:col-span-1 space-y-10">
                    <div class="bg-gray-900/50 backdrop-blur-3xl border border-white/10 p-10 rounded-[3rem] shadow-2xl relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/10 rounded-full blur-3xl"></div>
                        <h4 class="text-xs font-black text-white uppercase tracking-[0.4em] mb-10 italic flex items-center gap-3">
                            <span class="w-1.5 h-4 bg-indigo-500 rounded-full"></span>
                            Core Metadata
                        </h4>
                        
                        <div class="space-y-6">
                            <div>
                                <p class="text-[8px] font-black text-gray-600 uppercase tracking-widest mb-1">Email Address</p>
                                <p class="text-sm font-bold text-white">{{ $user->email }}</p>
                            </div>
                            <div>
                                <p class="text-[8px] font-black text-gray-600 uppercase tracking-widest mb-1">Authorization Level</p>
                                <span class="px-3 py-1 bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-[9px] font-black uppercase tracking-widest rounded-lg">{{ $user->role }}</span>
                            </div>
                            <div>
                                <p class="text-[8px] font-black text-gray-600 uppercase tracking-widest mb-1">Operational Since</p>
                                <p class="text-xs font-bold text-gray-400">{{ $user->created_at->format('M d, Y') }} ({{ $user->created_at->diffForHumans() }})</p>
                            </div>
                             <div>
                                <p class="text-[8px] font-black text-gray-600 uppercase tracking-widest mb-1">Identity Integrity</p>
                                <span class="px-3 py-1 {{ $user->is_blocked ? 'bg-red-500/10 text-red-500 border-red-500/20' : 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' }} text-[9px] font-black uppercase tracking-widest rounded-lg">
                                    {{ $user->is_blocked ? 'BLOCKED' : 'NOMINAL' }}
                                </span>
                            </div>
                        </div>

                         <div class="mt-10 pt-10 border-t border-white/5 grid grid-cols-2 gap-4 text-center">
                            <div class="bg-white/5 p-4 rounded-3xl border border-white/5">
                                <p class="text-[8px] font-black text-gray-600 uppercase tracking-widest mb-1">Assets</p>
                                <p class="text-2xl font-black text-white italic tracking-tighter">{{ $user->cars->count() }}</p>
                            </div>
                            <div class="bg-white/5 p-4 rounded-3xl border border-white/5">
                                <p class="text-[8px] font-black text-gray-600 uppercase tracking-widest mb-1">Missions</p>
                                <p class="text-2xl font-black text-white italic tracking-tighter">{{ $user->bookings->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Verification Evidence -->
                    <div class="bg-gray-900/50 backdrop-blur-3xl border border-white/10 p-10 rounded-[3rem] shadow-2xl">
                         <h4 class="text-xs font-black text-white uppercase tracking-[0.4em] mb-10 italic flex items-center gap-3">
                            <span class="w-1.5 h-4 bg-emerald-500 rounded-full"></span>
                            Verification Artifacts
                        </h4>

                        @if($user->verifications->count() > 0)
                            <div class="space-y-6">
                                @foreach($user->verifications as $v)
                                    <div class="p-6 bg-gray-950 border border-white/5 rounded-[2rem] space-y-4">
                                        <div class="flex justify-between items-center">
                                            <p class="text-[9px] font-black text-white uppercase tracking-widest">NID ARTIFACT</p>
                                            <span class="px-2 py-0.5 {{ $v->status === 'approved' ? 'text-emerald-500' : 'text-amber-500' }} text-[8px] font-black uppercase tracking-widest">{{ $v->status }}</span>
                                        </div>
                                        <div class="aspect-video rounded-xl bg-gray-900 border border-white/10 overflow-hidden">
                                            @if($v->document_path)
                                                <img src="{{ Storage::url($v->document_path) }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-[10px] text-gray-700 font-bold italic">NO IMAGE DATA</div>
                                            @endif
                                        </div>
                                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-tight">Verified At: {{ $v->updated_at->format('M d, Y') }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="py-12 text-center opacity-30 italic text-[10px] font-black tracking-widest uppercase">No verified data captured</div>
                        @endif
                    </div>
                </div>

                <!-- Active Assets & Missions -->
                <div class="lg:col-span-2 space-y-10">
                    
                    <!-- Fleet Assets -->
                    @if($user->role === 'owner')
                    <div class="bg-gray-900/50 backdrop-blur-3xl border border-white/10 rounded-[3rem] shadow-2xl overflow-hidden">
                        <div class="p-10 border-b border-white/5 flex items-center justify-between">
                             <h4 class="text-xs font-black text-white uppercase tracking-[0.4em] italic flex items-center gap-3">
                                <span class="w-1.5 h-4 bg-purple-500 rounded-full"></span>
                                Fleet Ledger
                            </h4>
                            <span class="text-[10px] font-black text-gray-600 uppercase tracking-widest">{{ $user->cars->count() }} Assets Detected</span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <tbody class="divide-y divide-white/5">
                                    @foreach($user->cars as $car)
                                        <tr class="group hover:bg-white/[0.02] transition-colors">
                                            <td class="px-10 py-6">
                                                <div class="flex items-center gap-4">
                                                    <div class="w-16 h-12 bg-gray-800 rounded-xl overflow-hidden border border-white/5 shrink-0">
                                                        @if($car->images->count() > 0)
                                                            <img src="{{ Storage::url($car->images->first()->image_path) }}" class="w-full h-full object-cover">
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <a href="{{ route('admin.cars.show', $car) }}" class="font-bold text-white hover:text-indigo-400 block transition-colors">{{ $car->brand }} {{ $car->model }}</a>
                                                        <div class="text-[9px] text-gray-600 font-bold tracking-widest uppercase">{{ $car->location }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-10 py-6">
                                                <div class="text-sm font-black text-emerald-400 font-mono">৳{{ number_format($car->price_per_day) }}</div>
                                                <div class="text-[8px] font-black text-gray-700 uppercase tracking-[0.2em] mt-1">Daily Fare</div>
                                            </td>
                                            <td class="px-10 py-6 text-right">
                                                <span class="px-3 py-1 bg-white/5 border border-white/10 text-gray-500 text-[8px] font-black uppercase tracking-widest rounded-lg">{{ $car->status }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    <!-- Operation Log (Role-Aware) -->
                    @if($user->role === 'owner' || $user->receivedBookings->count() > 0)
                        <div class="bg-gray-900/50 backdrop-blur-3xl border border-white/10 rounded-[3rem] shadow-2xl overflow-hidden">
                            <div class="p-10 border-b border-white/5 flex items-center justify-between">
                                <h4 class="text-xs font-black text-white uppercase tracking-[0.4em] italic flex items-center gap-3">
                                    <span class="w-1.5 h-4 bg-purple-500 rounded-full"></span>
                                    Fleet Mission Ledger (Received)
                                </h4>
                                <span class="text-[10px] font-black text-gray-600 uppercase tracking-widest">{{ $user->receivedBookings->count() }} Fleet Missions Captured</span>
                            </div>
                            @if($user->receivedBookings->count() > 0)
                                <div class="overflow-x-auto">
                                    <table class="w-full text-left border-collapse">
                                        <tbody class="divide-y divide-white/5">
                                            @foreach($user->receivedBookings->sortByDesc('created_at')->take(10) as $b)
                                                <tr class="group hover:bg-white/[0.02] transition-colors">
                                                    <td class="px-10 py-6">
                                                        <div>
                                                            <a href="{{ route('admin.bookings.show', $b) }}" class="font-bold text-white hover:text-indigo-400 block transition-colors">#FLEET-{{ strtoupper(substr($b->id, 0, 8)) }}</a>
                                                            <div class="text-[9px] text-gray-600 font-bold tracking-widest uppercase mt-1">{{ $b->car->brand }} {{ $b->car->model }}</div>
                                                        </div>
                                                    </td>
                                                    <td class="px-10 py-6">
                                                        <div class="text-[10px] font-bold text-gray-400 italic">
                                                            Renter: {{ $b->customer->name }}
                                                        </div>
                                                        <div class="text-[8px] text-gray-600 mt-1 uppercase tracking-tighter">
                                                            {{ \Carbon\Carbon::parse($b->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($b->end_date)->format('M d, Y') }}
                                                        </div>
                                                    </td>
                                                    <td class="px-10 py-6">
                                                        <div class="text-sm font-black text-white font-mono">৳{{ number_format($b->total_price) }}</div>
                                                    </td>
                                                    <td class="px-10 py-6 text-right">
                                                        <span class="px-3 py-1 bg-purple-500/10 border border-purple-500/20 text-purple-400 text-[8px] font-black uppercase tracking-widest rounded-lg">{{ $b->status }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="py-20 text-center opacity-30 italic text-[10px] font-black tracking-widest uppercase italic font-black">No fleet activity detected in the mission ledger</div>
                            @endif
                        </div>
                    @endif

                    <!-- Deployment Log (Personal) -->
                    <div class="bg-gray-900/50 backdrop-blur-3xl border border-white/10 rounded-[3rem] shadow-2xl overflow-hidden">
                        <div class="p-10 border-b border-white/5 flex items-center justify-between">
                             <h4 class="text-xs font-black text-white uppercase tracking-[0.4em] italic flex items-center gap-3">
                                <span class="w-1.5 h-4 bg-amber-500 rounded-full"></span>
                                Personal Deployment History
                            </h4>
                            <span class="text-[10px] font-black text-gray-600 uppercase tracking-widest">{{ $user->bookings->count() }} Deployments Registered</span>
                        </div>
                        @if($user->bookings->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <tbody class="divide-y divide-white/5">
                                        @foreach($user->bookings->sortByDesc('created_at')->take(10) as $b)
                                            <tr class="group hover:bg-white/[0.02] transition-colors">
                                                <td class="px-10 py-6">
                                                    <div>
                                                        <a href="{{ route('admin.bookings.show', $b) }}" class="font-bold text-white hover:text-indigo-400 block transition-colors">#PERSONAL-{{ strtoupper(substr($b->id, 0, 8)) }}</a>
                                                        <div class="text-[9px] text-gray-600 font-bold tracking-widest uppercase mt-1">{{ $b->car->brand }} {{ $b->car->model }}</div>
                                                    </div>
                                                </td>
                                                <td class="px-10 py-6">
                                                    <div class="text-[10px] font-bold text-gray-400 italic">
                                                        {{ \Carbon\Carbon::parse($b->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($b->end_date)->format('M d, Y') }}
                                                    </div>
                                                </td>
                                                <td class="px-10 py-6">
                                                    <div class="text-sm font-black text-white font-mono">৳{{ number_format($b->total_price) }}</div>
                                                </td>
                                                <td class="px-10 py-6 text-right">
                                                    <span class="px-3 py-1 bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-[8px] font-black uppercase tracking-widest rounded-lg">{{ $b->status }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                             <div class="py-20 text-center opacity-30 italic text-[10px] font-black tracking-widest uppercase italic">No personal deployment data captured</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
