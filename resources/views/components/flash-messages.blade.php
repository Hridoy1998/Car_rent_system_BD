@if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
         class="fixed bottom-10 right-10 z-[60] bg-emerald-500/90 backdrop-blur-xl text-white px-8 py-4 rounded-2xl shadow-2xl border border-emerald-400/20 flex items-center gap-4 animate-in slide-in-from-right-10">
        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
        </div>
        <div>
            <p class="text-[10px] font-black uppercase tracking-widest opacity-60 leading-none mb-1">Success Protocol</p>
            <p class="text-xs font-bold">{{ session('success') }}</p>
        </div>
        <button @click="show = false" class="ml-4 opacity-50 hover:opacity-100 transition-opacity">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>
@endif

@if (session('error'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 8000)" 
         class="fixed bottom-10 right-10 z-[60] bg-red-600/90 backdrop-blur-xl text-white px-8 py-4 rounded-2xl shadow-2xl border border-red-500/20 flex items-center gap-4 animate-in slide-in-from-right-10">
        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center text-red-100">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        </div>
        <div>
            <p class="text-[10px] font-black uppercase tracking-widest opacity-60 leading-none mb-1">Protocol Violation</p>
            <p class="text-xs font-bold">{{ session('error') }}</p>
        </div>
        <button @click="show = false" class="ml-4 opacity-50 hover:opacity-100 transition-opacity">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>
@endif
