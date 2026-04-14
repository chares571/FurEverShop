<div class="fur-shell space-y-8 pt-10">
    <section class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-blue-500">Orders</p>
            <h1 class="mt-2 text-3xl font-black text-slate-900">Your FurEver order history</h1>
        </div>
        <a href="{{ route('shop.index') }}" class="fur-button-secondary">Shop again</a>
    </section>

    @if (session('success'))
        <div class="fur-card border border-green-100 bg-green-50 px-5 py-4 text-sm font-medium text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <section class="space-y-5">
        @forelse ($orders as $order)
            <article class="fur-card p-6">
                <div class="flex flex-col gap-4 border-b border-slate-100 pb-5 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Order #{{ $order->id }}</p>
                        <h2 class="mt-2 text-xl font-bold text-slate-900">{{ ucfirst($order->status) }}</h2>
                    </div>
                    <div class="text-sm text-slate-500">
                        <p>{{ $order->created_at->format('M d, Y h:i A') }}</p>
                        <p class="text-lg font-black text-slate-900">₱{{ number_format($order->total_price, 2) }}</p>
                    </div>
                </div>
                <div class="mt-5 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($order->items as $item)
                        <div class="rounded-3xl bg-slate-50 p-4">
                            <p class="font-bold text-slate-900">{{ $item->product?->name ?? 'Product removed' }}</p>
                            <p class="mt-1 text-sm text-slate-500">Qty {{ $item->quantity }}</p>
                            <p class="mt-1 text-sm font-semibold text-slate-700">₱{{ number_format($item->price, 2) }}</p>
                        </div>
                    @endforeach
                </div>
            </article>
        @empty
            <div class="fur-card p-12 text-center">
                <h2 class="text-2xl font-black text-slate-900">No orders yet</h2>
                <p class="mt-2 text-sm text-slate-500">Your completed checkouts will show up here.</p>
            </div>
        @endforelse
    </section>

    <div>{{ $orders->links() }}</div>
</div>
