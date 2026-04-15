<div class="fur-shell space-y-8 pt-4 sm:pt-6">
    <section class="fur-toolbar">
        <div>
            <p class="fur-section-kicker">Checkout</p>
            <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl">A smooth finish for your FurEver order.</h1>
        </div>
        <p class="max-w-xl text-sm leading-7 text-slate-500">Clear shipping details, simple payment choices, and a steady summary panel keep the last step focused.</p>
    </section>

    <div class="grid gap-8 lg:grid-cols-[minmax(0,1fr)_360px]">
        <form wire:submit="placeOrder" class="fur-card space-y-6 p-6 sm:p-8">
            <div class="grid gap-4 md:grid-cols-2">
                <label class="space-y-2">
                    <span class="text-sm font-semibold text-slate-700">Full name</span>
                    <input wire:model="shipping_name" type="text" class="fur-input">
                    @error('shipping_name') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                </label>
                <label class="space-y-2">
                    <span class="text-sm font-semibold text-slate-700">Email</span>
                    <input wire:model="shipping_email" type="email" class="fur-input">
                    @error('shipping_email') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                </label>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <label class="space-y-2">
                    <span class="text-sm font-semibold text-slate-700">Phone</span>
                    <input wire:model="shipping_phone" type="text" class="fur-input">
                    @error('shipping_phone') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                </label>
                <label class="space-y-2">
                    <span class="text-sm font-semibold text-slate-700">Delivery notes</span>
                    <input wire:model="notes" type="text" class="fur-input" placeholder="Optional instructions">
                    @error('notes') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                </label>
            </div>

            <label class="space-y-2">
                <span class="text-sm font-semibold text-slate-700">Shipping address</span>
                <textarea wire:model="shipping_address" rows="5" class="fur-input"></textarea>
                @error('shipping_address') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
            </label>

            <div class="border-t border-slate-100 pt-6">
                <p class="text-sm font-semibold text-slate-700">Payment method</p>
                <div class="mt-4 grid gap-3">
                    <label @class([
                        'rounded-[24px] border p-4 transition',
                        'border-orange-300 bg-orange-50/80' => $payment_method === 'cash_on_delivery',
                        'border-slate-200 bg-white/80' => $payment_method !== 'cash_on_delivery',
                    ])>
                        <div class="flex items-start gap-3">
                            <input type="radio" wire:model="payment_method" value="cash_on_delivery" class="mt-1 h-4 w-4 text-orange-600">
                            <div>
                                <p class="font-semibold text-slate-900">Cash on Delivery</p>
                                <p class="text-sm text-slate-500">Pay when your order arrives.</p>
                            </div>
                        </div>
                    </label>
                    <label @class([
                        'rounded-[24px] border p-4 transition',
                        'border-orange-300 bg-orange-50/80' => $payment_method === 'e_wallet',
                        'border-slate-200 bg-white/80' => $payment_method !== 'e_wallet',
                    ])>
                        <div class="flex items-start gap-3">
                            <input type="radio" wire:model="payment_method" value="e_wallet" class="mt-1 h-4 w-4 text-orange-600">
                            <div>
                                <p class="font-semibold text-slate-900">E-Wallet</p>
                                <p class="text-sm text-slate-500">GCash, Maya, and similar wallet payments.</p>
                            </div>
                        </div>
                    </label>
                    <label @class([
                        'rounded-[24px] border p-4 transition',
                        'border-orange-300 bg-orange-50/80' => $payment_method === 'bank_transfer',
                        'border-slate-200 bg-white/80' => $payment_method !== 'bank_transfer',
                    ])>
                        <div class="flex items-start gap-3">
                            <input type="radio" wire:model="payment_method" value="bank_transfer" class="mt-1 h-4 w-4 text-orange-600">
                            <div>
                                <p class="font-semibold text-slate-900">Bank Transfer</p>
                                <p class="text-sm text-slate-500">Direct bank deposit before fulfillment.</p>
                            </div>
                        </div>
                    </label>
                </div>
                @error('payment_method') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="fur-button w-full" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="placeOrder">Place order</span>
                <span wire:loading wire:target="placeOrder">Processing your order</span>
            </button>
        </form>

        <aside class="fur-card h-fit p-6">
            <p class="fur-section-kicker">Order summary</p>
            <h2 class="mt-2 text-2xl font-black text-slate-900">Review before you place it.</h2>

            <div class="mt-5 space-y-3">
                @foreach ($items as $item)
                    <div class="rounded-[22px] bg-slate-50/90 px-4 py-4">
                        <div class="flex items-center justify-between gap-4 text-sm">
                            <div>
                                <p class="font-semibold text-slate-800">{{ $item['name'] }}</p>
                                <p class="text-slate-500">Qty {{ $item['quantity'] }}</p>
                            </div>
                            <p class="font-black text-slate-900">PHP {{ number_format($item['subtotal'], 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 border-t border-slate-100 pt-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-500">Total</span>
                    <span class="text-2xl font-black text-slate-900">PHP {{ number_format($subtotal, 2) }}</span>
                </div>
            </div>
        </aside>
    </div>
</div>
