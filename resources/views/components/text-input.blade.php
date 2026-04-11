@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'block w-full rounded-xl bg-gray-900/50 border border-gray-700 text-white focus:border-indigo-500 focus:ring-indigo-500/50 placeholder-gray-500 transition-colors shadow-inner px-4 py-2.5']) }}>
