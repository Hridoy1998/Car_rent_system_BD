@props(['route', 'placeholder' => 'Search identities, assets, or records...', 'value' => request('search')])

<form action="{{ $route }}" method="GET" class="relative group">
    @foreach(request()->except('search', 'page') as $key => $val)
        <input type="hidden" name="{{ $key }}" value="{{ $val }}">
    @endforeach
    
    <div class="relative">
        <input type="text" 
               name="search" 
               value="{{ $value }}" 
               placeholder="{{ $placeholder }}" 
               class="w-full md:w-96 bg-gray-950/50 backdrop-blur-xl border border-white/5 rounded-2xl py-4 pl-12 pr-4 text-sm text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none placeholder:text-gray-700 placeholder:italic font-medium group-hover:border-white/10">
        
        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-600 group-hover:text-indigo-400 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>

        @if($value)
            <a href="{{ $route . '?' . http_build_query(request()->except('search', 'page')) }}" 
               class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-white transition-colors"
               title="Clear Tactical Query">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </a>
        @endif
    </div>
</form>
