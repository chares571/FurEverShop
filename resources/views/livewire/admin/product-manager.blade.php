<div class="space-y-8">
    <!-- Header -->
    <section>
        <p class="text-sm font-semibold uppercase tracking-[0.25em] text-orange-500">Products</p>
        <h1 class="mt-2 text-4xl font-black text-slate-900">Product Catalog</h1>
        <p class="mt-1 text-slate-600">Create and manage your FurEver inventory</p>
    </section>

    <div class="grid gap-8 xl:grid-cols-[400px_1fr]">
        <!-- Form Card -->
        <div class="xl:sticky xl:top-24">
            <form wire:submit="save" class="fur-card space-y-5 p-6">
                <h2 class="text-lg font-black text-slate-900">{{ $productId ? '✏️ Edit Product' : '➕ New Product' }}</h2>

                <div class="space-y-4 border-t border-slate-100 pt-4">
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Product Name</label>
                        <input wire:model="name" type="text" placeholder="e.g., Premium Dog Food" class="fur-input">
                        @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Category</label>
                        <select wire:model="category" class="fur-input">
                            @foreach ($categories as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                            @if ($existingCategory && ! array_key_exists($existingCategory, $categories))
                                <option value="{{ $existingCategory }}">Legacy: {{ ucfirst(str_replace('-', ' ', $existingCategory)) }}</option>
                            @endif
                        </select>
                        @error('category') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid gap-3 sm:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">Price (₱)</label>
                            <input wire:model="price" type="number" step="0.01" placeholder="0.00" class="fur-input">
                            @error('price') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">Stock</label>
                            <input wire:model="stock" type="number" min="0" placeholder="0" class="fur-input">
                            @error('stock') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Description <span class="text-xs font-normal text-slate-500">(optional)</span></label>
                        <textarea wire:model="description" rows="4" placeholder="Describe this product..." class="fur-input text-sm"></textarea>
                        @error('description') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Product Image</label>
                        <input wire:model="image" type="file" accept=".jpg,.jpeg,.png,.webp" class="fur-input block w-full text-sm">
                        @error('image') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        @if ($existingImage)
                            <p class="mt-2 text-xs text-slate-500">📷 {{ $existingImage }}</p>
                        @endif
                    </div>

                    <label class="flex items-center gap-3 rounded-lg bg-orange-50 px-4 py-3">
                        <input wire:model="is_featured" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-orange-600">
                        <span class="text-sm font-semibold text-slate-700">Feature on homepage</span>
                    </label>
                </div>

                <div class="flex gap-3 border-t border-slate-100 pt-4">
                    <button type="submit" class="fur-button flex-1">
                        {{ $productId ? 'Update' : 'Create' }} Product
                    </button>
                    <button type="button" wire:click="resetForm" class="fur-button-secondary">Reset</button>
                </div>
            </form>
        </div>

        <!-- Products Table -->
        <section class="fur-card p-6">
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-lg font-black text-slate-900">Your Products</h2>
                    <p class="mt-1 text-sm text-slate-600">Total: <span class="font-bold">{{ $products->total() }}</span></p>
                </div>
                <input wire:model.live.debounce.350ms="search" type="text" placeholder="🔍 Search products..." class="fur-input sm:max-w-xs">
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="border-b border-slate-100 text-slate-600">
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
                            <tr class="transition-colors hover:bg-slate-50">
                                <td class="px-4 py-4">
                                    <p class="font-bold text-slate-900">{{ $product->name }}</p>
                                    <p class="mt-1 line-clamp-1 text-xs text-slate-500">{{ $product->description }}</p>
                                </td>
                                <td class="px-4 py-4">
                                    <span class="inline-block rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-700">{{ ucfirst($product->category) }}</span>
                                </td>
                                <td class="px-4 py-4 font-bold text-slate-900">₱{{ number_format($product->price, 2) }}</td>
                                <td class="px-4 py-4 text-center">
                                    <span class="inline-block rounded-full px-3 py-1 text-xs font-bold {{ $product->stock > 10 ? 'bg-emerald-100 text-emerald-700' : ($product->stock > 0 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                        {{ $product->stock }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button wire:click="edit({{ $product->id }})" class="rounded-lg bg-slate-100 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-200">Edit</button>
                                        <button wire:click="delete({{ $product->id }})" wire:confirm="Delete this product?" class="rounded-lg bg-red-100 px-3 py-2 text-xs font-semibold text-red-700 hover:bg-red-200">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-12 text-center">
                                    <p class="text-sm text-slate-500">No products found. Create your first product to get started!</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex justify-center">{{ $products->links() }}</div>
        </section>
    </div>
</div>
