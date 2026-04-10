<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-black text-2xl leading-tight text-white">
                    {{ __('Fleet Revenue & Bookings') }}
                </h2>
                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-[0.2em] mt-1">Operational management of your active rental pipeline</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen text-slate-200 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-purple-600/5 rounded-full blur-[120px] -z-10"></div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
                    {{ session('success') }}
                </div>
            @endif

            <!-- Strategic Itinerary Search -->
            <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 p-6 rounded-[2rem] shadow-2xl flex flex-col md:flex-row gap-4 items-center justify-between">
                <x-search-bar :route="route('owner.bookings.index')" placeholder="Search by user, car, or ID..." />
                <div class="flex items-center gap-4">
                     <span class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Active Pipeline: {{ $bookings->total() }} Records</span>
                </div>
            </div>

            <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 overflow-hidden shadow-2xl rounded-[2.5rem]">
                @if($bookings->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-white/5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">
                                    <th class="py-8 pl-8">Vehicle & Location</th>
                                    <th class="py-8">Renter Identity</th>
                                    <th class="py-8">Booking Window</th>
                                    <th class="py-8">Gross Revenue</th>
                                    <th class="py-8">Live Status</th>
                                    <th class="py-8 text-right pr-8">Operational Control</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @foreach($bookings as $booking)
                                    <tr class="group hover:bg-white/[0.02] transition-colors">
                                        <td class="py-8 pl-8">
                                            <div class="flex items-center gap-4">
                                                <div class="w-14 h-10 rounded-xl bg-gray-800 border border-white/10 overflow-hidden shadow-lg">
                                                    @if($booking->car->images->count() > 0)
                                                        <img src="{{ Storage::url($booking->car->images->first()->image_path) }}" class="w-full h-full object-cover">
                                                    @endif
                                                </div>
                                                <div>
                                                    <a href="{{ route('cars.show', $booking->car) }}" class="text-sm font-bold text-white hover:text-indigo-400 transition-colors block">{{ $booking->car->title }}</a>
                                                    <div class="text-[9px] text-gray-600 font-bold uppercase tracking-widest">{{ $booking->car->location }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-8">
                                            <a href="{{ route('profiles.show', $booking->customer) }}" class="group/renter flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-lg bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-[10px] font-black text-indigo-400 group-hover/renter:bg-indigo-600 group-hover/renter:text-white transition-all shadow-lg">
                                                    {{ substr($booking->customer->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <div class="text-sm font-bold text-gray-300 group-hover/renter:text-white transition-colors">{{ $booking->customer->name }}</div>
                                                    <div class="text-[8px] text-gray-500 font-bold uppercase tracking-tighter">View Reputation</div>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="py-8">
                                            <div class="text-[11px] font-mono text-gray-400">
                                                {{ \Carbon\Carbon::parse($booking->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}
                                            </div>
                                            <div class="text-[8px] text-gray-600 font-bold uppercase mt-1">Confirmed Timeframe</div>
                                        </td>
                                        <td class="py-8">
                                            <div class="text-sm font-black text-emerald-400">৳{{ number_format($booking->total_price, 0) }}</div>
                                            <div class="flex items-center gap-2 mt-1">
                                                <span class="text-[8px] text-gray-600 font-black uppercase tracking-widest">{{ $booking->payment_status === 'paid' ? 'Settled' : 'Unpaid' }}</span>
                                                @if($booking->security_deposit_amount > 0)
                                                    <span class="px-1.5 py-0.5 bg-white/5 border border-white/10 rounded text-[7px] font-bold text-gray-500 uppercase tracking-tighter" title="Security Collateral">
                                                        Dep: ৳{{ number_format($booking->security_deposit_amount, 0) }}
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="py-8 text-center">
                                            @php
                                                $statusColors = [
                                                    'pending' => 'bg-amber-500/10 text-amber-500 border-amber-500/20',
                                                    'approved' => 'bg-blue-500/10 text-blue-400 border-blue-500/20', // Authorized
                                                    'ongoing' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20', // Trip Started
                                                    'returned' => 'bg-purple-500/10 text-purple-400 border-purple-500/20 highlight-pulse', // Inspection Needed
                                                    'completed' => 'bg-white/5 text-gray-500 border-white/10 opacity-50',
                                                    'rejected' => 'bg-red-500/10 text-red-500 border-red-500/20',
                                                    'cancelled' => 'bg-red-500/10 text-red-500 border-red-500/20',
                                                ];
                                                $color = $statusColors[$booking->status] ?? 'bg-white/5 text-gray-500 border-white/10';
                                            @endphp
                                            <span class="px-2.5 py-1 rounded-lg text-[8px] font-black uppercase tracking-widest border {{ $color }}">
                                                {{ $booking->status === 'approved' ? 'AUTHORIZED' : ($booking->status === 'ongoing' ? 'DEPLOYED' : $booking->status) }}
                                            </span>
                                        </td>
                                        <td class="py-12 text-right pr-8" x-data="{ openHandover: false, openAudit: false }">
                                            <div class="flex items-center justify-end gap-3">
                                                <a href="{{ route('bookings.messages.index', $booking) }}" class="p-3 bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white rounded-2xl border border-white/5 transition-all shadow-xl" title="Renter Liaison">
                                                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                                </a>
                                                
                                                {{-- Lifecycle Actions --}}
                                                @if($booking->status === 'pending')
                                                    <div class="flex gap-2">
                                                        <form action="{{ route('owner.bookings.update', $booking) }}" method="POST">
                                                            @csrf @method('PUT')
                                                            <input type="hidden" name="status" value="approved">
                                                            <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-[9px] font-black uppercase tracking-widest rounded-2xl transition-all shadow-xl shadow-indigo-600/20">Authorize</button>
                                                        </form>
                                                        <form action="{{ route('owner.bookings.update', $booking) }}" method="POST">
                                                            @csrf @method('PUT')
                                                            <input type="hidden" name="status" value="rejected">
                                                            <button type="submit" class="px-5 py-2.5 bg-white/5 border border-white/10 text-gray-500 text-[9px] font-black uppercase tracking-widest rounded-2xl hover:bg-red-600 hover:text-white transition-all">Deny</button>
                                                        </form>
                                                    </div>
                                                @elseif($booking->status === 'approved')
                                                    <button @click="openHandover = true" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-500 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl transition-all shadow-xl shadow-emerald-600/20 flex items-center gap-2 group">
                                                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                                                        Initiate Handover
                                                    </button>

                                                    {{-- Handover Modal --}}
                                                    <div x-show="openHandover" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-950/80 backdrop-blur-md" x-cloak>
                                                        <div @click.away="openHandover = false" class="bg-gray-900 border border-white/10 rounded-[2.5rem] w-full max-w-lg p-8 shadow-3xl text-left">
                                                            <h3 class="text-xl font-black text-white italic tracking-tight mb-6 flex items-center gap-3">
                                                                <span class="w-1.5 h-8 bg-emerald-500 rounded-full"></span>
                                                                Deployment Protocol
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
                                                                        <button type="button" @click="openHandover = false" class="flex-1 py-4 bg-white/5 text-gray-500 text-[10px] font-black uppercase tracking-widest rounded-2xl hover:bg-white/10 transition-all">Abort</button>
                                                                        <button type="submit" class="flex-[2] py-4 bg-emerald-600 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl shadow-xl shadow-emerald-500/20 hover:bg-emerald-500 transition-all">Authorize Release</button>
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

                                                     {{-- Audit Modal 2.0 --}}
                                                     <div x-show="openAudit" x-data="{ damageDetected: false }" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-950/80 backdrop-blur-md" x-cloak>
                                                         <div @click.away="openAudit = false" class="bg-gray-900 border border-white/10 rounded-[2.5rem] w-full max-w-xl p-10 shadow-3xl text-left overflow-y-auto max-h-[90vh] relative overflow-hidden">
                                                             <div class="absolute -right-20 -top-20 w-80 h-80 bg-purple-600/5 rounded-full blur-[100px] pointer-events-none"></div>
                                                             
                                                             <h3 class="text-xl font-black text-white italic tracking-tight mb-8 flex items-center gap-3">
                                                                 <span class="w-1.5 h-8 bg-purple-500 rounded-full shadow-[0_0_15px_rgba(168,85,247,0.5)]"></span>
                                                                 Physical Integrity Audit
                                                             </h3>
                                                             
                                                             <form action="{{ route('owner.bookings.update', $booking) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                                                                 @csrf @method('PUT')
                                                                 <input type="hidden" name="status" value="returned">
                                                                 
                                                                 <div class="grid grid-cols-2 gap-6">
                                                                     <div>
                                                                         <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest block mb-2">Verified Odometer</label>
                                                                         <input type="number" name="end_odo" required value="{{ $booking->renter_end_odo }}" class="w-full bg-gray-950 border border-white/5 text-white rounded-2xl text-sm py-4 px-6 focus:ring-purple-500 outline-none font-mono">
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
                                                                             Integrity Breach Detected?
                                                                         </label>
                                                                         <span :class="damageDetected ? 'text-red-500 animate-pulse' : 'text-emerald-500'" class="text-[8px] font-black uppercase tracking-widest" x-text="damageDetected ? 'Sovereign Lock Triggered' : 'Asset Verified Clean'"></span>
                                                                     </div>

                                                                     <div x-show="damageDetected" x-transition class="space-y-4 pt-4 border-t border-white/5">
                                                                         <div>
                                                                             <label class="text-[9px] font-black text-red-400 uppercase tracking-widest block mb-2">Breach Documentation</label>
                                                                             <textarea name="damage_description" placeholder="Describe the physical compromise..." class="w-full bg-gray-950 border border-red-500/20 text-white rounded-2xl text-xs py-4 px-6 focus:ring-red-600 outline-none resize-none italic"></textarea>
                                                                         </div>
                                                                         <div class="grid grid-cols-2 gap-4">
                                                                            <div>
                                                                                <label class="text-[9px] font-black text-red-400 uppercase tracking-widest block mb-2">Assessment Cost (৳)</label>
                                                                                <input type="number" name="damage_cost" placeholder="0.00" class="w-full bg-gray-950 border border-red-500/20 text-white rounded-2xl text-sm py-4 px-6 focus:ring-red-600 outline-none font-mono">
                                                                            </div>
                                                                            <div>
                                                                                <label class="text-[9px] font-black text-red-400 uppercase tracking-widest block mb-2">Evidence Artifact</label>
                                                                                <input type="file" name="damage_image" class="text-[9px] text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-red-500/10 file:text-red-400 cursor-pointer">
                                                                            </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>

                                                                 <div>
                                                                     <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest block mb-2">General Audit Notes</label>
                                                                     <textarea name="inspection_notes" rows="2" placeholder="Platform-level inspection testimony..." class="w-full bg-gray-950 border border-white/5 text-white rounded-2xl text-xs py-4 px-6 focus:ring-purple-500 outline-none resize-none"></textarea>
                                                                 </div>

                                                                 <div class="flex gap-4 pt-4">
                                                                     <button type="button" @click="openAudit = false" class="flex-1 py-4 bg-white/5 text-gray-500 text-[10px] font-black uppercase tracking-widest rounded-2xl hover:bg-white/10 transition-all">Cancel</button>
                                                                     <button type="submit" class="flex-[2] py-4 bg-purple-600 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl shadow-xl shadow-purple-500/20 hover:bg-purple-500 transition-all">Log Final Audit</button>
                                                                 </div>
                                                             </form>
                                                         </div>
                                                     </div>

                                                @elseif($booking->status === 'returned')
                                                    @if($booking->isLocked())
                                                        <div class="flex flex-col items-end gap-3 p-4 bg-red-500/5 border-2 border-red-500/20 rounded-3xl neon-shadow-red animate-pulse">
                                                            <div class="flex items-center gap-2">
                                                                <span class="w-2 h-2 bg-red-500 rounded-full shadow-[0_0_8px_rgba(239,68,68,1)]"></span>
                                                                <span class="text-red-500 text-[10px] font-black uppercase tracking-widest">Integrity Lock Active</span>
                                                            </div>
                                                            <div class="text-[8px] text-red-400 font-bold uppercase tracking-tighter text-right">Settlement Blocked: Resolution Required</div>
                                                        </div>
                                                    @else
                                                        <form action="{{ route('owner.bookings.update', $booking) }}" method="POST">
                                                            @csrf @method('PUT')
                                                            <input type="hidden" name="status" value="completed">
                                                            <button type="submit" class="px-6 py-3 bg-white text-gray-950 hover:bg-emerald-500 hover:text-white text-[10px] font-black uppercase tracking-widest rounded-xl transition-all shadow-xl shadow-white/10 flex items-center gap-2 group" onclick="return confirm('Settle transaction and finalize capture? Ensure all inspections are complete.');">
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
                                            
                                             {{-- Legacy form removed, now integrated into Audit modal --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="py-24 text-center">
                        <div class="w-24 h-24 bg-gray-900 rounded-[2rem] border border-white/5 flex items-center justify-center mx-auto mb-6 text-4xl opacity-20">📊</div>
                        <h3 class="text-white font-black uppercase tracking-widest text-sm mb-2">No Active Pipeline</h3>
                        <p class="text-gray-600 text-[11px] italic mx-auto max-w-sm">Vehicle lease authorizations will materialize here once renters initiate discovery requests.</p>
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
