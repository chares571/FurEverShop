<div class="space-y-8">
    <!-- Header -->
    <section>
        <p class="text-sm font-semibold uppercase tracking-[0.25em] text-blue-500">Orders</p>
        <h1 class="mt-2 text-4xl font-black text-slate-900">Order Management</h1>
        <p class="mt-1 text-slate-600">Track and update customer orders in real-time</p>
    </section>

    <!-- Filters -->
    <section class="flex items-center justify-between">
        <div class="text-sm text-slate-600">
            Total Orders: <span class="font-bold text-slate-900">{{ $orders->total() }}</span>
        </div>
        <select wire:model.live="statusFilter" class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700">
            <option value="all">All statuses</option>
            @foreach ($statuses as $status)
                <option value="{{ $status }}">{{ ucfirst($status) }}</option>
            @endforeach
        </select>
    </section>

    <!-- Orders List -->
    <section class="space-y-4">
        @forelse ($orders as $order)
            <article class="fur-card overflow-hidden transition-shadow hover:shadow-md">
                <!-- Order Header -->
                <div class="flex flex-col gap-4 border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white p-6 md:flex-row md:items-start md:justify-between">
                    <div class="min-w-0 flex-1">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Order #{{ $order->id }}</p>
                        <h3 class="mt-2 text-xl font-black text-slate-900">{{ $order->shipping_name }}</h3>
                        <p class="mt-1 text-sm text-slate-600">{{ $order->shipping_email }} • {{ $order->shipping_phone }}</p>
                        <p class="mt-2 text-sm text-slate-600">📍 {{ $order->shipping_address }}</p>
                    </div>
                    <div class="flex flex-col items-end gap-3">
                        <p class="text-3xl font-black text-slate-900">₱{{ number_format($order->total_price, 2) }}</p>
                        <select wire:change="updateStatus({{ $order->id }}, $event.target.value)" class="rounded-lg border-2 border-slate-200 bg-white px-3 py-2 text-sm font-bold" style="border-color: {{ ['pending' => '#ef4444', 'processing' => '#f59e0b', 'shipped' => '#3b82f6', 'delivered' => '#10b981', 'cancelled' => '#6b7280'][$order->status] ?? '#6b7280' }};">
                            @foreach ($statuses as $status)
                                <option value="{{ $status }}" @selected($order->status === $status)>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="border-b border-slate-100 px-6 py-6">
                    <h4 class="mb-4 text-sm font-bold uppercase tracking-wider text-slate-600">Items Ordered</h4>
                    <div class="grid gap-3 md:grid-cols-2 xl:grid-cols-3">
                        @foreach ($order->items as $item)
                            <div class="rounded-lg border border-slate-100 bg-slate-50 p-4">
                                <p class="font-bold text-slate-900">{{ $item->product?->name ?? '❌ Product removed' }}</p>
                                <p class="mt-2 flex items-center justify-between text-sm font-medium text-slate-600">
                                    <span>Qty: <span class="font-bold">{{ $item->quantity }}</span></span>
                                    <span class="text-slate-900">₱{{ number_format($item->price, 2) }}</span>
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Order Meta -->
                <div class="flex flex-col gap-3 p-6 text-xs text-slate-500 md:flex-row md:justify-between md:items-center">
                    <div>
                        <p>📅 Ordered: <span class="font-bold text-slate-700">{{ $order->created_at->format('M d, Y g:i A') }}</span></p>
                    </div>
                    <div class="text-right">
                        <p>👤 By: <span class="font-bold text-slate-700">{{ $order->user->name }}</span></p>
                    </div>
                </div>
            </article>
        @empty
            <!-- Empty State -->
            <div class="rounded-lg border-2 border-dashed border-slate-200 bg-slate-50 p-12 text-center">
                <svg class="mx-auto h-16 w-16 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <h3 class="mt-4 text-lg font-black text-slate-900">No orders yet</h3>
                <p class="mt-2 text-sm text-slate-600">Orders will appear here as customers start shopping. Keep promoting! 🚀</p>
            </div>
        @endforelse
    </section>

    <!-- Pagination -->
    <div class="flex justify-center">
        {{ $orders->links() }}
    </div>
</div>
