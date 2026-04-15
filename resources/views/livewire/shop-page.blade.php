<div class="fur-shell space-y-8 pt-10">
    @php
        $isAdminShopView = auth()->check()
            && auth()->user()->isAdmin()
            && (request()->routeIs('shop.*') || request()->routeIs('home'));
    @endphp
    
    <section class="fur-card overflow-hidden p-6 sm:p-8">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-orange-500">Shop</p>
            <h1 class="mt-2 text-3xl font-black text-slate-900">Pet essentials for happy paws and calmer homes</h1>
            </div>
            <div wire:loading.flex class="items-center gap-2 text-sm font-medium text-slate-500">
                <span class="h-2.5 w-2.5 animate-pulse rounded-full bg-orange-400"></span>
                Updating products...
            </div>
        </div>

        <div class="mt-6 grid gap-4 md:grid-cols-3">
            <input wire:model.live.debounce.400ms="search" type="text" placeholder="Search toys, beds, bowls..." class="fur-input md:col-span-1">
            <select wire:model.live="category" class="fur-input">
                <option value="all">All categories</option>
                @foreach ($categories as $key => $label)
                    <option value="{{ $key }}">{{ $label }}</option>
                @endforeach
            </select>
            <select wire:model.live="sort" class="fur-input">
                <option value="latest">Newest first</option>
                <option value="name">Name A-Z</option>
                <option value="price_low">Price low to high</option>
                <option value="price_high">Price high to low</option>
            </select>
        </div>
    </section>

    <section class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($products as $product)
            <article class="fur-card overflow-hidden transition duration-300 hover:-translate-y-1">
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
                <div class="p-6">
                    <div class="flex items-center justify-between gap-3">
                        <span class="fur-badge bg-slate-100 text-slate-600">{{ ucfirst($product->category) }}</span>
                        <span class="text-lg font-black text-slate-900">₱{{ number_format($product->price, 2) }}</span>
                    </div>
                    <h2 class="mt-4 text-xl font-bold text-slate-900">{{ $product->name }}</h2>
                    <p class="mt-2 text-sm leading-7 text-slate-500">{{ \Illuminate\Support\Str::limit($product->description, 100) }}</p>
                    <div class="mt-5 flex flex-col gap-3">
                        <div class="flex items-center justify-between gap-3">
                            <span class="text-sm font-medium {{ $product->inStock() ? 'text-green-600' : 'text-red-500' }}">
                                {{ $product->inStock() ? $product->stock.' in stock' : 'Out of stock' }}
                            </span>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('shop.show', $product) }}" class="fur-button-secondary">Details</a>
                            @if (!$isAdminShopView)
                                <button wire:click="addToCart({{ $product->id }})" wire:loading.attr="disabled" class="fur-button" @disabled(! $product->inStock())>
                                    Add
                                </button>
                                <button wire:click="buyNow({{ $product->id }})" wire:loading.attr="disabled" class="rounded-2xl border-2 border-orange-500 bg-white px-4 py-2 text-sm font-semibold text-orange-500 transition hover:bg-orange-50" @disabled(! $product->inStock())>
                                    Buy Now
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </article>
        @empty
            <div class="fur-card col-span-full p-12 text-center">
                <h3 class="text-xl font-bold text-slate-900">No products matched your filters.</h3>
                <p class="mt-2 text-sm text-slate-500">Try another search term or switch categories.</p>
            </div>
        @endforelse
    </section>

    <div>{{ $products->links() }}</div>
</div>
