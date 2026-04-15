<div class="space-y-8">
    <section class="fur-toolbar">
        <div>
            <p class="fur-section-kicker">Admin dashboard</p>
            <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl">A clearer snapshot of store health.</h1>
            <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-500">This workspace highlights stock, order activity, and revenue first so you can act quickly without hunting through tables.</p>
        </div>
    </section>

    <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        <div class="fur-stat">
            <p class="text-sm font-semibold text-slate-500">Total Products</p>
            <p class="mt-3 text-4xl font-black text-slate-900">{{ $metrics['products'] }}</p>
        </div>
        <div class="fur-stat">
            <p class="text-sm font-semibold text-slate-500">Total Orders</p>
            <p class="mt-3 text-4xl font-black text-slate-900">{{ $metrics['orders'] }}</p>
        </div>
        <div class="fur-stat">
            <p class="text-sm font-semibold text-slate-500">Active Shoppers</p>
            <p class="mt-3 text-4xl font-black text-slate-900">{{ $metrics['users'] }}</p>
        </div>
        <div class="fur-stat">
            <div class="pointer-events-none absolute -right-8 -top-8 h-24 w-24 rounded-full bg-orange-300/35 blur-3xl"></div>
            <div class="pointer-events-none absolute bottom-0 left-0 h-24 w-24 rounded-full bg-amber-200/35 blur-3xl"></div>
            <div class="relative">
                <p class="text-xs font-black uppercase tracking-[0.32em] text-orange-600">Revenue</p>
                <p class="mt-2 text-4xl font-black tracking-tight text-slate-950 sm:text-5xl">PHP {{ number_format($metrics['revenue'], 0) }}</p>
                <div class="mt-4 h-px w-full bg-gradient-to-r from-orange-200 via-orange-100 to-transparent"></div>

            </div>
        </div>
    </section>

    <section class="grid gap-6 xl:grid-cols-2">
        <div class="fur-card p-6">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="fur-section-kicker">Recent activity</p>
                    <h2 class="mt-2 text-2xl font-black text-slate-900">Recent orders</h2>
                </div>
                <a href="{{ route('admin.orders') }}" class="fur-link">View all</a>
            </div>

            <div class="mt-5 space-y-3">
                @forelse ($recentOrders as $order)
                    <div class="rounded-[24px] border border-slate-100 bg-slate-50/90 p-4">
                        <div class="flex items-center justify-between gap-4">
                            <div class="min-w-0">
                                <p class="font-black text-slate-900">#{{ $order->id }}</p>
                                <p class="text-sm text-slate-600">{{ $order->user->name }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-black text-slate-900">PHP {{ number_format($order->total_price, 2) }}</p>
                                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">{{ $order->status }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="rounded-[24px] border border-dashed border-slate-200 bg-slate-50 p-6 text-center">
                        <p class="text-sm text-slate-500">No orders yet. New activity will surface here automatically.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="fur-card p-6">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="fur-section-kicker">Inventory watch</p>
                    <h2 class="mt-2 text-2xl font-black text-slate-900">Low stock alerts</h2>
                </div>
                <a href="{{ route('admin.products') }}" class="fur-link">Manage products</a>
            </div>

            <div class="mt-5 space-y-3">
                @forelse ($lowStockProducts as $product)
                    <div class="rounded-[24px] border border-slate-100 bg-slate-50/90 p-4">
                        <div class="flex items-center justify-between gap-4">
                            <div class="min-w-0">
                                <p class="font-black text-slate-900">{{ $product->name }}</p>
                                <p class="text-sm text-slate-600">{{ ucfirst($product->category) }}</p>
                            </div>
                            <span class="fur-status-pill {{ $product->stock === 0 ? 'bg-red-100 text-red-700' : ($product->stock <= 2 ? 'bg-orange-100 text-orange-700' : 'bg-yellow-100 text-yellow-700') }}">
                                {{ $product->stock }} left
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="rounded-[24px] border border-dashed border-slate-200 bg-slate-50 p-6 text-center">
                        <p class="text-sm text-slate-500">All products are currently stocked well.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
