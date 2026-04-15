<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center gap-2 rounded-full bg-red-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition duration-200 hover:-translate-y-0.5 hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-200 focus:ring-offset-2']) }}>
    {{ $slot }}
</button>
