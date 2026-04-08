<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">{{ __('Promo Codes') }}</h2>
        </div>
    </x-slot>

    <div class="py-12 relative z-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-green-500/10 border border-green-500/30 text-green-400 px-4 py-3 rounded-xl">{{ session('success') }}</div>
            @endif

            <!-- Create Form -->
            <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 shadow-2xl sm:rounded-2xl p-8">
                <h3 class="text-lg font-bold text-white mb-6">Create New Promo Code</h3>
                <form action="{{ route('admin.promo-codes.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold tracking-widest text-gray-400 uppercase mb-2">Code</label>
                            <input type="text" name="code" value="{{ old('code') }}" required class="w-full bg-gray-800 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500" placeholder="SUMMER25">
                            @error('code')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold tracking-widest text-gray-400 uppercase mb-2">Discount Type</label>
                            <select name="discount_type" required class="w-full bg-gray-800 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500">
                                <option value="percentage" {{ old('discount_type') === 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                                <option value="fixed" {{ old('discount_type') === 'fixed' ? 'selected' : '' }}>Fixed Amount (৳)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold tracking-widest text-gray-400 uppercase mb-2">Discount Value</label>
                            <input type="number" name="discount_value" value="{{ old('discount_value') }}" required min="0.01" step="0.01" class="w-full bg-gray-800 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500">
                            @error('discount_value')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold tracking-widest text-gray-400 uppercase mb-2">Expiry Date</label>
                            <input type="date" name="expiry_date" value="{{ old('expiry_date') }}" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full bg-gray-800 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500">
                            @error('expiry_date')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <button type="submit" class="mt-6 px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 text-white rounded-xl font-bold shadow-lg transition-all">
                        Create Promo Code
                    </button>
                </form>
            </div>

            <!-- Existing Codes -->
            <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 shadow-2xl sm:rounded-2xl overflow-hidden">
                @if($promoCodes->count() > 0)
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-800/50 border-b border-white/10 uppercase text-xs tracking-wider text-gray-400">
                                <th class="p-4">Code</th>
                                <th class="p-4">Discount</th>
                                <th class="p-4">Expiry</th>
                                <th class="p-4">Status</th>
                                <th class="p-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($promoCodes as $promo)
                                <tr class="hover:bg-white/5 transition-colors">
                                    <td class="p-4 font-mono font-bold text-indigo-400">{{ $promo->code }}</td>
                                    <td class="p-4 text-white">
                                        @if($promo->discount_type === 'percentage')
                                            {{ $promo->discount_value }}%
                                        @else
                                            ৳{{ number_format($promo->discount_value) }}
                                        @endif
                                    </td>
                                    <td class="p-4 text-gray-300">{{ \Carbon\Carbon::parse($promo->expiry_date)->format('M d, Y') }}</td>
                                    <td class="p-4">
                                        @if($promo->isValid())
                                            <span class="px-2 py-1 bg-green-500/10 text-green-400 border border-green-500/20 rounded text-xs font-bold uppercase">Active</span>
                                        @else
                                            <span class="px-2 py-1 bg-red-500/10 text-red-400 border border-red-500/20 rounded text-xs font-bold uppercase">Expired</span>
                                        @endif
                                    </td>
                                    <td class="p-4">
                                        <form action="{{ route('admin.promo-codes.destroy', $promo) }}" method="POST" onsubmit="return confirm('Delete this promo code?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-xs bg-red-500/10 hover:bg-red-500/20 text-red-400 px-3 py-1.5 rounded-lg border border-red-500/30 transition-colors font-bold uppercase">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="p-4 border-t border-white/10">{{ $promoCodes->links() }}</div>
                @else
                    <div class="p-12 text-center text-gray-400">No promo codes created yet.</div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
