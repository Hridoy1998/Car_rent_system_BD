<x-public-layout>
    <x-slot name="title">Elite Fleet Logistics - CRS BD Home</x-slot>

    <!-- Phase 1: Cinematic Hero & Tactical Search -->
    <div class="relative min-h-[90vh] flex flex-col justify-center items-center overflow-hidden">
        <!-- Background Hero Image (True Full Width) -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/assets/hero_car.png') }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/20 to-black/90"></div>
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-32 pb-48" data-aos="fade-up">
            <h4 class="text-[8px] sm:text-[10px] font-black text-orange-500 uppercase tracking-[0.6em] mb-6 italic">Mastering Bangladesh Mobility</h4>
            <h1 class="text-3xl sm:text-5xl md:text-7xl lg:text-9xl font-black text-white uppercase tracking-tighter leading-[0.9] md:leading-[0.85] italic mb-8">
                <span class="text-white">CRS</span> <span class="text-orange-500">BD</span> <br/>
                <span class="text-blue-500">Rental</span> Platform
            </h1>
            <p class="text-white/70 font-bold text-[8px] sm:text-[10px] md:text-lg uppercase tracking-[0.2em] max-w-2xl mx-auto leading-loose italic">
                The premier peer-to-peer car sharing marketplace in Bangladesh. Secure rentals and professional standards for every journey.
            </p>
        </div>

        <!-- Search Hub (Unified Pro Design) -->
        <div class="relative md:absolute md:bottom-[-40px] left-0 right-0 z-30 max-w-5xl mx-auto px-4 mt-12 md:mt-0" data-aos="fade-up" data-aos-delay="400">
            <div class="bg-white p-2 rounded-[2rem] shadow-[0_40px_120px_rgba(0,0,0,0.3)] border border-gray-100/50">
                <div class="bg-white p-10 md:p-14 rounded-[1.8rem] border border-gray-50">
                    <form action="{{ route('search') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-10 md:gap-14 items-end">
                        <!-- Location Section -->
                        <div class="space-y-5">
                            <label class="block text-[11px] font-black text-gray-900 uppercase tracking-[0.4em] ml-1 italic">Location</label>
                            <div class="relative group">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-orange-500 transition-transform group-focus-within:scale-110">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                </span>
                                <input type="text" name="location" placeholder="ANY CITY / SECTOR" class="w-full pl-12 pr-6 py-6 bg-white border-2 border-gray-300 rounded-2xl focus:ring-4 focus:ring-blue-900/10 focus:border-blue-900 font-black text-blue-900 uppercase tracking-widest text-xs transition-all italic placeholder-gray-500 shadow-sm">
                            </div>
                        </div>

                        <!-- Date Section 1 -->
                        <div class="space-y-5">
                            <label class="block text-[11px] font-black text-gray-900 uppercase tracking-[0.4em] ml-1 italic">Start Date</label>
                            <div class="relative">
                                <input type="date" name="start_date" class="w-full px-6 py-6 bg-white border-2 border-gray-300 rounded-2xl focus:ring-4 focus:ring-blue-900/10 focus:border-blue-900 font-black text-blue-900 text-xs transition-all uppercase italic shadow-sm">
                            </div>
                        </div>

                        <!-- Date Section 2 -->
                        <div class="space-y-5">
                            <label class="block text-[11px] font-black text-gray-900 uppercase tracking-[0.4em] ml-1 italic">End Date</label>
                            <div class="relative">
                                <input type="date" name="end_date" class="w-full px-6 py-6 bg-white border-2 border-gray-300 rounded-2xl focus:ring-4 focus:ring-blue-900/10 focus:border-blue-900 font-black text-blue-900 text-xs transition-all uppercase italic shadow-sm">
                            </div>
                        </div>

                        <!-- Action Section -->
                        <div>
                            <button type="submit" class="w-full py-6 bg-blue-900 hover:bg-orange-500 text-white font-black rounded-2xl shadow-2xl shadow-blue-900/20 transition-all duration-300 uppercase tracking-[0.2em] italic text-xs flex items-center justify-center gap-3">
                                <span>Search Cars</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Phase 2: Fleet Intelligence Preview (Polished) -->
    <section class="pt-48 pb-32 bg-white relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-b from-gray-100/50 to-white"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-24" data-aos="fade-up">
                <div class="flex flex-col items-center gap-4 mb-6">
                    <span class="text-[12px] font-black text-orange-500 uppercase tracking-[0.6em] italic">OUR COLLECTION</span>
                    <h2 class="text-4xl md:text-6xl font-black text-gray-900 uppercase tracking-tighter leading-tight italic">
                        Preview Our Most <br/> <span class="text-blue-900 text-5xl md:text-7xl">Popular Cars</span>
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @forelse ($featuredCars as $index => $car)
                    <div data-aos="fade-up" data-aos-delay="{{ 100 * ($index % 3) }}">
                        <x-car-card :car="$car" />
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center text-gray-500 bg-white rounded-3xl border-2 border-dashed border-gray-100 italic">
                        <p class="text-[10px] font-black uppercase tracking-[0.4em]">Zero Units Detected in Sector</p>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-20 text-center" data-aos="fade-up">
                <a href="{{ route('search') }}" class="group relative inline-flex items-center justify-center px-14 py-6 bg-blue-900 hover:bg-orange-500 text-white text-[11px] font-black uppercase tracking-[0.4em] rounded-2xl transition-all duration-500 shadow-2xl shadow-blue-900/20 hover:shadow-orange-500/30 active:scale-95 hover:-translate-y-1 italic">
                    <span class="relative z-10 flex items-center gap-3">
                        Explore Full Registry
                        <svg class="w-4 h-4 transition-transform duration-500 group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </span>
                </a>
            </div>
        </div>
    </section>

    <!-- Phase 3: Tactical Statistics & USP Sidebar -->
    <section class="py-32 bg-[#050B1A] relative overflow-hidden italic">
        <div class="absolute top-0 right-0 w-1/3 h-full bg-blue-900/10 rounded-l-full blur-[150px]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex flex-col lg:flex-row gap-20 items-center">
            
            <!-- Statistics Panel -->
            <div class="lg:w-1/2 space-y-16" data-aos="fade-right">
                <div>
                    <h4 class="text-[10px] font-black text-orange-500 uppercase tracking-[0.5em] mb-4">Our History</h4>
                    <h2 class="text-5xl md:text-6xl font-black text-white uppercase tracking-tighter leading-tight italic">Your Trust Is All In Our <span class="text-blue-500 leading-none">Global Car Rental</span> Service</h2>
                    <p class="text-gray-400 font-bold text-sm uppercase tracking-widest leading-loose mt-8 opacity-80">We maintain an elite network of high-performance vehicles, backed by deep analytical logistics and absolute customer dedication.</p>
                </div>
                
                <div class="grid grid-cols-3 gap-12 border-t border-white/5 pt-12">
                    <div>
                        <div class="text-5xl font-black text-white mb-2 italic">15<span class="text-orange-500 text-3xl">+</span></div>
                        <div class="text-[8px] font-black text-gray-500 uppercase tracking-[0.4em]">Years Exp</div>
                    </div>
                    <div>
                        <div class="text-5xl font-black text-white mb-2 italic">450<span class="text-orange-500 text-3xl">+</span></div>
                        <div class="text-[8px] font-black text-gray-500 uppercase tracking-[0.4em]">Active Units</div>
                    </div>
                    <div>
                        <div class="text-5xl font-black text-white mb-2 italic">25<span class="text-orange-500 text-3xl">k</span></div>
                        <div class="text-[8px] font-black text-gray-500 uppercase tracking-[0.4em]">Operators</div>
                    </div>
                </div>

                <a href="{{ route('pages.how-it-works') }}" class="group relative inline-flex items-center justify-center px-10 py-5 bg-orange-500 hover:bg-white text-white hover:text-blue-900 text-[11px] font-black uppercase tracking-[0.4em] rounded-2xl transition-all duration-500 shadow-2xl shadow-orange-500/20 hover:shadow-blue-900/20 active:scale-95 hover:-translate-y-1 italic">
                    <span class="relative z-10 flex items-center gap-3">
                        Read More Hub
                        <svg class="w-4 h-4 transition-transform duration-500 group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </span>
                </a>
            </div>

            <!-- USP Sidebar / Options -->
            <div class="lg:w-1/2 grid grid-cols-1 gap-8 w-full" data-aos="fade-left">
                @php
                    $usps = [
                        ['title' => 'Quick and Easy Booking', 'desc' => 'Instant activation protocol for rapid unit deployment.', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['title' => 'All Online For User', 'desc' => 'Manage your entire logistics pipeline via our secure console.', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                        ['title' => '24/7 Support', 'desc' => 'Tactical ground support remains operational around the clock.', 'icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z'],
                    ];
                @endphp
                @foreach($usps as $usp)
                    <div class="bg-white/5 border border-white/10 p-10 rounded-[2.5rem] flex items-center gap-10 hover:bg-white/10 transition-all group">
                        <div class="w-16 h-16 bg-orange-500 text-white rounded-2xl flex items-center justify-center shrink-0 shadow-xl shadow-orange-500/20 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 font-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="{{ $usp['icon'] }}"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-black text-white uppercase italic mb-2 tracking-tight">{{ $usp['title'] }}</h4>
                            <p class="text-gray-500 text-xs font-bold uppercase tracking-widest">{{ $usp['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Phase 4: Logistic Solutions (Services) -->
    <section class="py-32 bg-gray-100 italic">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-24" data-aos="fade-up">
                <h4 class="text-[10px] font-black text-orange-500 uppercase tracking-[0.5em] mb-6 italic">Support Capability</h4>
                <h2 class="text-5xl md:text-7xl font-black text-gray-900 uppercase tracking-tighter italic">Complete Solutions For Your <span class="text-blue-900">Vehicle Needs</span></h2>
                <div class="w-24 h-1 bg-orange-500 mx-auto mt-10 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                @php
                    $services = [
                        ['title' => 'City Fleet Rental', 'desc' => 'High-efficiency units optimized for urban logistics.', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-10V4m-5 4h.01M9 16h6m2 2h2m-2-2h-3m-9 0H3m2 0h3'],
                        ['title' => 'Short/Long Term Rental', 'desc' => 'Flexible duration protocols for custom mission lengths.', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                        ['title' => 'Corporate Hubs', 'desc' => 'Strategic mobility solutions for advanced enterprise operations.', 'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                        ['title' => 'Intercity Logistics', 'desc' => 'Long-range mobility across diverse geographical hubs.', 'icon' => 'M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7'],
                        ['title' => 'Airport Transfers', 'desc' => 'Rapid touchdown-to-transport synchronization.', 'icon' => 'M12 19l9 2-9-18-9 18 9-2zm0 0v-8'],
                        ['title' => 'Event Mobilization', 'desc' => 'Coordinated group mobility for high-value strategic events.', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 005.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                    ];
                @endphp
                @foreach($services as $service)
                    <div class="bg-white p-12 rounded-[3.5rem] border border-white hover:border-blue-900/10 shadow-xl shadow-blue-900/[0.03] transition-all group hover:-translate-y-2">
                        <div class="w-16 h-16 bg-blue-50 text-blue-900 rounded-2xl flex items-center justify-center mb-10 group-hover:bg-blue-900 group-hover:text-white transition-all shadow-sm">
                            <svg class="w-8 h-8 font-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="{{ $service['icon'] }}"></path></svg>
                        </div>
                        <h3 class="text-2xl font-black text-gray-900 uppercase italic mb-4 tracking-tight">{{ $service['title'] }}</h3>
                        <p class="text-gray-400 text-xs font-bold uppercase tracking-widest leading-loose mb-8">{{ $service['desc'] }}</p>
                        <a href="{{ route('pages.how-it-works') }}" class="text-[10px] font-black text-blue-900 uppercase tracking-widest italic flex items-center gap-2 group-hover:text-orange-500 transition-colors">Learn More Hub <span class="group-hover:translate-x-1 transition-transform">→</span></a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Phase 5: Trusted Network (Categories) -->
    <section class="py-32 bg-white italic border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-24" data-aos="fade-up">
                <h4 class="text-[10px] font-black text-orange-500 uppercase tracking-[0.5em] mb-6 italic">Unit Classification</h4>
                <h2 class="text-5xl md:text-7xl font-black text-gray-900 uppercase tracking-tighter italic leading-tight">Trusted By Thousands, <br/> Release Your <span class="text-blue-900">Preferred Choice</span></h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @php
                    $cats = [
                        ['name' => 'SUV Logistics', 'icon' => 'M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2m16-10a4 4 0 11-8 0 4 4 0 018 0zM9 7a4 4 0 11-8 0 4 4 0 018 0z', 'color' => 'orange-500'],
                        ['name' => 'Lux Sedan Hub', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'color' => 'blue-900'],
                        ['name' => 'Compact Range', 'icon' => 'M5 10l7-7m0 0l7 7m-7-7v18', 'color' => 'blue-900'],
                        ['name' => 'Pickup Force', 'icon' => 'M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4', 'color' => 'orange-500'],
                        ['name' => 'Off-Road Units', 'icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'blue-900'],
                        ['name' => 'Coupe Stealth', 'icon' => 'M13 10V6m0 8h9m-9 0H5m12 1a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z', 'color' => 'orange-500'],
                        ['name' => 'Heavy Logistics', 'icon' => 'M3 10h18M7 15h1m4 0h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z', 'color' => 'blue-900'],
                        ['name' => 'Elite Specials', 'icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.143-7.714L1 12l6.857-2.143L11 3z', 'color' => 'orange-500'],
                    ];
                @endphp
                @foreach($cats as $cat)
                    <div class="bg-gray-50 p-10 rounded-[2rem] border border-gray-100 flex flex-col items-center text-center group hover:bg-white hover:shadow-2xl transition-all cursor-pointer">
                        <div class="w-16 h-16 rounded-full bg-white mb-6 flex items-center justify-center text-{{ $cat['color'] }} shadow-sm group-hover:scale-110 transition-transform">
                             <svg class="w-8 h-8 font-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="{{ $cat['icon'] }}"></path></svg>
                        </div>
                        <h4 class="text-sm font-black text-gray-900 uppercase italic tracking-tight">{{ $cat['name'] }}</h4>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section: 3 Easy Steps (Classic Alternating Layout) -->
    <section class="py-40 bg-gray-50 italic">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-32" data-aos="fade-up">
                <h4 class="text-[12px] font-black text-orange-500 uppercase tracking-[0.6em] mb-4 italic">HOW IT WORKS</h4>
                <h2 class="text-5xl md:text-7xl font-black text-gray-900 uppercase tracking-tighter italic">Rental Car in <span class="text-blue-900">3 Easy Steps</span></h2>
            </div>

            <div class="space-y-32">
                <!-- Step 1 -->
                <div class="flex flex-col lg:flex-row items-center gap-20" data-aos="fade-up">
                    <div class="lg:w-1/2 space-y-8">
                        <div class="space-y-4">
                            <span class="text-orange-500 font-black text-lg uppercase tracking-widest italic">Step 1</span>
                            <h3 class="text-4xl md:text-5xl font-black text-gray-900 uppercase italic leading-tight">Pick and Reserve <br/> a Premium Car</h3>
                            <p class="text-gray-500 font-bold uppercase tracking-widest leading-loose text-xs max-w-lg">Select your high-performance unit from our master fleet. We maintain an elite network of vehicles optimized for every terrain.</p>
                        </div>
                    </div>
                    <div class="lg:w-1/2 rounded-[3.5rem] overflow-hidden shadow-2xl border-x-8 border-white">
                        <img src="{{ asset('images/assets/rent_banner.png') }}" class="w-full h-[450px] object-cover">
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="flex flex-col lg:flex-row-reverse items-center gap-20" data-aos="fade-up">
                    <div class="lg:w-1/2 space-y-8">
                        <div class="space-y-4">
                            <span class="text-orange-500 font-black text-lg uppercase tracking-widest italic">Step 2</span>
                            <h3 class="text-4xl md:text-5xl font-black text-gray-900 uppercase italic leading-tight">Customize Your <br/> Preferences</h3>
                            <p class="text-gray-500 font-bold uppercase tracking-widest leading-loose text-xs max-w-lg">Establish mission timeline and deployment protocols. Our secure console allows for rapid protocol activation.</p>
                        </div>
                    </div>
                    <div class="lg:w-1/2 rounded-[3.5rem] overflow-hidden shadow-2xl border-x-8 border-white">
                        <img src="{{ asset('images/assets/preferences_banner.png') }}" class="w-full h-[450px] object-cover">
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="flex flex-col lg:flex-row items-center gap-20" data-aos="fade-up">
                    <div class="lg:w-1/2 space-y-8">
                        <div class="space-y-4">
                            <span class="text-orange-500 font-black text-lg uppercase tracking-widest italic">Step 3</span>
                            <h3 class="text-4xl md:text-5xl font-black text-gray-900 uppercase italic leading-tight">Complete and Pay <br/> Your Booking</h3>
                            <p class="text-gray-500 font-bold uppercase tracking-widest leading-loose text-xs max-w-lg">Executive operational control and execute your travel mission. Secure final verification via our integrated payment hub.</p>
                        </div>
                    </div>
                    <div class="lg:w-1/2 rounded-[3.5rem] overflow-hidden shadow-2xl border-x-8 border-white">
                        <img src="{{ asset('images/assets/earn_banner.png') }}" class="w-full h-[450px] object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Trusted Choice (Professional Feature Grid) -->
    <section class="py-40 bg-white italic relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-32" data-aos="fade-up">
                <h4 class="text-[12px] font-black text-orange-500 uppercase tracking-[0.6em] mb-4 italic">WHY CHOOSE US</h4>
                <h2 class="text-5xl md:text-7xl font-black text-gray-900 uppercase tracking-tighter italic">Trusted by Thousands. <br/> Become Your <span class="text-blue-900">Preferred Choice.</span></h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @php
                    $features = [
                        ['title' => 'Quick & Easy Booking', 'color' => 'bg-orange-500', 'textColor' => 'text-white', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['title' => 'Well Maintained Cars', 'color' => 'bg-gray-50', 'textColor' => 'text-gray-900', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                        ['title' => 'Flexible Pickup & Return', 'color' => 'bg-gray-50', 'textColor' => 'text-gray-900', 'icon' => 'M3 10h18M7 15h1m4 0h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z'],
                        ['title' => 'Trusted Technicians', 'color' => 'bg-gray-50', 'textColor' => 'text-gray-900', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                        ['title' => 'All In One Services', 'color' => 'bg-gray-50', 'textColor' => 'text-gray-900', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z'],
                        ['title' => 'Customer Centered Service', 'color' => 'bg-blue-900', 'textColor' => 'text-white', 'icon' => 'M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2m16-10a4 4 0 11-8 0 4 4 0 018 0zM9 7a4 4 0 11-8 0 4 4 0 018 0z'],
                    ];
                @endphp
                @foreach($features as $feature)
                    <div class="{{ $feature['color'] }} p-12 rounded-[2.5rem] space-y-8 shadow-xl hover:-translate-y-2 transition-all duration-500">
                        <div class="w-16 h-16 {{ $feature['color'] === 'bg-white' || $feature['color'] === 'bg-gray-50' ? 'bg-white' : 'bg-white/10' }} rounded-2xl flex items-center justify-center {{ $feature['textColor'] }} shadow-sm">
                            <svg class="w-8 h-8 font-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="{{ $feature['icon'] }}"></path></svg>
                        </div>
                        <div class="space-y-4">
                            <h4 class="text-2xl font-black {{ $feature['textColor'] }} uppercase italic leading-tight">{{ $feature['title'] }}</h4>
                            <p class="{{ $feature['color'] === 'bg-gray-50' ? 'text-gray-400' : 'text-white/70' }} text-[10px] font-bold uppercase tracking-widest leading-loose">Elite logistics support tailored for every client mission in the Bangladesh hub.</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Phase 7: Tactical Conversion Banners (Double CTA) -->
    <section class="py-32 bg-white italic">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-10">
            <!-- Banner 1: Rent Your Car -->
            <div class="relative h-[400px] rounded-[3.5rem] overflow-hidden group shadow-2xl shadow-blue-900/10" data-aos="fade-right">
                <img src="{{ asset('images/assets/rent_keys.png') }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-900/90 via-blue-900/40 to-transparent"></div>
                <div class="relative z-10 h-full flex flex-col justify-center p-16 space-y-6">
                    <h3 class="text-4xl md:text-5xl font-black text-white uppercase italic tracking-tighter leading-none">Don't Have a Ride? <br/> <span class="text-orange-500">Rent Your Car Today!</span></h3>
                    <a href="{{ route('search') }}" class="w-fit px-12 py-5 bg-orange-500 text-white font-black text-[10px] uppercase tracking-[0.4em] rounded-2xl shadow-xl shadow-orange-500/30 hover:bg-white hover:text-blue-900 transition-all">Get Started Hub</a>
                </div>
            </div>

            <!-- Banner 2: Become an Operator -->
            <div class="relative h-[400px] rounded-[3.5rem] overflow-hidden group shadow-2xl shadow-orange-500/10" data-aos="fade-left">
                <img src="{{ asset('images/assets/tools_graphic.png') }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-r from-orange-500/90 via-orange-500/40 to-transparent"></div>
                <div class="relative z-10 h-full flex flex-col justify-center p-16 space-y-6">
                    <h3 class="text-4xl md:text-5xl font-black text-white uppercase italic tracking-tighter leading-none">Having Car Stock? <br/> <span class="text-blue-900">Be An Operator!</span></h3>
                    <a href="{{ route('register') }}" class="w-fit px-12 py-5 bg-white text-blue-900 font-black text-[10px] uppercase tracking-[0.4em] rounded-2xl shadow-xl shadow-white/30 hover:bg-blue-900 hover:text-white transition-all">Registry Hub</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Phase 8: Testimonials & Tactical FAQ -->
    <section class="py-32 bg-gray-50 italic">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-32">
            
            <!-- Testimonials Segment -->
            <div class="flex flex-col lg:flex-row gap-20 items-center">
                <div class="lg:w-1/2 space-y-12" data-aos="fade-right">
                    <div>
                        <h4 class="text-[10px] font-black text-orange-500 uppercase tracking-[0.5em] mb-4 italic">Operator Intel</h4>
                        <h2 class="text-5xl md:text-6xl font-black text-gray-900 uppercase tracking-tighter leading-tight italic">Real Reports From <span class="text-blue-900">Elite Renters</span></h2>
                    </div>
                    <div class="bg-white p-12 rounded-[3.5rem] shadow-2xl shadow-blue-900/[0.03] border border-gray-100 relative">
                         <div class="text-7xl text-gray-100 absolute top-10 right-10 leading-none">“</div>
                         <p class="text-xl font-black text-gray-900 uppercase tracking-widest italic leading-loose relative z-10">
                            Absolute operational excellence. The unit was in pristine condition and the rendezvous was handled with total precision. CRS BD remains our primary mobility hub.
                         </p>
                         <div class="mt-12 flex items-center gap-6">
                            <div class="w-16 h-16 rounded-full bg-blue-900 flex items-center justify-center text-white text-xl font-black shadow-lg shadow-blue-900/20">RS</div>
                            <div>
                                <h4 class="text-sm font-black text-gray-900 uppercase italic tracking-widest mb-1">Ryan Sinclair</h4>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.3em]">Verified Master Renter</p>
                            </div>
                         </div>
                    </div>
                </div>
                <!-- Tactical Graphic -->
                <div class="lg:w-1/2 rounded-[3.5rem] overflow-hidden shadow-2xl shadow-blue-900/10" data-aos="fade-left">
                     <img src="https://images.unsplash.com/photo-1549421263-5ec394a5ad4c?auto=format&fit=crop&q=80&w=1200" class="w-full h-[500px] object-cover">
                </div>
            </div>

            <!-- Polished FAQ Intel Console (Autovia Style) -->
            <div class="flex flex-col lg:flex-row-reverse gap-20 items-center">
                <div class="lg:w-1/2 space-y-12" data-aos="fade-left">
                    <div>
                        <h4 class="text-[12px] font-black text-orange-500 uppercase tracking-[0.6em] mb-4 italic">FAQ</h4>
                        <h2 class="text-5xl md:text-6xl font-black text-gray-900 uppercase tracking-tighter leading-tight italic">Need Help? <br/> <span class="text-blue-900">Find Answers Here</span></h2>
                    </div>
                    
                    <div x-data="{ active: 1 }" class="space-y-6">
                         @php
                            $faqs = [
                                ['id' => 1, 'q' => 'How Do I Rent My Selective Car?', 'a' => 'Navigate to our car collection, choose your preferred unit, and complete the booking protocol via our secure console.'],
                                ['id' => 2, 'q' => 'What Documents Do I Need To Provide?', 'a' => 'An active NID/Passport and a valid Driving License are mandatory for mission-critical activation.'],
                                ['id' => 3, 'q' => 'Can I Modify or Cancel My Booking?', 'a' => 'Cancellations and modifications are supported via your operative dashboard up to 24 hours prior to deployment.'],
                                ['id' => 4, 'q' => 'Do You Offer Roadside Assistance?', 'a' => 'Our tactical ground support remains operational 24/7 across all Bangladesh territory hubs.'],
                            ];
                         @endphp
                         @foreach($faqs as $faq)
                            <div class="bg-white rounded-3xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-xl transition-all">
                                <button @click="active = active === {{ $faq['id'] }} ? 0 : {{ $faq['id'] }}" class="w-full p-8 flex items-center justify-between text-left">
                                    <span class="text-sm font-black text-gray-900 uppercase italic tracking-widest leading-none">{{ $faq['q'] }}</span>
                                    <span class="text-orange-500 font-black text-2xl transition-transform" :class="active === {{ $faq['id'] }} ? 'rotate-45' : ''">+</span>
                                </button>
                                <div x-show="active === {{ $faq['id'] }}" x-collapse>
                                    <div class="px-8 pb-8 text-[11px] font-bold text-gray-400 uppercase tracking-widest leading-loose">
                                        {{ $faq['a'] }}
                                    </div>
                                </div>
                            </div>
                         @endforeach
                    </div>
                </div>
                <!-- FAQ Asset (Autovia Banner) -->
                <div class="lg:w-1/2 p-2 bg-white rounded-[4rem] shadow-2xl shadow-blue-900/10 border border-gray-100 overflow-hidden" data-aos="fade-right">
                    <div class="relative group">
                        <img src="{{ asset('images/assets/faq_graphic.png') }}" class="w-full h-auto rounded-[3.5rem] group-hover:scale-105 transition-transform duration-1000">
                        <div class="absolute inset-0 bg-blue-900/20 mix-blend-overlay"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Phase 9: Knowledge Hub (Articles) -->
    <section class="py-32 bg-white italic border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-24" data-aos="fade-up">
                <h4 class="text-[10px] font-black text-orange-500 uppercase tracking-[0.5em] mb-6 italic">Tactical Intel</h4>
                <h2 class="text-5xl md:text-7xl font-black text-gray-900 uppercase tracking-tighter italic">Fleet Car Best <span class="text-blue-900">Rental Tips</span></h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @php
                    $blogs = [
                        ['title' => 'How To Maintain Elite Performance On Long Range Travels', 'img' => 'https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&q=80&w=800'],
                        ['title' => 'Why Hybrid Logistics Are Changing The Rental Sector', 'img' => 'https://images.unsplash.com/photo-1541443131876-44b03de101c5?auto=format&fit=crop&q=80&w=800'],
                        ['title' => 'The Evolution Of Strategic Fleet Management Systems', 'img' => 'https://images.unsplash.com/photo-1490902858474-755158ac704b?auto=format&fit=crop&q=80&w=800'],
                    ];
                @endphp
                @foreach($blogs as $index => $blog)
                    <div class="bg-gray-50 rounded-[3rem] overflow-hidden border border-gray-100 group hover:shadow-2xl transition-all" data-aos="fade-up" data-aos-delay="{{ $index * 150 }}">
                        <div class="h-64 overflow-hidden relative">
                            <img src="{{ $blog['img'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute bottom-6 left-6 px-4 py-2 bg-blue-900/90 backdrop-blur-md rounded-xl text-[8px] font-black text-white uppercase tracking-widest">Master Op</div>
                        </div>
                        <div class="p-10 space-y-6">
                            <h4 class="text-xl font-black text-gray-900 uppercase italic tracking-tight leading-tight group-hover:text-blue-900 transition-colors">{{ $blog['title'] }}</h4>
                            <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest leading-loose">Dec 18, 2026 • Knowledge Hub</p>
                            <a href="#" class="inline-block text-[10px] font-black text-blue-900 uppercase tracking-[0.3em] border-b border-blue-900 pb-1 hover:text-orange-500 hover:border-orange-500 transition-all italic">Read Full Intel</a>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-20 text-center" data-aos="fade-up">
                <a href="#" class="px-14 py-6 bg-blue-900 text-white font-black text-[10px] uppercase tracking-[0.4em] rounded-2xl shadow-xl shadow-blue-900/20 italic transform hover:-translate-y-1 transition-all">View All Intel</a>
            </div>
        </div>
    </section>

    <!-- Phase 10: Global Hub Footer CTA (Integrated) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-24 relative z-30" data-aos="zoom-in">
        <div class="bg-orange-500 rounded-[2.5rem] p-12 md:p-20 flex flex-col md:flex-row items-center justify-between shadow-[0_30px_100px_rgba(249,115,22,0.4)] relative overflow-hidden italic">
             <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] mix-blend-overlay"></div>
             <div class="relative z-10 space-y-4 text-center md:text-left mb-10 md:mb-0">
                <h2 class="text-4xl md:text-6xl font-black text-white uppercase tracking-tighter leading-none italic">Need Help Right Now? <br/> Contact Our Team</h2>
                <p class="text-[10px] font-black text-white uppercase tracking-[0.5em] opacity-80 italic">Ground Support Operational 24/7 Bangladesh Hub</p>
             </div>
             <a href="{{ route('pages.contact') }}" class="relative z-10 px-12 py-6 bg-white text-orange-500 font-black text-[10px] uppercase tracking-[0.4em] rounded-2xl shadow-xl hover:bg-blue-900 hover:text-white transition-all duration-500 group flex items-center gap-4">
                <svg class="w-6 h-6 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                Contact Us Now
             </a>
        </div>
    </section>
</x-public-layout>
