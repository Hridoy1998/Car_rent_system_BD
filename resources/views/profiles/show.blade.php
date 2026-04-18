<x-public-layout>
    <x-slot name="title">{{ $user->name }} - Sovereign Identity Record | CRS BD</x-slot>

    <!-- Sovereign Identity Hero: High-Impact Branding -->
    <div class="relative pt-48 pb-32 bg-[#050B1A] overflow-hidden">
        <div class="absolute inset-0 opacity-[0.05] bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] mix-blend-overlay"></div>
        <div class="absolute top-0 right-0 w-1/2 h-full bg-blue-900/10 rounded-bl-full blur-[150px]"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
            <div class="flex flex-col lg:flex-row items-center gap-16 lg:gap-24">
                <!-- Identity Asset (Avatar) -->
                <div class="relative group">
                    <div class="absolute -inset-10 bg-blue-500/10 blur-[80px] rounded-full group-hover:bg-blue-500/20 transition-all duration-1000"></div>
                    <div class="relative w-48 h-48 lg:w-72 lg:h-72 rounded-[4rem] bg-gray-900 border-8 border-white/5 shadow-2xl overflow-hidden flex items-center justify-center text-8xl font-black text-white italic transform transition-transform duration-700 group-hover:scale-105">
                        @if($user->profile_photo)
                            <img src="{{ Storage::url($user->profile_photo) }}" class="w-full h-full object-cover">
                        @else
                            {{ substr($user->name, 0, 1) }}
                        @endif
                    </div>
                    @if($user->is_verified)
                        <div class="absolute -bottom-4 -right-4 w-20 h-20 bg-emerald-500 rounded-[2rem] border-8 border-[#050B1A] flex items-center justify-center shadow-2xl" title="Identity Verified">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                    @endif
                </div>

                <!-- Identity Briefing -->
                <div class="flex-1 text-center lg:text-left space-y-10">
                    <div class="space-y-6">
                        <div class="flex items-center justify-center lg:justify-start gap-4">
                            <span class="h-0.5 w-12 bg-orange-500"></span>
                            <span class="text-[12px] font-black text-white uppercase tracking-[0.5em] italic">Established Member Hub | since {{ $user->created_at->format('Y') }}</span>
                        </div>
                        <h1 class="text-6xl md:text-8xl lg:text-9xl font-black text-white uppercase tracking-tighter italic leading-none">
                            {{ explode(' ', $user->name)[0] }} <br/>
                            <span class="text-orange-500 drop-shadow-[0_0_50px_rgba(249,115,22,0.3)]">{{ explode(' ', $user->name, 2)[1] ?? '' }}</span>
                        </h1>
                        <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4">
                            <span class="px-6 py-2 bg-blue-600 rounded-xl text-[10px] font-black text-white uppercase tracking-[0.3em] italic shadow-lg shadow-blue-600/20">Certified {{ $user->role }}</span>
                            @if($user->address)
                                <span class="px-6 py-2 bg-white/5 border border-white/10 rounded-xl text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] italic">{{ $user->address }} Sector</span>
                            @endif
                        </div>
                    </div>

                    <div class="w-full h-1 bg-white/5 relative overflow-hidden rounded-full max-w-2xl mx-auto lg:mx-0">
                        <div class="absolute inset-0 w-1/2 bg-orange-500 shadow-[0_0_20px_rgba(249,115,22,0.5)]"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Intelligence Stats Panel: Floating Data Bar -->
    <div class="relative z-20 max-w-5xl mx-auto px-4 -mt-16" data-aos="zoom-in" data-aos-delay="200">
        <div class="bg-white rounded-[2.5rem] p-10 md:p-14 shadow-[0_50px_100px_rgba(0,0,0,0.1)] border border-gray-100 grid grid-cols-1 md:grid-cols-3 gap-12 text-center divide-y md:divide-y-0 md:divide-x divide-gray-100">
            <div class="space-y-3">
                <div class="flex justify-center gap-1 mb-2">
                    @for($i=0; $i<5; $i++)
                        <svg class="w-5 h-5 {{ $i < round($stats['rating']) ? 'text-orange-500' : 'text-gray-100' }} fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    @endfor
                </div>
                <div class="text-4xl font-black text-[#050B1A] tracking-tighter italic leading-none">{{ number_format($stats['rating'], 1) }}</div>
                <div class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic">Performance Rating</div>
            </div>
            <div class="space-y-3 pt-12 md:pt-0">
                <div class="text-xs font-black text-orange-500 uppercase tracking-[0.4em] mb-4 italic">Operational</div>
                <div class="text-4xl font-black text-[#050B1A] tracking-tighter italic leading-none">{{ $stats['host_trips'] }}</div>
                <div class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic">Missions Hosted</div>
            </div>
            <div class="space-y-3 pt-12 md:pt-0">
                <div class="text-xs font-black text-blue-600 uppercase tracking-[0.4em] mb-4 italic">Engagement</div>
                <div class="text-4xl font-black text-[#050B1A] tracking-tighter italic leading-none">{{ $stats['renter_trips'] }}</div>
                <div class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic">Missions Completed</div>
            </div>
        </div>
    </div>

    <!-- Main Content Stream -->
    <div class="bg-white py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-32">
            
            <!-- Intel Dossier: Protocol Statement -->
            <section class="max-w-4xl mx-auto text-center space-y-12" data-aos="fade-up">
                <div class="flex flex-col items-center gap-4">
                    <span class="w-1.5 h-12 bg-orange-500 rounded-full"></span>
                    <h2 class="text-4xl md:text-5xl font-black text-gray-900 uppercase italic tracking-tighter">Intel <span class="text-orange-500">Dossier</span></h2>
                </div>
                <p class="text-xl md:text-3xl font-black text-gray-900 uppercase italic tracking-widest leading-loose">
                    "{{ $user->bio ?: 'This member maintains elite operational clearance within the CRS BD logistics network, adhering to full maintenance protocols and professional integrity standards.' }}"
                </p>
                <div class="flex justify-center gap-10 text-[10px] font-black text-gray-400 uppercase tracking-[0.4em] italic">
                    <span class="flex items-center gap-3"><span class="w-2 h-2 rounded-full bg-emerald-500"></span> Identity Authenticated</span>
                    <span class="flex items-center gap-3"><span class="w-2 h-2 rounded-full bg-blue-500"></span> Strategic Contributor</span>
                </div>
            </section>

            <!-- Operational Portfolio: Global Card Integration -->
            @if($user->role === 'owner' || $user->role === 'admin')
                <section class="space-y-16" data-aos="fade-up">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-6">
                            <span class="w-2 h-14 bg-[#050B1A] rounded-full"></span>
                            <h2 class="text-4xl font-black text-gray-900 uppercase italic tracking-tight">Operational <span class="text-blue-900">Portfolio</span></h2>
                        </div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.5em] italic hidden md:block">{{ count($cars) }} ACTIVE ASSETS DETECTED</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                        @forelse($cars as $car)
                            <x-car-card :car="$car" />
                        @empty
                            <div class="col-span-full py-32 text-center bg-gray-50 rounded-[3rem] border-2 border-dashed border-gray-200 opacity-50">
                                <p class="text-[10px] font-black uppercase tracking-[0.5em] italic text-gray-400">Zero Active Assets in This Sector</p>
                            </div>
                        @endforelse
                    </div>
                </section>
            @endif

            <!-- Perception Ledger: Community Reviews -->
            <section class="space-y-16" data-aos="fade-up">
                <div class="flex items-center gap-6 text-left">
                    <span class="w-2 h-14 bg-emerald-500 rounded-full"></span>
                    <h2 class="text-4xl font-black text-gray-900 uppercase italic tracking-tight">Perception <span class="text-emerald-500">Ledger</span></h2>
                </div>

                @if($userReviews->isNotEmpty())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                        @foreach($userReviews as $review)
                            <div class="bg-gray-50 border border-gray-100 rounded-[3rem] p-12 transition-all hover:bg-white hover:shadow-2xl hover:border-blue-900/10 group cursor-default">
                                <div class="flex items-center gap-6 mb-10">
                                    <div class="w-16 h-16 rounded-[1.5rem] bg-[#050B1A] border-4 border-white shadow-xl flex items-center justify-center text-sm font-black text-white italic overflow-hidden transform group-hover:scale-110 transition-transform duration-700">
                                        <img src="{{ $review->reviewer->profile_photo_url }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="min-w-0">
                                        <h4 class="text-gray-900 font-black uppercase italic tracking-tighter truncate leading-none mb-2">{{ $review->reviewer->name }}</h4>
                                        <div class="text-[9px] text-gray-400 uppercase tracking-[0.3em] font-black italic">{{ $review->reviewer->role }} • Intelligence Signal</div>
                                    </div>
                                </div>
                                <div class="bg-white rounded-2xl p-6 border border-gray-100 italic relative mb-8">
                                    <div class="text-4xl text-blue-900/10 absolute top-4 left-4 leading-none">“</div>
                                    <p class="text-xs font-black text-gray-900 uppercase tracking-widest leading-loose relative z-10">
                                        {{ $review->comment }}
                                    </p>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex gap-1 text-orange-500">
                                        @for($i=0; $i<5; $i++)
                                            <svg class="w-3 h-3 {{ $i < $review->rating ? 'fill-current' : 'text-gray-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        @endfor
                                    </div>
                                    <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic">{{ $review->created_at->format('M Y') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-gray-50 rounded-[3.5rem] p-24 text-center border-2 border-dashed border-gray-100 opacity-50">
                        <div class="text-5xl mb-8">📡</div>
                        <h3 class="text-xl font-black text-gray-900 uppercase italic tracking-tighter mb-2 leading-none">Zero Feedback Signals</h3>
                        <p class="text-gray-400 text-[9px] font-black uppercase tracking-[0.4em] italic">THIS IDENTITY RECORD HAS NO ASSOCIATED REVIEW LOGS</p>
                    </div>
                @endif
            </section>
        </div>
    </div>

    <!-- Need Help Hub CTA -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-32" data-aos="zoom-in">
        <div class="bg-orange-500 rounded-[3rem] p-16 flex flex-col md:flex-row items-center justify-between shadow-2xl shadow-orange-500/20 relative overflow-hidden italic">
            <div class="relative z-10 space-y-4 text-center md:text-left mb-10 md:mb-0">
                <h2 class="text-4xl md:text-6xl font-black text-white uppercase italic tracking-tighter leading-none">Strategic Question?</h2>
                <p class="text-[10px] font-black text-white uppercase tracking-[0.4em] opacity-80 italic">Contact Our Tactical Support Team Today</p>
            </div>
            <a href="{{ route('pages.contact') }}" class="relative z-10 px-12 py-6 bg-white text-orange-500 font-black text-[10px] uppercase tracking-[0.4em] rounded-2xl shadow-xl hover:bg-[#050B1A] hover:text-white transition-all duration-500 group flex items-center gap-3">
                <svg class="w-5 h-5 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                Contact NOW
            </a>
        </div>
    </section>
</x-public-layout>
