<div class="fur-shell space-y-8 pt-4 sm:pt-6">
    @php
        $isAdminShopView = auth()->check()
            && auth()->user()->isAdmin()
            && (request()->routeIs('shop.*') || request()->routeIs('home'));
    @endphp

    <section class="fur-toolbar">
        <div class="max-w-2xl">
            <p class="fur-section-kicker">Shop catalog</p>
            <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl">Pet essentials for calmer homes and happier routines.</h1>
            <p class="mt-3 text-sm leading-7 text-slate-500">Browse by category, refine the list quickly, and move from discovery to checkout with less clutter.</p>
        </div>

        <div wire:loading.flex class="items-center gap-2 rounded-full bg-orange-50 px-4 py-2 text-sm font-semibold text-orange-700">
            <span class="h-2.5 w-2.5 animate-pulse rounded-full bg-orange-400"></span>
            Updating products
        </div>
    </section>

    <section class="fur-card p-5 sm:p-6">
        <div class="grid gap-4 md:grid-cols-3">
            <label class="space-y-2">
                <span class="text-sm font-semibold text-slate-700">Search</span>
                <input wire:model.live.debounce.400ms="search" type="text" placeholder="Toys, beds, bowls, carriers..." class="fur-input">
            </label>
            <label class="space-y-2">
                <span class="text-sm font-semibold text-slate-700">Category</span>
                <select wire:model.live="category" class="fur-input">
                    <option value="all">All categories</option>
                    @foreach ($categories as $key => $label)
                        <option value="{{ $key }}">{{ $label }}</option>
                    @endforeach
                </select>
            </label>
            <label class="space-y-2">
                <span class="text-sm font-semibold text-slate-700">Sort by</span>
                <select wire:model.live="sort" class="fur-input">
                    <option value="latest">Newest first</option>
                    <option value="name">Name A-Z</option>
                    <option value="price_low">Price low to high</option>
                    <option value="price_high">Price high to low</option>
                </select>
            </label>
        </div>
    </section>

    <section class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($products as $product)
            <article class="fur-card flex h-full flex-col overflow-hidden transition duration-300 hover:-translate-y-1">
                <a href="{{ route('shop.show', $product) }}" class="block">
                    <div class="flex aspect-[4/3] items-center justify-center overflow-hidden bg-gradient-to-br from-orange-100 via-white to-blue-100">
                        @if ($product->image)
                            @if (strpos($product->image, 'http') === 0)
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="h-full w-full object-cover" loading="lazy">
                            @else
                                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover" loading="lazy">
                            @endif
                        @else
                            <span class="text-5xl font-black text-white/90 drop-shadow">{{ strtoupper(substr($product->name, 0, 1)) }}</span>
                        @endif
                    </div>
                </a>

                <div class="flex flex-1 flex-col gap-4 p-6">
                    <div class="flex items-center justify-between gap-3">
                        <span class="fur-badge bg-slate-100 text-slate-700">{{ ucfirst($product->category) }}</span>
                        <span class="text-lg font-black text-slate-900">PHP {{ number_format($product->price, 2) }}</span>
                    </div>

                    <div class="flex-1">
                        <h2 class="text-xl font-black text-slate-900">{{ $product->name }}</h2>
                        <p class="mt-2 text-sm leading-7 text-slate-500">{{ \Illuminate\Support\Str::limit($product->description, 100) }}</p>
                    </div>

                    <div class="flex items-center justify-between gap-3">
                        <span class="fur-status-pill {{ $product->inStock() ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                            {{ $product->inStock() ? $product->stock.' available' : 'Sold Out' }}
                        </span>
                        <a href="{{ route('shop.show', $product) }}" class="fur-link">Details</a>
                    </div>

                    <div class="mt-auto flex flex-wrap gap-2">
                        <a href="{{ route('shop.show', $product) }}" class="fur-button-secondary flex-1 text-center">View</a>
                        @if (! $isAdminShopView)
                            <button wire:click="addToCart({{ $product->id }})" wire:loading.attr="disabled" class="fur-button flex-1 disabled:cursor-not-allowed disabled:opacity-60" @disabled(! $product->inStock())>
                                Add to cart
                            </button>
                            <button wire:click="buyNow({{ $product->id }})" wire:loading.attr="disabled" class="fur-button-secondary disabled:cursor-not-allowed disabled:opacity-60" @disabled(! $product->inStock())>
                                Buy now
                            </button>
                        @endif
                    </div>
                </div>
            </article>
        @empty
            <div class="fur-card col-span-full px-8 py-12 text-center">
                <h3 class="text-xl font-black text-slate-900">No products matched your filters.</h3>
                <p class="mt-2 text-sm text-slate-500">Try a different keyword, category, or sort option.</p>
            </div>
        @endforelse
    </section>

    <div>{{ $products->links() }}</div>
</div>
