<div class="fur-shell space-y-8 pt-10">
    <section>
        <p class="text-sm font-semibold uppercase tracking-[0.25em] text-green-500">Checkout</p>
        <h1 class="mt-2 text-3xl font-black text-slate-900">A smooth finish for your FurEver order</h1>
    </section>

    <div class="grid gap-8 lg:grid-cols-[1fr_360px]">
        <form wire:submit="placeOrder" class="fur-card space-y-5 p-6 sm:p-8">
            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Full name</label>
                    <input wire:model="shipping_name" type="text" class="fur-input">
                    @error('shipping_name') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                    <input wire:model="shipping_email" type="email" class="fur-input">
                    @error('shipping_email') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>
            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Phone</label>
                    <input wire:model="shipping_phone" type="text" class="fur-input">
                    @error('shipping_phone') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Delivery notes</label>
                    <input wire:model="notes" type="text" class="fur-input" placeholder="Optional instructions">
                    @error('notes') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Shipping address</label>
                <textarea wire:model="shipping_address" rows="5" class="fur-input"></textarea>
                @error('shipping_address') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="fur-button w-full" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="placeOrder">Place order</span>
                <span wire:loading wire:target="placeOrder">Processing your order...</span>
            </button>
        </form>

        <aside class="fur-card h-fit p-6">
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-orange-500">Order summary</p>
            <div class="mt-5 space-y-4">
                @foreach ($items as $item)
                    <div class="flex items-center justify-between gap-4 text-sm">
                        <div>
                            <p class="font-semibold text-slate-800">{{ $item['name'] }}</p>
                            <p class="text-slate-500">Qty {{ $item['quantity'] }}</p>
                        </div>
                        <p class="font-bold text-slate-900">₱{{ number_format($item['subtotal'], 2) }}</p>
                    </div>
                @endforeach
            </div>
            <div class="mt-6 border-t border-slate-100 pt-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-500">Total</span>
                    <span class="text-xl font-black text-slate-900">₱{{ number_format($subtotal, 2) }}</span>
                </div>
            </div>
        </aside>
    </div>
</div>
