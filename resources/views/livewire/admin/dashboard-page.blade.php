<div class="space-y-6">
    <!-- Header -->
    <section>
        <p class="text-sm font-semibold uppercase tracking-[0.25em] text-orange-500">Dashboard</p>
        <h1 class="mt-2 text-3xl font-black text-slate-900">Welcome back!</h1>
        <p class="mt-1 text-slate-600">Monitor your shop performance and manage inventory</p>
    </section>

    <!-- Metrics Cards -->
    <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        <div class="fur-card overflow-hidden p-5">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-slate-500">Total Products</p>
                    <p class="mt-2 text-3xl font-black text-slate-900">{{ $metrics['products'] }}</p>
                </div>
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-orange-100">
                    <svg class="h-5 w-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="fur-card overflow-hidden p-5">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-slate-500">Total Orders</p>
                    <p class="mt-2 text-3xl font-black text-slate-900">{{ $metrics['orders'] }}</p>
                </div>
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100">
                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="fur-card overflow-hidden p-5">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-slate-500">Active Shoppers</p>
                    <p class="mt-2 text-3xl font-black text-slate-900">{{ $metrics['users'] }}</p>
                </div>
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-100">
                    <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM16 16H9m0 0H5m11 0a7 7 0 01-13 0" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="fur-card overflow-hidden p-5">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-slate-500">Total Revenue</p>
                    <p class="mt-2 text-3xl font-black text-slate-900">₱{{ number_format($metrics['revenue'], 0) }}</p>
                </div>
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-violet-100">
                    <svg class="h-6 w-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- Recent Activity -->
    <section class="grid gap-6 xl:grid-cols-2">
        <!-- Recent Orders -->
        <div class="fur-card p-5">
            <div class="flex items-center justify-between gap-4">
                <h2 class="text-lg font-black text-slate-900">Recent Orders</h2>
                <a href="{{ route('admin.orders') }}" class="text-sm font-semibold text-orange-600 hover:text-orange-700">View all</a>
            </div>
            <div class="mt-5 space-y-2">
                @forelse ($recentOrders as $order)
                    <div class="flex items-center justify-between rounded-lg border border-slate-100 bg-slate-50 p-3 transition-colors hover:bg-slate-100">
                        <div class="min-w-0 flex-1">
                            <p class="font-semibold text-slate-900">#{{ $order->id }}</p>
                            <p class="text-sm text-slate-600">{{ $order->user->name }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-black text-slate-900">₱{{ number_format($order->total_price, 2) }}</p>
                            <p class="text-xs font-medium text-slate-500">{{ ucfirst($order->status) }}</p>
                        </div>
                    </div>
                @empty
                    <div class="rounded-lg border border-dashed border-slate-200 bg-slate-50 p-6 text-center">
                        <p class="text-sm text-slate-500">No orders yet. Promotions coming soon!</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Low Stock Alerts -->
        <div class="fur-card p-5">
            <div class="flex items-center justify-between gap-4">
                <h2 class="text-lg font-black text-slate-900">Low Stock Alerts</h2>
                <a href="{{ route('admin.products') }}" class="text-sm font-semibold text-orange-600 hover:text-orange-700">Manage</a>
            </div>
            <div class="mt-5 space-y-2">
                @forelse ($lowStockProducts as $product)
                    <div class="flex items-center justify-between rounded-lg border border-slate-100 bg-slate-50 p-3 transition-colors hover:bg-slate-100">
                        <div class="min-w-0 flex-1">
                            <p class="font-semibold text-slate-900">{{ $product->name }}</p>
                            <p class="text-sm text-slate-600">{{ ucfirst($product->category) }}</p>
                        </div>
                        <div class="text-right">
                            <p class="rounded-full px-3 py-1 text-sm font-bold {{ $product->stock === 0 ? 'bg-red-100 text-red-700' : ($product->stock <= 2 ? 'bg-orange-100 text-orange-700' : 'bg-yellow-100 text-yellow-700') }}">
                                {{ $product->stock }} left
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="rounded-lg border border-dashed border-slate-200 bg-slate-50 p-6 text-center">
                        <p class="text-sm text-slate-500">✓ All products are well-stocked</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
