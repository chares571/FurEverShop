<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use App\Support\FurEver;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ProductManager extends Component
{
    use WithFileUploads;
    use WithPagination;

    public ?int $productId = null;
    public string $name = '';
    public string $category = 'dogs';
    public string $description = '';
    public string $price = '';
    public string $stock = '0';
    public bool $is_featured = false;
    public $image;
    public ?string $existingImage = null;
    public ?string $existingCategory = null;
    public string $search = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function save(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', Rule::in(array_keys(FurEver::categories()))],
            'description' => ['required', 'string', 'max:4000'],
            'price' => ['required', 'numeric', 'min:0.01'],
            'stock' => ['required', 'integer', 'min:0'],
            'is_featured' => ['boolean'],
            'image' => ['nullable', 'image', 'max:2048', 'mimes:jpg,jpeg,png,webp'],
        ]);

        $product = $this->productId ? Product::query()->findOrFail($this->productId) : new Product();
        $product->fill([
            'name' => $validated['name'],
            'slug' => $product->slug,
            'category' => $validated['category'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'is_featured' => $validated['is_featured'] ?? false,
        ]);

        $product->save();

        if (!$this->productId) {
            $product->slug = Str::slug($product->name).'-'.$product->id;
            $product->save();
        }

        if ($this->image) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $product->image = $this->image->store('products', 'public');
        }

        $product->save();

        if (! array_key_exists($product->category, FurEver::categories())) {
            $this->existingCategory = $product->category;
        } else {
            $this->existingCategory = null;
        }

        $this->resetForm();
        $this->dispatch('notify', message: 'Product saved successfully.');
    }

    public function edit(int $productId): void
    {
        $product = Product::query()->findOrFail($productId);
        $this->productId = $product->id;
        $this->name = $product->name;
        $this->category = $product->category;
        $this->description = $product->description;
        $this->price = (string) $product->price;
        $this->stock = (string) $product->stock;
        $this->is_featured = $product->is_featured;
        $this->existingImage = $product->image;
        $this->existingCategory = $product->category;
        $this->image = null;
    }

    public function delete(int $productId): void
    {
        $product = Product::query()->findOrFail($productId);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        if ($this->productId === $productId) {
            $this->resetForm();
        }

        $this->dispatch('notify', message: 'Product deleted.', type: 'error');
    }

    public function resetForm(): void
    {
        $this->reset(['productId', 'name', 'description', 'price', 'image', 'existingImage', 'existingCategory']);
        $this->category = 'dogs';
        $this->stock = '0';
        $this->is_featured = false;
    }

    public function render()
    {
        return view('livewire.admin.product-manager', [
            'products' => Product::query()
                ->when($this->search, fn ($query) => $query->where('name', 'like', '%'.$this->search.'%'))
                ->latest()
                ->paginate(8),
            'categories' => FurEver::categories(),
        ])->layout('layouts.admin', [
            'title' => 'Manage Products | FurEver',
        ]);
    }
}
