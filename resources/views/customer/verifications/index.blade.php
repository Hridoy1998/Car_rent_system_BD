<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Identity Verification') }}
        </h2>
    </x-slot>

    <div class="py-12 relative z-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 bg-green-500/10 border border-green-500/30 text-green-400 px-4 py-3 rounded-xl backdrop-blur-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-3 rounded-xl backdrop-blur-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 overflow-hidden shadow-2xl sm:rounded-2xl p-8">
                
                <h3 class="text-2xl font-bold text-white tracking-tight mb-4">Account Verification</h3>
                <p class="text-gray-400 mb-8">Before you can book high-value vehicles, you must provide proof of identity. Upload an official document (NID, Passport, or Driver's License).</p>

                @if($verification)
                    <div class="p-6 rounded-xl border {{ $verification->status === 'approved' ? 'border-green-500/30 bg-green-500/10' : ($verification->status === 'rejected' ? 'border-red-500/30 bg-red-500/10' : 'border-yellow-500/30 bg-yellow-500/10') }}">
                        <p class="text-white font-bold mb-2">Current Status:
                            <span class="uppercase tracking-wider px-2 py-1 rounded text-xs ml-2
                                {{ $verification->status === 'approved' ? 'bg-green-500/20 text-green-400' : ($verification->status === 'rejected' ? 'bg-red-500/20 text-red-400' : 'bg-yellow-500/20 text-yellow-400') }}">
                                {{ $verification->status }}
                            </span>
                        </p>
                        <p class="text-sm text-gray-400">Document Type: {{ $verification->document_type }}</p>
                        @if($verification->status === 'rejected')
                            <p class="text-sm text-red-400 mt-4">Your previous document was rejected. Please submit a clear, readable document below.</p>
                        @endif
                    </div>
                @endif

                @if(!$verification || $verification->status === 'rejected')
                    <form action="{{ route('customer.verifications.store') }}" method="POST" enctype="multipart/form-data" class="mt-8">
                        @csrf
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-bold tracking-wider text-gray-400 mb-2">Document Type</label>
                                <select name="document_type" required class="w-full bg-gray-800 border-white/10 rounded-xl px-4 py-3 text-white focus:ring-indigo-500">
                                    <option value="NID">National ID (NID)</option>
                                    <option value="Passport">Passport</option>
                                    <option value="Drivers_License">Driver's License</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-bold tracking-wider text-gray-400 mb-2">Upload File</label>
                                <input type="file" name="document_file" required accept="image/jpeg,image/png,image/jpg" class="w-full text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-gray-800 file:text-indigo-400 hover:file:bg-gray-700">
                                <p class="text-xs text-gray-500 mt-2">JPEG or PNG. Max size 5MB.</p>
                            </div>

                            <button type="submit" class="w-full py-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 text-white rounded-xl font-bold shadow-lg shadow-indigo-600/30 transition-all">
                                Submit for Verification
                            </button>
                        </div>
                    </form>
                @endif
            </div>
            
        </div>
    </div>
</x-app-layout>
