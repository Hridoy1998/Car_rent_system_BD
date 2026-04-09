<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white leading-tight">
            {{ __('Identity Verification') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen relative overflow-hidden">
        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-indigo-600/10 rounded-full blur-[120px] -z-10"></div>

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 bg-green-500/10 border border-green-500/30 text-green-400 px-4 py-3 rounded-xl backdrop-blur-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 overflow-hidden shadow-2xl sm:rounded-3xl p-10">
                
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 rounded-xl bg-indigo-500/20 flex items-center justify-center text-indigo-400 border border-indigo-500/30 shadow-[0_0_15px_rgba(79,70,229,0.2)]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-white tracking-tight leading-tight">Secure Verification</h3>
                        <p class="text-sm text-gray-500">Enable high-value vehicle bookings.</p>
                    </div>
                </div>

                @if($verification)
                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r {{ $verification->status === 'approved' ? 'from-emerald-600 to-teal-600 shadow-[0_0_20px_rgba(16,185,129,0.2)]' : ($verification->status === 'rejected' ? 'from-red-600 to-rose-600 shadow-[0_0_20px_rgba(225,29,72,0.2)]' : 'from-amber-600 to-orange-600 shadow-[0_0_20px_rgba(245,158,11,0.2)]') }} rounded-2xl opacity-30 blur-sm"></div>
                        <div class="relative p-6 bg-gray-950/80 rounded-2xl border border-white/5 backdrop-blur-sm">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-xs font-bold text-gray-500 uppercase tracking-widest">Current Status</span>
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-tight border shadow-lg 
                                    {{ $verification->status === 'approved' ? 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' : ($verification->status === 'rejected' ? 'bg-red-500/10 text-red-500 border-red-500/20' : 'bg-amber-500/10 text-amber-500 border-amber-500/20') }}">
                                    {{ $verification->status }}
                                </span>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-12 bg-gray-900 rounded-lg overflow-hidden border border-white/10">
                                    <img src="{{ Storage::url($verification->document_file) }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <p class="text-white font-bold">{{ $verification->document_type }}</p>
                                    <p class="text-xs text-gray-500 italic">Submitted on {{ $verification->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                            
                            @if($verification->status === 'rejected')
                                <div class="mt-6 pt-6 border-t border-white/5">
                                    <p class="text-sm text-red-400 leading-relaxed font-medium">Your submission was rejected by our compliance team. Please review our requirements and re-submit a clear, non-glare photo of your document below.</p>
                                </div>
                            @elseif($verification->status === 'pending')
                                <div class="mt-6 pt-6 border-t border-white/5">
                                    <p class="text-sm text-gray-400 leading-relaxed">Our team is currently reviewing your identity. This usually takes less than 24 hours. You will be notified once complete.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                @if(!$verification || $verification->status === 'rejected')
                    <div class="mt-10">
                         <form action="{{ route('customer.verifications.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="space-y-8">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ms-1">Document Type</label>
                                        <select name="document_type" required class="w-full bg-gray-950 border border-white/5 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 transition-all">
                                            <option value="NID">National ID (NID)</option>
                                            <option value="Passport">Passport</option>
                                            <option value="Drivers_License">Driver's License</option>
                                        </select>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ms-1">Identity File</label>
                                        <div class="relative group cursor-pointer">
                                            <input type="file" name="document_file" required accept="image/jpeg,image/png,image/jpg" class="absolute inset-0 w-full h-full opacity-0 z-20 cursor-pointer">
                                            <div class="bg-gray-950 border border-white/5 rounded-xl px-4 py-3 text-sm text-gray-400 flex items-center justify-between group-hover:border-indigo-500/50 transition-colors">
                                                <span class="truncate">Select JPEG or PNG...</span>
                                                <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-4 bg-indigo-500/5 rounded-2xl border border-indigo-500/10">
                                    <div class="flex items-start gap-3">
                                        <svg class="w-5 h-5 text-indigo-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <p class="text-xs text-gray-400 leading-relaxed italic">By submitting, you agree to our terms of service and verify that the document provided is original and belongs to you.</p>
                                    </div>
                                </div>

                                <button type="submit" class="w-full py-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white rounded-xl font-bold shadow-[0_0_20px_rgba(79,70,229,0.3)] hover:shadow-[0_0_30px_rgba(79,70,229,0.5)] transition-all text-lg tracking-wide">
                                    Securely Submit ID
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
            
        </div>
    </div>
</x-app-layout>
