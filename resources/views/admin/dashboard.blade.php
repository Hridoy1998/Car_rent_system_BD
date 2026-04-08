<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Admin Headquarters') }}
        </h2>
    </x-slot>

    <div class="py-12 relative z-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 overflow-hidden shadow-2xl sm:rounded-2xl p-8">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-purple-600 to-pink-500 flex items-center justify-center shadow-lg shadow-purple-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white tracking-tight">System Control</h3>
                </div>

                <p class="text-gray-400 mb-8">System overview. Manage users, approve car listings, and track platform health below.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Cars -->
                    <div class="bg-gray-800/50 rounded-2xl p-6 border border-white/5 relative overflow-hidden group">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <h4 class="text-gray-400 text-sm font-medium mb-1">Pending Cars</h4>
                        <div class="text-4xl font-bold text-white mb-4">{{ $stats['pending_cars'] }}</div>
                        <a href="{{ route('admin.cars.index') }}" class="inline-flex items-center text-indigo-400 hover:text-indigo-300 text-sm font-semibold transition-colors">
                            Review fleet &rarr;
                        </a>
                    </div>
                    
                    <!-- Users -->
                    <div class="bg-gray-800/50 rounded-2xl p-6 border border-white/5 relative overflow-hidden group">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <h4 class="text-gray-400 text-sm font-medium mb-1">Total Users</h4>
                        <div class="text-4xl font-bold text-white mb-4">{{ $stats['total_users'] }}</div>
                        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-blue-400 hover:text-blue-300 text-sm font-semibold transition-colors">
                            Manage users ({{ $stats['blocked_users'] }} blocked) &rarr;
                        </a>
                    </div>
                    
                    <!-- Verifications -->
                    <div class="bg-gray-800/50 rounded-2xl p-6 border border-white/5 relative overflow-hidden group">
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <h4 class="text-gray-400 text-sm font-medium mb-1">Pending Verifications</h4>
                        <div class="text-4xl font-bold text-white mb-4">{{ $stats['pending_verifications'] }}</div>
                        <a href="{{ route('admin.verifications.index') }}" class="inline-flex items-center text-purple-400 hover:text-purple-300 text-sm font-semibold transition-colors">
                            Check documents &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
