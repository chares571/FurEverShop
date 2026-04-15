<div class="fur-shell space-y-8 pt-4 sm:pt-6">
    <section class="fur-toolbar">
        <div>
            <p class="fur-section-kicker">Orders</p>
            <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl">Your FurEver order history.</h1>
            <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-500">Track status updates faster, review completed purchases, and jump straight to product feedback when you are ready.</p>
        </div>
        <a href="{{ route('shop.index') }}" class="fur-button-secondary">Shop again</a>
    </section>

    <section class="space-y-5">
        @forelse ($orders as $order)
            @php
                $statusClasses = match ($order->status) {
                    \App\Models\Order::STATUS_COMPLETED => 'bg-emerald-100 text-emerald-700',
                    \App\Models\Order::STATUS_PROCESSING => 'bg-blue-100 text-blue-700',
                    \App\Models\Order::STATUS_CANCELLED => 'bg-red-100 text-red-700',
                    default => 'bg-amber-100 text-amber-700',
                };
            @endphp

            <article class="fur-card overflow-hidden p-6 sm:p-7">
                <div class="flex flex-col gap-5 border-b border-slate-100 pb-6 lg:flex-row lg:items-start lg:justify-between">
                    <div class="space-y-4">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-[0.3em] text-slate-400">Order #{{ $order->id }}</p>
                            <div class="mt-3 flex flex-wrap items-center gap-3">
                                <h2 class="text-2xl font-black text-slate-900">{{ ucfirst($order->status) }}</h2>
                                <span class="fur-status-pill {{ $statusClasses }}">{{ ucfirst($order->status) }}</span>
                            </div>
                        </div>

                        <div class="grid gap-3 sm:grid-cols-3">
                            <div class="fur-metric-card">
                                <p class="text-xs font-bold uppercase tracking-[0.24em] text-slate-400">Placed</p>
                                <p class="mt-2 text-sm font-semibold text-slate-700">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                            </div>
                            <div class="fur-metric-card">
                                <p class="text-xs font-bold uppercase tracking-[0.24em] text-slate-400">Items</p>
                                <p class="mt-2 text-2xl font-black text-slate-900">{{ $order->items->sum('quantity') }}</p>
                            </div>
                            <div class="fur-metric-card">
                                <p class="text-xs font-bold uppercase tracking-[0.24em] text-slate-400">Total</p>
                                <p class="mt-2 text-2xl font-black text-slate-900">PHP {{ number_format($order->total_price, 2) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3 lg:items-end">
                        @if (in_array($order->status, ['pending', 'processing']))
                            <button
                                wire:click="cancelOrder({{ $order->id }})"
                                wire:confirm="Are you sure you want to cancel this order? Stock will be restored."
                                class="inline-flex items-center justify-center rounded-full bg-red-50 px-4 py-2 text-sm font-semibold text-red-700 transition hover:bg-red-100"
                            >
                                Cancel order
                            </button>
                        @elseif ($order->status === \App\Models\Order::STATUS_COMPLETED)
                            <div class="fur-subtle-panel px-4 py-3 text-sm text-slate-600 lg:max-w-xs">
                                <p class="font-semibold text-slate-800">Completed successfully</p>
                                <p class="mt-1 leading-6">You can now leave feedback for the products in this order.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($order->items as $item)
                        @php
                            $canRate = $order->status === \App\Models\Order::STATUS_COMPLETED
                                && $item->product
                                && ! isset($reviewedProductIds[$item->product->id]);
                        @endphp

                        <div class="fur-subtle-panel flex h-full flex-col p-4">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex min-w-0 items-start gap-3">
                                    <div class="flex h-16 w-16 shrink-0 items-center justify-center overflow-hidden rounded-[18px] bg-gradient-to-br from-orange-100 via-white to-blue-100">
                                        @if ($item->product?->image)
                                            @if (strpos($item->product->image, 'http') === 0)
                                                <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="h-full w-full object-cover" loading="lazy">
                                            @else
                                                <img src="{{ asset('storage/'.$item->product->image) }}" alt="{{ $item->product->name }}" class="h-full w-full object-cover" loading="lazy">
                                            @endif
                                        @elseif ($item->product)
                                            <span class="text-lg font-black text-white/90 drop-shadow">{{ strtoupper(substr($item->product->name, 0, 1)) }}</span>
                                        @else
                                            <span class="text-xs font-black uppercase tracking-[0.2em] text-slate-400">N/A</span>
                                        @endif
                                    </div>

                                    <div class="min-w-0">
                                        <p class="font-black text-slate-900">{{ $item->product?->name ?? 'Product removed' }}</p>
                                        <p class="mt-1 text-sm text-slate-500">Qty {{ $item->quantity }}</p>
                                    </div>
                                </div>
                                <p class="text-sm font-semibold text-slate-700">PHP {{ number_format($item->price, 2) }}</p>
                            </div>

                            <div class="mt-4 flex items-center justify-between gap-3">
                                @if ($item->product)
                                    <a href="{{ route('shop.show', $item->product) }}" class="fur-link">View product</a>
                                @else
                                    <span class="text-sm text-slate-400">No product link</span>
                                @endif

                                @if ($canRate)
                                    <a href="{{ route('shop.show', $item->product) }}#reviews" class="fur-button px-4 py-2">
                                        Rate
                                    </a>
                                @elseif ($order->status === \App\Models\Order::STATUS_COMPLETED && $item->product)
                                    <span class="fur-status-pill bg-slate-200 text-slate-600">Reviewed</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </article>
        @empty
            <div class="fur-card p-12 text-center">
                <h2 class="text-2xl font-black text-slate-900">No orders yet</h2>
                <p class="mt-2 text-sm text-slate-500">Your completed checkouts and feedback actions will show up here.</p>
            </div>
        @endforelse
    </section>

    <div>{{ $orders->links() }}</div>
</div>
