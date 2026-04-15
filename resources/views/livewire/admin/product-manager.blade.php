<div class="space-y-8">
    <section class="fur-toolbar">
        <div>
            <p class="fur-section-kicker">Products</p>
            <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl">Product catalog management.</h1>
            <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-500">Create new items, refine existing listings, and keep pricing, stock, and featured products organized from a single view.</p>
        </div>
    </section>

    <div class="grid gap-8 xl:grid-cols-[400px_minmax(0,1fr)]">
        <div class="xl:sticky xl:top-24">
            <form wire:submit="save" class="fur-card space-y-5 p-6">
                <div>
                    <p class="fur-section-kicker">{{ $productId ? 'Editing product' : 'New product' }}</p>
                    <h2 class="mt-2 text-2xl font-black text-slate-900">{{ $productId ? 'Update listing details' : 'Create a new listing' }}</h2>
                </div>

                <div class="space-y-4 border-t border-slate-100 pt-4">
                    <label class="space-y-2">
                        <span class="text-sm font-semibold text-slate-700">Product name</span>
                        <input wire:model="name" type="text" placeholder="Premium Dog Food" class="fur-input">
                        @error('name') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                    </label>

                    <label class="space-y-2">
                        <span class="text-sm font-semibold text-slate-700">Category</span>
                        <select wire:model="category" class="fur-input">
                            @foreach ($categories as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                            @if ($existingCategory && ! array_key_exists($existingCategory, $categories))
                                <option value="{{ $existingCategory }}">Legacy: {{ ucfirst(str_replace('-', ' ', $existingCategory)) }}</option>
                            @endif
                        </select>
                        @error('category') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                    </label>

                    <div class="grid gap-3 sm:grid-cols-2">
                        <label class="space-y-2">
                            <span class="text-sm font-semibold text-slate-700">Price</span>
                            <input wire:model="price" type="number" step="0.01" placeholder="0.00" class="fur-input">
                            @error('price') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                        </label>
                        <label class="space-y-2">
                            <span class="text-sm font-semibold text-slate-700">Stock</span>
                            <input wire:model="stock" type="number" min="0" placeholder="0" class="fur-input">
                            @error('stock') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                        </label>
                    </div>

                    <label class="space-y-2">
                        <span class="text-sm font-semibold text-slate-700">Description</span>
                        <textarea wire:model="description" rows="4" placeholder="Describe this product..." class="fur-input text-sm"></textarea>
                        @error('description') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                    </label>

                    <label class="space-y-2">
                        <span class="text-sm font-semibold text-slate-700">Product image</span>
                        <input wire:model="image" type="file" accept=".jpg,.jpeg,.png,.webp" class="fur-input block w-full text-sm">
                        @error('image') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                        @if ($existingImage)
                            <p class="text-xs text-slate-500">Current image: {{ $existingImage }}</p>
                        @endif
                    </label>

                    <label class="flex items-center gap-3 rounded-[22px] bg-orange-50 px-4 py-3">
                        <input wire:model="is_featured" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-orange-600">
                        <span class="text-sm font-semibold text-slate-700">Feature on homepage</span>
                    </label>
                </div>

                <div class="flex gap-3 border-t border-slate-100 pt-4">
                    <button type="submit" class="fur-button flex-1">{{ $productId ? 'Update product' : 'Create product' }}</button>
                    <button type="button" wire:click="resetForm" class="fur-button-secondary">Reset</button>
                </div>
            </form>
        </div>

        <section class="fur-table-shell">
            <div class="border-b border-slate-100 px-6 py-5">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="fur-section-kicker">Catalog list</p>
                        <h2 class="mt-2 text-2xl font-black text-slate-900">Your products</h2>
                        <p class="mt-1 text-sm text-slate-500">Total products: <span class="font-bold text-slate-900">{{ $products->total() }}</span></p>
                    </div>
                    <input wire:model.live.debounce.350ms="search" type="text" placeholder="Search products..." class="fur-input sm:max-w-xs">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="border-b border-slate-100 bg-slate-50/70 text-slate-600">
                        <tr>
                            <th class="px-4 py-3 font-semibold">Product</th>
                            <th class="px-4 py-3 font-semibold">Category</th>
                            <th class="px-4 py-3 font-semibold text-right">Price</th>
                            <th class="px-4 py-3 font-semibold text-center">Stock</th>
                            <th class="px-4 py-3 font-semibold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($products as $product)
                            <tr class="transition-colors hover:bg-slate-50/80">
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-14 w-14 shrink-0 items-center justify-center overflow-hidden rounded-[18px] bg-gradient-to-br from-orange-100 via-white to-blue-100">
                                            @if ($product->image)
                                                @if (strpos($product->image, 'http') === 0)
                                                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="h-full w-full object-cover" loading="lazy">
                                                @else
                                                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover" loading="lazy">
                                                @endif
                                            @else
                                                <span class="text-lg font-black text-white/90 drop-shadow">{{ strtoupper(substr($product->name, 0, 1)) }}</span>
                                            @endif
                                        </div>

                                        <div class="min-w-0">
                                            <p class="font-black text-slate-900">{{ $product->name }}</p>
                                            <p class="mt-1 line-clamp-1 text-xs text-slate-500">{{ $product->description }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <span class="fur-badge bg-orange-100 text-orange-700">{{ ucfirst($product->category) }}</span>
                                </td>
                                <td class="px-4 py-4 text-right font-black text-slate-900">PHP {{ number_format($product->price, 2) }}</td>
                                <td class="px-4 py-4 text-center">
                                    <span class="fur-status-pill {{ $product->stock > 10 ? 'bg-emerald-100 text-emerald-700' : ($product->stock > 0 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                        {{ $product->stock }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button wire:click="edit({{ $product->id }})" class="fur-button-secondary px-4 py-2 text-xs">Edit</button>
                                        <button wire:click="delete({{ $product->id }})" wire:confirm="Delete this product?" class="rounded-full bg-red-50 px-4 py-2 text-xs font-semibold text-red-700 transition hover:bg-red-100">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-12 text-center text-sm text-slate-500">
                                    No products found. Create your first listing to get started.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-5">{{ $products->links() }}</div>
        </section>
    </div>
</div>
