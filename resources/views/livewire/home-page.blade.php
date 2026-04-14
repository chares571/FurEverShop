<div class="space-y-14">
    <section class="fur-shell pt-10">
        <div class="grid gap-8 lg:grid-cols-[1.2fr_0.8fr] lg:items-center">
            <div class="fur-card overflow-hidden px-7 py-10 sm:px-10">
                <span class="fur-badge bg-orange-100 text-orange-600">Livewire-powered pet boutique</span>
                <h1 class="mt-6 max-w-2xl text-4xl font-black tracking-tight text-slate-900 sm:text-6xl">
                    FurEver makes pet shopping feel warm, fast, and joyful.
                </h1>
                <p class="mt-5 max-w-2xl text-lg leading-8 text-slate-600">
                    Browse lovable essentials for dogs, cats, and everyday adventures with a smooth real-time shopping flow.
                </p>
                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('shop.index') }}" class="fur-button">Shop Now</a>
                    <a href="#featured" class="fur-button-secondary">See Featured Picks</a>
                </div>
                <div class="mt-10 grid gap-4 sm:grid-cols-3">
                    <div class="rounded-3xl bg-orange-50 p-4">
                        <p class="text-2xl font-black text-slate-900">{{ $stats['products'] }}</p>
                        <p class="text-sm text-slate-500">Curated products</p>
                    </div>
                    <div class="rounded-3xl bg-green-50 p-4">
                        <p class="text-2xl font-black text-slate-900">{{ $stats['happyOrders'] }}</p>
                        <p class="text-sm text-slate-500">Orders delivered</p>
                    </div>
                    <div class="rounded-3xl bg-blue-50 p-4">
                        <p class="text-2xl font-black text-slate-900">{{ $stats['inStock'] }}</p>
                        <p class="text-sm text-slate-500">In-stock favorites</p>
                    </div>
                </div>
            </div>

            <div class="grid gap-4">
                <div class="fur-card rotate-[-2deg] p-6">
                    <p class="text-sm font-semibold uppercase tracking-[0.25em] text-green-500">Pet-friendly design</p>
                    <p class="mt-3 text-2xl font-bold text-slate-900">Soft visuals, quick cart actions, and a cleaner path to checkout.</p>
                </div>
                <div class="fur-card rotate-[2deg] bg-gradient-to-br from-blue-50 to-white p-6">
                    <p class="text-sm font-semibold uppercase tracking-[0.25em] text-blue-500">Real-time shopping</p>
                    <p class="mt-3 text-2xl font-bold text-slate-900">Search, filter, and update your cart instantly with Livewire.</p>
                </div>
            </div>
        </div>
    </section>

    @php
        $categoryDescriptions = [
            'dogs' => 'Supportive beds, harnesses, toys, and essentials for adventurous pups.',
            'cats' => 'Cat-friendly tunnels, scratchers, bowls, and calm lounging gear.',
            'hamsters' => 'Small-animal bedding, wheels, hideaways, and chew-safe accessories.',
            'birds' => 'Perches, toys, feeders, and habitat comforts for happy birds.',
            'fish' => 'Aquarium filters, decor, and care supplies for healthy aquatic habitats.',
            'rabbits' => 'Soft bedding, safe chew toys, and cozy home comforts for rabbits.',
            'guinea-pigs' => 'Cuddly supplies, hay feeders, and cozy living essentials for guinea pigs.',
            'ferrets' => 'Play tunnels, soft bedding, and safe fun gear designed for ferrets.',
            'reptiles' => 'Heat lamps, hides, and habitat essentials for reptiles and amphibians.',
        ];
    @endphp
    <section class="fur-shell">
        <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($categories as $key => $label)
                <a href="{{ route('shop.index', ['category' => $key]) }}" class="fur-card group overflow-hidden p-6 transition duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <span class="fur-badge {{ $loop->index % 5 === 0 ? 'bg-orange-100 text-orange-600' : ($loop->index % 5 === 1 ? 'bg-green-100 text-green-600' : ($loop->index % 5 === 2 ? 'bg-blue-100 text-blue-600' : ($loop->index % 5 === 3 ? 'bg-purple-100 text-purple-600' : 'bg-pink-100 text-pink-600'))) }}">{{ $label }}</span>
                        <span class="text-xl">→</span>
                    </div>
                    <h2 class="mt-8 text-2xl font-black text-slate-900">{{ $label }}</h2>
                    <p class="mt-2 text-sm leading-7 text-slate-500">{{ $categoryDescriptions[$key] ?? 'Stylish picks built for comfort, play, and care' }}</p>
                </a>
            @endforeach
        </div>
    </section>

    <section id="featured" class="fur-shell pb-8">
        <div class="mb-6 flex items-end justify-between gap-4">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-orange-500">Featured</p>
                <h2 class="mt-2 text-3xl font-black text-slate-900">Best-loved FurEver finds</h2>
            </div>
            <a href="{{ route('shop.index') }}" class="text-sm font-semibold text-slate-600">Browse all products</a>
        </div>
        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($featuredProducts as $product)
                <article class="fur-card overflow-hidden transition duration-300 hover:-translate-y-1">
                    <div class="flex aspect-[4/3] items-center justify-center bg-gradient-to-br from-orange-100 via-white to-blue-100">
                        @if ($product->image)
                            <img src="{{ str_starts_with($product->image, 'http') ? $product->image : asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                        @else
                            <span class="text-5xl font-black text-white/90 drop-shadow">{{ strtoupper(substr($product->name, 0, 1)) }}</span>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between gap-3">
                            <span class="fur-badge bg-slate-100 text-slate-600">{{ ucfirst($product->category) }}</span>
                            <span class="text-lg font-black text-slate-900">₱{{ number_format($product->price, 2) }}</span>
                        </div>
                        <h3 class="mt-4 text-xl font-bold text-slate-900">{{ $product->name }}</h3>
                        <p class="mt-2 text-sm leading-7 text-slate-500">{{ \Illuminate\Support\Str::limit($product->description, 110) }}</p>
                        <div class="mt-5 flex items-center justify-between">
                            <span class="text-sm font-medium text-slate-500">{{ $product->stock }} left</span>
                            <a href="{{ route('shop.show', $product) }}" class="fur-button-secondary">View</a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="fur-card col-span-full p-10 text-center text-slate-500">Featured products will appear here after seeding or creating them in admin.</div>
            @endforelse
        </div>
    </section>
</div>
