<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-orange-500 to-amber-500 px-5 py-3 text-sm font-semibold text-white shadow-[0_18px_34px_-18px_rgba(249,115,22,0.9)] transition duration-200 hover:-translate-y-0.5 hover:brightness-105 focus:outline-none focus:ring-2 focus:ring-orange-200 focus:ring-offset-2']) }}>
    {{ $slot }}
</button>
