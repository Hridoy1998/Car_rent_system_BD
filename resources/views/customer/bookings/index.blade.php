<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-black text-2xl leading-tight text-white">
                    {{ __('Travel Itineraries') }}
                </h2>
                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-[0.2em] mt-1">Status of your decentralized car-sharing requests</p>
            </div>
            <a href="{{ route('home') }}" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-[10px] font-black uppercase tracking-widest rounded-xl transition-all shadow-xl shadow-indigo-600/20">
                Initiate New Booking
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-indigo-600/5 rounded-full blur-[150px] -z-10"></div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-8 bg-emerald-500/10 border border-emerald-500/50 text-emerald-400 p-4 rounded-2xl font-bold text-sm flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-8 bg-red-500/10 border border-red-500/50 text-red-400 p-4 rounded-2xl font-bold text-sm flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Tactical History Search -->
            <div class="flex justify-center mb-10">
                <x-search-bar :route="route('customer.bookings.index')" placeholder="Search by booking ID, car brand, or host..." />
            </div>

            <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 overflow-hidden shadow-2xl rounded-[2.5rem]">
                @if($bookings->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-white/5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">
                                    <th class="pb-6 pl-8">Vehicle & Destination</th>
                                    <th class="pb-6">Host Intel</th>
                                    <th class="pb-6">Timeframe</th>
                                    <th class="pb-6">Outcome (Price)</th>
                                    <th class="pb-6 text-right pr-8">Status Cycle</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @foreach($bookings as $booking)
                                    <tr class="group hover:bg-white/[0.02] transition-colors">
                                        <td class="py-8 pl-8">
                                            <div class="flex items-center gap-4">
                                                <div class="w-16 h-12 rounded-xl overflow-hidden border border-white/10 shadow-lg bg-gray-800">
                                                    @if($booking->car->images->count() > 0)
                                                        <img src="{{ Storage::url($booking->car->images->first()->image_path) }}" alt="Car" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                                    @endif
                                                </div>
                                                <div>
                                                    <a href="{{ route('cars.show', $booking->car) }}" class="text-sm font-bold text-white hover:text-indigo-400 transition-colors block">
                                                        {{ $booking->car->title }}
                                                    </a>
                                                    <div class="text-[9px] text-gray-500 font-bold uppercase tracking-widest mt-1">{{ $booking->car->location }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-8">
                                            <a href="{{ route('profiles.show', $booking->car->owner) }}" class="flex items-center gap-3 group/owner">
                                                <div class="w-8 h-8 rounded-lg bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-[10px] font-black text-indigo-400 group-hover/owner:bg-indigo-600 group-hover/owner:text-white transition-all">
                                                    {{ substr($booking->car->owner->name, 0, 1) }}
                                                </div>
                                                <div class="text-sm font-bold text-gray-300 group-hover/owner:text-white transition-colors">{{ $booking->car->owner->name }}</div>
                                            </a>
                                        </td>
                                        <td class="py-8 text-[11px] font-mono text-gray-400">
                                            <div>{{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}</div>
                                            <div class="text-gray-600 mt-1">→ {{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</div>
                                        </td>
                                        <td class="py-12">
                                            <div class="text-base font-black text-white italic tracking-tighter shadow-xl shadow-indigo-500/10">৳ {{ number_format($booking->total_price, 0) }}</div>
                                            <div class="flex items-center gap-2 mt-2">
                                                @if($booking->payment_status === 'paid')
                                                    <span class="text-[8px] font-black uppercase tracking-widest text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded-md border border-emerald-500/20">Settled ✓</span>
                                                @else
                                                    <span class="text-[8px] font-black uppercase tracking-widest text-yellow-500/50 bg-yellow-500/5 px-2 py-0.5 rounded-md border border-yellow-500/10">Pending</span>
                                                @endif

                                                @if($booking->security_deposit_amount > 0)
                                                    <div class="flex items-center gap-1 group/deposit relative">
                                                        <span class="p-1 {{ $booking->security_deposit_status === 'released' ? 'bg-emerald-500/10 text-emerald-400' : 'bg-red-500/10 text-red-400' }} rounded-md border border-current opacity-70 group-hover:opacity-100 transition-all cursor-help">
                                                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                                        </span>
                                                        <div class="hidden group-hover:block absolute bottom-full left-1/2 -translate-x-1/2 mb-2 w-32 p-3 bg-gray-950 border border-white/10 rounded-xl shadow-2xl z-50 text-[8px] font-black uppercase tracking-widest text-center">
                                                            <span class="text-gray-500">Deposit {{ $booking->security_deposit_status }}</span>
                                                            <div class="text-white mt-1">৳ {{ number_format($booking->security_deposit_amount, 0) }}</div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="py-10 text-right pr-8" x-data="{ openReturn: false }">
                                            <div class="flex items-center justify-end gap-3 mb-6">
                                                 {{-- Action Buttons --}}
                                                 <div class="flex gap-2">
                                                    <a href="{{ route('customer.bookings.show', $booking) }}" class="p-2.5 bg-indigo-600/10 hover:bg-indigo-600 text-indigo-400 hover:text-white rounded-xl border border-indigo-500/20 transition-all font-black text-[9px] flex items-center gap-2 uppercase tracking-widest" title="Tactical Hub">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                        Details
                                                    </a>
                                                    <a href="{{ route('bookings.messages.index', $booking) }}" class="p-2.5 bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white rounded-xl border border-white/5 transition-all" title="Chat with Host">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                                    </a>
                                                    
                                                    @if(in_array($booking->status, ['completed', 'approved', 'ongoing', 'returning', 'returned']))
                                                        <a href="{{ route('invoices.download', $booking) }}" class="p-2.5 bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white rounded-xl border border-white/5 transition-all" title="Download Invoice">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                        </a>
                                                    @endif
                                                 </div>

                                                @if($booking->status === 'approved' && $booking->payment_status === 'pending')
                                                    <form action="{{ route('customer.bookings.pay', $booking) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-[10px] font-black uppercase tracking-widest rounded-xl transition-all shadow-xl shadow-indigo-600/20">Finalize Payment</button>
                                                    </form>
                                                @endif

                                                @if($booking->status === 'ongoing')
                                                    <button @click="openReturn = true" class="px-5 py-2.5 bg-purple-600 hover:bg-purple-500 text-white text-[9px] font-black uppercase tracking-widest rounded-xl transition-all shadow-xl shadow-purple-600/20">Initiate Return</button>
                                                    
                                                    {{-- Return Modal --}}
                                                    <div x-show="openReturn" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-950/80 backdrop-blur-md" x-cloak>
                                                        <div @click.away="openReturn = false" class="bg-gray-900 border border-white/10 rounded-[2.5rem] w-full max-w-lg p-8 shadow-3xl text-left">
                                                            <h3 class="text-xl font-black text-white italic tracking-tight mb-6 flex items-center gap-3">
                                                                <span class="w-1.5 h-8 bg-purple-500 rounded-full"></span>
                                                                Return Protocol
                                                            </h3>

                                                            <form action="{{ route('customer.bookings.update', $booking) }}" method="POST">
                                                                @csrf @method('PUT')
                                                                <input type="hidden" name="status" value="returning">
                                                                <div class="space-y-6">
                                                                    <div>
                                                                        <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest block mb-2">Final Odometer Reading</label>
                                                                        <input type="number" name="renter_end_odo" required placeholder="Enter mileage as shown on dash..." class="w-full bg-gray-950 border border-white/5 text-white rounded-2xl text-sm py-4 px-6 focus:ring-purple-500 outline-none font-mono">
                                                                    </div>
                                                                    <div class="flex gap-4">
                                                                        <button type="button" @click="openReturn = false" class="flex-1 py-4 bg-white/5 text-gray-500 text-[10px] font-black uppercase tracking-widest rounded-2xl hover:bg-white/10 transition-all">Cancel</button>
                                                                        <button type="submit" class="flex-[2] py-4 bg-purple-600 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl shadow-xl shadow-purple-500/20 hover:bg-purple-500 transition-all">Parked & Ready</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="min-w-[120px]">
                                                    @php
                                                        $statusColors = [
                                                            'pending' => 'bg-amber-500/10 text-amber-500 border-amber-500/20',
                                                            'approved' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                                            'ongoing' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20 animate-pulse',
                                                            'returning' => 'bg-purple-500/10 text-purple-400 border-purple-500/20',
                                                            'returned' => 'bg-emerald-500/5 text-emerald-600 border-emerald-500/10',
                                                            'completed' => 'bg-white/5 text-gray-500 border-white/10 opacity-50',
                                                            'rejected' => 'bg-red-500/10 text-red-500 border-red-500/20',
                                                            'cancelled' => 'bg-red-500/10 text-red-500 border-red-500/20',
                                                        ];
                                                        $color = $statusColors[$booking->status] ?? 'bg-white/5 text-gray-500 border-white/10';
                                                    @endphp
                                                    <span class="px-3 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest border {{ $color }}">
                                                        {{ $booking->status === 'approved' ? 'AUTHORIZED' : ($booking->status === 'ongoing' ? 'DEPLOYED' : ($booking->status === 'returning' ? 'AWAIT AUDIT' : $booking->status)) }}
                                                    </span>
                                                </div>
                                            </div>

                                            {{-- Sovereign Dispute Terminal --}}
                                            @if($booking->damageReports->where('status', 'pending')->count())
                                                @foreach($booking->damageReports->where('status', 'pending') as $report)
                                                    <div x-data="{ openDispute: false }" class="mt-4">
                                                        <button @click="openDispute = true" class="w-full p-4 bg-red-950/20 border-2 border-red-500/30 rounded-2xl group hover:border-red-500/60 transition-all shadow-[0_0_20px_rgba(239,68,68,0.1)] text-left flex items-center justify-between">
                                                            <div class="flex items-center gap-4">
                                                                <div class="w-10 h-10 rounded-xl bg-red-500/10 flex items-center justify-center text-red-500 animate-pulse border border-red-500/20">
                                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                                                </div>
                                                                <div>
                                                                    <h4 class="text-[10px] font-black text-red-400 uppercase tracking-widest">Asset Integrity Dispute Filed</h4>
                                                                    <p class="text-[8px] text-gray-500 font-bold uppercase mt-1">Status: Pending Verification | Response Required</p>
                                                                </div>
                                                            </div>
                                                            <div class="flex flex-col items-end">
                                                                @php
                                                                    $deadline = $report->created_at->addHours(24);
                                                                    $isOverdue = now()->greaterThan($deadline);
                                                                @endphp
                                                                <span class="text-[8px] font-black {{ $isOverdue ? 'text-red-600' : 'text-yellow-500/50' }} uppercase tracking-widest italic">
                                                                    Deadline: {{ $deadline->format('M d, H:i') }}
                                                                </span>
                                                                <span class="text-[9px] font-black text-white mt-1 border-b border-white/10 hover:border-white transition-all">Engage Portal →</span>
                                                            </div>
                                                        </button>

                                                        {{-- Sovereign Resolution Terminal Modal --}}
                                                        <div x-show="openDispute" class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-gray-950/90 backdrop-blur-2xl" x-cloak>
                                                            <div @click.away="openDispute = false" class="bg-gray-900 border-2 border-red-500/20 rounded-[3rem] w-full max-w-4xl p-12 shadow-[0_0_100px_rgba(239,68,68,0.2)] text-left grid lg:grid-cols-2 gap-12 relative overflow-hidden">
                                                                <div class="absolute -right-20 -top-20 w-80 h-80 bg-red-500/5 rounded-full blur-[100px] pointer-events-none"></div>
                                                                
                                                                <div>
                                                                    <h3 class="text-2xl font-black text-white italic tracking-tight mb-8 flex items-center gap-4">
                                                                        <span class="w-2 h-10 bg-red-500 rounded-full shadow-[0_0_20px_rgba(239,68,68,0.5)]"></span>
                                                                        Integrity Breach Evidence
                                                                    </h3>
                                                                    
                                                                    <div class="aspect-video rounded-3xl overflow-hidden border-2 border-white/5 bg-gray-950 shadow-inner mb-8 group relative">
                                                                        @if($report->image)
                                                                            <img src="{{ Storage::url($report->image) }}" class="w-full h-full object-cover">
                                                                        @else
                                                                            <div class="w-full h-full flex flex-col items-center justify-center text-gray-800 italic text-[11px] font-black uppercase tracking-[0.4em]">No Evidence Artifact</div>
                                                                        @endif
                                                                        <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-transparent to-transparent opacity-60"></div>
                                                                    </div>

                                                                    <div class="p-6 bg-white/5 border border-white/5 rounded-3xl">
                                                                        <div class="text-[9px] font-black text-gray-500 uppercase tracking-widest mb-3 italic">Host Testimony</div>
                                                                        <p class="text-sm font-bold text-gray-300 leading-relaxed italic">"{{ $report->description }}"</p>
                                                                    </div>
                                                                </div>

                                                                <div class="flex flex-col">
                                                                    <div class="bg-gray-950 border border-white/5 flex items-center justify-between p-8 rounded-3xl mb-8">
                                                                        <div>
                                                                            <span class="block text-[10px] text-gray-500 font-black uppercase tracking-widest mb-1 italic">Claimed Valuation</span>
                                                                            <span class="text-4xl font-black text-white tracking-tighter italic">৳{{ number_format($report->cost, 0) }}</span>
                                                                        </div>
                                                                        <div class="p-4 bg-red-500/10 rounded-2xl border border-red-500/20 text-red-500 text-xs font-black uppercase tracking-widest text-center">
                                                                            Asset Loss<br>Protocol
                                                                        </div>
                                                                    </div>

                                                                    <form action="{{ route('customer.damage-reports.respond', $report) }}" method="POST" class="flex-1 flex flex-col justify-between">
                                                                        @csrf @method('PUT')
                                                                        <div class="space-y-6">
                                                                            <label class="block">
                                                                                <span class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 block italic">Platform Dispute Testimony</span>
                                                                                <textarea name="customer_notes" rows="4" placeholder="Log your version of the incident for platform review..." class="w-full bg-gray-950 border border-white/5 text-white rounded-3xl text-sm py-5 px-6 focus:ring-red-500 outline-none italic"></textarea>
                                                                            </label>
                                                                        </div>

                                                                        <div class="grid grid-cols-2 gap-4 mt-12">
                                                                            <button type="submit" name="status" value="acknowledged" class="py-5 bg-emerald-600 hover:bg-emerald-500 text-white text-[11px] font-black uppercase tracking-widest rounded-3xl transition-all shadow-xl shadow-emerald-600/20 group/btn flex items-center justify-center gap-2">
                                                                                Accept Liability
                                                                                <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                                            </button>
                                                                            <button type="submit" name="status" value="disputed" class="py-5 bg-white text-gray-950 hover:bg-red-600 hover:text-white text-[11px] font-black uppercase tracking-widest rounded-3xl transition-all shadow-xl shadow-white/10 group/dis flex items-center justify-center gap-2">
                                                                                Dispute Claim
                                                                                <svg class="w-4 h-4 group-hover/dis:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                                <button @click="openDispute = false" class="absolute top-8 right-8 text-white/20 hover:text-white transition-colors">
                                                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif

                                            {{-- Reputation Management (Review Host) --}}
                                            @php
                                                $hasReviewed = \App\Models\UserReview::where('reviewer_id', auth()->id())
                                                    ->where('booking_id', $booking->id)
                                                    ->exists();
                                            @endphp
                                            @if($booking->status === 'completed' && !$hasReviewed)
                                                <div class="mt-6 p-6 bg-white/5 border border-dashed border-white/20 rounded-[2.5rem] text-left">
                                                      <h4 class="text-[9px] font-black text-white uppercase tracking-[0.2em] mb-4 flex items-center gap-2 italic">
                                                          <span class="w-1.5 h-3 bg-indigo-500 rounded-full"></span>
                                                          Update Host Reputation
                                                      </h4>
                                                      <form action="{{ route('customer.bookings.reviews.store', $booking) }}" method="POST" class="space-y-4">
                                                          @csrf
                                                          <div class="flex items-center gap-4">
                                                              <select name="rating" required class="bg-gray-950 border border-white/5 text-white rounded-xl text-[10px] py-2 px-3 font-black focus:ring-indigo-500">
                                                                  <option value="5">Excellent</option>
                                                                  <option value="4">Good</option>
                                                                  <option value="3">Average</option>
                                                                  <option value="2">Poor</option>
                                                                  <option value="1">Critical Fault</option>
                                                              </select>
                                                              <input type="text" name="comment" placeholder="Log host conduct..." class="flex-1 bg-gray-950 border border-white/5 text-white rounded-xl text-[11px] py-2.5 px-5 focus:ring-indigo-500 outline-none font-bold">
                                                              <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-[9px] font-black uppercase rounded-xl transition-all shadow-lg">Submit</button>
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
                        <div class="w-24 h-24 bg-gray-900 rounded-[2rem] border border-white/5 flex items-center justify-center mx-auto mb-6 text-4xl opacity-20">🛸</div>
                        <h3 class="text-white font-black uppercase tracking-widest text-sm mb-2">Workspace Empty</h3>
                        <p class="text-gray-600 text-[11px] italic">You have no active vehicle lease authorizations at this time.</p>
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
