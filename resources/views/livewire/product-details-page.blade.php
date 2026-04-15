<div class="fur-shell space-y-10 pt-10">
    <section class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr]">
        <div class="fur-card overflow-hidden">
            <div class="flex aspect-square items-center justify-center bg-gradient-to-br from-orange-100 via-white to-blue-100">
                @if ($product->image)
                    @if (strpos($product->image, 'http') === 0)
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="h-full w-full object-cover" loading="lazy">
                    @else
                        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover" loading="lazy">
                    @endif
                @else
                    <span class="text-7xl font-black text-white/90 drop-shadow">{{ strtoupper(substr($product->name, 0, 1)) }}</span>
                @endif
            </div>
        </div>

        <div class="fur-card p-8">
            <span class="fur-badge bg-blue-100 text-blue-600">{{ ucfirst($product->category) }}</span>
            <h1 class="mt-4 text-4xl font-black text-slate-900">{{ $product->name }}</h1>
            <p class="mt-4 text-base leading-8 text-slate-600">{{ $product->description }}</p>
            <div class="mt-8 flex items-center justify-between gap-4">
                <span class="text-3xl font-black text-slate-900">₱{{ number_format($product->price, 2) }}</span>
                <span class="text-sm font-semibold {{ $product->inStock() ? 'text-green-600' : 'text-red-500' }}">
                    {{ $product->inStock() ? $product->stock.' available now' : 'Currently unavailable' }}
                </span>
            </div>

            <div class="mt-8 flex flex-col gap-4 sm:flex-row">
                <input wire:model="quantity" type="number" min="1" max="{{ max($product->stock, 1) }}" class="fur-input sm:w-28">
                <button wire:click="addToCart" wire:loading.attr="disabled" class="fur-button flex-1" @disabled(! $product->inStock())>
                    Add to cart
                </button>
                <button wire:click="buyNow" wire:loading.attr="disabled" class="flex-1 rounded-2xl border-2 border-orange-500 bg-white px-4 py-3 text-sm font-semibold text-orange-500 transition hover:bg-orange-50" @disabled(! $product->inStock())>
                    Buy Now
                </button>
            </div>
            @error('quantity') <p class="mt-2 text-sm font-medium text-red-500">{{ $message }}</p> @enderror
        </div>
    </section>

    <!-- Reviews Section -->
    <section>
        <livewire:product-review :product="$product" />
    </section>

    <section class="pb-8">
        <div class="mb-5 flex items-end justify-between gap-4">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-green-500">You may also like</p>
                <h2 class="mt-2 text-2xl font-black text-slate-900">More in {{ ucfirst($product->category) }}</h2>
            </div>
            <a href="{{ route('shop.index', ['category' => $product->category]) }}" class="text-sm font-semibold text-slate-600">View category</a>
        </div>
        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
            @forelse ($relatedProducts as $relatedProduct)
                <a href="{{ route('shop.show', $relatedProduct) }}" class="fur-card block overflow-hidden p-4 transition duration-300 hover:-translate-y-1">
                    <div class="flex aspect-square items-center justify-center rounded-3xl bg-gradient-to-br from-orange-100 via-white to-blue-100">
                        @if ($relatedProduct->image)
                            @if (strpos($relatedProduct->image, 'http') === 0)
                                <img src="{{ $relatedProduct->image }}" alt="{{ $relatedProduct->name }}" class="h-full w-full rounded-3xl object-cover" loading="lazy">
                            @else
                                <img src="{{ asset('storage/'.$relatedProduct->image) }}" alt="{{ $relatedProduct->name }}" class="h-full w-full rounded-3xl object-cover" loading="lazy">
                            @endif
                        @else
                            <span class="text-4xl font-black text-white/90 drop-shadow">{{ strtoupper(substr($relatedProduct->name, 0, 1)) }}</span>
                        @endif
                    </div>
                    <h3 class="mt-4 text-lg font-bold text-slate-900">{{ $relatedProduct->name }}</h3>
                    <p class="mt-1 text-sm font-semibold text-slate-500">₱{{ number_format($relatedProduct->price, 2) }}</p>
                </a>
            @empty
                <div class="fur-card col-span-full p-8 text-center text-sm text-slate-500">More related products will show here as your catalog grows.</div>
            @endforelse
        </div>
    </section>
</div>
