<?php

namespace App\Support;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class ProductCatalogBackup
{
    public const DISK = 'local';
    public const PATH = 'backups/products.json';

    public static function sync(): void
    {
        $payload = Product::query()
            ->orderBy('id')
            ->get([
                'name',
                'slug',
                'category',
                'description',
                'price',
                'image',
                'stock',
                'is_featured',
            ])
            ->map(fn (Product $product) => [
                'name' => $product->name,
                'slug' => $product->slug,
                'category' => $product->category,
                'description' => $product->description,
                'price' => (string) $product->price,
                'image' => $product->image,
                'stock' => $product->stock,
                'is_featured' => $product->is_featured,
            ])
            ->values()
            ->all();

        Storage::disk(self::DISK)->put(self::PATH, json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }

    public static function load(): Collection
    {
        if (! Storage::disk(self::DISK)->exists(self::PATH)) {
            return collect();
        }

        $decoded = json_decode(Storage::disk(self::DISK)->get(self::PATH), true);

        return collect(is_array($decoded) ? $decoded : []);
    }
}
