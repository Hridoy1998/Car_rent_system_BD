<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
            <div>
                <h2 class="font-black text-2xl leading-tight text-white uppercase italic tracking-tighter">
                    {{ __('Bookings & Revenue') }}
                </h2>
                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-[0.2em] mt-1">Manage your car rentals and track your earnings</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen text-slate-200 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-purple-600/5 rounded-full blur-[120px] -z-10"></div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            @if(session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 p-6 rounded-3xl text-emerald-400 text-xs font-black uppercase tracking-widest flex items-center gap-4 mb-8">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-500/10 border border-red-500/20 p-6 rounded-3xl text-red-500 text-xs font-black uppercase tracking-widest flex flex-col gap-3 mb-8">
                    @foreach($errors->all() as $error)
                        <div class="flex items-center gap-4">
                            <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                            {{ $error }}
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Search Bookings -->
            <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 p-6 rounded-[2rem] shadow-2xl flex flex-col md:flex-row gap-6 items-center justify-between">
                <div class="w-full md:flex-1">
                    <x-search-bar :route="route('owner.bookings.index')" placeholder="Search by user, car, or ID..." />
                </div>
                <div class="flex items-center gap-4 shrink-0">
                     <span class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Total Bookings: {{ $bookings->total() }}</span>
                </div>
            </div>

            <div class="bg-gray-900/50 border border-white/10 overflow-hidden shadow-2xl rounded-[2.5rem]">
                @if($bookings->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-white/5 text-[9px] font-black uppercase tracking-[0.3em] text-gray-600">
                                    <th class="py-6 pl-8">Asset & Logistics</th>
                                    <th class="py-6">Operator</th>
                                    <th class="py-6">Timeframe</th>
                                    <th class="py-6">Revenue Data</th>
                                    <th class="py-6">Mission Status</th>
                                    <th class="py-6 text-right pr-8">Tactical Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @foreach($bookings as $booking)
                                    <tr class="group hover:bg-white/[0.03] transition-all duration-300">
                                        <td class="py-5 pl-8">
                                            <div class="flex items-center gap-4">
                                                <div class="w-14 h-10 rounded-xl bg-gray-800 border border-white/10 overflow-hidden shrink-0 shadow-lg relative">
                                                    @if($booking->car->images->count() > 0)
                                                        <img src="{{ Storage::url($booking->car->images->first()->image_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                                    @endif
                                                </div>
                                                <div class="max-w-[150px]">
                                                    <a href="{{ route('cars.show', $booking->car) }}" class="text-xs font-black text-white hover:text-indigo-400 transition-colors block truncate italic">{{ $booking->car->brand }} {{ $booking->car->model }}</a>
                                                    <div class="text-[8px] text-gray-600 font-black uppercase tracking-[0.1em] mt-0.5 truncate">{{ $booking->car->location }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-5">
                                            <a href="{{ route('profiles.show', $booking->customer) }}" class="group/renter flex items-center gap-3 w-fit">
                                                <div class="w-9 h-9 rounded-xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-[11px] font-black text-indigo-400 group-hover/renter:bg-indigo-600 group-hover/renter:text-white transition-all">
                                                    {{ substr($booking->customer->name, 0, 1) }}
                                                </div>
                                                <div class="hidden sm:block">
                                                    <div class="text-[11px] font-black text-gray-300 group-hover/renter:text-white transition-colors">{{ $booking->customer->name }}</div>
                                                    <div class="text-[7px] text-gray-600 font-bold uppercase tracking-tighter">Verified Operator</div>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="py-5">
                                            <div class="text-[10px] font-black text-gray-400 font-mono tracking-tighter">
                                                {{ \Carbon\Carbon::parse($booking->start_date)->format('m/d') }} » {{ \Carbon\Carbon::parse($booking->end_date)->format('m/d/y') }}
                                            </div>
                                            <div class="text-[7px] text-gray-700 font-black uppercase mt-1">Global Standard Time</div>
                                        </td>
                                        <td class="py-5">
                                            <div class="text-sm font-black text-emerald-400 tracking-tighter">৳{{ number_format($booking->total_price, 0) }}</div>
                                            <div class="flex items-center gap-1.5 mt-1">
                                                <span class="w-1 h-1 rounded-full {{ $booking->payment_status === 'paid' ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                                                <span class="text-[7px] text-gray-600 font-black uppercase tracking-widest">{{ $booking->payment_status === 'paid' ? 'Settled' : 'Unpaid' }}</span>
                                            </div>
                                        </td>
                                        <td class="py-5">
                                            @php
                                                $statusMap = [
                                                    'pending' => ['label' => 'Awaiting Auth', 'color' => 'text-amber-500 border-amber-500/20 bg-amber-500/5'],
                                                    'approved' => ['label' => 'Authorized', 'color' => 'text-indigo-400 border-indigo-500/20 bg-indigo-500/5'],
                                                    'ongoing' => ['label' => 'Active Mission', 'color' => 'text-emerald-400 border-emerald-500/20 bg-emerald-500/5'],
                                                    'returning' => ['label' => 'Returning', 'color' => 'text-purple-400 border-purple-500/20 bg-purple-500/5 animate-pulse'],
                                                    'returned' => ['label' => 'Landed', 'color' => 'text-purple-400 border-purple-500/20 bg-purple-500/5'],
                                                    'completed' => ['label' => 'Archived', 'color' => 'text-gray-600 border-white/5 bg-white/5'],
                                                    'rejected' => ['label' => 'Denied', 'color' => 'text-red-500 border-red-500/20 bg-red-500/5'],
                                                    'cancelled' => ['label' => 'Aborted', 'color' => 'text-red-500 border-red-500/20 bg-red-500/5'],
                                                ];
                                                $config = $statusMap[$booking->status] ?? ['label' => $booking->status, 'color' => 'text-gray-500 border-white/10 bg-white/5'];
                                            @endphp
                                            <span class="px-2 py-0.5 rounded-md text-[7px] font-black uppercase tracking-[0.2em] border {{ $config['color'] }}">
                                                {{ $config['label'] }}
                                            </span>
                                        </td>
                                        <td class="py-5 text-right pr-8" x-data="{ openHandover: false, openAudit: false }">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="{{ route('owner.bookings.show', $booking) }}" class="p-2.5 bg-white/5 hover:bg-white/10 text-gray-500 hover:text-white rounded-xl border border-white/5 transition-all shadow-lg" title="Open Mission Brief">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                </a>
                                                
                                                @if($booking->status === 'pending')
                                                    <div class="flex gap-1.5 ml-2">
                                                        <form action="{{ route('owner.bookings.update', $booking) }}" method="POST">
                                                            @csrf @method('PUT')
                                                            <input type="hidden" name="status" value="approved">
                                                            <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-[8px] font-black uppercase tracking-widest rounded-xl transition-all shadow-xl shadow-indigo-600/20">Authorize</button>
                                                        </form>
                                                    </div>
                                                @elseif($booking->status === 'approved')
                                                    <button @click="openHandover = true" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white text-[8px] font-black uppercase tracking-widest rounded-xl transition-all shadow-xl shadow-emerald-600/20 flex items-center gap-2">
                                                        Handover
                                                    </button>

                                                    <div x-show="openHandover" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-950/80 backdrop-blur-md" x-cloak>
                                                        <div @click.away="openHandover = false" class="bg-gray-900 border border-white/10 rounded-[2.5rem] w-full max-w-lg p-8 shadow-3xl text-left">
                                                            <h3 class="text-xl font-black text-white italic tracking-tight mb-6 flex items-center gap-3">
                                                                <span class="w-1.5 h-8 bg-emerald-500 rounded-full"></span>
                                                                Check-in Protocol
                                                            </h3>
                                                            <form action="{{ route('owner.bookings.update', $booking) }}" method="POST">
                                                                @csrf @method('PUT')
                                                                <input type="hidden" name="status" value="ongoing">
                                                                <div class="space-y-6">
                                                                    <div>
                                                                        <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest block mb-2">Current Odometer (km)</label>
                                                                        <input type="number" name="start_odo" required placeholder="Enter starting mileage..." class="w-full bg-gray-950 border border-white/5 text-white rounded-2xl text-sm py-4 px-6 focus:ring-emerald-500 outline-none font-mono">
                                                                    </div>
                                                                    <div class="p-4 bg-emerald-500/5 border border-emerald-500/20 rounded-2xl text-[10px] text-emerald-400 font-bold leading-relaxed">
                                                                       ⚠️ Verify document integrity and proof of identity physically before deploying the asset.
                                                                    </div>
                                                                    <div class="flex gap-4">
                                                                        <button type="button" @click="openHandover = false" class="flex-1 py-4 bg-white/5 text-gray-500 text-[10px] font-black uppercase tracking-widest rounded-2xl hover:bg-white/10 transition-all">Cancel</button>
                                                                        <button type="submit" class="flex-[2] py-4 bg-emerald-600 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl shadow-xl shadow-emerald-500/20 hover:bg-emerald-500 transition-all">Approve Release</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                @elseif(in_array($booking->status, ['ongoing', 'returning']))
                                                    <button @click="openAudit = true" class="px-6 py-3 {{ $booking->status === 'returning' ? 'bg-purple-600 animate-pulse' : 'bg-white text-gray-950' }} hover:scale-105 text-[10px] font-black uppercase tracking-widest rounded-2xl transition-all shadow-xl flex items-center gap-2 group">
                                                        <svg class="w-4 h-4 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        {{ $booking->status === 'returning' ? 'Verify Return Request' : 'Conduct Audit' }}
                                                    </button>

                                                     <div x-show="openAudit" x-data="{ damageDetected: false }" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-950/80 backdrop-blur-md" x-cloak>
                                                         <div @click.away="openAudit = false" class="bg-gray-900 border border-white/10 rounded-[2.5rem] w-full max-w-xl p-10 shadow-3xl text-left overflow-y-auto max-h-[90vh] relative overflow-hidden">
                                                             <div class="absolute -right-20 -top-20 w-80 h-80 bg-purple-600/5 rounded-full blur-[100px] pointer-events-none"></div>
                                                             
                                                             <h3 class="text-xl font-black text-white italic tracking-tight mb-8 flex items-center gap-3">
                                                                 <span class="w-1.5 h-8 bg-purple-500 rounded-full shadow-[0_0_15px_rgba(168,85,247,0.5)]"></span>
                                                                 Return Inspection
                                                             </h3>
                                                             
                                                             <form action="{{ route('owner.bookings.update', $booking) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                                                                 @csrf @method('PUT')
                                                                 <input type="hidden" name="status" value="returned">
                                                                 
                                                                 <!-- Trip Context Metadata -->
                                                                 <div class="flex items-center justify-between mb-8 p-5 bg-white/5 rounded-3xl border border-white/10 shadow-inner">
                                                                     <div>
                                                                         <div class="text-[8px] text-gray-500 font-black uppercase tracking-widest mb-1">Departure Odometer</div>
                                                                         <div class="text-white font-mono text-lg font-black tracking-tighter">{{ number_format($booking->start_odo) }} <span class="text-[10px] text-gray-600 font-bold uppercase">km</span></div>
                                                                     </div>
                                                                     <div class="h-8 w-px bg-white/10"></div>
                                                                     <div class="text-right">
                                                                         <div class="text-[8px] text-indigo-400 font-black uppercase tracking-widest mb-1 italic">Renter's Final Log</div>
                                                                         <div class="text-white font-mono text-lg font-black tracking-tighter">{{ number_format($booking->renter_end_odo ?? $booking->start_odo) }} <span class="text-[10px] text-gray-600 font-bold uppercase">km</span></div>
                                                                     </div>
                                                                 </div>

                                                                 <div class="grid grid-cols-2 gap-6">
                                                                     <div>
                                                                         <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest block mb-2">Verified Odometer</label>
                                                                         <input type="number" name="end_odo" required value="{{ $booking->renter_end_odo ?? $booking->start_odo }}" class="w-full bg-gray-950 border border-white/5 text-white rounded-2xl text-sm py-4 px-6 focus:ring-purple-500 outline-none font-mono">
                                                                     </div>
                                                                     <div>
                                                                         <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest block mb-2">Fuel Level</label>
                                                                         <select name="end_fuel" required class="w-full bg-gray-950 border border-white/5 text-white rounded-2xl text-sm py-4 px-6 focus:ring-purple-500 outline-none">
                                                                             <option value="Full">Full Tank</option>
                                                                             <option value="3/4">3/4 Tank</option>
                                                                             <option value="1/2">1/2 Tank</option>
                                                                             <option value="1/4">1/4 Tank</option>
                                                                             <option value="Empty">Empty</option>
                                                                         </select>
                                                                     </div>
                                                                 </div>

                                                                 <div class="p-6 bg-white/5 border border-white/5 rounded-3xl space-y-4">
                                                                     <div class="flex items-center justify-between">
                                                                         <label class="text-[10px] font-black text-white uppercase tracking-widest flex items-center gap-2">
                                                                             <input type="checkbox" x-model="damageDetected" class="rounded border-white/10 bg-gray-950 text-red-600 focus:ring-red-600">
                                                                             Any Damage Detected?
                                                                         </label>
                                                                         <span :class="damageDetected ? 'text-red-500 animate-pulse' : 'text-emerald-500'" class="text-[8px] font-black uppercase tracking-widest" x-text="damageDetected ? 'Damage Report Triggered' : 'No Damage Detected'"></span>
                                                                     </div>

                                                                     <div x-show="damageDetected" x-transition class="space-y-4 pt-4 border-t border-white/5">
                                                                         <div>
                                                                             <label class="text-[9px] font-black text-red-400 uppercase tracking-widest block mb-2">Damage Documentation</label>
                                                                             <textarea name="damage_description" x-bind:required="damageDetected" placeholder="Describe the physical compromise..." class="w-full bg-gray-950 border border-red-500/20 text-white rounded-2xl text-xs py-4 px-6 focus:ring-red-600 outline-none resize-none italic"></textarea>
                                                                         </div>
                                                                         <div class="grid grid-cols-2 gap-4">
                                                                            <div>
                                                                                <label class="text-[9px] font-black text-red-400 uppercase tracking-widest block mb-2">Assessment Cost (৳)</label>
                                                                                <input type="number" step="0.01" name="damage_cost" x-bind:required="damageDetected" placeholder="0.00" class="w-full bg-gray-950 border border-red-500/20 text-white rounded-2xl text-sm py-4 px-6 focus:ring-red-600 outline-none font-mono">
                                                                            </div>
                                                                            <div>
                                                                                <label class="text-[9px] font-black text-red-400 uppercase tracking-widest block mb-2">Evidence Image</label>
                                                                                <input type="file" name="damage_image" class="text-[9px] text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-red-500/10 file:text-red-400 cursor-pointer">
                                                                            </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>

                                                                 <div>
                                                                     <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest block mb-2">General Audit Notes</label>
                                                                     <textarea name="inspection_notes" rows="2" placeholder="Inspection testimony..." class="w-full bg-gray-950 border border-white/5 text-white rounded-2xl text-xs py-4 px-6 focus:ring-purple-500 outline-none resize-none"></textarea>
                                                                 </div>

                                                                 <div class="flex gap-4 pt-4">
                                                                     <button type="button" @click="openAudit = false" class="flex-1 py-4 bg-white/5 text-gray-500 text-[10px] font-black uppercase tracking-widest rounded-2xl hover:bg-white/10 transition-all">Cancel</button>
                                                                     <button type="submit" class="flex-[2] py-4 bg-purple-600 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl shadow-xl shadow-purple-500/20 hover:bg-purple-500 transition-all">Complete Inspection</button>
                                                                 </div>
                                                             </form>
                                                         </div>
                                                     </div>

                                                @elseif($booking->status === 'returned')
                                                    @if($booking->isLocked())
                                                        <div class="flex flex-col items-end gap-3 p-4 bg-red-500/5 border-2 border-red-500/20 rounded-3xl neon-shadow-red animate-pulse">
                                                            <div class="flex items-center gap-2">
                                                                <span class="w-2 h-2 bg-red-500 rounded-full shadow-[0_0_8px_rgba(239,68,68,1)]"></span>
                                                                <span class="text-red-500 text-[10px] font-black uppercase tracking-widest">Damage Report Active</span>
                                                            </div>
                                                            <div class="text-[8px] text-red-400 font-bold uppercase tracking-tighter text-right">Settlement Blocked: Resolution Required</div>
                                                        </div>
                                                    @else
                                                        <form action="{{ route('owner.bookings.update', $booking) }}" method="POST">
                                                            @csrf @method('PUT')
                                                            <input type="hidden" name="status" value="completed">
                                                            <button type="submit" class="px-6 py-3 bg-white text-gray-950 hover:bg-emerald-500 hover:text-white text-[10px] font-black uppercase tracking-widest rounded-xl transition-all shadow-xl shadow-white/10 flex items-center gap-2 group" onclick="return confirm('Settle transaction and finalize trip? Ensure all inspections are complete.');">
                                                                <svg class="w-4 h-4 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                                Finalize Trip
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endif
                                            </div>

                                            @if($booking->status === 'completed' && !(\App\Models\UserReview::where('reviewer_id', auth()->id())->where('booking_id', $booking->id)->exists()))
                                                 <div class="mt-6 p-6 bg-white/5 border border-dashed border-white/20 rounded-[2rem] text-left">
                                                      <h4 class="text-[9px] font-black text-white uppercase tracking-[0.2em] mb-4 flex items-center gap-2 italic">
                                                          <span class="w-1.5 h-3 bg-indigo-500 rounded-full"></span>
                                                          Update Renter Reputation
                                                      </h4>
                                                      <form action="{{ route('owner.bookings.review', $booking) }}" method="POST" class="space-y-4">
                                                          @csrf
                                                          <div class="flex items-center gap-4">
                                                              <select name="rating" required class="bg-gray-950 border border-white/5 text-white rounded-xl text-[10px] py-1.5 px-3 font-black focus:ring-indigo-500">
                                                                  <option value="5">Excellent</option>
                                                                  <option value="4">Good</option>
                                                                  <option value="3">Average</option>
                                                                  <option value="2">Poor</option>
                                                                  <option value="1">Critical Fault</option>
                                                              </select>
                                                              <input type="text" name="comment" placeholder="Log renter conduct..." class="flex-1 bg-gray-950 border border-white/5 text-white rounded-xl text-[11px] py-2 px-4 focus:ring-indigo-500 outline-none font-bold">
                                                              <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-[8px] font-black uppercase rounded-lg transition-all shadow-lg">Submit</button>
                                                          </div>
                                                      </form>
                                                 </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="py-24 text-center">
                        <div class="w-24 h-24 bg-gray-900 rounded-[2rem] border border-white/5 flex items-center justify-center mx-auto mb-6 text-4xl opacity-20">📅</div>
                        <h3 class="text-white font-black uppercase tracking-widest text-sm mb-2">No Bookings Yet</h3>
                        <p class="text-gray-600 text-[11px] italic mx-auto max-w-sm">Upcoming car rentals will appear here once customers book your vehicles.</p>
                    </div>
                @endif
            </div>

            @if($bookings->hasPages())
                <div class="mt-8">
                    {{ $bookings->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
