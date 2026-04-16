<div class="fur-shell space-y-8 pt-4 sm:pt-6">
    <section class="fur-toolbar">
        <div>
            <p class="fur-section-kicker">Your cart</p>
            <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl">Everything your pet is about to love.</h1>
        </div>
        <a href="{{ route('shop.index') }}" class="fur-button-secondary">Continue shopping</a>
    </section>

    <div class="grid gap-8 lg:grid-cols-[minmax(0,1fr)_360px]">
        <section class="space-y-4">
            @forelse ($items as $item)
                <article class="fur-card flex flex-col gap-5 p-5 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-4">
                        <div class="flex h-24 w-24 shrink-0 items-center justify-center overflow-hidden rounded-[28px] bg-gradient-to-br from-orange-100 via-white to-blue-100">
                            @if ($item['image'])
                                @if (strpos($item['image'], 'http') === 0)
                                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover" loading="lazy">
                                @else
                                    <img src="{{ asset('storage/'.$item['image']) }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover" loading="lazy">
                                @endif
                            @else
                                <span class="text-3xl font-black text-white/90">{{ strtoupper(substr($item['name'], 0, 1)) }}</span>
                            @endif
                        </div>
                        <div>
                            <a href="{{ route('shop.show', $item['slug']) }}" class="text-lg font-black text-slate-900">{{ $item['name'] }}</a>
                            <p class="mt-1 text-sm text-slate-500">PHP {{ number_format($item['price'], 2) }} each</p>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-3">
                        <div class="flex items-center gap-2 rounded-full bg-slate-100 px-3 py-2">
                            <button wire:click="decrease({{ $item['product_id'] }})" class="h-8 w-8 rounded-full bg-white text-lg font-bold text-slate-700 shadow-sm">-</button>
                            <span class="min-w-8 text-center text-sm font-semibold">{{ $item['quantity'] }}</span>
                            <button wire:click="increase({{ $item['product_id'] }})" class="h-8 w-8 rounded-full bg-white text-lg font-bold text-slate-700 shadow-sm">+</button>
                        </div>
                        <p class="min-w-24 text-right text-base font-black text-slate-900">PHP {{ number_format($item['subtotal'], 2) }}</p>
                        <button wire:click="remove({{ $item['product_id'] }})" class="rounded-full bg-red-50 px-4 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-100">
                            Remove
                        </button>
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
            <p class="fur-section-kicker">Order summary</p>
            <h2 class="mt-2 text-2xl font-black text-slate-900">Ready to bring this home?</h2>
            <p class="mt-3 text-sm leading-7 text-slate-500">Shipping and final confirmation happen during checkout, so this page stays focused on your basket.</p>

            <div class="mt-6 rounded-[24px] bg-slate-50/90 p-5">
                <div class="flex items-center justify-between text-sm text-slate-500">
                    <span>Subtotal</span>
                    <span class="text-xl font-black text-slate-900">PHP {{ number_format($subtotal, 2) }}</span>
                </div>
            </div>

            @auth
                <a href="{{ $items->isEmpty() ? '#' : route('checkout.index', ['mode' => 'cart']) }}" class="mt-6 {{ $items->isEmpty() ? 'pointer-events-none opacity-50' : '' }} fur-button w-full">
                    Proceed to checkout
                </a>
            @else
                <a href="{{ route('login') }}" class="mt-6 fur-button w-full">Log in to checkout</a>
            @endauth
        </aside>
    </div>
</div>
