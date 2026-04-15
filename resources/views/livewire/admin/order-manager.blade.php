<div class="space-y-8">
    <section class="fur-toolbar">
        <div>
            <p class="fur-section-kicker">Orders</p>
            <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl">Order management in one flowing timeline.</h1>
            <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-500">Review customer details, inspect items, and update fulfillment status without leaving the list view.</p>
        </div>

        <div class="flex items-center gap-3">
            <div class="text-sm text-slate-600">
                Total orders: <span class="font-bold text-slate-900">{{ $orders->total() }}</span>
            </div>
            <select wire:model.live="statusFilter" class="fur-input w-auto min-w-[170px]">
                <option value="all">All statuses</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>
    </section>

    <section class="space-y-4">
        @forelse ($orders as $order)
            <article class="fur-card overflow-hidden">
                <div class="border-b border-slate-100 bg-gradient-to-r from-slate-50/95 to-white px-6 py-6">
                    <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-bold uppercase tracking-[0.3em] text-slate-400">Order #{{ $order->id }}</p>
                            <h2 class="mt-2 text-2xl font-black text-slate-900">{{ $order->shipping_name }}</h2>
                            <p class="mt-2 text-sm text-slate-600">{{ $order->shipping_email }} | {{ $order->shipping_phone }}</p>
                            <p class="mt-2 text-sm leading-6 text-slate-500">{{ $order->shipping_address }}</p>
                        </div>

                        <div class="flex flex-col gap-3 lg:items-end">
                            <p class="text-3xl font-black text-slate-900">PHP {{ number_format($order->total_price, 2) }}</p>
                            <select wire:change="updateStatus({{ $order->id }}, $event.target.value)" class="fur-input min-w-[180px] font-semibold">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}" @selected($order->status === $status)>{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="border-b border-slate-100 px-6 py-6">
                    <p class="text-sm font-semibold text-slate-700">Items ordered</p>
                    <div class="mt-4 grid gap-3 md:grid-cols-2 xl:grid-cols-3">
                        @foreach ($order->items as $item)
                            <div class="rounded-[22px] border border-slate-100 bg-slate-50/90 p-4">
                                <div class="flex items-start gap-3">
                                    <div class="flex h-14 w-14 shrink-0 items-center justify-center overflow-hidden rounded-[18px] bg-gradient-to-br from-orange-100 via-white to-blue-100">
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

                                    <div class="min-w-0 flex-1">
                                        <p class="font-black text-slate-900">{{ $item->product?->name ?? 'Product removed' }}</p>
                                        <div class="mt-2 flex items-center justify-between text-sm text-slate-600">
                                            <span>Qty {{ $item->quantity }}</span>
                                            <span class="font-bold text-slate-900">PHP {{ number_format($item->price, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex flex-col gap-3 px-6 py-5 text-sm text-slate-500 md:flex-row md:items-center md:justify-between">
                    <p>Ordered {{ $order->created_at->format('M d, Y g:i A') }}</p>
                    <p>Customer account: <span class="font-semibold text-slate-700">{{ $order->user->name }}</span></p>
                </div>
            </article>
        @empty
            <div class="fur-card p-12 text-center">
                <h3 class="text-xl font-black text-slate-900">No orders yet</h3>
                <p class="mt-2 text-sm text-slate-500">Orders will appear here as customers start shopping.</p>
            </div>
        @endforelse
    </section>

    <div>{{ $orders->links() }}</div>
</div>
