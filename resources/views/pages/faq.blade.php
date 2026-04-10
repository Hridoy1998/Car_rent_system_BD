<x-app-layout>
    <div class="py-24 bg-gray-950 min-h-screen relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-indigo-600/5 rounded-full blur-[150px] -z-10"></div>
        
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-black text-white mb-6">Frequently Asked</h1>
                <p class="text-gray-400">Everything you need to know about the Car Rent System platform.</p>
            </div>

            <div class="space-y-4" x-data="{ active: null }">
                
                @php
                    $faqs = [
                        [
                            'q' => 'How do I start renting?',
                            'a' => 'Sign up, browse our catalog, and find a car you like. Before booking, you must upload your driving license for verification. Once approved, just pick your dates and book!'
                        ],
                        [
                            'q' => 'What happens if the car gets damaged?',
                            'a' => 'Always take photos during pickup. If damage is found after return, the host will file a Vehicle Claim. You can then review the evidence and either pay or dispute the claim for Admin arbitration.'
                        ],
                        [
                            'q' => 'How and when do hosts get paid?',
                            'a' => 'Hosts get paid automatically after the trip is marked as completed by both parties. Earnings are credited to your virtual wallet and can be withdrawn weekly.'
                        ],
                        [
                            'q' => 'Is there a limit on mileage?',
                            'a' => 'Mileage limits are set individually by hosts for each vehicle. Check the car details page for "Included Mileage" and "Extra KM cost".'
                        ],
                        [
                            'q' => 'Can I cancel my booking?',
                            'a' => 'Yes, you can cancel for a full refund up to 24 hours before the trip starts. Late cancellations may incur a small fee to compensate the host.'
                        ]
                    ];
                @endphp

                @foreach($faqs as $index => $faq)
                <div class="bg-gray-900/50 backdrop-blur-xl border border-white/5 rounded-3xl overflow-hidden transition-all">
                    <button @click="active === {{ $index }} ? active = null : active = {{ $index }}" 
                            class="w-full px-8 py-6 text-left flex justify-between items-center group">
                        <span class="text-lg font-bold text-gray-200 group-hover:text-white transition-colors">{{ $faq['q'] }}</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform duration-300" 
                             :class="active === {{ $index }} ? 'rotate-180' : ''" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="active === {{ $index }}" 
                         x-collapse
                         class="px-8 pb-8 text-gray-400 text-sm leading-relaxed italic">
                        {{ $faq['a'] }}
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-20 p-10 bg-indigo-600/10 border border-indigo-500/20 rounded-[3rem] text-center">
                <h3 class="text-2xl font-black text-white mb-4">Still have questions?</h3>
                <p class="text-gray-400 mb-8 max-w-md mx-auto italic">Our support team is available 24/7 for emergency roadside assistance and booking queries.</p>
                <a href="mailto:support@neon-monolith.com" class="inline-block px-10 py-5 bg-indigo-600 hover:bg-indigo-500 text-white font-black rounded-2xl transition-all shadow-xl uppercase tracking-widest text-sm">Contact Support</a>
            </div>
        </div>
    </div>
</x-app-layout>
