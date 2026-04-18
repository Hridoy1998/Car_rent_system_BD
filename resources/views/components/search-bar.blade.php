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
               class="w-full md:w-96 bg-gray-50 border border-gray-100 rounded-2xl py-4 pl-12 pr-4 text-[10px] text-blue-900 font-black uppercase tracking-[0.2em] focus:ring-4 focus:ring-blue-900/5 focus:border-blue-900 transition-all outline-none placeholder:text-gray-300 italic group-hover:border-gray-200 shadow-xl shadow-blue-900/[0.02]">
        
        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-hover:text-blue-900 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>

        @if($value)
            <a href="{{ $route . '?' . http_build_query(request()->except('search', 'page')) }}" 
               class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-orange-500 transition-colors"
               title="Reset Registry Query">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </a>
        @endif
    </div>
</form>
