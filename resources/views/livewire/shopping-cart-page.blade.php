<div class="fur-shell space-y-8 pt-10">
    <section class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-orange-500">Your cart</p>
            <h1 class="mt-2 text-3xl font-black text-slate-900">Everything your pet will love</h1>
        </div>
        <a href="{{ route('shop.index') }}" class="fur-button-secondary">Continue shopping</a>
    </section>

    <div class="grid gap-8 lg:grid-cols-[1fr_360px]">
        <section class="space-y-4">
            @forelse ($items as $item)
                <article class="fur-card flex flex-col gap-4 p-5 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-4">
                        <div class="flex h-20 w-20 items-center justify-center rounded-3xl bg-gradient-to-br from-orange-100 via-white to-blue-100 text-2xl font-black text-white/90">
                            {{ strtoupper(substr($item['name'], 0, 1)) }}
                        </div>
                        <div>
                            <a href="{{ route('shop.show', $item['slug']) }}" class="text-lg font-bold text-slate-900">{{ $item['name'] }}</a>
                            <p class="text-sm text-slate-500">₱{{ number_format($item['price'], 2) }} each</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-2 rounded-full bg-slate-100 px-3 py-2">
                            <button wire:click="decrease({{ $item['product_id'] }})" class="h-8 w-8 rounded-full bg-white text-lg font-bold text-slate-700">-</button>
                            <span class="min-w-8 text-center text-sm font-semibold">{{ $item['quantity'] }}</span>
                            <button wire:click="increase({{ $item['product_id'] }})" class="h-8 w-8 rounded-full bg-white text-lg font-bold text-slate-700">+</button>
                        </div>
                        <p class="min-w-20 text-right text-base font-bold text-slate-900">₱{{ number_format($item['subtotal'], 2) }}</p>
                        <button wire:click="remove({{ $item['product_id'] }})" class="text-sm font-semibold text-red-500">Remove</button>
                    </div>
                </article>
            @empty
                <div class="fur-card p-12 text-center">
                    <h2 class="text-2xl font-black text-slate-900">Your cart is empty</h2>
                    <p class="mt-2 text-sm text-slate-500">Pick a few cozy finds and come back here to check out.</p>
                </div>
            @endforelse
        </section>

        <aside class="fur-card h-fit p-6">
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-blue-500">Summary</p>
            <h2 class="mt-2 text-2xl font-black text-slate-900">Ready to bring this home?</h2>
            <div class="mt-6 flex items-center justify-between text-sm text-slate-500">
                <span>Subtotal</span>
                <span class="text-lg font-black text-slate-900">₱{{ number_format($subtotal, 2) }}</span>
            </div>
            <p class="mt-3 text-sm leading-7 text-slate-500">Shipping and final confirmation happen during checkout.</p>
            @auth
                <a href="{{ $items->isEmpty() ? '#' : route('checkout.index') }}" class="mt-6 inline-flex w-full items-center justify-center rounded-full bg-gradient-to-r from-orange-400 to-orange-500 px-5 py-3 text-sm font-semibold text-white {{ $items->isEmpty() ? 'pointer-events-none opacity-50' : '' }}">
                    Checkout
                </a>
            @else
                <a href="{{ route('login') }}" class="mt-6 inline-flex w-full items-center justify-center rounded-full bg-gradient-to-r from-orange-400 to-orange-500 px-5 py-3 text-sm font-semibold text-white">
                    Log in to checkout
                </a>
            @endauth
        </aside>
    </div>
</div>
