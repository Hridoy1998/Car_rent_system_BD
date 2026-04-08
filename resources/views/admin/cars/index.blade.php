<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-white bg-gray-950">
            {{ __('Listing Approvals') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen text-slate-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-500/10 border border-green-500/50 text-green-400 p-4 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex space-x-1 mb-6 bg-gray-900 border border-white/10 rounded-lg p-1 w-fit">
                <a href="{{ route('admin.cars.index', ['status' => 'pending']) }}" class="px-4 py-2 rounded-md text-sm font-medium transition-colors {{ $status === 'pending' ? 'bg-indigo-600 text-white shadow-[0_0_10px_rgba(79,70,229,0.4)]' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    Pending Approvals
                </a>
                <a href="{{ route('admin.cars.index', ['status' => 'approved']) }}" class="px-4 py-2 rounded-md text-sm font-medium transition-colors {{ $status === 'approved' ? 'bg-indigo-600 text-white shadow-[0_0_10px_rgba(79,70,229,0.4)]' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    Approved Cars
                </a>
            </div>

            <div class="bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg border border-white/5">
                <div class="p-6 text-gray-200">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-white/10 text-gray-400">
                                <th class="pb-3 font-medium">Car</th>
                                <th class="pb-3 font-medium">Owner</th>
                                <th class="pb-3 font-medium">Price</th>
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
                                                <div class="text-sm text-gray-400">{{ $car->location }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4">
                                        <div class="text-sm">{{ $car->owner->name }}</div>
                                        <div class="text-xs text-gray-400">{{ $car->owner->email }}</div>
                                    </td>
                                    <td class="py-4 font-mono">
                                        <div class="text-white">৳{{ number_format($car->price_per_day) }}/d</div>
                                    </td>
                                    <td class="py-4 text-right flex justify-end gap-2 items-center">
                                        @if($car->status === 'pending')
                                            <form action="{{ route('admin.cars.update', $car) }}" method="POST">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="px-3 py-1.5 bg-green-500/20 text-green-400 hover:bg-green-500/30 rounded border border-green-500/30 transition-colors text-sm font-medium shadow-[0_0_10px_rgba(34,197,94,0.1)]">Approve</button>
                                            </form>
                                            <form action="{{ route('admin.cars.update', $car) }}" method="POST">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="px-3 py-1.5 bg-red-500/20 text-red-400 hover:bg-red-500/30 rounded border border-red-500/30 transition-colors text-sm font-medium">Reject</button>
                                            </form>
                                        @else
                                            <span class="px-2 py-1 bg-gray-800 text-gray-400 rounded text-xs border border-white/10 uppercase tracking-wider">{{ $car->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-12 text-center text-gray-500">
                                        No {{ $status }} cars found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $cars->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
