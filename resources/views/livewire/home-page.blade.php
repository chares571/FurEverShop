<div class="space-y-14">
    @php
        $isAdminShopView = auth()->check()
            && auth()->user()->isAdmin()
            && (request()->routeIs('shop.*') || request()->routeIs('home'));

        $categoryDescriptions = [
            'dogs' => 'Beds, harnesses, toys, and daily comforts for energetic pups.',
            'cats' => 'Scratchers, feeders, calming corners, and playful cat favorites.',
            'hamsters' => 'Small habitat upgrades, bedding, wheels, and chew-safe picks.',
            'birds' => 'Perches, toys, feeders, and enrichment for brighter aviaries.',
            'fish' => 'Aquarium care, decor, filtration, and healthy tank essentials.',
            'rabbits' => 'Soft bedding, safe chews, and gentle comforts for rabbits.',
            'guinea-pigs' => 'Cozy hideaways, hay feeders, and everyday care supplies.',
            'ferrets' => 'Tunnels, hammocks, and active play picks made for curious ferrets.',
            'reptiles' => 'Habitat control, hides, lighting, and reptile-friendly support.',
        ];
    @endphp

    <section class="fur-shell pt-4 sm:pt-6">
        <div class="fur-card relative overflow-hidden px-6 py-8 sm:px-8 sm:py-10 lg:px-12 lg:py-12">
            <div class="fur-soft-grid absolute inset-y-0 right-0 hidden w-1/2 opacity-40 lg:block"></div>
            <div class="pointer-events-none absolute -right-12 top-10 h-56 w-56 rounded-full bg-orange-200/40 blur-3xl"></div>
            <div class="pointer-events-none absolute bottom-0 right-24 h-56 w-56 rounded-full bg-blue-200/30 blur-3xl"></div>

            <div class="relative grid gap-10 lg:grid-cols-[minmax(0,1.15fr)_380px] lg:items-center">
                <div>
                    <p class="fur-section-kicker">Trusted pet essentials store</p>
                    <h1 class="mt-4 max-w-3xl text-4xl font-black tracking-tight text-slate-900 sm:text-5xl lg:text-6xl">
                        Shopping for your pet should feel warm, clear, and genuinely helpful.
                    </h1>
                    <p class="mt-5 max-w-2xl text-lg leading-8 text-slate-600">
                        FurEver brings together thoughtful accessories, feeding essentials, and comfort picks in one calm storefront made for real pet routines.
                    </p>

                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('shop.index') }}" class="fur-button">Explore the shop</a>
                        <a href="#featured" class="fur-button-secondary">See featured picks</a>
                    </div>

                    <div class="mt-8 grid gap-4 sm:grid-cols-3">
                        <div class="fur-stat">
                            <p class="text-3xl font-black text-slate-900">{{ $stats['products'] }}</p>
                            <p class="mt-1 text-sm text-slate-500">Curated products</p>
                        </div>
                        <div class="fur-stat">
                            <p class="text-3xl font-black text-slate-900">{{ $stats['happyOrders'] }}</p>
                            <p class="mt-1 text-sm text-slate-500">Orders fulfilled</p>
                        </div>
                        <div class="fur-stat">
                            <p class="text-3xl font-black text-slate-900">{{ $stats['inStock'] }}</p>
                            <p class="mt-1 text-sm text-slate-500">In-stock favorites</p>
                        </div>
                    </div>
                </div>

                <div class="grid gap-4">
                    <div class="fur-card bg-slate-900 px-6 py-6 text-white">
                        <p class="text-xs font-bold uppercase tracking-[0.32em] text-orange-300">Why people stay</p>
                        <p class="mt-4 text-2xl font-black tracking-tight">Simple discovery, clear stock signals, and a checkout flow that stays out of the way.</p>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-1">
                        <div class="fur-card px-5 py-5">
                            <p class="text-sm font-semibold text-slate-500">Fast filtering</p>
                            <p class="mt-2 text-lg font-black text-slate-900">Find the right category quickly, then sort by what matters.</p>
                        </div>
                        <div class="fur-card px-5 py-5">
                            <p class="text-sm font-semibold text-slate-500">Made for repeat care</p>
                            <p class="mt-2 text-lg font-black text-slate-900">From daily supplies to special treats, the layout supports quick reorders.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="fur-shell">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="fur-section-kicker">Shop by companion</p>
                <h2 class="mt-2 text-3xl font-black tracking-tight text-slate-900">A clearer starting point for every kind of pet.</h2>
            </div>
            <p class="max-w-xl text-sm leading-6 text-slate-500">Choose a category and land on a filtered catalog designed to reduce browsing friction.</p>
        </div>

        <div class="mt-6 grid gap-5 md:grid-cols-2 xl:grid-cols-4">
            @foreach ($categories as $key => $label)
                <a href="{{ route('shop.index', ['category' => $key]) }}" class="fur-card group relative overflow-hidden px-6 py-6 transition duration-300 hover:-translate-y-1">
                    <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-orange-400 via-amber-300 to-blue-300 opacity-80"></div>
                    <div class="flex items-start justify-between gap-4">
                        <span class="fur-badge bg-slate-100 text-slate-700">{{ $label }}</span>
                        <span class="rounded-full bg-orange-50 px-3 py-1 text-xs font-bold uppercase tracking-[0.24em] text-orange-600">View</span>
                    </div>
                    <h3 class="mt-8 text-2xl font-black tracking-tight text-slate-900">{{ $label }}</h3>
                    <p class="mt-3 text-sm leading-7 text-slate-500">{{ $categoryDescriptions[$key] ?? 'Practical picks for comfort, play, and daily care.' }}</p>
                </a>
            @endforeach
        </div>
    </section>

    <section id="featured" class="fur-shell pb-8">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="fur-section-kicker">Featured products</p>
                <h2 class="mt-2 text-3xl font-black tracking-tight text-slate-900">Best-loved FurEver finds</h2>
            </div>
            <a href="{{ route('shop.index') }}" class="fur-link">Browse the full catalog</a>
        </div>

        <div class="mt-6 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($featuredProducts as $product)
                <article class="fur-card flex h-full flex-col overflow-hidden transition duration-300 hover:-translate-y-1">
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

                    <div class="flex flex-1 flex-col gap-4 p-6">
                        <div class="flex items-center justify-between gap-3">
                            <span class="fur-badge bg-slate-100 text-slate-700">{{ ucfirst($product->category) }}</span>
                            <span class="text-xl font-black text-slate-900">PHP {{ number_format($product->price, 2) }}</span>
                        </div>

                        <div class="flex-1">
                            <h3 class="text-xl font-black text-slate-900">{{ $product->name }}</h3>
                            <p class="mt-2 text-sm leading-7 text-slate-500">{{ \Illuminate\Support\Str::limit($product->description, 110) }}</p>
                        </div>

                        <div class="flex items-center justify-between text-sm">
                            <span class="fur-status-pill {{ $product->inStock() ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                {{ $product->inStock() ? $product->stock.' in stock' : 'Sold Out' }}
                            </span>
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
                <div class="fur-card col-span-full px-8 py-12 text-center text-slate-500">
                    Featured products will appear here after you seed or create them in the admin area.
                </div>
            @endforelse
        </div>
    </section>
</div>
