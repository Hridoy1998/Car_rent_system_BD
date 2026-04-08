<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-gray-950 text-white">
            <h2 class="font-semibold text-xl leading-tight text-white">
                {{ __('My Fleet') }}
            </h2>
            <a href="{{ route('owner.cars.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 rounded-lg text-white font-medium transition-colors shadow-[0_0_15px_rgba(79,70,229,0.5)]">
                + Add Car
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen text-slate-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-500/10 border border-green-500/50 text-green-400 p-4 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg border border-white/5">
                <div class="p-6 text-gray-200">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-white/10 text-gray-400">
                                <th class="pb-3 font-medium">Car</th>
                                <th class="pb-3 font-medium">Details</th>
                                <th class="pb-3 font-medium">Price</th>
                                <th class="pb-3 font-medium">Status</th>
                                <th class="pb-3 font-medium text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse ($cars as $car)
                                <tr class="hover:bg-white/5 transition-colors">
                                    <td class="py-4">
                                        <div class="flex items-center">
                                            @if($car->images->count() > 0)
                                                <img src="{{ Storage::url($car->images->first()->image_path) }}" alt="{{ $car->title }}" class="w-16 h-12 rounded object-cover mr-4">
                                            @else
                                                <div class="w-16 h-12 bg-gray-800 rounded mr-4 flex items-center justify-center text-gray-500 border border-white/10">No Img</div>
                                            @endif
                                            <div>
                                                <a href="{{ route('cars.show', $car) }}" class="font-bold text-white hover:text-indigo-400 transition-colors">{{ $car->title }}</a>
                                                <div class="text-sm text-gray-400">{{ $car->brand }} {{ $car->model }} ({{ $car->year }})</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4">
                                        <div class="text-sm">{{ $car->type }} - {{ $car->transmission }}</div>
                                        <div class="text-xs text-gray-400">{{ $car->location }}</div>
                                    </td>
                                    <td class="py-4 font-mono">
                                        <div class="text-white">৳{{ number_format($car->price_per_day) }}/d</div>
                                    </td>
                                    <td class="py-4">
                                        @if($car->status === 'approved')
                                            <span class="px-2 py-1 bg-green-500/10 text-green-400 rounded-full text-xs font-semibold border border-green-500/20">Active</span>
                                        @elseif($car->status === 'pending')
                                            <span class="px-2 py-1 bg-yellow-500/10 text-yellow-500 rounded-full text-xs font-semibold border border-yellow-500/20">Pending review</span>
                                        @else
                                            <span class="px-2 py-1 bg-red-500/10 text-red-400 rounded-full text-xs font-semibold border border-red-500/20">Disabled</span>
                                        @endif
                                    </td>
                                    <td class="py-4 text-right flex justify-end gap-3 items-center">
                                        <a href="{{ route('owner.cars.edit', $car) }}" class="text-indigo-400 hover:text-indigo-300 text-sm font-medium">Edit</a>
                                        <form action="{{ route('owner.cars.destroy', $car) }}" method="POST" class="inline-block mt-0.5">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300 text-sm font-medium">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center text-gray-500">
                                        You haven't listed any cars yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
