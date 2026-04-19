{{-- Tactical Intervention Panels: Oversight Terminal Hardened --}}

{{-- Handover Logic --}}
<div 
    x-show="activePanel === 'handover'" 
    x-cloak
    x-transition:enter="transition ease-out duration-500"
    x-transition:enter-start="opacity-0 translate-y-12"
    x-transition:enter-end="opacity-100 translate-y-0"
    class="bg-white border-2 border-emerald-100 p-8 md:p-14 rounded-[3rem] md:rounded-[4rem] shadow-xl shadow-[#050B1A]/5 relative overflow-hidden group/pnl"
>
    <div class="relative z-10">
        <div class="flex items-center gap-4 md:gap-6 mb-10 md:mb-14 px-2">
            <div class="w-12 h-12 md:w-16 md:h-16 bg-emerald-500 rounded-xl md:rounded-[1.5rem] flex items-center justify-center text-white shadow-xl border border-white/10 italic font-black text-xl md:text-2xl">HI</div>
            <div>
                <h3 class="text-2xl md:text-3xl font-black text-[#050B1A] uppercase italic tracking-tight leading-none">Handover</h3>
                <p class="text-[9px] text-gray-400 font-black uppercase tracking-widest mt-2 md:mt-3 italic leading-none">Initiating Deployment Protocol</p>
            </div>
        </div>

        <form action="{{ route('owner.bookings.update', $booking) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-14">
            @csrf @method('PUT')
            <input type="hidden" name="status" value="ongoing">
            
            <div class="space-y-10 md:space-y-12">
                <div class="space-y-4 md:space-y-5">
                    <label class="text-[10px] md:text-[11px] font-black text-gray-400 uppercase tracking-widest ms-6 md:ms-8 italic leading-none">Odometer Registry (km)</label>
                    <input type="number" name="start_odo" required value="{{ $booking->start_odo }}" class="w-full bg-gray-50 border-2 border-white rounded-[2rem] p-6 md:p-8 text-[#050B1A] font-black text-2xl md:text-4xl tracking-tight focus:bg-white focus:border-emerald-500 transition-all italic font-outfit outline-none shadow-inner">
                </div>
                <div class="space-y-4 md:space-y-5">
                    <label class="text-[10px] md:text-[11px] font-black text-gray-400 uppercase tracking-widest ms-6 md:ms-8 italic leading-none">Fuel Reserves</label>
                    <div class="relative">
                        <select name="start_fuel" required class="w-full bg-gray-50 border-2 border-white rounded-[2rem] p-6 md:p-8 text-[#050B1A] font-black text-[10px] md:text-[11px] uppercase tracking-widest focus:bg-white focus:border-emerald-500 transition-all italic appearance-none cursor-pointer outline-none shadow-inner">
                            <option value="Full">Institutional Full</option>
                            <option value="3/4">3/4 Tactical</option>
                            <option value="1/2">1/2 Tactical</option>
                            <option value="1/4">1/4 Tactical</option>
                            <option value="Empty">Depleted</option>
                        </select>
                        <div class="absolute right-10 top-1/2 -translate-y-1/2 pointer-events-none text-gray-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-10 md:space-y-12 flex flex-col justify-between">
                <div class="space-y-4 md:space-y-5">
                    <label class="text-[10px] md:text-[11px] font-black text-gray-400 uppercase tracking-widest ms-6 md:ms-8 italic leading-none">Handover Artifact</label>
                    <div class="relative group/upload cursor-pointer" onclick="document.getElementById('handover_image').click()">
                        <div class="bg-gray-50 border-2 border-dashed border-gray-100 rounded-[2.5rem] p-8 md:p-12 text-center group-hover/upload:border-emerald-500 group-hover/upload:bg-emerald-50 transition-all duration-500">
                             <svg class="w-8 h-8 md:w-10 md:h-10 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                             <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic leading-none">Ingest Visual Log</p>
                        </div>
                        <input type="file" name="handover_image" id="handover_image" class="hidden">
                    </div>
                </div>
                <div class="pt-6">
                    <p class="text-[9px] text-emerald-600 font-black uppercase tracking-widest italic mb-8 leading-relaxed bg-emerald-50/50 border border-emerald-100 p-6 rounded-[2rem] text-center">
                        Certify operator credentials before asset release.
                    </p>
                    <button type="submit" class="w-full py-8 bg-emerald-500 hover:bg-emerald-600 text-white font-black text-[11px] md:text-[12px] uppercase tracking-widest rounded-[2.5rem] shadow-xl shadow-emerald-500/20 transition-all hover:-translate-y-1 italic leading-none">Authorize Deployment</button>
                    <button type="button" @click="activePanel = null" class="w-full mt-6 text-[9px] font-black text-gray-400 uppercase tracking-widest hover:text-[#050B1A] transition-colors italic leading-none">Abort Command</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Audit & Return Logic --}}
<div 
    x-show="activePanel === 'audit'" 
    x-data="{ damageDetected: false }"
    x-cloak
    x-transition:enter="transition ease-out duration-500"
    x-transition:enter-start="opacity-0 translate-y-12"
    x-transition:enter-end="opacity-100 translate-y-0"
    class="bg-white border-2 border-purple-100 p-8 md:p-14 rounded-[3rem] md:rounded-[4rem] shadow-xl shadow-[#050B1A]/5 relative overflow-hidden group/audit"
>
    <div class="relative z-10">
        <div class="flex items-center gap-4 md:gap-6 mb-10 md:mb-14 px-2">
            <div class="w-12 h-12 md:w-16 md:h-16 bg-purple-600 rounded-xl md:rounded-[1.5rem] flex items-center justify-center text-white shadow-xl border border-white/10 italic font-black text-xl md:text-2xl">RA</div>
            <div>
                <h3 class="text-2xl md:text-3xl font-black text-[#050B1A] uppercase italic tracking-tight leading-none">Return Audit</h3>
                <p class="text-[9px] text-gray-400 font-black uppercase tracking-widest mt-2 md:mt-3 italic leading-none">De-deployment Sequence Artifacts</p>
            </div>
        </div>

        <form action="{{ route('owner.bookings.update', $booking) }}" method="POST" enctype="multipart/form-data" class="space-y-10 md:space-y-14">
            @csrf @method('PUT')
            <input type="hidden" name="status" value="returned">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-14">
                <div class="space-y-4 md:space-y-5">
                    <label class="text-[10px] md:text-[11px] font-black text-gray-400 uppercase tracking-widest ms-6 md:ms-8 italic leading-none">Final Odo Registry</label>
                    <input type="number" name="end_odo" required value="{{ $booking->renter_end_odo ?? $booking->start_odo }}" class="w-full bg-gray-50 border-2 border-white rounded-[2rem] p-6 md:p-8 text-[#050B1A] font-black text-2xl md:text-4xl tracking-tight focus:bg-white focus:border-purple-500 transition-all italic font-outfit outline-none shadow-inner">
                </div>
                <div class="space-y-4 md:space-y-5">
                    <label class="text-[10px] md:text-[11px] font-black text-gray-400 uppercase tracking-widest ms-6 md:ms-8 italic leading-none">Fuel Reserves</label>
                    <div class="relative">
                        <select name="end_fuel" required class="w-full bg-gray-50 border-2 border-white rounded-[2rem] p-6 md:p-8 text-[#050B1A] font-black text-[10px] md:text-[11px] uppercase tracking-widest focus:bg-white focus:border-purple-500 transition-all italic appearance-none cursor-pointer outline-none shadow-inner">
                            <option value="Full">Institutional Full</option>
                            <option value="3/4">3/4 Tactical</option>
                            <option value="1/2">1/2 Tactical</option>
                            <option value="1/4">1/4 Tactical</option>
                            <option value="Empty">Depleted</option>
                        </select>
                        <div class="absolute right-10 top-1/2 -translate-y-1/2 pointer-events-none text-gray-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-8 md:p-14 border-2 rounded-[2.5rem] md:rounded-[4rem] transition-all duration-700" :class="damageDetected ? 'bg-red-50 border-red-200' : 'bg-gray-50 border-white shadow-inner'">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-8 mb-10 md:mb-12">
                    <label class="flex items-center gap-4 md:gap-6 cursor-pointer group/toggle">
                        <div class="relative">
                            <input type="checkbox" x-model="damageDetected" class="sr-only">
                            <div class="w-14 h-8 md:w-16 md:h-10 rounded-full transition-colors duration-500" :class="damageDetected ? 'bg-red-500' : 'bg-gray-200'"></div>
                            <div class="absolute left-1 top-1 w-6 h-6 md:w-8 md:h-8 bg-white rounded-full transition-transform duration-500 shadow-xl" :class="damageDetected ? 'translate-x-6' : 'translate-x-0'"></div>
                        </div>
                        <span class="text-xs md:text-sm font-black uppercase tracking-widest italic" :class="damageDetected ? 'text-red-700' : 'text-[#050B1A]'">Structural Damage?</span>
                    </label>
                    <span x-show="damageDetected" class="text-[8px] md:text-[10px] font-black text-red-500 uppercase tracking-widest animate-pulse italic leading-none">Incident Log Required</span>
                </div>

                <div x-show="damageDetected" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-10 md:space-y-14 pt-10 md:pt-14 border-t border-red-200/30">
                    <div class="space-y-4 md:space-y-5">
                        <label class="text-[10px] md:text-[11px] font-black text-red-500 uppercase tracking-widest ms-6 md:ms-8 italic leading-none">Damage Documentation</label>
                        <textarea name="damage_description" x-bind:required="damageDetected" placeholder="Record the compromise details..." class="w-full bg-white border-2 border-red-100 rounded-[2rem] p-8 text-red-900 font-bold text-xs uppercase tracking-widest italic focus:border-red-500 outline-none resize-none transition-all shadow-sm"></textarea>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-14">
                        <div class="space-y-4 md:space-y-5">
                            <label class="text-[10px] md:text-[11px] font-black text-red-500 uppercase tracking-widest ms-6 md:ms-8 italic leading-none">Repair Assessment (৳)</label>
                            <input type="number" step="0.01" name="damage_cost" x-bind:required="damageDetected" placeholder="0.00" class="w-full bg-white border-2 border-red-100 rounded-[2.5rem] p-6 md:p-8 text-red-600 font-black text-3xl md:text-4xl tracking-tight italic font-outfit outline-none">
                        </div>
                        <div class="space-y-4 md:space-y-5">
                            <label class="text-[10px] md:text-[11px] font-black text-red-500 uppercase tracking-widest ms-6 md:ms-8 italic leading-none">Incident Artifact</label>
                            <div class="relative group/dmg cursor-pointer" onclick="document.getElementById('damage_image').click()">
                                <div class="bg-red-50/50 border-2 border-dashed border-red-100 rounded-[2rem] p-8 text-center group-hover/dmg:border-red-500 group-hover/dmg:bg-red-50 transition-all">
                                     <svg class="w-8 h-8 md:w-10 md:h-10 text-red-200 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                                     <p class="text-[9px] font-black text-red-400 uppercase tracking-widest italic leading-none">Upload Visual Log</p>
                                </div>
                                <input type="file" name="damage_image" id="damage_image" class="hidden">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-4 md:space-y-5">
                <label class="text-[10px] md:text-[11px] font-black text-gray-400 uppercase tracking-widest ms-8 italic leading-none">Post-Deployment Testimony</label>
                <textarea name="inspection_notes" rows="3" placeholder="Log decommissioning metadata..." class="w-full bg-gray-50 border-2 border-white rounded-[3rem] p-8 text-[#050B1A] font-bold text-xs uppercase tracking-widest italic focus:bg-white focus:border-purple-500 outline-none resize-none transition-all shadow-inner"></textarea>
            </div>

            <div class="pt-8">
                <button type="submit" class="w-full py-8 bg-purple-600 hover:bg-purple-700 text-white font-black text-[12px] uppercase tracking-widest rounded-[2.5rem] shadow-xl shadow-purple-600/20 transition-all hover:scale-[1.02] italic leading-none">Complete Final Audit</button>
                <button type="button" @click="activePanel = null" class="w-full mt-6 text-[9px] font-black text-gray-400 uppercase tracking-widest hover:text-[#050B1A] transition-colors italic text-center leading-none">Abort Audit Command</button>
            </div>
        </form>
    </div>
</div>

{{-- Reputation Update Logic --}}
<div 
    x-show="activePanel === 'review'" 
    x-cloak
    x-transition:enter="transition ease-out duration-500"
    x-transition:enter-start="opacity-0 translate-y-12"
    x-transition:enter-end="opacity-100 translate-y-0"
    class="bg-white border-2 border-indigo-100 p-8 md:p-14 rounded-[3rem] md:rounded-[4rem] shadow-xl shadow-[#050B1A]/5 relative overflow-hidden group/rep"
>
    <div class="relative z-10">
        <div class="flex items-center gap-4 md:gap-6 mb-10 md:mb-14 px-2">
            <div class="w-12 h-12 md:w-16 md:h-16 bg-indigo-600 rounded-xl md:rounded-[1.5rem] flex items-center justify-center text-white shadow-xl border border-white/10 italic font-black text-xl md:text-2xl">LR</div>
            <div>
                <h3 class="text-2xl md:text-3xl font-black text-[#050B1A] uppercase italic tracking-tight leading-none">Log Reputation</h3>
                <p class="text-[9px] text-gray-400 font-black uppercase tracking-widest mt-2 md:mt-3 italic leading-none">Update Operator Conduct Registry</p>
            </div>
        </div>

        <form action="{{ route('owner.bookings.review', $booking) }}" method="POST" class="space-y-10 md:space-y-14">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 md:gap-14">
                <div class="md:col-span-1 space-y-4 md:space-y-5">
                    <label class="text-[10px] md:text-[11px] font-black text-gray-400 uppercase tracking-widest ms-6 md:ms-8 italic leading-none">Scalar</label>
                    <div class="relative">
                        <select name="rating" required class="w-full bg-gray-50 border-2 border-white rounded-[2rem] p-6 text-[#050B1A] font-black text-[10px] md:text-[11px] uppercase tracking-widest focus:bg-white focus:border-indigo-500 transition-all italic appearance-none cursor-pointer outline-none shadow-inner">
                            <option value="5">5 ★ Elite</option>
                            <option value="4">4 ★ Reliable</option>
                            <option value="3">3 ★ Nominal</option>
                            <option value="2">2 ★ Below</option>
                            <option value="1">1 ★ Breach</option>
                        </select>
                        <div class="absolute right-8 top-1/2 -translate-y-1/2 pointer-events-none text-gray-300">
                             <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>
                <div class="md:col-span-3 space-y-4 md:space-y-5">
                    <label class="text-[10px] md:text-[11px] font-black text-gray-400 uppercase tracking-widest ms-6 md:ms-8 italic leading-none">Conduct Testimony</label>
                    <input type="text" name="comment" required placeholder="Record operator conduct artifacts..." class="w-full bg-gray-50 border-2 border-white rounded-[2rem] p-6 text-[#050B1A] font-bold text-xs uppercase tracking-widest italic placeholder-gray-300 focus:bg-white focus:border-indigo-500 transition-all outline-none shadow-inner">
                </div>
            </div>
            
            <div class="pt-6">
                <button type="submit" class="w-full py-8 bg-indigo-600 hover:bg-indigo-700 text-white font-black text-[11px] md:text-[12px] uppercase tracking-widest rounded-[2.5rem] shadow-xl shadow-indigo-600/20 transition-all hover:scale-[1.02] italic leading-none">Commit Conduct Manifest</button>
                <button type="button" @click="activePanel = null" class="w-full mt-6 text-[9px] font-black text-gray-400 uppercase tracking-widest hover:text-[#050B1A] transition-colors italic text-center leading-none">Abort Command</button>
            </div>
        </form>
    </div>
</div>
