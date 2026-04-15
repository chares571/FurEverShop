<div class="fur-shell space-y-10 pt-4 sm:pt-6">
    <section class="fur-panel-grid">
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

        <div class="fur-card p-6 sm:p-8">
            <p class="fur-section-kicker">{{ ucfirst($product->category) }}</p>
            <h1 class="mt-3 text-4xl font-black tracking-tight text-slate-900">{{ $product->name }}</h1>
            <p class="mt-4 text-base leading-8 text-slate-600">{{ $product->description }}</p>

            <div class="mt-8 flex flex-col gap-3 rounded-[28px] bg-slate-50/80 p-5 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm font-semibold text-slate-500">Price</p>
                    <p class="mt-1 text-3xl font-black text-slate-900">PHP {{ number_format($product->price, 2) }}</p>
                </div>
                <span class="fur-status-pill {{ $product->inStock() ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                    {{ $product->inStock() ? $product->stock.' available now' : 'Sold Out' }}
                </span>
            </div>

            <div class="mt-8 flex flex-col gap-4 sm:flex-row">
                <label class="space-y-2">
                    <span class="text-sm font-semibold text-slate-700">Quantity</span>
                    <input wire:model="quantity" type="number" min="1" max="{{ max($product->stock, 1) }}" class="fur-input sm:w-32 disabled:cursor-not-allowed disabled:opacity-60" @disabled(! $product->inStock())>
                </label>
                <div class="flex flex-1 flex-col gap-3 sm:flex-row sm:items-end">
                    <button wire:click="addToCart" wire:loading.attr="disabled" class="fur-button flex-1 disabled:cursor-not-allowed disabled:opacity-60" @disabled(! $product->inStock())>
                        Add to cart
                    </button>
                    <button wire:click="buyNow" wire:loading.attr="disabled" class="fur-button-secondary flex-1 disabled:cursor-not-allowed disabled:opacity-60" @disabled(! $product->inStock())>
                        Buy now
                    </button>
                </div>
            </div>
            @error('quantity') <p class="mt-2 text-sm font-medium text-red-500">{{ $message }}</p> @enderror
        </div>
    </section>

    <section id="reviews">
        <livewire:product-review :product="$product" />
    </section>

    <section class="pb-8">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="fur-section-kicker">More to explore</p>
                <h2 class="mt-2 text-3xl font-black tracking-tight text-slate-900">More in {{ ucfirst($product->category) }}</h2>
            </div>
            <a href="{{ route('shop.index', ['category' => $product->category]) }}" class="fur-link">View category</a>
        </div>

        <div class="mt-6 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
            @forelse ($relatedProducts as $relatedProduct)
                <a href="{{ route('shop.show', $relatedProduct) }}" class="fur-card block overflow-hidden p-4 transition duration-300 hover:-translate-y-1">
                    <div class="flex aspect-square items-center justify-center rounded-[24px] bg-gradient-to-br from-orange-100 via-white to-blue-100">
                        @if ($relatedProduct->image)
                            @if (strpos($relatedProduct->image, 'http') === 0)
                                <img src="{{ $relatedProduct->image }}" alt="{{ $relatedProduct->name }}" class="h-full w-full rounded-[24px] object-cover" loading="lazy">
                            @else
                                <img src="{{ asset('storage/'.$relatedProduct->image) }}" alt="{{ $relatedProduct->name }}" class="h-full w-full rounded-[24px] object-cover" loading="lazy">
                            @endif
                        @else
                            <span class="text-4xl font-black text-white/90 drop-shadow">{{ strtoupper(substr($relatedProduct->name, 0, 1)) }}</span>
                        @endif
                    </div>
                    <h3 class="mt-4 text-lg font-black text-slate-900">{{ $relatedProduct->name }}</h3>
                    <p class="mt-1 text-sm font-semibold text-slate-500">PHP {{ number_format($relatedProduct->price, 2) }}</p>
                </a>
            @empty
                <div class="fur-card col-span-full p-8 text-center text-sm text-slate-500">More related products will show here as your catalog grows.</div>
            @endforelse
        </div>
    </section>
</div>
