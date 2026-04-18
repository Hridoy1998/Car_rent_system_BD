<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-8">
            <div>
                <h2 class="font-black text-4xl text-gray-900 tracking-tighter uppercase italic leading-none">
                    Identity <span class="text-orange-500">Authorization</span>
                </h2>
                <p class="text-[10px] text-gray-400 font-black uppercase tracking-[0.4em] mt-3 italic">
                    Sovereign Identity Registry Protocol
                </p>
            </div>
            <div class="flex items-center gap-4 bg-[#050B1A] px-6 py-3 rounded-2xl border border-white/10 shadow-xl shadow-blue-900/10">
                <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
                <span class="text-white text-[10px] font-black uppercase tracking-[0.2em] italic">Secure Terminal Active</span>
            </div>
        </div>
    </x-slot>

    <div class="py-20 bg-gray-50 min-h-screen relative overflow-hidden">
        <!-- Institutional Decoration -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#050B1A 1px, transparent 1px); background-size: 40px 40px;"></div>
        
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-12 relative z-10">
            
            @if(session('success'))
                <div class="mb-10 bg-emerald-50 border border-emerald-100 p-6 rounded-[2rem] flex items-center gap-6 shadow-xl shadow-emerald-900/5" data-aos="fade-down">
                    <div class="w-12 h-12 bg-emerald-500 rounded-2xl flex items-center justify-center text-white shrink-0 shadow-lg shadow-emerald-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-[10px] font-black text-emerald-900 uppercase tracking-widest italic mb-1">Authorization Success</h4>
                        <p class="text-[11px] font-bold text-emerald-600 uppercase tracking-widest italic">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-10 bg-red-50 border border-red-100 p-6 rounded-[2rem] flex items-center gap-6 shadow-xl shadow-red-900/5" data-aos="fade-down">
                    <div class="w-12 h-12 bg-red-500 rounded-2xl flex items-center justify-center text-white shrink-0 shadow-lg shadow-red-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-[10px] font-black text-red-900 uppercase tracking-widest italic mb-1">Authorization Breach</h4>
                        <p class="text-[11px] font-bold text-red-600 uppercase tracking-widest italic">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-white border border-gray-100 rounded-[3.5rem] p-12 lg:p-16 shadow-[0_40px_100px_rgba(0,0,0,0.03)] relative overflow-hidden group">
                <div class="absolute -right-20 -top-20 w-80 h-80 bg-blue-900/[0.02] rounded-full blur-[100px]"></div>
                
                <!-- Protocol Header -->
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-10 mb-16 pb-16 border-b border-gray-100">
                    <div class="flex items-center gap-8">
                        <div class="w-20 h-20 rounded-[2rem] bg-[#050B1A] flex items-center justify-center text-orange-500 shadow-2xl shadow-blue-900/20">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-3xl font-black text-gray-900 tracking-tighter uppercase italic leading-none mb-3">Identity Protocol</h3>
                            <p class="text-[10px] text-gray-400 font-black uppercase tracking-[0.4em] italic">Establish Trust within the CRS BD Network</p>
                        </div>
                    </div>
                </div>

                @if($verification)
                    <div class="mb-16">
                        <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.5em] mb-10 italic flex items-center gap-4">
                            <span class="w-12 h-px bg-gray-200"></span> Active Authorization Record
                        </h4>
                        
                        <div class="relative bg-gray-50 rounded-[2.5rem] p-10 border border-gray-100 overflow-hidden group/card transition-all duration-500 hover:shadow-2xl hover:bg-white">
                            <div class="flex flex-col md:flex-row items-center gap-12 relative z-10">
                                <div class="w-48 h-32 rounded-[1.5rem] bg-gray-200 overflow-hidden border-4 border-white shadow-xl italic shrink-0">
                                    <img src="{{ $verification->document_file_url }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1 text-center md:text-left">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-6">
                                        <div>
                                            <h3 class="text-2xl font-black text-[#050B1A] tracking-tighter uppercase italic leading-none mb-2">{{ $verification->document_type }}</h3>
                                            <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest italic">Serialized ID: {{ $verification->id_number }}</p>
                                        </div>
                                        <div class="px-8 py-3 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] italic border
                                            {{ $verification->status === 'approved' ? 'bg-emerald-500/10 text-emerald-600 border-emerald-500/20 shadow-[0_0_20px_rgba(16,185,129,0.1)]' : ($verification->status === 'rejected' ? 'bg-red-500/10 text-red-600 border-red-500/20 shadow-[0_0_20px_rgba(225,29,72,0.1)]' : 'bg-orange-500/10 text-orange-600 border-orange-500/20 shadow-[0_0_20px_rgba(249,115,22,0.1)]') }}">
                                            Protocol Status: {{ $verification->status }}
                                        </div>
                                    </div>
                                    
                                    @if($verification->status === 'rejected')
                                        <div class="p-6 bg-red-50 rounded-2xl border border-red-100 italic">
                                            <p class="text-[11px] font-bold text-red-600 uppercase tracking-widest leading-loose">
                                                Identity Breach: The submitted documentation did not meet institutional standards. Please authorize a high-fidelity re-submission below.
                                            </p>
                                        </div>
                                    @elseif($verification->status === 'pending')
                                        <div class="p-6 bg-orange-50 rounded-2xl border border-orange-100 italic">
                                            <p class="text-[11px] font-bold text-orange-600 uppercase tracking-widest leading-loose text-center">
                                                Verification in Progress: Institutional assets are currently auditing your identity. Clearance usually occurs within 12-24 hours.
                                            </p>
                                        </div>
                                    @else
                                        <div class="p-6 bg-emerald-50 rounded-2xl border border-emerald-100 italic">
                                            <p class="text-[11px] font-bold text-emerald-600 uppercase tracking-widest leading-loose text-center">
                                                Sovereign Clearance: Your identity is authenticated. You have unrestricted access to elite vehicle units.
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if(!$verification || $verification->status === 'rejected')
                    <div class="space-y-12">
                        <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.5em] mb-10 italic flex items-center gap-4">
                            <span class="w-12 h-px bg-gray-200"></span> Identity Submission Terminal
                        </h4>
                        
                        <form action="{{ route('customer.verifications.store') }}" method="POST" enctype="multipart/form-data" class="space-y-12">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                <div class="space-y-6">
                                    <label class="text-xs font-black text-[#050B1A] uppercase tracking-[0.2em] italic ms-4">1. Document Type</label>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest italic ms-4 -mt-4">Select your identification method</p>
                                    <select name="document_type" required class="w-full bg-gray-50 border-2 border-gray-300 rounded-2xl px-8 py-6 text-gray-900 font-bold uppercase italic tracking-widest focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all text-sm outline-none shadow-inner">
                                        <option value="NID">National ID (NID)</option>
                                        <option value="Passport">Passport</option>
                                        <option value="Drivers_License">Driver's License</option>
                                    </select>
                                </div>

                                <div class="space-y-6">
                                    <label class="text-xs font-black text-[#050B1A] uppercase tracking-[0.2em] italic ms-4">2. ID Number</label>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest italic ms-4 -mt-4">Enter the number on your document</p>
                                    <input type="text" name="id_number" required placeholder="e.g. 1998XXXXXXXXXXXX" class="w-full bg-gray-50 border-2 border-gray-300 rounded-2xl px-8 py-6 text-gray-900 font-bold uppercase italic tracking-widest focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all text-sm outline-none shadow-inner placeholder:text-gray-300">
                                </div>
                            </div>

                            <div class="space-y-6">
                                <label class="text-xs font-black text-[#050B1A] uppercase tracking-[0.2em] italic ms-4">3. Document Photo</label>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest italic ms-4 -mt-4">Upload a clear photo of your ID (Front Side)</p>
                                <div class="relative group cursor-pointer">
                                    <input type="file" name="document_file" required accept="image/jpeg,image/png,image/jpg" class="absolute inset-0 w-full h-full opacity-0 z-20 cursor-pointer">
                                    <div class="bg-gray-50 border-2 border-dashed border-gray-300 rounded-[3rem] p-20 text-center group-hover:border-orange-500 transition-all duration-500 relative overflow-hidden shadow-inner">
                                        <div class="absolute inset-0 bg-orange-500 opacity-0 group-hover:opacity-[0.02] transition-opacity"></div>
                                        <div class="mb-8 mx-auto w-24 h-24 bg-white rounded-[2rem] flex items-center justify-center text-gray-300 shadow-xl group-hover:text-orange-500 transition-colors">
                                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        </div>
                                        <h5 class="text-sm font-black text-gray-900 uppercase tracking-widest italic mb-2">Click to Upload Document</h5>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.3em] italic">Ensure all text is readable and no glare is visible</p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-8 bg-[#050B1A] rounded-[2.5rem] flex flex-col md:flex-row items-center justify-between gap-8 shadow-2xl shadow-blue-900/20 italic">
                                <div class="flex items-center gap-6">
                                    <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-orange-500">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    </div>
                                    <p class="text-[10px] text-white/60 font-black uppercase tracking-widest leading-loose md:max-w-md">
                                        Protocol Agreement: By initiating this authorization, you confirm the absolute authenticity of all identifiers provided.
                                    </p>
                                </div>
                                <button type="submit" class="px-12 py-6 bg-orange-500 text-white font-black text-[12px] uppercase tracking-[0.4em] rounded-2xl shadow-xl shadow-orange-500/30 hover:bg-white hover:text-orange-500 transition-all duration-500 whitespace-nowrap">
                                    Initiate Authorization
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>

            <!-- Operational Intel Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="bg-white border border-gray-100 p-10 rounded-[2.5rem] shadow-xl shadow-blue-900/5 group hover:border-[#050B1A]/20 transition-all duration-500">
                    <div class="w-14 h-14 bg-gray-50 rounded-2xl flex items-center justify-center text-[#050B1A] mb-8 shadow-inner group-hover:bg-[#050B1A] group-hover:text-white transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h5 class="text-[11px] font-black text-[#050B1A] uppercase tracking-[0.3em] mb-4 italic">Fidelity Audit</h5>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest leading-loose italic">Precision verification ensures unit safety and operator accountability across the network.</p>
                </div>
                <div class="bg-white border border-gray-100 p-10 rounded-[2.5rem] shadow-xl shadow-blue-900/5 group hover:border-[#050B1A]/20 transition-all duration-500">
                    <div class="w-14 h-14 bg-gray-50 rounded-2xl flex items-center justify-center text-[#050B1A] mb-8 shadow-inner group-hover:bg-[#050B1A] group-hover:text-white transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h5 class="text-[11px] font-black text-[#050B1A] uppercase tracking-[0.3em] mb-4 italic">Rapid Clearance</h5>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest leading-loose italic">Institutional assets process submissions with mission-critical speed, usually within 24 hours.</p>
                </div>
                <div class="bg-white border border-gray-100 p-10 rounded-[2.5rem] shadow-xl shadow-blue-900/5 group hover:border-[#050B1A]/20 transition-all duration-500">
                    <div class="w-14 h-14 bg-gray-50 rounded-2xl flex items-center justify-center text-[#050B1A] mb-8 shadow-inner group-hover:bg-[#050B1A] group-hover:text-white transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h5 class="text-[11px] font-black text-[#050B1A] uppercase tracking-[0.3em] mb-4 italic">Protocol Assistance</h5>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest leading-loose italic">Our tactical support hub is online 24/7 to resolve identity authorization bottlenecks.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
