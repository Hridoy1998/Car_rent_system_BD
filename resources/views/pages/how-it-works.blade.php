<x-public-layout>
    <div class="py-24 bg-gray-950 relative overflow-hidden">
        <!-- Decoration -->
        <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-indigo-600/5 rounded-full blur-[150px] -z-10"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h1 class="text-4xl md:text-6xl font-black text-white mb-6">How It Works</h1>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">Experience the future of car sharing. Whether you're looking for a ride or want to earn from your car, we've got you covered.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- For Renters -->
                <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 rounded-[3rem] p-10 shadow-2xl relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-8 opacity-5 group-hover:opacity-10 transition-opacity">
                        <svg class="w-32 h-32 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <h2 class="text-3xl font-black text-white mb-8 flex items-center gap-3">
                        <span class="w-12 h-12 rounded-2xl bg-indigo-500/20 flex items-center justify-center text-indigo-400">01</span>
                        For Renters
                    </h2>
                    <ul class="space-y-8">
                        <li class="flex gap-4">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-500/20 flex items-center justify-center text-emerald-400 mt-1">✓</div>
                            <div>
                                <h4 class="text-white font-bold mb-1">Find & Reserve</h4>
                                <p class="text-gray-400 text-sm">Browse unique cars and book instantly. No paperwork, no counters.</p>
                            </div>
                        </li>
                        <li class="flex gap-4">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-500/20 flex items-center justify-center text-emerald-400 mt-1">✓</div>
                            <div>
                                <h4 class="text-white font-bold mb-1">ID Verification</h4>
                                <p class="text-gray-400 text-sm">Upload your driving license for a one-time verification. Safety first.</p>
                            </div>
                        </li>
                        <li class="flex gap-4">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-500/20 flex items-center justify-center text-emerald-400 mt-1">✓</div>
                            <div>
                                <h4 class="text-white font-bold mb-1">Pick up & Drive</h4>
                                <p class="text-gray-400 text-sm">Coordinate with the host via our secure chat and start your journey.</p>
                            </div>
                        </li>
                    </ul>
                    <a href="{{ route('home') }}" class="mt-10 inline-block px-8 py-4 bg-indigo-600 hover:bg-indigo-500 text-white font-black rounded-2xl transition-all uppercase tracking-widest text-sm">Find your car</a>
                </div>

                <!-- For Owners -->
                <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 rounded-[3rem] p-10 shadow-2xl relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-8 opacity-5 group-hover:opacity-10 transition-opacity">
                        <svg class="w-32 h-32 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h2 class="text-3xl font-black text-white mb-8 flex items-center gap-3">
                        <span class="w-12 h-12 rounded-2xl bg-purple-500/20 flex items-center justify-center text-purple-400">02</span>
                        For Hosts
                    </h2>
                    <ul class="space-y-8">
                        <li class="flex gap-4">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-purple-500/20 flex items-center justify-center text-purple-400 mt-1">✓</div>
                            <div>
                                <h4 class="text-white font-bold mb-1">List for Free</h4>
                                <p class="text-gray-400 text-sm">Add your car details and high-res photos. It only takes 5 minutes.</p>
                            </div>
                        </li>
                        <li class="flex gap-4">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-purple-500/20 flex items-center justify-center text-purple-400 mt-1">✓</div>
                            <div>
                                <h4 class="text-white font-bold mb-1">Review Requests</h4>
                                <p class="text-gray-400 text-sm">You have total control. Approve requests based on renter profiles and ratings.</p>
                            </div>
                        </li>
                        <li class="flex gap-4">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-purple-500/20 flex items-center justify-center text-purple-400 mt-1">✓</div>
                            <div>
                                <h4 class="text-white font-bold mb-1">Earn Money</h4>
                                <p class="text-gray-400 text-sm">Payments are processed automatically. Sit back and watch your fleet earn.</p>
                            </div>
                        </li>
                    </ul>
                    <a href="{{ route('owner.cars.create') }}" class="mt-10 inline-block px-8 py-4 bg-purple-600 hover:bg-purple-500 text-white font-black rounded-2xl transition-all uppercase tracking-widest text-sm">List your car</a>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
