<x-public-layout>
    <x-slot name="title">{{ $car->year }} {{ $car->brand }} {{ $car->model }} - CRS BD Registry</x-slot>

    <!-- Header Hero: High-Impact Performance Context -->
    <div class="relative pt-40 pb-32 bg-[#050B1A] overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] mix-blend-overlay"></div>
        <div class="absolute top-0 right-0 w-1/2 h-full bg-blue-900/10 rounded-bl-full blur-[120px]"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
            <div class="flex flex-col lg:flex-row items-center gap-20">
                <!-- Title Component (Left) -->
                <div class="lg:w-1/2 space-y-10">
                    <!-- Breadcrumbs -->
                    <nav class="flex text-[11px] font-black uppercase tracking-[0.3em] text-gray-400" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-3">
                            <li><a href="{{ route('home') }}" class="text-gray-500 hover:text-white transition-colors italic">Home</a></li>
                            <li><span class="text-orange-500">/</span></li>
                            <li><a href="{{ route('search', ['location' => $car->location]) }}" class="text-gray-500 hover:text-white transition-colors italic">{{ $car->location }} Territory</a></li>
                            <li><span class="text-orange-500">/</span></li>
                            <li class="text-blue-500 italic tracking-[0.4em]">Unit Logistics</li>
                        </ol>
                    </nav>

                    <div class="space-y-8">
                        <div class="flex items-center gap-4">
                            <span class="h-0.5 w-12 bg-orange-500"></span>
                            <span class="text-[12px] font-black text-white uppercase tracking-[0.5em] italic">Vehicle Specification Profile</span>
                        </div>
                        <h1 class="text-5xl md:text-7xl lg:text-9xl font-black text-white uppercase tracking-tighter italic leading-none">
                            <span class="text-gray-400">{{ $car->brand }}</span> <br/>
                            <span class="text-blue-500 drop-shadow-[0_0_30px_rgba(59,130,246,0.2)]">{{ $car->model }}</span>
                        </h1>
                        
                        <div class="flex flex-wrap gap-x-12 gap-y-6">
                            <div class="flex items-center gap-3">
                                <span class="text-[10px] font-black text-gray-500 uppercase tracking-widest italic">Model Year</span>
                                <span class="text-lg font-black text-white italic tracking-tighter">{{ $car->year }}</span>
                            </div>
                            <div class="flex items-center gap-3 border-l border-white/10 pl-12">
                                <span class="text-[10px] font-black text-gray-500 uppercase tracking-widest italic">Status</span>
                                <span class="text-lg font-black text-emerald-500 italic tracking-tighter">Ready for Mission</span>
                            </div>
                        </div>

                        <div class="w-full h-1.5 bg-white/5 relative overflow-hidden rounded-full">
                            <div class="absolute inset-0 w-1/3 bg-blue-600 shadow-[0_0_15px_rgba(37,99,235,0.5)]"></div>
                            <div class="absolute inset-y-0 right-0 w-1 h-full bg-orange-500 animate-pulse"></div>
                        </div>
                    </div>
                </div>

                <!-- Cover Image (Right) -->
                <div class="lg:w-1/2 relative group" data-aos="zoom-in" data-aos-delay="200">
                    <div class="absolute -inset-10 bg-blue-500/10 blur-[80px] rounded-full group-hover:bg-blue-500/20 transition-all duration-1000"></div>
                    <img src="{{ $car->primary_image_url }}" class="relative w-full h-auto object-contain drop-shadow-[0_45px_100px_rgba(0,0,0,0.5)] group-hover:scale-105 transition-transform duration-700">
                    
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gray-50 min-h-screen py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
                
                <!-- Main Content Channel (9 Cols) -->
                <div class="lg:col-span-8 space-y-24">
                    
                    <!-- Section: Unit Gallery Hub (Relocated) -->
                    <section class="space-y-12" data-aos="fade-up">
                        <div class="flex items-center gap-4">
                            <span class="w-1.5 h-12 bg-orange-500 rounded-full"></span>
                            <h2 class="text-4xl font-black text-gray-900 uppercase italic tracking-tight">Unit <span class="text-orange-500">Gallery</span></h2>
                        </div>
                        
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                            @foreach($car->images as $index => $image)
                                <div class="aspect-square rounded-[2rem] overflow-hidden border border-gray-100 shadow-xl group cursor-pointer">
                                    <img src="{{ Storage::url($image->image_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                </div>
                            @endforeach
                            @if($car->images->count() < 6)
                                @for($i = $car->images->count(); $i < 6; $i++)
                                    <div class="aspect-square rounded-[2rem] bg-gray-50 flex items-center justify-center opacity-50 grayscale border-2 border-dashed border-gray-200">
                                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endfor
                            @endif
                        </div>
                    </section>

                    <!-- Section: Car Overview (Elite Grid) -->
                    <section class="space-y-12" data-aos="fade-up">
                        <div class="flex items-center gap-4">
                            <span class="w-1.5 h-12 bg-blue-900 rounded-full"></span>
                            <h2 class="text-4xl font-black text-gray-900 uppercase italic tracking-tight">Car <span class="text-blue-900">Overview</span></h2>
                        </div>
                        
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            @php
                                $overview = [
                                    ['label' => 'Transmission', 'val' => $car->transmission, 'icon' => 'M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4'],
                                    ['label' => 'Fuel Type', 'val' => $car->fuel_type, 'icon' => 'M13 10V6m0 8h9m-9 0H5m12 1a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z'],
                                    ['label' => 'Drive Type', 'val' => 'Front Wheel Drive', 'icon' => 'M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7'],
                                    ['label' => 'Seating Capacity', 'val' => $car->seats . ' Personnel', 'icon' => 'M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2m16-10a4 4 0 11-8 0 4 4 0 018 0zM9 7a4 4 0 11-8 0 4 4 0 018 0z'],
                                    ['label' => 'Air Conditioning', 'val' => 'Automatic Climate', 'icon' => 'M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z'],
                                    ['label' => 'Luggage Capacity', 'val' => '2 Large + 2 Small', 'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z'],
                                    ['label' => 'Engine', 'val' => $car->engine_capacity ?: '1.5L Turbo', 'icon' => 'M3 10h18M7 15h1m4 0h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z'],
                                    ['label' => 'Infotainment', 'val' => 'Touchscreen + AirPlay', 'icon' => 'M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z'],
                                ];
                            @endphp
                            @foreach($overview as $item)
                                <div class="bg-white border border-gray-100 rounded-[2.5rem] p-8 transition-all hover:border-blue-900/20 shadow-xl shadow-blue-900/[0.02] group">
                                    <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-900 mb-6 group-hover:bg-blue-900 group-hover:text-white transition-all shadow-sm">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"></path></svg>
                                    </div>
                                    <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1 italic">{{ $item['label'] }}</h4>
                                    <p class="text-xs font-black text-gray-900 uppercase tracking-tight italic">{{ $item['val'] }}</p>
                                </div>
                            @endforeach
                        </div>
                        
                        <p class="text-sm font-bold text-gray-500 uppercase tracking-widest leading-loose ml-1">
                            {{ $car->description ?: 'This Master Spec unit is maintained to elite operational standards, ensuring peak performance across all terrains and mission parameters. Classification level: Premium.' }}
                        </p>
                    </section>

                    
                    <!-- Section: Regional Hub (Location Map RESTORED & VIBRANT) -->
                    <section class="space-y-12" data-aos="fade-up">
                         <div class="flex items-center gap-4">
                            <span class="w-1.5 h-12 bg-blue-500 rounded-full"></span>
                            <h2 class="text-4xl font-black text-gray-900 uppercase italic tracking-tight">Regional <span class="text-blue-500">Hub</span></h2>
                        </div>
                        <div class="rounded-[2rem] md:rounded-[3.5rem] overflow-hidden shadow-2xl border-4 md:border-8 border-white relative group">
                            <div id="discovery-map" class="w-full h-[350px] md:h-[500px] z-0 transition-all duration-1000 group-hover:scale-[1.02]"></div>
                            <div class="absolute top-10 left-10 z-10 px-8 py-4 bg-white/90 backdrop-blur-md rounded-2xl border border-gray-100 shadow-xl">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1 italic">Deployment Zone</p>
                                <p class="text-blue-900 text-sm font-black uppercase tracking-[0.2em] italic">{{ $car->location }} Territory</p>
                            </div>
                        </div>
                    </section>

                    <!-- Section: Customer Reviews -->
                    <section class="space-y-12" data-aos="fade-up">
                        <div class="flex items-center gap-4">
                            <span class="w-1.5 h-12 bg-emerald-500 rounded-full"></span>
                            <h2 class="text-4xl font-black text-gray-900 uppercase italic tracking-tight">Customer <span class="text-emerald-500">Reviews</span></h2>
                        </div>
                        
                        <div x-data="{ active: 0, count: {{ $car->reviews->count() ?: 3 }} }" class="relative">
                            <div class="overflow-hidden rounded-[3rem] bg-white border border-gray-100 p-12 shadow-2xl shadow-blue-900/[0.03]">
                                <div class="flex transition-transform duration-500 ease-in-out" :style="{ transform: `translateX(-${active * 100}%)` }">
                                    @forelse($car->reviews as $review)
                                        <div class="w-full flex-shrink-0 text-center px-4">
                                            <div class="flex justify-center mb-10">
                                                <div class="text-6xl text-blue-900 opacity-20 italic">“</div>
                                            </div>
                                            <p class="text-xl font-black text-gray-900 uppercase tracking-widest italic mb-10 leading-loose">
                                                {{ $review->comment }}
                                            </p>
                                            <div class="flex flex-col items-center">
                                                <div class="flex gap-1 mb-4 text-orange-500">
                                                    @for($i=0; $i<5; $i++)
                                                       <svg class="w-4 h-4 {{ $i < $review->rating ? 'fill-current' : 'text-gray-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                    @endfor
                                                </div>
                                                <h4 class="text-sm font-black text-gray-900 uppercase italic tracking-[0.2em]">{{ $review->customer->name }}</h4>
                                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Verified Logistics User</p>
                                            </div>
                                        </div>
                                    @empty
                                        @php $dummies = [['name' => 'Dr. Paul Marcus', 'comment' => "I always use their service because they're reliable and honest. From rentals to maintenance, they take care of all my needs."], ['name' => 'Sarah Fleet', 'comment' => "Absolute operational excellence. The unit was in pristine condition and the rendezvous was handled with total precision."], ['name' => 'James Nexus', 'comment' => "Highest fidelity mobility service in the region. The unit performed flawlessly across long-range mission targets."]]; @endphp
                                        @foreach($dummies as $dummy)
                                            <div class="w-full flex-shrink-0 text-center px-4">
                                                <div class="flex justify-center mb-10">
                                                    <div class="text-6xl text-blue-900 opacity-20 italic">“</div>
                                                </div>
                                                <p class="text-xl font-black text-gray-900 uppercase tracking-widest italic mb-10 leading-loose">
                                                    {{ $dummy['comment'] }}
                                                </p>
                                                <div class="flex flex-col items-center">
                                                    <div class="flex gap-1 mb-4 text-orange-500">
                                                        @for($i=0; $i<5; $i++)
                                                           <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                        @endfor
                                                    </div>
                                                    <h4 class="text-sm font-black text-gray-900 uppercase italic tracking-[0.2em]">{{ $dummy['name'] }}</h4>
                                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Operational Renter</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforelse
                                </div>
                            </div>
                            <!-- Controls -->
                            <button @click="active = (active - 1 + count) % count" class="absolute left-6 top-1/2 -translate-y-1/2 w-14 h-14 bg-white border border-gray-100 rounded-full flex items-center justify-center text-gray-400 hover:text-blue-900 shadow-xl transition-all"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg></button>
                            <button @click="active = (active + 1) % count" class="absolute right-6 top-1/2 -translate-y-1/2 w-14 h-14 bg-white border border-gray-100 rounded-full flex items-center justify-center text-gray-400 hover:text-blue-900 shadow-xl transition-all"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg></button>
                            <div class="flex justify-center gap-3 mt-10">
                                <template x-for="i in count"><button @click="active = i-1" class="w-8 h-1 transition-all rounded-full" :class="active === i-1 ? 'bg-blue-900' : 'bg-gray-200'"></button></template>
                            </div>
                        </div>
                    </section>

                    <!-- Section: Rental Terms -->
                    <section class="space-y-12" data-aos="fade-up">
                        <div class="text-center space-y-4">
                            <div class="text-[10px] font-black text-orange-500 uppercase tracking-[0.4em] mb-4">Rental Term Protocol</div>
                            <h2 class="text-5xl font-black text-gray-900 uppercase italic tracking-tighter">Rental terms must be <span class="text-blue-900">followed</span></h2>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            @php
                                $terms = [
                                    ['label' => 'Minimum Rental Duration', 'val' => '1 Cycle (24h)', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                                    ['label' => 'Mileage Threshold', 'val' => '300 KM / Cycle', 'icon' => 'M13 10V6m0 8h9m-9 0H5m12 1a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z'],
                                    ['label' => 'Security Protocol (Deposit)', 'val' => '৳5,000 (Fully Refundable)', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                                    ['label' => 'Operator Age Requirement', 'val' => '21+ Years with valid License', 'icon' => 'M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14'],
                                ];
                            @endphp
                            @foreach($terms as $term)
                                <div class="flex items-start gap-8 bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-xl shadow-blue-900/[0.02] hover:border-blue-900/10 hover:shadow-blue-900/5 transition-all group">
                                    <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-900 shrink-0 group-hover:bg-blue-900 group-hover:text-white transition-all"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $term['icon'] }}"></path></svg></div>
                                    <div>
                                        <h4 class="text-sm font-black text-gray-900 uppercase italic mb-2 tracking-tight">{{ $term['label'] }}</h4>
                                        <p class="text-xs font-bold text-gray-500 uppercase tracking-widest leading-relaxed">{{ $term['val'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                </div>

                <!-- Sidebar Channel (4 Cols) -->
                <div class="lg:col-span-4 space-y-12">
                    <div class="bg-white border border-gray-100 p-10 rounded-[3rem] shadow-2xl shadow-blue-900/10 relative overflow-hidden" data-aos="fade-left">
                        <div class="absolute top-0 left-0 w-full h-2 bg-blue-900"></div>
                        <h1 class="text-4xl font-black text-gray-900 uppercase italic tracking-tighter mb-4">{{ $car->brand }} <span class="text-blue-900">{{ $car->model }}</span></h1>
                        <div class="bg-blue-900 rounded-[2rem] p-8 text-white mb-8 relative overflow-hidden shadow-lg shadow-blue-900/20">
                             <h4 class="text-[10px] font-black uppercase tracking-[0.4em] mb-6 italic text-orange-400">Tactical Advantage</h4>
                             <ul class="space-y-4">
                                <li class="flex items-start gap-3"><span class="w-5 h-5 bg-orange-500 rounded-md flex items-center justify-center shrink-0"><svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></span><span class="text-[10px] font-black uppercase tracking-widest italic leading-tight">Elite Performance configuration</span></li>
                                <li class="flex items-start gap-3"><span class="w-5 h-5 bg-orange-500 rounded-md flex items-center justify-center shrink-0"><svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></span><span class="text-[10px] font-black uppercase tracking-widest italic leading-tight">Master-class reliability</span></li>
                                <li class="flex items-start gap-3"><span class="w-5 h-5 bg-orange-500 rounded-md flex items-center justify-center shrink-0"><svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></span><span class="text-[10px] font-black uppercase tracking-widest italic leading-tight">Optimal unit fuel efficiency</span></li>
                             </ul>
                        </div>

                        <!-- Asset Custodian Profile Hub -->
                        <div class="bg-white border border-gray-100 p-10 rounded-[3rem] shadow-xl shadow-blue-900/5 mb-8 group hover:border-orange-500/20 transition-all duration-500">
                             <h4 class="text-[10px] font-black uppercase tracking-[0.4em] mb-8 italic text-gray-400 flex items-center gap-3">
                                <span class="w-8 h-px bg-gray-200"></span> Asset Custodian
                             </h4>
                             <div class="flex items-center gap-6 mb-8">
                                <div class="relative">
                                    <div class="w-20 h-20 rounded-full overflow-hidden border-4 border-white shadow-xl">
                                        <img src="{{ $car->owner->profile_photo_url }}" class="w-full h-full object-cover">
                                    </div>
                                    @if($car->owner->is_verified)
                                        <div class="absolute -bottom-1 -right-1 w-8 h-8 bg-emerald-500 rounded-full border-4 border-white flex items-center justify-center shadow-lg">
                                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="text-xl font-black text-gray-900 uppercase italic tracking-tighter leading-none mb-2">{{ $car->owner->name }}</h3>
                                    <p class="text-[9px] font-black text-emerald-600 uppercase tracking-widest italic">Verified Registry Host</p>
                                </div>
                             </div>
                             @if($car->owner->bio)
                                <p class="text-[11px] font-bold text-gray-500 uppercase tracking-widest leading-loose mb-8 italic">
                                    "{{ Str::limit($car->owner->bio, 120) }}"
                                </p>
                             @endif
                             <a href="{{ route('profiles.show', $car->owner) }}" class="w-full py-5 bg-[#050B1A] hover:bg-blue-800 text-white text-[10px] font-black uppercase tracking-[0.4em] rounded-[1.2rem] shadow-xl transition-all duration-300 text-center italic flex items-center justify-center gap-3">
                                View Intelligence Dossier
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                             </a>
                        </div>
                        <div class="flex flex-col gap-6">
                            <div class="flex items-center justify-between p-8 bg-blue-50/50 rounded-[2rem] border border-blue-100 shadow-inner">
                                <div class="space-y-1">
                                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1 italic">Mission Rate</p>
                                    <div class="flex items-baseline gap-1">
                                        <span class="text-3xl font-black text-blue-900 italic">৳{{ number_format($car->price_per_day) }}</span>
                                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">/ Cycle</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex gap-4">
                                <a href="#book-console" class="flex-1 py-6 bg-orange-500 hover:bg-black text-white text-[12px] font-black uppercase tracking-[0.3em] rounded-[1.5rem] shadow-xl shadow-orange-500/20 hover:shadow-black/20 transition-all duration-500 text-center italic">
                                    Ready to Book?
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
                                }">
                                    <button @click="toggle()" :disabled="saving" class="w-20 h-full flex items-center justify-center bg-white border-2 border-gray-100 rounded-[1.5rem] hover:border-orange-500 transition-all group disabled:opacity-50">
                                        <svg :class="favorited ? 'text-red-500 fill-current' : 'text-gray-300 group-hover:text-red-400'" class="w-6 h-6 transition-transform duration-300 group-hover:scale-125" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                    </button>
                                </div>
                                @endauth
                            </div>
                        </div>
                    </div>

                    <div class="space-y-8" data-aos="fade-left" data-aos-delay="200">
                        <h3 class="text-2xl font-black text-gray-900 uppercase italic tracking-tight flex items-center gap-3"><span class="w-8 h-1 bg-orange-500 rounded-full"></span>More Car List</h3>
                        <div class="space-y-6">
                            @foreach($relatedCars as $rCar)
                                <a href="{{ route('cars.show', $rCar) }}" class="flex items-center gap-6 p-6 bg-white border border-gray-100 rounded-[2rem] hover:shadow-2xl hover:border-blue-900/10 transition-all group">
                                    <div class="w-24 h-24 bg-gray-50 rounded-2xl overflow-hidden p-2 shrink-0 border border-gray-100 shadow-sm"><img src="{{ $rCar->primary_image_url }}" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500"></div>
                                    <div><h4 class="text-sm font-black text-gray-900 uppercase italic tracking-tight group-hover:text-blue-900 transition-colors mb-1">{{ $rCar->brand }} {{ $rCar->model }}</h4><div class="flex items-center gap-2"><span class="text-xs font-black text-blue-900 italic">৳{{ number_format($rCar->price_per_day) }}</span><span class="text-[8px] font-black text-gray-400 uppercase tracking-widest">/ Day</span></div></div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div id="book-console" class="bg-white border border-gray-100 p-10 rounded-[3rem] shadow-2xl shadow-blue-900/10 relative overflow-hidden" data-aos="fade-left" data-aos-delay="300">
                        <div class="absolute top-0 left-0 w-full h-2 bg-orange-500 shadow-[0_4px_10px_rgba(249,115,22,0.3)]"></div>
                        <h3 class="text-2xl font-black text-gray-900 mb-10 uppercase tracking-tight italic flex items-center gap-4">
                            <span class="w-6 h-6 bg-orange-500 rounded-lg flex items-center justify-center"><svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg></span>
                            Initialize Mission
                        </h3>
                        <form action="{{ route('customer.bookings.store') }}" method="POST" class="space-y-10">
                            @csrf
                            <input type="hidden" name="car_id" value="{{ $car->id }}">
                            <div class="space-y-8">
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] ml-1">Inception Protocol (Start)</label>
                                    <div class="relative">
                                        <span class="absolute right-6 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </span>
                                        <input type="date" name="start_date" required min="{{ date('Y-m-d') }}" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-6 py-5 text-blue-900 font-black uppercase text-xs focus:ring-4 focus:ring-blue-900/5 focus:border-blue-900 transition-all italic hover:bg-white">
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] ml-1">Termination Protocol (End)</label>
                                    <div class="relative">
                                        <span class="absolute right-6 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </span>
                                        <input type="date" name="end_date" required min="{{ date('Y-m-d') }}" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-6 py-5 text-blue-900 font-black uppercase text-xs focus:ring-4 focus:ring-blue-900/5 focus:border-blue-900 transition-all italic hover:bg-white">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="w-full py-7 bg-blue-900 hover:bg-orange-500 text-white font-black text-[11px] uppercase tracking-[0.4em] rounded-[1.5rem] shadow-2xl shadow-blue-900/20 hover:shadow-orange-500/20 transition-all duration-500 italic transform hover:-translate-y-1">Confirm Deployment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Need Help Hub CTA -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-32" data-aos="zoom-in">
        <div class="bg-orange-500 rounded-[3rem] p-16 flex flex-col md:flex-row items-center justify-between shadow-2xl shadow-orange-500/20 relative overflow-hidden italic">
            <div class="relative z-10 space-y-4 text-center md:text-left mb-10 md:mb-0">
                <h2 class="text-4xl md:text-6xl font-black text-white uppercase italic tracking-tighter leading-none">Need Help Right Now?</h2>
                <p class="text-[10px] font-black text-white uppercase tracking-[0.4em] opacity-80 italic">Contact Our Tactical Support Team Today</p>
            </div>
            <a href="{{ route('pages.contact') }}" class="relative z-10 px-12 py-6 bg-white text-orange-500 font-black text-[10px] uppercase tracking-[0.4em] rounded-2xl shadow-xl hover:bg-blue-900 hover:text-white transition-all duration-500 group flex items-center gap-3">
                <svg class="w-5 h-5 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                Contact US
            </a>
        </div>
    </section>

    <!-- Map Scripts RESTORED & VIBRANT -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lat = {{ $car->latitude ?: 23.8103 }};
            const lng = {{ $car->longitude ?: 90.4125 }};
            const map = L.map('discovery-map', { 
                center: [lat, lng], 
                zoom: 13, 
                zoomControl: true, 
                attributionControl: false,
                scrollWheelZoom: false // Prevent scroll hijacking on mobile and desktop
            });
            
            // Using Standard OpenStreetMap tiles (Highest clarity for human eyes)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
            
            // High Visibility Circle
            L.circle([lat, lng], { color: '#2563eb', fillColor: '#2563eb', fillOpacity: 0.15, radius: 800 }).addTo(map);
            
            // Standard High-Contrast Marker
            L.marker([lat, lng]).addTo(map);

            // Apply clear visual filter to the map tile pane
            map.getPanes().tilePane.style.filter = 'contrast(1.1) saturate(1.2)';
        });
    </script>
</x-public-layout>
