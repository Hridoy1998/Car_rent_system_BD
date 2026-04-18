@props(['car'])

<div class="bg-white border border-gray-100 rounded-[2rem] overflow-hidden hover:shadow-2xl hover:shadow-blue-900/10 transition-all duration-500 group flex flex-col h-full relative" data-aos="fade-up">
    <!-- Image Container -->
    <div class="relative pt-8 pb-4 px-8 bg-gray-50 group-hover:bg-blue-900/[0.01] transition-colors overflow-hidden">
        <a href="{{ route('cars.show', $car) }}" class="block">
            <img src="{{ $car->primary_image_url }}" alt="{{ $car->brand }} {{ $car->model }}" 
                 class="w-full h-44 object-contain group-hover:scale-105 transition-all duration-700 relative z-10">
        </a>
        
        @auth
        <div x-data="{ 
            favorited: {{ auth()->user()->favorites()->where('car_id', $car->id)->exists() ? 'true' : 'false' }},
            saving: false,
            toggle() {
                if(this.saving) return;
                this.saving = true;
                fetch('{{ route('customer.favorites.toggle', $car) }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                }).then(res => {
                    if(res.ok) this.favorited = !this.favorited;
                }).finally(() => this.saving = false);
            }
        }" class="absolute top-6 right-6 z-30">
            <button @click="toggle()" :disabled="saving" class="w-10 h-10 lg:w-12 lg:h-12 bg-white/90 backdrop-blur-md hover:bg-orange-500 text-red-500 hover:text-white rounded-2xl shadow-2xl transition-all hover:scale-110 active:scale-95 border border-white/20 flex items-center justify-center disabled:opacity-50">
                <svg :class="favorited ? 'fill-current' : 'fill-none'" class="w-5 h-5 transition-transform duration-300 group-hover:scale-125" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
            </button>
        </div>
        @endauth

        @if(!$car->is_available)
            <div class="absolute inset-0 bg-white/60 backdrop-blur-[2px] flex items-center justify-center z-20">
                <span class="px-5 py-2 bg-gray-900 text-white text-[10px] font-black uppercase tracking-[0.3em] rounded-xl shadow-xl">Fully Booked</span>
            </div>
        @endif
    </div>
    
    <!-- Content Area -->
    <div class="p-8 flex-1 flex flex-col justify-between">
        <div class="space-y-6">
            <div class="text-center">
                <h3 class="text-xl font-black text-gray-900 tracking-tight leading-none mb-2">
                    <a href="{{ route('cars.show', $car) }}" class="hover:text-blue-900 transition-colors uppercase italic">{{ $car->brand }} <span class="text-blue-900">{{ $car->model }}</span></a>
                </h3>
                @if($car->type)
                    <p class="text-[10px] text-blue-500 font-black uppercase tracking-[0.2em] italic">{{ $car->type }} Series</p>
                @endif
            </div>
            
            <!-- 4-Spec Grid (Autovia Style) -->
            <div class="grid grid-cols-2 gap-y-4 gap-x-6 py-6 border-y border-gray-50">
                <div class="flex items-center gap-2.5">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">{{ $car->year }}</span>
                </div>
                <div class="flex items-center gap-2.5">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                    <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest truncate">{{ $car->transmission }}</span>
                </div>
                <div class="flex items-center gap-2.5">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V6m0 8h9m-9 0H5m12 1a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">{{ $car->fuel_type }}</span>
                </div>
                <div class="flex items-center gap-2.5">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2m16-10a4 4 0 11-8 0 4 4 0 018 0zM9 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">{{ $car->seats }} Seats</span>
                </div>
            </div>
        </div>
        
        <div class="flex items-center justify-between pt-6">
            <div>
                <div class="text-2xl font-black text-gray-900 italic tracking-tighter">৳{{ number_format($car->price_per_day, 0) }}<span class="text-[10px] text-gray-400 font-bold not-italic tracking-widest ml-1">/DAY</span></div>
            </div>
            <a href="{{ route('cars.show', $car) }}" class="px-8 py-3.5 bg-blue-900 hover:bg-orange-500 text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-xl transition-all duration-300 shadow-xl shadow-blue-900/10 hover:shadow-orange-500/20 active:scale-95 italic">
                View Details
            </a>
        </div>
    </div>
</div>
